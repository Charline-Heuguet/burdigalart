<?php 

namespace App\Tests;

use App\Entity\Artist;
use App\Entity\Event;
use App\Entity\Scene;
use PHPUnit\Framework\TestCase;

class SlugUpdateTest extends TestCase
{
    /**
     * @dataProvider entityProvider
     */
    public function testUpdateSlug($entity, callable $setNameCallback, $expectedSlug)
    {
        // Utilisation du callback pour configurer le nom
        $setNameCallback($entity, 'Jean Dupont');
        $entity->updateSlug();

        $this->assertEquals($expectedSlug, $entity->getSlug(), 'The slug should be correctly generated based on the name');
    }

    public function entityProvider()
    {
        return [
            [new Artist(), function($entity, $name) { $entity->setArtistName($name); }, 'jean-dupont'],
            [new Event(), function($entity, $name) { $entity->setTitle($name); }, 'jean-dupont'],
            [new Scene(), function($entity, $name) { $entity->setName($name); }, 'jean-dupont']
        ];
    }
}
