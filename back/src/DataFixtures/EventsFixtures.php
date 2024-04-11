<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Event;
use App\Entity\Scene;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

class EventsFixtures extends Fixture implements FixtureGroupInterface
{
    public static function getGroups(): array
    {
        return ['group_event'];
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // Récupération des références aux scènes.
        $scenes = $manager->getRepository(Scene::class)->findAll(); // récupération de toutes les scènes

        // Création de 5 événements
        for ($i = 0; $i < 5; $i++) {
            $event = new Event();
            $event->setTitle($faker->sentence);
            $event->setDescription($faker->paragraph);
            $event->setDateTime(new \DateTimeImmutable());
            $event->setPoster($faker->imageUrl());
            $event->setPrice($faker->randomFloat(2, 0, 100));
            $event->setSlug($faker->slug);

            // Associer une scène au hasard
            $scene = $faker->randomElement($scenes);

            $event->setScene($scene);
            $manager->persist($event);
        }
        $manager->flush();
    }
}
