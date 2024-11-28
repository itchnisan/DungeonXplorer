<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choix d'un rôle</title>
</head>
<body>
    <h1>Choisissez votre rôle</h1>
    <form action="../controllers/traitement_creationClasse.php" method="post">
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
</body>
</html>
