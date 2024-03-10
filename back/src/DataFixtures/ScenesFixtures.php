<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Scene;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ScenesFixtures extends Fixture implements FixtureGroupInterface, DependentFixtureInterface
{
    public static function getGroups(): array
    {
        return ['group_scene', 'group_user'];
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // Récupération des utilisateurs
        $users = $manager->getRepository(User::class)->findAll();

        // Nombre de scènes à créer
        $numScenes = 10;

        for ($i = 0; $i < $numScenes; $i++) {
            $scene = new Scene();
            $scene->setSiret($faker->numerify('###'));
            $scene->setBanner($faker->imageUrl());
            $scene->setName($faker->company);
            $scene->setAddress($faker->streetAddress);
            $scene->setZipcode($faker->postcode);
            $scene->setTown($faker->city);
            $scene->setPhoneNumber($faker->phoneNumber);
            $scene->setCapacity($faker->numberBetween(50, 1000));
            $scene->setInstagram($faker->userName);
            $scene->setFacebook($faker->userName);
            $scene->setEventTitle($faker->sentence);
            $scene->setEventDescription($faker->paragraph);
            // ne pas utiliser faker pour la date
            $scene->setEventDateTime(new \DateTimeImmutable());
            $scene->setEventPoster($faker->imageUrl());
            $scene->setEventPrice($faker->randomFloat(2, 0, 100));
            $scene->setSubscription($faker->boolean);
            $scene->setSlug($faker->slug);

            // Associer un utilisateur au hasard
            $user = $faker->randomElement($users);
            $scene->setUser($user);

            $manager->persist($scene);
        }

        $manager->flush();
    }

    // GetDependencies permet de définir l'ordre de création des fixtures
    public function getDependencies(): array
    {
        return [
            UserFixture::class,
        ];
    }
}
