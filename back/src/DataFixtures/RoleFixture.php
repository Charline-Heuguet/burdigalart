<?php

namespace App\DataFixtures;

use App\Entity\Role;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

class RoleFixture extends Fixture implements FixtureGroupInterface
{
    public static function getGroups(): array
    {
        return ['group_role'];
    }
    
    public function load(ObjectManager $manager): void
    {
        // On ne veut que 3 rôles
        $roles = ['Gérant', 'Artiste', 'Spectateur'];

        foreach ($roles as $roleName) {
            // Vérifie si le rôle existe déjà
            if ($manager->getRepository(Role::class)->findOneBy(['roleName' => $roleName]) === null) {
                $role = new Role();
                $role->setRoleName($roleName);
                $manager->persist($role);
            }
        }
        $manager->flush();
    }
}
