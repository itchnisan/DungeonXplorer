<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../views/style.css">
    <title>Choix d'un ancien personnage</title>
</head>
<body>
    <div class="container">
    <?php
        session_start();

        if (isset($_SESSION['hero_data'])) {
            $hero = $_SESSION['hero_data']; // Access hero data from the session
            $hero_name = htmlspecialchars($hero['hero_name']);
            $hero_pv = htmlspecialchars($hero['hero_pv']);
            $hero_biography = htmlspecialchars($hero['hero_biography']);
            $hero_mana = htmlspecialchars($hero['hero_mana']);
            $hero_strength = htmlspecialchars($hero['hero_strength']);
            $hero_initiative = htmlspecialchars($hero['hero_initiative']);
            $class_name = isset($hero['class_name']) ? htmlspecialchars($hero['class_name']) : "Classe inconnue";

            // Optional values
            $hero_bourse_or = isset($hero['hero_bourse_or']) ? htmlspecialchars($hero['hero_bourse_or']) : null;
            $hero_image = isset($hero['hero_image']) ? htmlspecialchars($hero['hero_image']) : null;
            $hero_current_level = isset($hero['current_level']) ? htmlspecialchars($hero['current_level']) : null;
        } else {
            echo "No hero data available.";
            exit;
        }
    ?>
    <h1>Détails de votre héros</h1>
    <div class="text-block">
    <h2><?= $hero_name; ?></h2>
        <p>Classe : <?= $class_name; ?></p>
        <p>PV: <?= $hero_pv; ?></p>
        <p>Biographie: <?= $hero_biography; ?></p>
        <p>Mana: <?= $hero_mana; ?></p>
        <p>Force: <?= $hero_strength; ?></p>
        <p>Initiative: <?= $hero_initiative; ?></p>

        <!-- Afficher les valeurs conditionnelles -->
        <?php if ($hero_current_level): ?>
            <p>Niveau actuel: <?= $hero_current_level; ?></p>
        <?php endif; ?>

        <?php if ($hero_bourse_or): ?>
            <p>Bourse d'or: <?= $hero_bourse_or; ?></p>
        <?php endif; ?>

        <?php if ($hero_image): ?>
            <p>Image:</p>
            <img src="<?= $hero_image; ?>" alt="Image du héros">
        <?php endif; ?>
    <a href="../Chapter/1" class="button">Partir à l'aventure !</a>
    </div>
    <a href="../controllers/traitement_creationClasse.php" class="button">Retour</a>
</div>
</body>
</html>
