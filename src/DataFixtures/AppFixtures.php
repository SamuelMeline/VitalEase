<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Créer 3 utilisateurs de base
        for ($i = 0; $i < 3; $i++) {
            $user = new User();
            $user->setEmail('user' . $i . '@example.com');
            $user->setRoles(['ROLE_USER']);
            $user->setPassword('password123');
            $manager->persist($user);
        }

        $manager->flush();
    }
}
