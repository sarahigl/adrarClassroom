<?php

namespace App\DataFixtures;

use App\Entity\Level;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as FakerFactory;

class LevelFixtures extends Fixture
{
    public const LEVEL_REFERENCE_TAG = 'level-';
    public const NB_LEVEL = 3;  // Nous avons 3 niveaux différents

    public function load(ObjectManager $manager): void
    {
        $faker = FakerFactory::create('fr_FR');

        // Niveaux à assigner
        $levels = ['easy', 'intermediate', 'hard'];

        foreach ($levels as $i => $levelLabel) {
            $level = new Level();
            $level->setLabel($levelLabel); 
            $manager->persist($level);
            $this->addReference(self::LEVEL_REFERENCE_TAG . $i, $level);
        }

        $manager->flush();
    }

}
