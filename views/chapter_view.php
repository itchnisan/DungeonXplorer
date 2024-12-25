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
</head>
<body>
    <div class="container">
        <h1><?php echo htmlspecialchars($chapter->getChapterNom()); ?> </h1>
        <img src="../<?php echo htmlspecialchars($chapter->getChapterImage()); ?>" alt="Image de chapitre">
        <div class="text-block">
            <p><?php echo nl2br(htmlspecialchars($chapter->getChapterContent())); ?></p>
        </div>
        <h2>Choisissez votre chemin:</h2>
        <ul>
            <?php foreach ($chapter->getLinks()  as $choice): ?>
                <li>
                    <a class="button" href="<?php echo htmlspecialchars($choice['chapter_id']); ?>">
                        <?php echo htmlspecialchars($choice['description']); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
