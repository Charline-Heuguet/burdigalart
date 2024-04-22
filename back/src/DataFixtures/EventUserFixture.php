<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Event;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

class EventUserFixture extends Fixture implements FixtureGroupInterface
{

    public static function getGroups(): array
    {
        return ['event_user_group'];
    }

    public function load(ObjectManager $manager): void
    {
        // Récupère tous les utilisateurs
        $users = $manager->getRepository(User::class)->findAll();

        // Récupère tous les événements
        $events = $manager->getRepository(Event::class)->findAll();

        foreach ($users as $user) {
            // Obtenir un événement aléatoire
            $randomEvent = $events[array_rand($events)];
            $user->addEvent($randomEvent); // Utilise la méthode addEvent de l'entité User
            $manager->persist($user); // Persiste l'utilisateur
        }

        $manager->flush();
    }
}
