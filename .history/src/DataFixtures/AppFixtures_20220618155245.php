<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Menu;
use App\Entity\Type;
use App\Entity\Client;
use App\Entity\Product;
use App\Entity\Gestionnaire;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($g = 0; $g < 10; $g++) {
            $gestionnaire = new Gestionnaire();
            $hash = $this->encoder->hashPassword($gestionnaire, 'passer');
            $gestionnaire->setNom($faker->lastname())
                ->setPrenom($faker->firstname())
                ->setEmail($faker->email())
                ->setPassword($hash);
            $manager->persist($gestionnaire);

            for ($i = 0; $i < 5; $i++) {
                $product = new Product();
                $type = new Type();
                $type->setLibelle($faker->randomElement(['COMPLÉMENT', 'RESISTANCE', 'BOISSON']));
                $manager->persist($type);
                $product->setLibelle($faker->randomElement(['FRITES', 'BURGER ROYAL', 'COCA COLA']))
                    ->setPrix($faker->randomDigitNotNull(2, 250, 5000))
                    ->setPhoto($faker->imageUrl(100, 100, 'food'))
                    ->setGestionnaire($gestionnaire)
                    ->setType($type);
                $manager->persist($product);
            }

            for ($i = 0; $i < 5; $i++) {
                $menu = new Menu();

                $menu->setLibelle($faker->randomElement(['BIG MENU', 'FAMILIAL ROYAL', 'NOPALÉ']))
                    ->setPrix($faker->randomDigitNotNull(2, 250, 3000))
                    ->setPhoto($faker->imageUrl(100, 100, 'food'))
                    ->setGestionnaire($gestionnaire);
                $manager->persist($menu);
            }


            for ($i = 0; $i < 2; $i++) {
                $client = new Client();
                $hash = $this->encoder->hashPassword($client, 'passer');

                $client->setNom($faker->lastname())
                    ->setPrenom($faker->firstname())
                    ->setEmail($faker->email())
                    ->setPassword($hash)
                    ->setTelephone($faker->phoneNumber);
                $manager->persist($client);
            }
        }



        $manager->flush();
    }
}
