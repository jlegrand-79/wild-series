<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    const PROGRAMS = [
        [
            'title' => 'House of the Dragon',
            'synopsis' => "200 ans avant les événements de Game Of Thrones, retour sur les origines de la Maison Targaryen avec le roi Viserys I Targaryen (Paddy Considine), le cinquième roi des sept royaumes. Il a été choisi pour succéder à son grand-père Jaehaerys Targaryen.
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
            'synopsis' => "A présent étudiante à la singulière Nevermore Academy, Wednesday Addams tente de s'adapter auprès des autres élèves tout en enquêtant à la suite d'une série de meurtres qui terrorise la ville...",
            'poster' => 'https://pictures.betaseries.com/fonds/poster/b5dc9ae24c0763d09c791041f4db677c.jpg',
            'category' => 'category_Fantastique',
        ],

        [
            'title' => 'Le Seigneur des anneaux : Les Anneaux de pouvoir',
            'synopsis' => "L'histoire se déroule sept mille ans avant les événements racontés dans Le Hobbit.
            La paix semble revenue après que Galadriel ait vaincu Morgoth. Mais Sauron prépare sa vengeance aux quatre coins de la Terre du Milieu.
            Des profondeurs les plus sombres des Monts Brumeux aux forêts majestueuses de la capitale Elfique de Lindon, à l’île royaume de Númenor et jusqu’aux confins les plus éloignés du monde, ces royaumes et personnages bâtiront des légendes qui continueront d’exister bien longtemps après leur mort.",
            'poster' => 'https://pictures.betaseries.com/fonds/poster/c75463cd02a6176af2cf74da550a03fc.jpg',
            'category' => 'category_Aventure',
        ],
        [
            'title' => 'Star Wars: Tales of the Jedi',
            'synopsis' => "Cette série événement en six épisodes met en scène des Jedi à l'ère de la prélogie. On suivra ainsi la vie très différente de deux d'entre eux, Ahsoka Tano et le comte Dooku. Chacun sera mis à l'épreuve et devra faire des choix qui définiront sa destinée.",
            'poster' => 'https://pictures.betaseries.com/fonds/poster/dc121ccf3db8d5625ff404825e5d9e0f.jpg',
            'category' => 'category_Animation',
        ],
        [
            'title' => 'Stranger Things',
            'synopsis' => "Novembre 1983, dans la ville de Hawkins dans l’Indiana, Will, Mike, Dustin et Lucas découvrent une jeune fille perdue dans la forêt, Eleven (Millie Bobby Brown). Cette mystérieuse enfant semble avoir des pouvoirs insoupçonnés. Cobaye pour la science, Eleven a un lien particulier avec l’Upside Down, un monde caché où règnent des créatures violentes et qui semble envahir la réalité. Alors qu’Eleven essaye de devenir une enfant normale, elle se confronte à la réalité avec l’amour, l’amitié, choses qu’elle n’a pas connues quand elle était entourée de scientifiques.
            L’Upside Down est un univers qui essaye de plus en plus d’envahir le monde réel. Les 4 amis, aidés par Eleven, affrontent les différentes menaces qui se réveillent. Le passé d’Eleven et les complots scientifiques vont progressivement peser sur les quatre amis. Ils sont aidés par leur famille dont la mère de Will, Joyce (Winona Ryder), et le shérif de la ville, Hopper (David Harbour). D’abord réticent à l’histoire autour d’Eleven, il se lie d’amitié avec le groupe et deviendra un allié de poids. D’autres enfants rencontrés au fil des saisons vont aussi rejoindre le groupe qui partageront ensemble le grand secret autour de l’existence de ce monde terrifiant. Ils savent qu’une menace immense pèse sur la ville, si ce n’est le monde. Hawkins est de plus en plus en danger et l’Upside Down gagne en puissance.",
            'poster' => 'https://pictures.betaseries.com/fonds/poster/296076ac6295bd60005737858fd0476c.jpg',
            'category' => 'category_Horreur',
        ],

        [
            'title' => 'Time After Time',
            'synopsis' => "À Londres, alors que le XIXe siècle touche à sa fin, H.G. Wells présente à ses amis sa nouvelle invention : une machine à remonter dans le temps ! Mais Jack l'Éventreur s'est glissé dans l'assistance et profite d'un moment d'inattention pour se propulser à Manhattan à notre époque...",
            'poster' => 'https://pictures.betaseries.com/fonds/poster/d98a2ec39f1e783e36fd50cbf9d6089e.jpg',
            'category' => 'category_Action',
        ],
        [
            'title' => 'Zero Hour',
            'synopsis' => "En tant qu'éditeur du magazine \"Modern Skeptic\", Hank Foley consacre sa vie a débusquer des indices, élucider des mythes et même révéler au grand jour des complots. Mais lorsque sa jeune épouse est kidnappée pour d'obscures raisons, il s'embarque dans l'une des plus mystérieuses aventures de l'histoire de l'humanité. Une carte au trésor cachée dans une vieille montre qu'elle détenait pourrait mener à une découverte cataclysmique. Hank doit déchiffrer les énigmes, les symboles et autres secrets que renferment cette carte, avant que les réponses ne tombent entre de mauvaises mains. Avec l'aide de deux jeunes associés et d'un agent du FBI, il s'engage dans une véritable course contre la montre pour retrouver sa femme et sauver l'humanité d'une gigantesque conspiration.",
            'poster' => 'https://pictures.betaseries.com/fonds/poster/3ec5157df9340e22ec027d0431b799cb.jpg',
            'category' => 'category_Fantastique',
        ],
        [
            'title' => 'Pushing Daisies',
            'synopsis' => "Depuis l'enfance, Ned sait qu'il a un don un peu spécial. Il peut, très brièvement, ramener les gens à la vie. Adulte, il est devenu un fantastique pâtissier passant son temps libre à aider son seul ami, un détective privé, dans ses enquêtes. Ramener à la vie des victimes peut en effet être utile. Mais le jour où Ned ressuscite son amour d'enfance et que cette dernière reste \"vivante\", tout se complique : s'il venait à la toucher une nouvelle fois, elle partirait définitivement...",
            'poster' => 'https://pictures.betaseries.com/fonds/poster/25552ba4b9ca57648a10cce71dae0a4b.jpg',
            'category' => 'category_Fantastique',
        ],
        [
            'title' => 'Mairimashita! Iruma-kun',
            'synopsis' => "Suzuki Iruma a été vendu par ses parents, en manque d'argent, à un démon. Désormais, il devra se faire à sa nouvelle vie en tant que démon : il devra vivre comme eux, mais surtout, aller à l'école du monde des démons, où tout un tas de créatures diaboliques étudient !",
            'poster' => 'https://pictures.betaseries.com/fonds/poster/68cff01c06272f41f570e1b839ca7b1c.jpg',
            'category' => 'category_Animation',
        ],
        [
            'title' => 'Prenez garde à Batman !',
            'synopsis' => "La série prend place pendant les premières années de Bruce Wayne en tant que Batman après sa période initiale contre le crime organisé. Dans ces nouvelles aventures, Batman fait équipe avec Katana, sa nouvelle acolyte, experte en arts martiaux et Alfred Pennyworth, son majordome et ancien agent secret, pour combattre des criminels tels que Anarky, Professeur Pyg, Mr Crapaud, Kraken et Magpie.",
            'poster' => 'https://pictures.betaseries.com/fonds/poster/28b5ac81848721258d1d6ea565ee0ef7.jpg',
            'category' => 'category_Animation',
        ],
        [
            'title' => 'Mes chers disparus',
            'synopsis' => "Pour donner vie à la passion de son mari, José Portal, et couper court à une procédure d'expulsion administrative abusive qui menace de mettre les siens à la rue, Marianne Elbert décide de vendre la maison de ville décrépie et classée, propriété de sa famille depuis cinq générations. Devant le caveau familial où reposent ses ancêtres, elle lance un dérisoire appel à laide. Se produit alors un événement aussi soudain qu'inattendu : les fantômes de sa mère Brigitte, de sa grand-mère Marie et de son arrière-grand-père Alphonse se retrouvent au beau milieu du salon, tirés contre leur gré de leur repos éternel...",
            'poster' => 'https://pictures.betaseries.com/fonds/poster/24e77e0b495a7687ebec9513c64a403e.jpg',
            'category' => 'category_Fantastique',
        ],
        [
            'title' => 'SpieZ! - Nouvelle Génération',
            'synopsis' => "SpieZ - Nouvelle génération raconte l’histoire de trois frères, Tony, Marc et Lee et de leur soeur, Megan. Ces quatre collégiens ont été secrètement sélectionnés par le WOOHP - le World Office des Opérations Hautement Prioritaires - pour devenir des espions internationaux. Ensemble, ces jeunes agents secrets devront jongler entre leur quotidien de collégiens de 12 ans et des missions particulièrement intenses et réalistes.",
            'poster' => 'https://pictures.betaseries.com/fonds/poster/245551.jpg',
            'category' => 'category_Animation',
        ],
        [
            'title' => 'Gabby et la maison magique',
            'synopsis' => "Félins mignons, créations rigolotes et magie colorée ! Rejoignez Gabby, une passionnée de chats, et son acolyte Pandy pour une série d'aventures animées.",
            'poster' => 'https://pictures.betaseries.com/fonds/poster/727cff815e4ff216df5afec80c419274.jpg',
            'category' => 'category_Aventure',
        ],
        [
            'title' => 'Komi cherche ses mots',
            'synopsis' => "Dans un lycée regorgeant de personnalités pour le moins originales, Tadano aide sa camarade Komi, timide et peu sociable, à atteindre son objectif : se faire 100 amis.",
            'poster' => 'https://pictures.betaseries.com/fonds/poster/cd9657ec6ba353a2846651fbe19880c1.jpg',
            'category' => 'category_Animation',
        ],
        [
            'title' => 'Correspondant express',
            'synopsis' => "Un jeune homme de quinze ans, du nom de Brett Miller, vit à Perth (Australie-Occidentale) et trouve, un jour, dans sa chambre un passage menant à l'autre bout de la planète, à Galway, en Irlande. Il se retrouve ainsi dans une école, au Collège O'Keefe où il rencontre une jeune fille irlandaise de quatorze ans, Hannah O'Flaherty. Tous deux promettent de garder le secret du passage mais leurs proches se posent des questions... (Wikipedia)",
            'poster' => 'https://pictures.betaseries.com/fonds/poster/cd10803b0dda7740e6447146a8a79969.jpg',
            'category' => 'category_Aventure',
        ],
        [
            'title' => 'Off the Map : Urgences au Bout du Monde',
            'synopsis' => "Jusqu'où est-il possible d'aller pour guérir ? Bienvenue dans \"La Ciudad de Estrellas\", un petit village perdu dans la jungle en Amérique du Sud, où trois médecins qui ont désespérement besoin de prendre un nouveau départ viennent vivre. La jeune et idéaliste Lily, accompagnée de ses collègues Mina et Manny, vont désormais travailler dans une clinique de fortune où ils seront confrontés à des cas médicaux des plus exotiques.",
            'poster' => 'https://pictures.betaseries.com/fonds/poster/ae93dd38f8f7a5af35f522efc5c6424c.jpg',
            'category' => 'category_Action',
        ],
        [
            'title' => 'Sandman',
            'synopsis' => "La série suit les personnes et les lieux affectés par Morpheus, le roi des rêves, alors qu'il répare les erreurs cosmiques – et humaines – qu'il a commises au cours de sa vaste existence. Adaptation des romans graphiques fantastiques de Neil Gaiman.",
            'poster' => 'https://pictures.betaseries.com/fonds/poster/0945856ac08782dc836d7c2520d8f22e.jpg',
            'category' => 'category_Horreur',
        ],
        [
            'title' => 'Chainsaw Man',
            'synopsis' => "Denji est un adolescent qui vit avec son chien-démon-tronçonneuse, Pochita. À cause d’une énorme dette que son père a laissée derrière lui, le garçon se retrouve dans la misère la plus totale, cherchant avec Pochita à rembourser l’argent en récoltant des cadavres de démons pour le compte d’une organisation. Un jour, Denji est trahi et tué. Encore conscient, il passe un contrat avec Pochita et renaît sous le nom de Chainsaw Man, un homme au cœur de démon…",
            'poster' => 'https://pictures.betaseries.com/fonds/poster/3b61cc0a0875495e0f7f898308f252af.jpg',
            'category' => 'category_Horreur',
        ],
        [
            'title' => 'The watcher',
            'synopsis' => "Lettres inquiétantes, voisins bizarres et menaces sinistres... Une famille s'installe dans une maison de rêve et découvre qu'elle a hérité d'une situation cauchemardesque.",
            'poster' => 'https://pictures.betaseries.com/fonds/poster/a630058ce72dbc7a2240781408251327.jpg',
            'category' => 'category_Horreur',
        ],
        [
            'title' => 'All Of Us Are Dead',
            'synopsis' => "Un lycée devient l'épicentre d'une épidémie liée à un virus zombie. Pris au piège, les élèves devront lutter pour s'échapper ou risquer d'être à leur tour contaminés.",
            'poster' => 'https://pictures.betaseries.com/fonds/poster/af67ed7ef9300a4347aa3f183edb31ac.jpg',
            'category' => 'category_Horreur',
        ],
        [
            'title' => 'Arcane',
            'synopsis' => "Championnes de leurs villes jumelles et rivales, deux sœurs se battent dans une guerre où font rage des technologies magiques et des perspectives diamétralement opposées.",
            'poster' => 'https://pictures.betaseries.com/fonds/poster/9ad9ec2a96fe47913df092037536e4ae.jpg',
            'category' => 'category_Action',
        ],
        [
            'title' => 'Andor',
            'synopsis' => "En cette ère dangereuse, Cassian Andor emprunte un chemin qui fera de lui un héros de la rébellion.",
            'poster' => 'https://pictures.betaseries.com/fonds/poster/03db998f694b3dd4f7c12bb1af59346f.jpg',
            'category' => 'category_Action',
        ],
        [
            'title' => 'Doctor Who',
            'synopsis' => "Cette série relate les aventures du Docteur, un extraterrestre, un Seigneur du Temps originaire de la planète Gallifrey, qui voyage à bord d'un TARDIS (Time And Relative Dimension(s) In Space), une machine pouvant voyager dans l'espace et dans le temps. Le TARDIS a l'apparence d'une cabine de police (construction typiquement britannique ressemblant à une cabine téléphonique), le système de camouflage étant resté bloqué. Comme tous les Seigneur du Temps, le Docteur possède treize vies, ce qui explique sa capacité à changer de corps lorsqu'il est proche de la mort.",
            'poster' => 'https://pictures.betaseries.com/fonds/poster/f5bcf7a09a786ff6a174c92447caa7ca.jpg',
            'category' => 'category_Aventure',
        ],
        [
            'title' => 'Kaamelott',
            'synopsis' => "Ve siècle après Jésus-Christ. L'Angleterre s'appelle encore la Bretagne. Le Christianisme naissant, les anciennes traditions celtes s’entrechoquent pendant que l‘Empire Romain s’effondre. Au carrefour de l’Histoire, le Royaume de Kaamelott apparaît alors comme le nouveau phare de la civilisation. Investi d’une Mission Divine, le Roi Arthur tente de guider son peuple vers la lumière : “Seigneur, je me vouerai tout entier à la noble quête dont Vous m’honorâtes. Mais avec l’équipe de romanos que je me promène, ça va pas être facile!” Entouré de ses Chevaliers, le Roi Arthur règne sur le Royaume de Kaamelott. Kaamelott nous plonge dans la réalité qui se cache derrière la Légende du Roi Arthur : les situations «professionnelles» (missions, quête du Graal, etc.) et les intrigues familiales (repas, scènes conjugales, etc.) nourrissent les coulisses de la Légende. Basé sur le décalage entre situations et dialogues (Jeu et langue contemporains), l’humour de la série oppose l’imagerie épique de la légende Arthurienne à une réalité quotidienne insoupçonnée. Il s’appuie sur cette torsion entre la Légende du Roi Arthur, la nature divine de ses aspirations, et la platitude de situations supposées réelles. Alexandre Astier : \" J’aime casser les genoux aux préjugés historiques. Dans Kaamelott, Arthur est sans noblesse et sa quête est réduite à une formalité administrative et poussive. Kaamelott, ça aurait dû être « Le Seigneur Des Anneaux », mais finalement bah, finalement, non. \"",
            'poster' => 'https://pictures.betaseries.com/fonds/poster/a06b36dfad9278199e76386368c7f1e0.jpg',
            'category' => 'category_Aventure',
        ],
        [
            'title' => 'Supernatural',
            'synopsis' => "Les aventures et le destin des deux frères Winchester sur les traces de leur père, un \"chasseur\", à la poursuite de monstres vivant parmi les humains.",
            'poster' => 'https://pictures.betaseries.com/fonds/poster/33765aaa2f3ac91e32f9d8ea1bc45ff5.jpg',
            'category' => 'category_Fantastique',
        ],
    ];

    private SluggerInterface $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function load(ObjectManager $manager): void
    {
        foreach (self::PROGRAMS as $key => $value) {

            $program = new Program();
            $program->setTitle(self::PROGRAMS[$key]['title']);
            $slug = $this->slugger->slug($program->getTitle());
            $program->setSlug($slug);
            $program->setSynopsis(self::PROGRAMS[$key]['synopsis']);
            $program->setPoster(self::PROGRAMS[$key]['poster']);
            $program->setCategory($this->getReference(self::PROGRAMS[$key]['category']));
            $manager->persist($program);
            $this->addReference('program_' . $key, $program);

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
