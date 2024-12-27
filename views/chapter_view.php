<?php
require_once 'controllers/ChapterController.php';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo $chapter->getChapterNom(); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Cinzel+Decorative:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../views/styleChapitre.css">
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }

        .modal-content {
            background-color: #fff;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            background-color:black;
        }

        .close-button {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close-button:hover,
        .close-button:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <!-- Bouton pour ouvrir la modale -->
    <button id="inventoryButton" class="button">Inventaire</button>

    <!-- Fenêtre modale -->
    <div id="inventoryModal" class="modal">
    <div class="modal-content">
        <span class="close-button">&times;</span>
            <h2>Votre Inventaire</h2>
            <?php if (!empty($heroInventory)): ?>
                <div class="text-block">
                <ul>
                    <?php foreach ($heroInventory as $item): ?>
                        <li>
                            <strong><?php echo htmlspecialchars($item['name']); ?></strong><br>
                            <em><?php echo htmlspecialchars($item['description']); ?></em><br>
                            Taille : <?php echo htmlspecialchars($item['size']); ?><br>
                            Efficacité : <?php echo htmlspecialchars($item['efficiency']); ?><br>
                            Quantité : <?php echo htmlspecialchars($item['amount']); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
                </div>
            <?php else: ?>
                <p>Aucun objet dans l'inventaire.</p>
            <?php endif; ?>
        </div>
    </div>

    <div class="container">
        <h1><?php echo htmlspecialchars($chapter->getChapterNom()); ?></h1>
        <img src="../<?php echo htmlspecialchars($chapter->getChapterImage()); ?>" alt="Image de chapitre">
        <div class="text-block">
            <p><?php echo nl2br(htmlspecialchars($chapter->getChapterContent())); ?></p>
        </div>
        <h2>Choisissez votre chemin:</h2>
        <ul>
            <?php foreach ($chapter->getLinks() as $choice): ?>
                <li>
                    <a class="button" href="<?php echo htmlspecialchars($choice['chapter_id']); ?>">
                        <?php echo htmlspecialchars($choice['description']); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <script>
        const inventoryButton = document.getElementById('inventoryButton');
        const inventoryModal = document.getElementById('inventoryModal');
        const closeButton = document.querySelector('.close-button');

        inventoryButton.addEventListener('click', () => {
            inventoryModal.style.display = 'block';
        });

        closeButton.addEventListener('click', () => {
            inventoryModal.style.display = 'none';
        });

        window.addEventListener('click', (event) => {
            if (event.target === inventoryModal) {
                inventoryModal.style.display = 'none';
            }
        });
    </script>
</body>
</html>
