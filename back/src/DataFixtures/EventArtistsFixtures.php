<?php

namespace App\DataFixtures;

use App\Entity\Event;
use App\Entity\Artist;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

class EventArtistsFixtures extends Fixture implements FixtureGroupInterface
{
    public static function getGroups(): array
    {
        return ['event_artist_group'];
    }
    
    public function load(ObjectManager $manager): void
    {
        // On récupère les événements
        $events = $manager->getRepository(Event::class)->findAll();

        // On récupère les artistes
        $artists = $manager->getRepository(Artist::class)->findAll();

        // On associe un artiste à un événement
        foreach ($events as $event) {
            $randomArtist = $artists[array_rand($artists)];
            $event->addArtist($randomArtist); // Utilise la méthode addArtist de l'entité Event
            $manager->persist($event);
        }
        $manager->flush();
    }
}
