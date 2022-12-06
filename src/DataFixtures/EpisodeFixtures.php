<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

use Faker\Factory;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        $nbOfPrograms = count(ProgramFixtures::PROGRAMS);

        for ($i = 0; $i < $nbOfPrograms; $i++) {
            for ($j = 1; $j < 6; $j++) {
                for ($k = 1; $k < 11; $k++) {
                    $episode = new Episode();
                    $episode->setNumber($k);
                    $episode->setTitle($faker->text(50));
                    $episode->setSynopsis($faker->paragraphs(3, true));
                    $episode->setSeason($this->getReference('season_' . $j . $i));
                    $manager->persist($episode);
                }
            }
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            SeasonFixtures::class,
        ];
    }
}
