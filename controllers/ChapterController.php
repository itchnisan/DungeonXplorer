<?php
require_once 'models/Hero.php';
require_once 'models/Treasure.php';
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
    private $treasures = [];
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
        $stmt = $db->prepare("
            SELECT inventory.*, items.items_name, items.items_description, items.items_size, items.items_efficiency
            FROM inventory
            JOIN items ON inventory.items_id = items.items_id
            WHERE inventory.hero_id = :hero_id
        ");
        $stmt->execute(['hero_id' => $heroId]);

        $inventory = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $item = [
                'inventory_id' => $row['inventory_id'],
                'item_id' => $row['items_id'],
                'name' => $row['items_name'],
                'description' => $row['items_description'],
                'size' => $row['items_size'],
                'efficiency' => $row['items_efficiency'],
                'amount' => $row['items_amount'],
            ];
            $inventory[] = $item;
        }

        $this->heroInventory = $inventory; // Stockage de l'inventaire
        return $inventory;
    }
    

    public function show($id)
    {

        $_SESSION['chapitre'] = $id;
        $chapter = $this->getChapter($id);
        $db = OuvrirConnexionPDO('mysql:host=localhost;dbname=dx_10;charset=utf8', 'root', '');


        $hero = $_SESSION['hero'];
        $idUser = $hero->getHeroId();
        $sqlUp = "UPDATE quest SET chapter_id = :chapID WHERE hero_id = :id";
        $cur = preparerRequetePDO($db, $sqlUp);

        ajouterParamPDO($cur, ':chapID', $id,'nombre');
        ajouterParamPDO($cur, ':id', $idUser,'nombre');
        $donnee = [];
        $res1 = $cur->execute();

        if ($chapter) {
            // Récupération de l'inventaire pour la vue
                $hero =$_SESSION['hero'];
                $heroInventory = $this->getHeroInventory($hero->getHeroId(), $db);
                $treasure = $this->getTreasure($id);
            include 'views/chapter_view.php'; // Charge la vue pour le chapitre
        } else {
            header('HTTP/1.0 404 Not Found');
            echo "Chapitre non trouvé!";
        }
    }

    public function getTreasure($id){
        $treasure = null;
        $db = OuvrirConnexionPDO('mysql:host=localhost;dbname=dx_10;charset=utf8', 'root', '');
        $sqlTreasure = $db->prepare("SELECT chapter_treasure.*, items.items_name, items.items_description, items.items_size, items.items_efficiency
            FROM chapter_treasure
            JOIN items ON chapter_treasure.item_id = items.items_id
            WHERE chapter_treasure.chapter_id = :chapter_id");
            $sqlTreasure->execute(['chapter_id' => $id]);
            $treasure = [];
        while ($row = $sqlTreasure->fetch(PDO::FETCH_ASSOC)) {
            $item = [
                'id' => $row['item_id'],
                'name' => $row['items_name'],
                'description' => $row['items_description'],
                'size' => $row['items_size'],
                'efficiency' => $row['items_efficiency']
            ];
            $treasure[] = $item;
        }

        $this->treasures = $treasure; // Stockage de l'inventaire
        return $treasure;
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
