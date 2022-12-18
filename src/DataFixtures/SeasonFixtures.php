<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

//Tout d'abord nous ajoutons la classe Factory de FakerPhp
use Faker\Factory;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        //Puis ici nous demandons à la Factory de nous fournir un Faker
        $faker = Factory::create();

        /**
         * L'objet $faker que tu récupères est l'outil qui va te permettre 
         * de te générer toutes les données que tu souhaites
         */

        $nbOfPrograms = count(ProgramFixtures::PROGRAMS);

        for ($i = 0; $i < $nbOfPrograms; $i++) {
            for ($j = 1; $j < 6; $j++) {
                $season = new Season();
                //Ce Faker va nous permettre d'alimenter l'instance de Season que l'on souhaite ajouter en base
                $season->setNumber($j);
                $season->setYear($faker->year());
                $season->setDescription($faker->text(255));
                $season->setProgram($this->getReference('program_' . $i));
                $manager->persist($season);
                $this->addReference('season_' . $j . $i, $season);
            }

            // Autre version pour parer les messages de GrumPHP vs objet Program
            // $program = $this->getReference('program_' . $faker->numberBetween(0, 24));
            // if ($program instanceof Program) {
            //     $season->setProgram($program);
            // }
            // $manager->persist($season);

        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ProgramFixtures::class,
        ];
    }
}
