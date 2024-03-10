<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Style;
use App\Entity\Artist;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ArtistFixtures extends Fixture implements FixtureGroupInterface, DependentFixtureInterface
{
    public static function getGroups(): array
    {
        return ['group_artist', 'group_category', 'group_style', 'group_user'];
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        // Récupération des références aux catégories, styles et utilisateurs
        $categories = $manager->getRepository(Category::class)->findAll();
        $styles = $manager->getRepository(Style::class)->findAll();
        $users = $manager->getRepository(User::class)->findAll(); // Récupération des utilisateurs


        for ($i = 0; $i < 5; $i++) {
            $artist = new Artist();
            $artist->setArtistName($faker->name);
            $artist->setOfficialPhoto($faker->imageUrl());
            $artist->setLinkExcerpt($faker->sentence);
            $artist->setInstagram($faker->userName);
            $artist->setFacebook($faker->userName);
            $artist->setShowPhoto($faker->imageUrl());
            $artist->setShowTitle($faker->sentence);
            $artist->setShowDescription($faker->paragraph);
            $artist->setSlug($faker->slug);

            // Associer une catégorie, un style et un utilisateur au hasard
            $category = $faker->randomElement($categories);
            $style = $faker->randomElement($styles);
            $user = $faker->randomElement($users); // Sélectionne un utilisateur au hasard

            $artist->setCategory($category);
            $artist->setStyle($style);
            $artist->setUser($user); // Associe l'utilisateur à l'artiste

            $manager->persist($artist);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CategoryFixture::class,
            StyleFixture::class,
            UserFixture::class,
        ];
    }
    
}
