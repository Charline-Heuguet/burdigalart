<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UserFixture extends Fixture implements FixtureGroupInterface
{
    public static function getGroups(): array
    {
        return ['group_user'];
    }
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // Tableau des rôles disponibles
        $roles = [
            ['ROLE_USER'],
            ['ROLE_ARTISTE'],
            ['ROLE_SCENE'],
        ];

        for ($i = 0; $i < 5; $i++) {
            $user = new User();
            $user->setName($faker->name);
            $user->setFirstname($faker->firstName);
            $user->setEmail($faker->email);

            // Hachage du mot de passe
            $plaintextPassword = 'password123';
            $hashedPassword = $this->passwordHasher->hashPassword($user, $plaintextPassword);
            $user->setPassword($hashedPassword);

            // Attribuer un rôle aléatoire à l'utilisateur
            $user->setRoles($faker->randomElement($roles));

            $user->setPicture($faker->imageUrl(640, 480, 'cats'));
            $manager->persist($user);
        }

        $manager->flush();
    }
}
