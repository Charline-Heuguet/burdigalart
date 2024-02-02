<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class CategoryFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // On ne veut que 2 catégories
        $categories = ['Stand-Up', 'Musique'];

        foreach ($categories as $categoryName) {
            $category = new Category();
            $category->setCategoryName($categoryName);
            $manager->persist($category);
        }
        $manager->flush();
    }
}
