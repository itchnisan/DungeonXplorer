<?php
require_once '../models/Hero.php';
require_once '../models/Treasure.php';
require_once '../models/Chapter.php';
require_once '../models/Inventory.php';
require_once '../models/Items.php';
include_once '../models/connexionPDO.php';

session_start(); 

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du formulaire
            $itemId = $_POST['item_id'] ?? null;
            $heroId = $_POST['hero_id'] ?? null;

            if ($itemId && $heroId) {
                $db = OuvrirConnexionPDO('mysql:host=localhost;dbname=dx_10;charset=utf8', 'root', '');

                // Insérer l'item dans l'inventaire du héros
                $sql = $db->prepare("INSERT INTO inventory (hero_id, items_id,items_amount) VALUES (:hero_id, :items_id , :items_amount)");
                $sql->execute([
                    'hero_id' => $heroId,
                    'items_id' => $itemId,
                    'items_amount' => 1
                ]);

                // Rediriger ou afficher un message
                header('Location: ../Chapter/' . $_POST['chapter_id']); // Redirection vers la page du chapitre
                exit;
            } else {
                echo "Erreur : données invalides.";
            }
        }
?>