<?php

namespace App\DataFixtures;

use App\Entity\Chapter;
use App\Entity\Course;
use App\Entity\Language;
use App\Entity\Level;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as FakerFactory;

class CourseFixtures extends Fixture implements DependentFixtureInterface
{
    public const COURSE_REFERENCE_TAG = 'course-';
    public const NB_COURSE = 10;
        public function load(ObjectManager $manager): void
        {
            $faker = FakerFactory::create('fr_FR');
    
            for ($i = 0; $i < self::NB_COURSE; $i++) {
                $course = new Course();
                $course->setCourseTitle($faker->title);
                $course->setCourseSynopsis($faker->sentence);
                $course->setCourseEstimationTime($faker->numerify);
                $course->setCourseImg($faker->imageUrl);
                $course->setCourseDate($faker->dateTimeThisYear);
                $course->setCoursesCreated($faker->numerify);
                $course->setIdLevel($this->getReference(LevelFixtures::LEVEL_REFERENCE_TAG . rand(0, LevelFixtures::NB_LEVEL - 1), Level::class));
                $course->setIdLanguage($this->getReference(LanguageFixtures::LANGUAGE_REFERENCE_TAG . rand(0, LanguageFixtures::NB_LANGUAGE - 1), Language::class));
                $course->setChapter($this->getReference(ChapterFixtures::CHAPTER_REFERENCE_TAG . rand(0, ChapterFixtures::NB_CHAPTER - 1), Chapter::class));
                $manager->persist($course);
                $this->addReference(self::COURSE_REFERENCE_TAG . $i, $course);
            }
            $manager->flush();
    }
    public function getDependencies():array
    {
        return [
            LevelFixtures::class,
            LanguageFixtures::class,
            ChapterFixtures::class
            
        ];
    }

}
