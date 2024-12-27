<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../views/style.css">
    <title>Formulaire de connexion</title>
  </head>
  <body>
    <div class="container">
    <h1>Connexion</h1>
    <div class="text-block">
    <form id="formulaireConnexion" name="formulaireConnexion" action = "../controllers/traitement_connexion.php" method="post">
		  <label for="courriel">Courriel : </label><input type="text" id="courriel" name="courriel" size="32" value=""><br />
      <label for="mdp">Mot de passe : </label><input type="password" id="mdp" name="mdp" size="64"  AUTOCOMPLETE=OFF> <br />
		  <button type="submit" name="BtSub">Connexion</button>
	  </form>
</div>
    <form id="formulaireDeconnexion" name="formulaireDeconnexion" action = "../controllers/traitement_deconnexion.php" method="post">
    <br>
      <button type="submit" name="BtSub" >Deconnexion</button>
    <br>
    <a href="../views/formulaire_inscription.php">
      <button type="button">Pas encore inscrit ? Inscrivez-vous</button>
    </a>
    </form>
</div>
  </body>
</html>