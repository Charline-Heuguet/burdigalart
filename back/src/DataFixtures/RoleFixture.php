<?php

namespace App\DataFixtures;

use App\Entity\Role;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class RoleFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // On ne veut que 3 rôles
        $roles = ['Gérant', 'Artiste', 'Public'];

        foreach ($roles as $roleName) {
            $role = new Role();
            $role->setRoleName($roleName);
            $manager->persist($role);
        }
        $manager->flush();
    }
}
