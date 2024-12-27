<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../views/style.css">
    <title>Formulaire d'inscription</title>
</head>
<body>
    <div class="container">
        <h1>Inscription</h1>
        <div class="text-block">
            <form id="formulaireInscription" name="formulaireInscription" action="../controllers/traitement_inscription.php" method="post">
                <label for="courriel">Courriel :</label>
                <input type="email" id="courriel" name="courriel" size="32" required><br>
                <label for="pseudo">Pseudo :</label>
                <input type="text" id="pseudo" name="pseudo" size="32" required><br>
                <label for="mdp">Mot de passe :</label>
                <input type="password" id="mdp" name="mdp" size="64" autocomplete="off" required><br>
                <button type="submit" name="BtSub">S'inscrire</button>
            </form>
        </div>
    </div>
</body>
</html>
