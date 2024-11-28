<?php
require_once 'controllers/ChapterController.php';

$ChapterController= new ChapterController();
$chapter =  $ChapterController->getChapter($id);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title><?php echo $chapter->getTitle(); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Cinzel+Decorative:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="views/styleChapitre.css">
</head>
<body>
    <div class="container">
        <h1><?php echo htmlspecialchars($chapter->getTitle()); ?></h1>
        <img src="<?php echo htmlspecialchars($chapter->getImage()); ?>" alt="Image de chapitre">
        <div class="text-block">
            <p><?php echo nl2br(htmlspecialchars($chapter->getDescription())); ?></p>
        </div>
        <h2>Choisissez votre chemin:</h2>
        <ul>
            <?php foreach ($chapter->getChoices() as $choice): ?>
                <li>
                    <a class="button" href="chapter.php?chapter=<?php echo htmlspecialchars($choice['chapter']); ?>">
                        <?php echo htmlspecialchars($choice['text']); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</body>
</html>
