<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Gestionnaire;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(UserPasswordHasherInterface $encoder){
        $this->encoder = $encoder ;
    }
    
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        
        for ($g=0; $g < 10; $g++) { 
            $gestionnaire = new Gestionnaire();
            $gestionnaire->setNom($faker->lastname())
                         ->setPrenom($faker->firstname())
                         ->setEmail($faker->email())
                        ->setPassword($hash);
            
        }

        $manager->flush();
    }
}
