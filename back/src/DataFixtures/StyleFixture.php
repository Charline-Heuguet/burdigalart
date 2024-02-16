<?php

namespace App\DataFixtures;

use App\Entity\Style;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class StyleFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // L'ID 3 est pour Stand-Up et l'ID 4 pour Musique
        $categoryStandUp = $manager->getRepository(Category::class)->find(5);
        $categoryMusique = $manager->getRepository(Category::class)->find(6);

        // Assure-toi que les catégories existent bien
        if ($categoryStandUp) {
            $styleHumour = new Style();
            $styleHumour->setStyleName('Humour');
            $styleHumour->setCategory($categoryStandUp);
            $manager->persist($styleHumour);
        }

        if ($categoryMusique) {
            // ajout des styles de musique
            $stylesMusique = ['Rock', 'Jazz', 'Electro', 'Classique', 'Pop', 'Jazz', 'Hip-Hop', 'Blues', 'Slam', 'Reggae', 'Country', 'Metal', 'Folk', 'Salsa', 'Indie', 'Funk']; 

            foreach ($stylesMusique as $styleName) {
                $style = new Style();
                $style->setStyleName($styleName);
                $style->setCategory($categoryMusique);
                $manager->persist($style);
            }
        }
        $manager->flush();
    }
}
