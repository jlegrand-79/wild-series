<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    const PROGRAMS = [
        [
            'title' => 'House of the Dragon',
            'synopsys' => "200 ans avant les événements de Game Of Thrones, retour sur les origines de la Maison Targaryen avec le roi Viserys I Targaryen (Paddy Considine), le cinquième roi des sept royaumes. Il a été choisi pour succéder à son grand-père Jaehaerys Targaryen.
        La Princesse Rhaenyra Targaryen (Emma D'Arcy) est la première née du Roi Viserys. Elle est dragonnière et souhaite devenir la première Reine.
        Le Prince Daemon Targaryen (Matt Smith) est l’héritier du trône de fer, il est le plus jeune frère du Roi Visery. C’est un dragonnier expérimenté et un guerrier redoutable.
        Ser Otto Hightower (Rhys Ifans) est le bras droit du Roi et rival du Prince Daemon.
        Lady Alicent Hightower (Olivia Cooke) est la fille de Ser Otto Hightower, et fait partie du cercle restreint du Roi. C’est la femme la plus avenante des Sept Royaumes.
        Lord Corlys Velaryon (Steve Toussaint) est connu comme le Serpent de Mer, il est à la tête de la maison Velaryon et le plus fameux marin de Westeros.
        La Princesse Rhaenys Velaryon (Eve Best) est une dragonnière et la femme de Lord Corlys. Connue comme la Reine qui ne l’a jamais été, elle est la cousine du Roi Viserys.
        Ser Criston Cole (Fabien Frankel) est un épéiste expérimenté de la région des Marches de Dorne. Il est le fils du Seigneur de Blackhaven.
        Mysaria (Sonoya Mizuno) est une alliée du Prince Daemon.",
            'poster' => 'https://pictures.betaseries.com/fonds/poster/b70ba80957707c986601c467a5e38929.jpg',
            'category' => 'category_Action',
        ],
        [
            'title' => 'Mercredi',
            'synopsys' => "A présent étudiante à la singulière Nevermore Academy, Wednesday Addams tente de s'adapter auprès des autres élèves tout en enquêtant à la suite d'une série de meurtres qui terrorise la ville...",
            'poster' => 'https://pictures.betaseries.com/fonds/poster/b5dc9ae24c0763d09c791041f4db677c.jpg',
            'category' => 'category_Fantastique',
        ],

        [
            'title' => 'Le Seigneur des anneaux : Les Anneaux de pouvoir',
            'synopsys' => "L'histoire se déroule sept mille ans avant les événements racontés dans Le Hobbit.
            La paix semble revenue après que Galadriel ait vaincu Morgoth. Mais Sauron prépare sa vengeance aux quatre coins de la Terre du Milieu.
            Des profondeurs les plus sombres des Monts Brumeux aux forêts majestueuses de la capitale Elfique de Lindon, à l’île royaume de Númenor et jusqu’aux confins les plus éloignés du monde, ces royaumes et personnages bâtiront des légendes qui continueront d’exister bien longtemps après leur mort.",
            'poster' => 'https://pictures.betaseries.com/fonds/poster/c75463cd02a6176af2cf74da550a03fc.jpg',
            'category' => 'category_Aventure',
        ],
        [
            'title' => 'Star Wars: Tales of the Jedi',
            'synopsys' => "Cette série événement en six épisodes met en scène des Jedi à l'ère de la prélogie. On suivra ainsi la vie très différente de deux d'entre eux, Ahsoka Tano et le comte Dooku. Chacun sera mis à l'épreuve et devra faire des choix qui définiront sa destinée.",
            'poster' => 'https://pictures.betaseries.com/fonds/poster/dc121ccf3db8d5625ff404825e5d9e0f.jpg',
            'category' => 'category_Animation',
        ],
        [
            'title' => 'Stranger Things',
            'synopsys' => "Novembre 1983, dans la ville de Hawkins dans l’Indiana, Will, Mike, Dustin et Lucas découvrent une jeune fille perdue dans la forêt, Eleven (Millie Bobby Brown). Cette mystérieuse enfant semble avoir des pouvoirs insoupçonnés. Cobaye pour la science, Eleven a un lien particulier avec l’Upside Down, un monde caché où règnent des créatures violentes et qui semble envahir la réalité. Alors qu’Eleven essaye de devenir une enfant normale, elle se confronte à la réalité avec l’amour, l’amitié, choses qu’elle n’a pas connues quand elle était entourée de scientifiques.
            L’Upside Down est un univers qui essaye de plus en plus d’envahir le monde réel. Les 4 amis, aidés par Eleven, affrontent les différentes menaces qui se réveillent. Le passé d’Eleven et les complots scientifiques vont progressivement peser sur les quatre amis. Ils sont aidés par leur famille dont la mère de Will, Joyce (Winona Ryder), et le shérif de la ville, Hopper (David Harbour). D’abord réticent à l’histoire autour d’Eleven, il se lie d’amitié avec le groupe et deviendra un allié de poids. D’autres enfants rencontrés au fil des saisons vont aussi rejoindre le groupe qui partageront ensemble le grand secret autour de l’existence de ce monde terrifiant. Ils savent qu’une menace immense pèse sur la ville, si ce n’est le monde. Hawkins est de plus en plus en danger et l’Upside Down gagne en puissance.",
            'poster' => 'https://pictures.betaseries.com/fonds/poster/296076ac6295bd60005737858fd0476c.jpg',
            'category' => 'category_Horreur',
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::PROGRAMS as $key => $categoryName) {

            $program = new Program();
            $program->setTitle(self::PROGRAMS[$key]['title']);
            $program->setSynopsys(self::PROGRAMS[$key]['synopsys']);
            $program->setPoster(self::PROGRAMS[$key]['poster']);
            $program->setCategory($this->getReference(self::PROGRAMS[$key]['category']));
            $manager->persist($program);
            $manager->flush();
        }
    }

    public function getDependencies()
    {
        // Tu retournes ici toutes les classes de fixtures dont ProgramFixtures dépend
        return [
            CategoryFixtures::class,
        ];
    }
}
