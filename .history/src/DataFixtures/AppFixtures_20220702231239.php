<?php

namespace App\DataFixtures;


use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    // public function __construct(UserPasswordHasherInterface $encoder)
    // {
    //     $this->encoder = $encoder;
    // }

    public function load(ObjectManager $manager): void
    {
       



        // $manager->flush();
    }
}
