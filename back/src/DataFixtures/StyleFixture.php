<?php

namespace App\DataFixtures;

use App\Entity\Style;
use App\Entity\Category;
use App\DataFixtures\CategoryFixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class StyleFixture extends Fixture implements FixtureGroupInterface, DependentFixtureInterface
{
    public static function getGroups(): array
    {
        return ['group_style', 'group_category'];
    }

    public function load(ObjectManager $manager): void
    {
        // Récupèration des catégories par leur nom
        $categoryStandUp = $manager->getRepository(Category::class)->findOneBy(['categoryName' => 'Stand-Up']);
        $categoryMusique = $manager->getRepository(Category::class)->findOneBy(['categoryName' => 'Musique']);

        // Pour les styles de 'Stand-Up'
        if ($categoryStandUp) {
            // Vérifie si le style existe déjà
            if ($manager->getRepository(Style::class)->findOneBy(['styleName' => 'Humour', 'category' => $categoryStandUp]) === null) {
                $styleHumour = new Style();
                $styleHumour->setStyleName('Humour');
                $styleHumour->setCategory($categoryStandUp);
                $manager->persist($styleHumour);
            }
        }

        // Pour les styles de 'Musique'
        if ($categoryMusique) {
            $stylesMusique = ['Rock', 'Jazz', 'Electro', 'Classique', 'Pop', 'Hip-Hop', 'Blues', 'Slam', 'Reggae', 'Country', 'Metal', 'Folk', 'Salsa', 'Indie', 'Funk'];
            
            foreach ($stylesMusique as $styleName) {
                // Vérifie si le style existe déjà
                if ($manager->getRepository(Style::class)->findOneBy(['styleName' => $styleName, 'category' => $categoryMusique]) === null) {
                    $style = new Style();
                    $style->setStyleName($styleName);
                    $style->setCategory($categoryMusique);
                    $manager->persist($style);
                }
            }
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CategoryFixture::class,
        ];
    }
}
