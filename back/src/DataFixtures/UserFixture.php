<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UserFixture extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setName($faker->name);
            $user->setFirstname($faker->firstName);
            $user->setEmail($faker->email);
            
            // Hachage du mot de passe
            $plaintextPassword = 'password123';
            $hashedPassword = $this->passwordHasher->hashPassword($user, $plaintextPassword);
            $user->setPassword($hashedPassword);

            $user->setAvatar($faker->imageUrl(640, 480, 'cats')); // Just as an example
            $manager->persist($user);
        }

        $manager->flush();
    }
}