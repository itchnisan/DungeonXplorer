<?php

// controllers/ChapterController.php

require_once 'models/Chapter.php';
include_once "models/connexionPDO.php";

//require_once 'views/chapter_view.php';

class ChapterController
{
    private $chapters = [];
     

    public function getChaptersFromDatabase($db)
{
    $query = $db->query("SELECT * FROM chapter");
    $chapters = array();

    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        $chapter = new Chapter();
        $chapter->hydrate($row);

        // Préparer la requête pour récupérer les liens
        $stmt = $db->prepare("SELECT links.* FROM links WHERE chapter_id = :chapter_id");
        $stmt->execute(['chapter_id' => $chapter->getChapterId()]);

        // Ajouter les informations des liens au chapitre
        while ($link = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $chapter->addLink([
                'description' => $link['description'],
                'chapter_id' => $link['next_chapter_id']
            ]);
        }

        array_push($chapters, $chapter);
    }

    return $chapters;
}

    public function __construct()
    {
        

        $chapt = $this->getChaptersFromDatabase(OuvrirConnexionPDO('mysql:host=localhost;dbname=dx10_bd;charset=utf8', 'root' , ''));

        foreach ($chapt as $chapter) {
            $this->chapters= $chapt;
        }
    }
    

    public function show($id)
    {
        $chapter = $this->getChapter($id);

        if ($chapter) {
            include 'views/chapter_view.php'; // Charge la vue pour le chapitre
        } else {
            // Si le chapitre n'existe pas, redirige vers un chapitre par défaut ou affiche une erreur
            header('HTTP/1.0 404 Not Found');
            echo "Chapitre non trouvé!";
        }
    }

    public function getChapter($id)
    {
        foreach ($this->chapters as $chapter) {
            if ($chapter->getChapterId() == $id) {
                //echo($chapter->getChapterId());
                return $chapter;
            }
        }
        return null; // Chapitre non trouvé
    }
}
