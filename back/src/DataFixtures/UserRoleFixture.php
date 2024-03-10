<?php

namespace App\DataFixtures;

use App\Entity\Role;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

class UserRoleFixture extends Fixture implements FixtureGroupInterface
{
    public static function getGroups(): array
    {
        return ['user_role_group'];
    }

    public function load(ObjectManager $manager): void
    {
         // Récupère tous les rôles
         $roles = $manager->getRepository(Role::class)->findAll();
        
         // Récupère tous les utilisateurs
         $users = $manager->getRepository(User::class)->findAll();

         foreach ($users as $user) {
             // Obtenir un rôle aléatoire
             $randomRole = $roles[array_rand($roles)];
             $user->addRole($randomRole); // Utilise la méthode addRole de l'entité User
             $manager->persist($user); // Persiste l'utilisateur
         }
 
         $manager->flush(); 
    }
}
