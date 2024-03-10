<?php

namespace App\DataFixtures;

use App\Entity\Scene;
use App\Entity\Artist;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

class ArtistSceneFixtures extends Fixture implements FixtureGroupInterface
{
    public static function getGroups(): array
    {
        return ['artist_scene_group'];
    }

    public function load(ObjectManager $manager): void
    {
        // Récupère tous les artistes
        $artists = $manager->getRepository(Artist::class)->findAll();

        // Récupère toutes les scènes
        $scenes = $manager->getRepository(Scene::class)->findAll();

        foreach ($artists as $artist) {
            // Obtenir une scène aléatoire
            $randomScene = $scenes[array_rand($scenes)];
            $artist->addScene($randomScene); // Utilise la méthode addScene de l'entité Artist
            $manager->persist($artist); // Persiste l'artiste
        }

        $manager->flush();
    }
}