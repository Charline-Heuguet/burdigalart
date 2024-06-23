<?php

namespace App\Tests\Entity;

use App\Entity\Artist;
use PHPUnit\Framework\TestCase;

class ArtistTest extends TestCase
{
    public function testUpdateSlug()
    {
        $artist = new Artist();
        $artist->setArtistName('Jean Dupont');
        $artist->updateSlug();

        echo "Generated slug: " . $artist->getSlug() . "\n";
        
        $this->assertEquals('jean-dupont', $artist->getSlug(), 'Slug should be correctly generated');
    }
}
