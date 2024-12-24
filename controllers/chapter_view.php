<?php
require_once 'controllers/ChapterController.php';
require_once 'index.php';

$ChapterController= new ChapterController();
$chapter =  $ChapterController->getChapter($id);

$router = $GLOBALS['router'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo $chapter->getTitle(); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Cinzel+Decorative:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../views/styleChapitre.css">
</head>
<body>
    <div class="container">
        <h1><?php echo htmlspecialchars($chapter->getTitle()); ?> </h1>
        <img src="<?php echo htmlspecialchars($chapter->getImage()); ?>" alt="Image de chapitre">
        <div class="text-block">
            <p><?php echo nl2br(htmlspecialchars($chapter->getDescription())); ?></p>
        </div>
        <h2>Choisissez votre chemin:</h2>
        <ul>
            <?php foreach ($chapter->getChoices() as $choice): ?>
                <li>
<<<<<<< HEAD:views/chapter_view.php
                    <a class="button" href="<?php echo htmlspecialchars($choice['chapter']); ?>">
                        <?php echo htmlspecialchars($choice['text']); ?>
                    </a>
=======
                <a class="button" href="/DungeonXplorer/Chapter/<?php echo $choice['chapter']; ?>">
                    <?php echo htmlspecialchars($choice['text']); ?>
                </a>
>>>>>>> 1b7533505d211f35132fd1d015fbf77cd5282d83:controllers/chapter_view.php
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
