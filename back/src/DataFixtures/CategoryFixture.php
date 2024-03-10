<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

class CategoryFixture extends Fixture implements FixtureGroupInterface
{
    public static function getGroups(): array
    {
        return ['group_category'];
    }

    public function load(ObjectManager $manager): void
    {
        // On ne veut que 2 catégories
        $categories = ['Stand-Up', 'Musique'];

        foreach ($categories as $categoryName) {
            // Vérifie si la catégorie existe déjà
            if ($manager->getRepository(Category::class)->findOneBy(['categoryName' => $categoryName]) === null) {
                $category = new Category();
                $category->setCategoryName($categoryName);
                $manager->persist($category);
            }
        }
        $manager->flush();
    }
}
