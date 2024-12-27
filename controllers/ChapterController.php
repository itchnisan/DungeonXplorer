<?php
require_once 'models/Hero.php';
require_once 'models/Chapter.php';
require_once 'models/Inventory.php';
require_once 'models/Items.php';
include_once 'models/connexionPDO.php';

session_start();

// controllers/ChapterController.php

require_once 'models/Chapter.php';
include_once "models/connexionPDO.php";

//require_once 'views/chapter_view.php';

class ChapterController
{
    private $chapters = [];
    private $heroInventory = []; // Nouveau : stockage de l'inventaire du héros

    public function __construct()
    {
        // Chargement des chapitres
        $this->chapters = $this->getChaptersFromDatabase(
            OuvrirConnexionPDO('mysql:host=localhost;dbname=dx_10;charset=utf8', 'root', '')
        );
    }

    // Récupération des chapitres
    public function getChaptersFromDatabase($db)
    {
        $query = $db->query("SELECT * FROM chapter");
        $chapters = [];

        while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
            $chapter = new Chapter();
            $chapter->hydrate($row);

            // Vérification combat
            $sqlCombat = $db->prepare("SELECT monster_id FROM encounter WHERE chapter_id = :chapter_id");
            $sqlCombat->execute(['chapter_id' => $chapter->getChapterId()]);
            $result = $sqlCombat->fetch(PDO::FETCH_ASSOC);

            if ($result) {
                $chapter->addLink([
                    'description' => 'LE COMBAT',
                    'chapter_id' => '../views/combat_view.php',
                ]);
            } else {
                // Récupération des liens
                $stmt = $db->prepare("SELECT links.* FROM links WHERE chapter_id = :chapter_id");
                $stmt->execute(['chapter_id' => $chapter->getChapterId()]);

                while ($link = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $chapter->addLink([
                        'description' => $link['description'],
                        'chapter_id' => $link['next_chapter_id'],
                    ]);
                }
            }

            $chapters[] = $chapter;
        }

        return $chapters;
    }

    // Nouveau : récupération de l'inventaire d'un héros
    public function getHeroInventory($heroId, $db)
    {
        
        //A changer si le temps
        $chapt = $this->getChaptersFromDatabase(OuvrirConnexionPDO('mysql:host=localhost;dbname=dx_10;charset=utf8', 'root' , ''));

        foreach ($chapt as $chapter) {
            $this->chapters= $chapt;
        }
    }
    

    public function show($id)
    {
        $chapter = $this->getChapter($id);
        $db = OuvrirConnexionPDO('mysql:host=localhost;dbname=dx_10;charset=utf8', 'root', '');

        if ($chapter) {
            // Récupération de l'inventaire pour la vue
                $hero =$_SESSION['hero'];
                $heroInventory = $this->getHeroInventory($hero->getHeroId(), $db);
            include 'views/chapter_view.php'; // Charge la vue pour le chapitre
        } else {
            header('HTTP/1.0 404 Not Found');
            echo "Chapitre non trouvé!";
        }
    }

    public function getChapter($id)
    {
        foreach ($this->chapters as $chapter) {
            if ($chapter->getChapterId() == $id) {
                return $chapter;
            }
        }
        return null;
    }
}
