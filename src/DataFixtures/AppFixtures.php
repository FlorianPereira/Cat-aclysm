<?php

namespace App\DataFixtures;

use App\Entity\Playlist;
use App\Factory\PlaylistFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

//  Adding entries via console :
//  php bin/console doctrine:fixtures:load
class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        PlaylistFactory::createMany(25);
    }
}
