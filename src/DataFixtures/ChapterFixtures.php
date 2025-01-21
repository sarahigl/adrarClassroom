<?php

namespace App\DataFixtures;

use App\Entity\Chapter;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as FakerFactory;

class ChapterFixtures extends Fixture //implements DependentFixtureInterface
{
    public const CHAPTER_REFERENCE_TAG = 'chapter-';
    public const NB_CHAPTER = 5;
        public function load(ObjectManager $manager): void
        {
            $faker = FakerFactory::create('fr_FR');
    
            for ($i = 0; $i < self::NB_CHAPTER; $i++) {
                $chapter = new Chapter();
                $chapter->setChapterTitle($faker->title);
                $chapter->setChapterPosition($faker->numberBetween(0,6));
                $chapter->setchapterContent($faker->text(400));
                $manager->persist($chapter);
                $this->addReference(self::CHAPTER_REFERENCE_TAG . $i, object: $chapter);
            }
            $manager->flush();
    }
    // public function getDependencies():array
    // {
    //     return [
    //         CourseFixtures::class
    //     ];
    // }
}
