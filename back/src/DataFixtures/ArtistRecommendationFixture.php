<?php

namespace App\DataFixtures;

use App\Entity\Artist;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

class ArtistRecommendationFixture extends Fixture  implements FixtureGroupInterface
{
    public static function getGroups(): array
    {
        return ['artist_recommendations'];
    }

    public function load(ObjectManager $manager)
    {
        // Récupère tous les artistes
        $artists = $manager->getRepository(Artist::class)->findAll();

        // Assure-toi d'avoir assez d'artistes pour créer des recommandations
        if (count($artists) > 1) {
            foreach ($artists as $artist) {
                // ici, chaque artiste recommande l'artiste suivant dans la liste
                $nextIndex = (array_search($artist, $artists) + 1) % count($artists);
                $artistRecommended = $artists[$nextIndex];

                // Vérifie si la recommandation n'existe pas déjà
                if (!$artist->getArtistRecommended()->contains($artistRecommended)) {
                    $artist->addArtistRecommended($artistRecommended);

                    // Persiste les changements
                    $manager->persist($artist);
                }
            }

            // Flush une fois toutes les recommandations ajoutées
            $manager->flush();
        }
    }
}
