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
       



        // $manager->flush();
    }
}
