<?php

namespace App\DataFixtures;

use App\Entity\Review;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use App\DataFixtures\UserFixtures;  
use Faker\Factory as FakerFactory;

class ReviewFixtures extends Fixture implements DependentFixtureInterface
{
    
    public const REVIEW_REFERENCE_TAG = 'review-';
    public const NB_REVIEW = 5;
        public function load(ObjectManager $manager): void
        {
            $faker = FakerFactory::create('fr_FR');
    
            for ($i = 0; $i < self::NB_REVIEW; $i++) {
                $review = new Review();
                $review->setReviewContent($faker->sentence);
                $review->setIdUser($this->getReference(UserFixtures::USER_REFERENCE_TAG . rand(0, UserFixtures::NB_USER - 1), User::class));
                $manager->persist($review);
                $this->addReference(self::REVIEW_REFERENCE_TAG . $i, $review);
            }
            $manager->flush();
    }
    public function getDependencies():array
    {
        return [
            UserFixtures::class
        ];
    }
}
