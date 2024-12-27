<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../views/style.css">
    <title>Choix d'un rôle</title>
</head>
<body>
    <div class="container">
    <h1>Choisissez votre rôle</h1>

    <form action="../controllers/traitement_creationClasse.php" method="post" class="text-block">

        <label for="nom">Votre nom : </label><input type="text" id="nom" name="nom" size="32" value=""><br />
        <!--<label for="image">Votre image : </label><input type="image" id="image" name="image" size="64"  AUTOCOMPLETE=OFF> <br />-->
        <label for="biography">Votre histoire : </label><input type="text" id="biography" name="biography" value=""><br />
        <label for="role">Sélectionnez un rôle :</label>
        <select name="role" id="role" required>
            <option value="" disabled selected>-- Choisir un rôle --</option>
            <option value="voleur">Voleur</option>
            <option value="guerrier">Guerrier</option>
            <option value="magicien">Magicien</option>
        </select>
        <br><br>
        <button type="submit">Valider</button>
    </form>
    <h2>Vous avez deja un personnage ?</h2>
    <a href="../controllers/ancienController.php" class="button">Choisir un ancien personnage</a>
</div>
</body>
</html>
