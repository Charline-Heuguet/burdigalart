<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class UserFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        // créer 10 utilisateurs
        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setName($faker->name);
            $user->setFirstname($faker->firstName);
            $user->setEmail($faker->email);
            $user->setPassword($faker->password);
            $user->setAvatar($faker->imageUrl($width = 640, $height = 480, 'cats')); // Just as an example
            $manager->persist($user);
        }

        $manager->flush();
    }
}
