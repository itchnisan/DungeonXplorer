-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 27 déc. 2024 à 22:14
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `dx_10`
--

-- --------------------------------------------------------

--
-- Structure de la table `chapter`
--

CREATE TABLE `chapter` (
  `chapter_id` int(11) NOT NULL,
  `chapter_nom` varchar(100) NOT NULL,
  `chapter_content` text NOT NULL,
  `chapter_image` varchar(255) DEFAULT NULL,
  `treasure_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `chapter`
--

INSERT INTO `chapter` (`chapter_id`, `chapter_nom`, `chapter_content`, `chapter_image`, `treasure_id`) VALUES
(1, 'Introduction', 'Le ciel est lourd ce soir sur le village du Val Perdu, dissimulé entre les montagnes. La petite taverne, dernier refuge avant l\'immense forêt, est étrangement calme quand le bourgmestre s’approche de vous. Homme d’apparence usée par les années et les soucis, il vous adresse un regard désespéré. « Ma fille… elle a disparu dans la forêt. Personne n’a osé la chercher… sauf vous, peutêtre ? On raconte qu’un sorcier vit dans un château en ruines, caché au cœur des bois. Depuis des mois, des jeunes filles disparaissent… J\'ai besoin de vous pour la retrouver. » Vous sentez le poids de la mission qui s’annonce, et un frisson parcourt votre échine. Bientôt, la forêt s\'ouvre devant vous, sombre et menaçante. La quête commence. ', 'Images/Village02.jpg', NULL),
(2, 'L\'orée de la forêt', 'Vous franchissez la lisière des arbres, la pénombre de la forêt avalant le sentier devant vous. Un vent froid glisse entre les troncs, et le bruissement des feuilles ressemble à un murmure menaçant. Deux chemins s’offrent à vous : l’un sinueux, bordé de vieux arbres noueux ; l’autre droit mais envahi par des ronces épaisses. ', 'Images/BrambleTrails01.jpg', NULL),
(3, 'L\'arbre aux corbeaux', 'Votre choix vous mène devant un vieux chêne aux branches tordues, grouillant de corbeaux noirs qui vous observent en silence. À vos pieds, des traces de pas légers, probablement récents, mènent plus loin dans les bois. Soudain, un bruit de pas feutrés se fait entendre. Vous ressentez la présence d’un prédateur. ', 'Images/Dark Forest02.jpg', NULL),
(4, 'Le sanglier enragé', 'En progressant, le calme de la forêt est soudain brisé par un grognement. Surgissant des buissons, un énorme sanglier, au pelage épais et aux yeux injectés de sang, se dirige vers vous. Sa rage est palpable, et il semble prêt à en découdre. Le voici qui décide brutalement de vous charger ! ', 'Images/Wild boar.jpg', NULL),
(5, 'Rencontre avec le paysan', 'Tandis que vous progressez, une voix humaine s’élève, interrompant le silence de la forêt. Vous tombez sur un vieux paysan, accroupi près de champignons aux couleurs vives. Il sursaute en vous voyant, puis se détend, vous souriant tristement. « Vous devriez faire attention, étranger, murmure-t-il. La nuit, des cris terrifiants retentissent depuis le cœur de la forêt… Des créatures rôdent. » ', 'Images/OldMan01.jpg', NULL),
(6, 'Le loup noir', 'À mesure que vous avancez, un bruissement attire votre attention. Une silhouette sombre s’élance soudainement devant vous : un loup noir aux yeux perçants. Son poil est hérissé et sa gueule laisse entrevoir des crocs acérés. Vous sentez son regard fixé sur vous, prêt à bondir. ', 'Images/Wolf01.jpg', NULL),
(7, 'La clairière aux pierres anciennes', 'Après votre rencontre, vous atteignez une clairière étrange, entourée de pierres dressées, comme un ancien autel oublié par le temps. Une légère brume rampe au sol, et les ombres des pierres semblent danser sous la lueur de la lune. ', 'Images/StoneWall02.jpg', NULL),
(8, 'Les murmures du ruisseau', 'Essoufflé mais déterminé, vous arrivez près d’un petit ruisseau qui serpente au milieu des arbres. Le chant de l’eau vous apaise quelque peu, mais des murmures étranges semblent émaner de la rive. Vous apercevez des inscriptions anciennes gravées dans une pierre moussue. ', 'Images/RuissoDansForet.jpg', NULL),
(9, 'Au pied du château', 'La forêt se disperse enfin, et devant vous se dresse une colline escarpée. Au sommet, le château en ruines projette une ombre menaçante sous le clair de lune. Les murs effrités et les tours en partie effondrées ajoutent à la sinistre réputation du lieu. Vous sentez que la véritable aventure commence ici, et que l’influence du sorcier n’est peut-être pas qu’une légende… ', 'Images/DarkCastle01.jpg', NULL),
(10, 'La lumière au bout du néant', 'Le monde se dérobe sous vos pieds, et une obscurité profonde vous enveloppe, glaciale et insondable. Vous ne sentez plus le poids de votre équipement, ni la morsure de la douleur. Juste un vide infini, vous aspirant lentement dans les ténèbres. Alors que vous perdez toute notion du temps, une lueur douce apparaît au loin, vacillante comme une flamme fragile dans l’obscurité. Au fur et à mesure que vous approchez, vous entendez une voix, faible mais bienveillante, qui murmure des mots oubliés, anciens. « Brave âme, ton chemin n\'est pas achevé... À ceux qui échouent, une seconde chance est accordée. Mais les caprices du destin exigent un sacrifice. » La lumière s\'intensifie, et vous sentez vos forces revenir, mais vos poches sont vides, votre sac allégé de tout trésor. Votre équipement, vos armes, tout a disparu, laissant place à une sensation de vulnérabilité. Lorsque la lumière vous enveloppe, vous ouvrez de nouveau les yeux, retrouvant la terre ferme sous vos pieds. Vous êtes de retour, sans autre possession que votre volonté de reprendre cette quête. Mais cette fois-ci, peut-être, saurez-vous éviter les pièges fatals qui vous ont mené à votre perte. ', 'Images/pierreForet.jpg', NULL),
(11, 'La curiosité tua le chat', 'Qu’avez-vous fait, Malheureux ! ', 'Images/mainPierre.jpg', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `chapter_treasure`
--

CREATE TABLE `chapter_treasure` (
  `chpter_treasure_id` int(11) NOT NULL,
  `chapter_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `class`
--

CREATE TABLE `class` (
  `class_id` int(11) NOT NULL,
  `class_name` varchar(50) NOT NULL,
  `class_description` text DEFAULT NULL,
  `class_base_pv` int(11) NOT NULL,
  `class_base_mana` int(11) NOT NULL,
  `class_strength` int(11) NOT NULL,
  `class_initiative` int(11) NOT NULL,
  `class_max_items` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `class`
--

INSERT INTO `class` (`class_id`, `class_name`, `class_description`, `class_base_pv`, `class_base_mana`, `class_strength`, `class_initiative`, `class_max_items`) VALUES
(1, 'guerrier', 'taillé dans le roc et forgé par des années de bataille. Sa silhouette massive est recouverte d’une armure lourde en acier noirci, ornée de symboles ancestraux qui racontent l’histoire de son royaume. Son casque, aux contours sévères, laisse entrevoir ses yeux perçants, toujours en alerte. Il porte une grande épée à deux mains, la lame imprégnée de magie ancienne, capable de fendre les ténèbres elles-mêmes.\r\nSon cri de guerre résonne dans les vallées et au cœur des citadelles, inspirant la peur chez ses ennemis et l’espoir chez ses compagnons. Maître dans l\'art de la guerre, il excelle aussi bien dans les combats rapprochés que dans la stratégie. Un guerrier d\'exception, à la fois force brute et défenseur implacable.\r\n\r\n', 30, 0, 15, 10, 10),
(2, 'voleur', 'maître de l\'art de l\'infiltration et de l\'assassinat furtif. Sa silhouette mince et agile se fond dans l\'ombre, ses mouvements aussi discrets que le souffle du vent. Vêtu de vêtements en cuir noir souple et orné de capes sombres, il porte des bottes silencieuses qui lui permettent de se déplacer sans faire un bruit. Un masque en tissu dissimule son visage, ne laissant apparaître que ses yeux glintants, remplis de malice et d’intelligence.\r\nSes ennemis l’entendent rarement avant qu’il ne soit trop tard. D’un seul geste rapide, il peut trancher les gorges, voler des trésors et disparaître dans la nuit sans laisser de trace. Pour ses alliés, il est un fantôme utile, offrant des informations cruciales, déjouant les systèmes de sécurité et ouvrant des chemins invisibles.\r\nIl vit dans l\'ombre, mais dans chaque mission, chaque vol, il démontre sa compétence, sa ruse et sa capacité à manipuler les situations à son avantage. Il n’a pas de loyauté pour les lois, mais un code personnel qui dicte ses actionscar dans le monde des voleurs, il est une légende.\r\n\r\n', 20, 10, 10, 25, 5),
(3, 'mage', 'un mage puissant, imprégné des mystères des arcanes et des secrets oubliés de l’univers. Vêtu d’une robe pourpre décorée de runes scintillantes, il porte un bâton ancien, orné d’une gemme magique au sommet qui pulse d\'une lueur énigmatique. Ses cheveux blancs comme l’argent tombent en mèches désordonnées autour de son visage, marqué par les années de pratique solitaire et d’études sur les forces invisibles qui régissent le monde\r\nLe mage maîtrise la magie dans toutes ses formes : des sorts destructeurs capables de raser des champs de bataille aux enchantements protecteurs qui confèrent une force surnaturelle à ses alliés. Son expertise va bien au-delà des simples éclats de feu ou de glace ; maîtrisant les arcanes élémentaires, la manipulation du temps et de l’espace, et même les subtilités de la nécromancie. Il incarne l’intellect et la sagesse, mais aussi la puissance pure', 20, 30, 10, 0, 10);

-- --------------------------------------------------------

--
-- Structure de la table `encounter`
--

CREATE TABLE `encounter` (
  `encounter_id` int(11) NOT NULL,
  `chapter_id` int(11) DEFAULT NULL,
  `monster_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `encounter`
--

INSERT INTO `encounter` (`encounter_id`, `chapter_id`, `monster_id`) VALUES
(1, 4, 2),
(2, 6, 3);

-- --------------------------------------------------------

--
-- Structure de la table `equipment`
--

CREATE TABLE `equipment` (
  `equipment_id` int(11) NOT NULL,
  `hero_id` int(11) NOT NULL,
  `items_id` int(11) NOT NULL,
  `items_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `hero`
--

CREATE TABLE `hero` (
  `user_id` int(11) DEFAULT NULL,
  `hero_id` int(11) NOT NULL,
  `hero_name` varchar(50) NOT NULL,
  `class_id` int(11) DEFAULT NULL,
  `hero_image` varchar(255) DEFAULT NULL,
  `hero_biography` text DEFAULT NULL,
  `hero_pv` int(11) NOT NULL,
  `hero_mana` int(11) NOT NULL,
  `hero_strength` int(11) NOT NULL,
  `hero_initiative` int(11) NOT NULL,
  `hero_xp` int(11) NOT NULL,
  `hero_bourse_or` int(11) DEFAULT NULL,
  `current_level` int(11) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `inventory`
--

CREATE TABLE `inventory` (
  `inventory_id` int(11) NOT NULL,
  `hero_id` int(11) DEFAULT NULL,
  `items_id` int(11) DEFAULT NULL,
  `items_amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `items`
--

CREATE TABLE `items` (
  `items_id` int(11) NOT NULL,
  `items_name` varchar(50) NOT NULL,
  `items_description` text DEFAULT NULL,
  `items_size` int(11) DEFAULT NULL,
  `items_efficiency` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `items`
--

INSERT INTO `items` (`items_id`, `items_name`, `items_description`, `items_size`, `items_efficiency`) VALUES
(1, 'Épée de l\'Aube', 'forgée à l’aube du monde, cette épée est réputée pour sa lame éclatante qui brille d’une lueur dorée. Sa poignée en cuir noir est décorée de runes anciennes, gravées dans le but de repousser les ténèbres. Lorsque l’épée est brandie sous un ciel clair, elle gagne en puissance et inflige des dégâts accrus aux créatures du mal. L’Épée de l\'Aube est un symbole de justice et de lumière.', 4, 1),
(2, ' Bouclier du Gardien', 'Ce bouclier massif, forgé dans un métal argenté et orné de gravures protectrices, est réputé pour sa résistance exceptionnelle. Il est gravé du symbole d\'un gardien mythique, un protecteur divin. Lorsqu’il est utilisé, il crée un champ de force protecteur qui peut absorber une partie des dégâts reçus. Les ennemis qui frappent ce bouclier se retrouvent souvent déstabilisés par l\'onde de choc qui en émane.', 6, 2),
(3, 'Bâton Magique des Éléments', 'Ce bâton long et fin est en bois d’ébène et orné de cristaux enchâssés qui représentent les quatre éléments : feu, eau, terre et air. Les cristaux brillent intensément lorsque le bâton est utilisé pour lancer des sorts. Ce bâton offre une maîtrise parfaite des éléments et peut infliger des dégâts élémentaires variés selon la volonté du porteur. En plus de ses pouvoirs offensifs, il permet de manipuler les éléments pour des actions de défense ou de guérison.', 4, 0),
(4, ' Poignard de l’Ombre', 'Ce poignard à la lame noire comme l\'obsidienne est conçu pour les assassins et les voleurs. Léger et aiguisé à l’extrême, il permet des attaques rapides et discrètes. Lorsque le porteur frappe, une aura sombre enveloppe la lame, la rendant presque invisible. Il est également réputé pour sa capacité à frapper à des endroits vitaux, infligeant des dégâts critiques avec une grande précision.', 2, 0);

-- --------------------------------------------------------

--
-- Structure de la table `level`
--

CREATE TABLE `level` (
  `level_id` int(11) NOT NULL,
  `level_level` int(11) NOT NULL,
  `level_required_xp` int(11) NOT NULL,
  `level_pv_bonus` int(11) NOT NULL,
  `level_mana_bonus` int(11) NOT NULL,
  `level_strength_bonus` int(11) NOT NULL,
  `level_initiative_bonus` int(11) NOT NULL,
  `class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `links`
--

CREATE TABLE `links` (
  `links_id` int(11) NOT NULL,
  `chapter_id` int(11) DEFAULT NULL,
  `next_chapter_id` int(11) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `links`
--

INSERT INTO `links` (`links_id`, `chapter_id`, `next_chapter_id`, `description`) VALUES
(1, 1, 2, 'Poursuivre l\'aventure'),
(2, 2, 3, 'Empruntez le chemin sinueux'),
(3, 2, 4, 'Prendre le sentier couvert de ronces'),
(4, 3, 5, 'Je choisis de rester prudent'),
(5, 3, 6, 'Je décide d’ignorer les bruits et de poursuivre ma route'),
(6, 4, 10, 'win'),
(7, 4, 8, 'loos'),
(8, 5, 7, 'Poursuive'),
(9, 6, 7, 'win'),
(10, 6, 10, 'loos'),
(11, 7, 8, 'Prendre le sentier couvert de mousse'),
(12, 7, 9, 'Suivre le chemin tortueux à travers les racines'),
(13, 8, 11, 'Touchez la pierre gravée'),
(14, 8, 9, 'Ignorez cette curiosité et poursuivez ma route'),
(15, 10, 1, 'Recommencer'),
(16, 11, 10, 'Suite');

-- --------------------------------------------------------

--
-- Structure de la table `loot`
--

CREATE TABLE `loot` (
  `loot_id` int(11) NOT NULL,
  `monster_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `loot_name` varchar(50) NOT NULL,
  `item_id` int(11) DEFAULT NULL,
  `loot_quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `loot`
--

INSERT INTO `loot` (`loot_id`, `monster_id`, `class_id`, `loot_name`, `item_id`, `loot_quantity`) VALUES
(1, 2, 1, 'coffre en bois', 1, 1),
(2, 2, 1, 'coffre en pierre', 2, 1),
(3, 2, 1, 'coffre en obsidienne', 3, 1),
(4, 2, 1, 'coffre divin', 4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `monster`
--

CREATE TABLE `monster` (
  `monster_id` int(11) NOT NULL,
  `monster_name` varchar(50) NOT NULL,
  `monster_pv` int(11) NOT NULL,
  `monster_mana` int(11) DEFAULT NULL,
  `monster_initiative` int(11) NOT NULL,
  `monster_strength` int(11) NOT NULL,
  `monster_attack` int(11) NOT NULL,
  `monster_xp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `monster`
--

INSERT INTO `monster` (`monster_id`, `monster_name`, `monster_pv`, `monster_mana`, `monster_initiative`, `monster_strength`, `monster_attack`, `monster_xp`) VALUES
(2, 'Sanglier', 5, NULL, 2, 3, 2, 4),
(3, 'Loup noir', 10, NULL, 2, 8, 4, 3);

-- --------------------------------------------------------

--
-- Structure de la table `quest`
--

CREATE TABLE `quest` (
  `quest_id` int(11) NOT NULL,
  `hero_id` int(11) DEFAULT NULL,
  `chapter_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `spell`
--

CREATE TABLE `spell` (
  `spell_id` int(11) NOT NULL,
  `spell_name` varchar(30) DEFAULT NULL,
  `spell_cost` int(11) DEFAULT NULL,
  `spell_damage` int(11) DEFAULT NULL,
  `spell_cure` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `spell`
--

INSERT INTO `spell` (`spell_id`, `spell_name`, `spell_cost`, `spell_damage`, `spell_cure`) VALUES
(1, 'boule de feu', 5, 5, 0),
(2, 'boule de soins ', 5, 0, 5),
(3, 'tonnerre divin ', 15, 15, 0),
(4, 'vague soigneuse', 15, 0, 15);

-- --------------------------------------------------------

--
-- Structure de la table `spelllist`
--

CREATE TABLE `spelllist` (
  `hero_id` int(11) DEFAULT NULL,
  `spell_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `spelllistmonster`
--

CREATE TABLE `spelllistmonster` (
  `id_spelllistMonster` int(11) NOT NULL,
  `monster_id` int(11) NOT NULL,
  `spell_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `typeequipment`
--

CREATE TABLE `typeequipment` (
  `items_id` int(11) DEFAULT NULL,
  `equipment_id` int(11) DEFAULT NULL,
  `typeEquipment_type` int(11) DEFAULT NULL,
  `typeEquipment_decs` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `user_mail` varchar(50) NOT NULL,
  `user_pseudo` varchar(50) NOT NULL,
  `user_mdp` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `chapter`
--
ALTER TABLE `chapter`
  ADD PRIMARY KEY (`chapter_id`),
  ADD KEY `treasure_id` (`treasure_id`);

--
-- Index pour la table `chapter_treasure`
--
ALTER TABLE `chapter_treasure`
  ADD PRIMARY KEY (`chpter_treasure_id`),
  ADD KEY `chapter_id` (`chapter_id`),
  ADD KEY `item_id` (`item_id`);

--
-- Index pour la table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`class_id`);

--
-- Index pour la table `encounter`
--
ALTER TABLE `encounter`
  ADD PRIMARY KEY (`encounter_id`),
  ADD KEY `chapter_id` (`chapter_id`),
  ADD KEY `monster_id` (`monster_id`);

--
-- Index pour la table `equipment`
--
ALTER TABLE `equipment`
  ADD PRIMARY KEY (`equipment_id`,`hero_id`,`items_id`,`items_type`),
  ADD KEY `hero_id` (`hero_id`);

--
-- Index pour la table `hero`
--
ALTER TABLE `hero`
  ADD PRIMARY KEY (`hero_id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`inventory_id`),
  ADD KEY `hero_id` (`hero_id`),
  ADD KEY `item_id` (`items_id`);

--
-- Index pour la table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`items_id`);

--
-- Index pour la table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`level_id`),
  ADD KEY `fk_level_class` (`class_id`);

--
-- Index pour la table `links`
--
ALTER TABLE `links`
  ADD PRIMARY KEY (`links_id`),
  ADD KEY `chapter_id` (`chapter_id`),
  ADD KEY `next_chapter_id` (`next_chapter_id`);

--
-- Index pour la table `loot`
--
ALTER TABLE `loot`
  ADD PRIMARY KEY (`loot_id`),
  ADD KEY `item_id` (`item_id`),
  ADD KEY `fk_loot_class` (`class_id`),
  ADD KEY `fk_loot_monster` (`monster_id`);

--
-- Index pour la table `monster`
--
ALTER TABLE `monster`
  ADD PRIMARY KEY (`monster_id`);

--
-- Index pour la table `quest`
--
ALTER TABLE `quest`
  ADD PRIMARY KEY (`quest_id`),
  ADD KEY `hero_id` (`hero_id`),
  ADD KEY `chapter_id` (`chapter_id`);

--
-- Index pour la table `spell`
--
ALTER TABLE `spell`
  ADD PRIMARY KEY (`spell_id`);

--
-- Index pour la table `spelllist`
--
ALTER TABLE `spelllist`
  ADD KEY `spell_id` (`spell_id`),
  ADD KEY `hero_id` (`hero_id`);

--
-- Index pour la table `spelllistmonster`
--
ALTER TABLE `spelllistmonster`
  ADD PRIMARY KEY (`id_spelllistMonster`),
  ADD KEY `monster_id` (`monster_id`),
  ADD KEY `spell_id` (`spell_id`);

--
-- Index pour la table `typeequipment`
--
ALTER TABLE `typeequipment`
  ADD KEY `items_id` (`items_id`),
  ADD KEY `equipment_id` (`equipment_id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`,`user_mail`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `chapter`
--
ALTER TABLE `chapter`
  MODIFY `chapter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `chapter_treasure`
--
ALTER TABLE `chapter_treasure`
  MODIFY `chpter_treasure_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `class`
--
ALTER TABLE `class`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `encounter`
--
ALTER TABLE `encounter`
  MODIFY `encounter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `equipment`
--
ALTER TABLE `equipment`
  MODIFY `equipment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `hero`
--
ALTER TABLE `hero`
  MODIFY `hero_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT pour la table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `inventory_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `items`
--
ALTER TABLE `items`
  MODIFY `items_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `level`
--
ALTER TABLE `level`
  MODIFY `level_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `links`
--
ALTER TABLE `links`
  MODIFY `links_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `loot`
--
ALTER TABLE `loot`
  MODIFY `loot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `monster`
--
ALTER TABLE `monster`
  MODIFY `monster_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `quest`
--
ALTER TABLE `quest`
  MODIFY `quest_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT pour la table `spell`
--
ALTER TABLE `spell`
  MODIFY `spell_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `spelllistmonster`
--
ALTER TABLE `spelllistmonster`
  MODIFY `id_spelllistMonster` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `chapter_treasure`
--
ALTER TABLE `chapter_treasure`
  ADD CONSTRAINT `Chapter_Treasure_ibfk_1` FOREIGN KEY (`chapter_id`) REFERENCES `chapter` (`chapter_id`),
  ADD CONSTRAINT `Chapter_Treasure_ibfk_2` FOREIGN KEY (`item_id`) REFERENCES `items` (`items_id`);

--
-- Contraintes pour la table `encounter`
--
ALTER TABLE `encounter`
  ADD CONSTRAINT `Encounter_ibfk_1` FOREIGN KEY (`chapter_id`) REFERENCES `chapter` (`chapter_id`),
  ADD CONSTRAINT `Encounter_ibfk_2` FOREIGN KEY (`monster_id`) REFERENCES `monster` (`monster_id`);

--
-- Contraintes pour la table `equipment`
--
ALTER TABLE `equipment`
  ADD CONSTRAINT `Equipment_ibfk_1` FOREIGN KEY (`hero_id`) REFERENCES `hero` (`hero_id`);

--
-- Contraintes pour la table `hero`
--
ALTER TABLE `hero`
  ADD CONSTRAINT `Hero_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `class` (`class_id`),
  ADD CONSTRAINT `Hero_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);

--
-- Contraintes pour la table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `Inventory_ibfk_1` FOREIGN KEY (`hero_id`) REFERENCES `hero` (`hero_id`),
  ADD CONSTRAINT `Inventory_ibfk_2` FOREIGN KEY (`items_id`) REFERENCES `items` (`items_id`);

--
-- Contraintes pour la table `level`
--
ALTER TABLE `level`
  ADD CONSTRAINT `fk_level_class` FOREIGN KEY (`class_id`) REFERENCES `class` (`class_id`);

--
-- Contraintes pour la table `links`
--
ALTER TABLE `links`
  ADD CONSTRAINT `Links_ibfk_1` FOREIGN KEY (`chapter_id`) REFERENCES `chapter` (`chapter_id`),
  ADD CONSTRAINT `Links_ibfk_2` FOREIGN KEY (`next_chapter_id`) REFERENCES `chapter` (`chapter_id`);

--
-- Contraintes pour la table `loot`
--
ALTER TABLE `loot`
  ADD CONSTRAINT `Loot_ibfk_1` FOREIGN KEY (`item_id`) REFERENCES `items` (`items_id`),
  ADD CONSTRAINT `fk_loot_class` FOREIGN KEY (`class_id`) REFERENCES `class` (`class_id`),
  ADD CONSTRAINT `fk_loot_monster` FOREIGN KEY (`monster_id`) REFERENCES `monster` (`monster_id`);

--
-- Contraintes pour la table `quest`
--
ALTER TABLE `quest`
  ADD CONSTRAINT `Quest_ibfk_1` FOREIGN KEY (`hero_id`) REFERENCES `hero` (`hero_id`),
  ADD CONSTRAINT `Quest_ibfk_2` FOREIGN KEY (`chapter_id`) REFERENCES `chapter` (`chapter_id`);

--
-- Contraintes pour la table `spelllist`
--
ALTER TABLE `spelllist`
  ADD CONSTRAINT `SpellList_ibfk_1` FOREIGN KEY (`spell_id`) REFERENCES `spell` (`spell_id`),
  ADD CONSTRAINT `SpellList_ibfk_2` FOREIGN KEY (`hero_id`) REFERENCES `hero` (`hero_id`);

--
-- Contraintes pour la table `spelllistmonster`
--
ALTER TABLE `spelllistmonster`
  ADD CONSTRAINT `spelllistmonster_ibfk_1` FOREIGN KEY (`monster_id`) REFERENCES `monster` (`monster_id`),
  ADD CONSTRAINT `spelllistmonster_ibfk_2` FOREIGN KEY (`spell_id`) REFERENCES `spell` (`spell_id`);

--
-- Contraintes pour la table `typeequipment`
--
ALTER TABLE `typeequipment`
  ADD CONSTRAINT `TypeEquipment_ibfk_1` FOREIGN KEY (`items_id`) REFERENCES `items` (`items_id`),
  ADD CONSTRAINT `TypeEquipment_ibfk_2` FOREIGN KEY (`equipment_id`) REFERENCES `equipment` (`equipment_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
