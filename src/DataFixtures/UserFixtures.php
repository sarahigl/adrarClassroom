<?php

namespace App\DataFixtures;

use App\Entity\Chapter;
use App\Entity\Review;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
   
        public const USER_REFERENCE_TAG = 'user-';
        public const NB_USER = 3;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < self::NB_USER; $i++) {
            $user = new User();
            $user->setRoles(['ROLE_USER']);
            $user->setEmail($faker->unique()->safeEmail);
            $user->setUserName($faker->userName);
            $user->setLastnameUser($faker->lastName);
            // $user->($this->getReference(ReviewFixtures::REVIEW_REFERENCE_TAG . rand(0, ReviewFixtures::NB_REVIEW - 1), Review::class));
            $user->addChapter($this->getReference(ChapterFixtures::CHAPTER_REFERENCE_TAG . rand(0, ChapterFixtures::NB_CHAPTER - 1), Chapter::class));
            $password = $faker->password(10);
            $user->setPassword(password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]));
            $manager->persist($user);
            $this->addReference(self::USER_REFERENCE_TAG . $i, $user);
        }
        $manager->flush();
    }
    public function getDependencies():array
    {
        return [
            ChapterFixtures::class
        ];
    }
    
}
