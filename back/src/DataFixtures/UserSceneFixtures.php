<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Scene;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

class UserSceneFixtures extends Fixture implements FixtureGroupInterface
{
    public static function getGroups(): array
    {
        return ['user_scene_group'];
    }

    public function load(ObjectManager $manager): void
    {
        // Récupère tous les utilisateurs
        $users = $manager->getRepository(User::class)->findAll();

        // Récupère toutes les scènes
        $scenes = $manager->getRepository(Scene::class)->findAll();

        foreach ($users as $user) {
            // Obtenir une scène aléatoire
            $randomScene = $scenes[array_rand($scenes)];
            $user->addScene($randomScene); // Utilise la méthode addScene de l'entité User
            $manager->persist($user); // Persiste l'utilisateur
        }

        $manager->flush();
    }
}