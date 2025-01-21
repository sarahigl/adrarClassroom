<?php

namespace App\DataFixtures;

use App\Entity\Language;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory as FakerFactory;

class LanguageFixtures extends Fixture
{
    public const LANGUAGE_REFERENCE_TAG = 'language-';
    public const NB_LANGUAGE = 5;
        public function load(ObjectManager $manager): void
        {
        $programmingLanguages = [
            'PHP',
            'JavaScript',
            'Python',
            'Java',
            'C++',
            'Ruby',
            'Go',
            'Swift',
            'TypeScript',
            'Rust'
        ];

        $languagesToPersist = array_slice($programmingLanguages, 0, self::NB_LANGUAGE);

        foreach ($languagesToPersist as $i => $languageLabel) {
            $language = new Language();
            $language->setLanguageLabel($languageLabel); 
            $manager->persist($language);
            $this->addReference(self::LANGUAGE_REFERENCE_TAG . $i, $language); 
        }

        $manager->flush();
    }
}
