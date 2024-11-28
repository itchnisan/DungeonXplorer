<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Formulaire de connexion</title>
  </head>
  <body>
    <form id="formulaireConnexion" name="formulaireConnexion" action = "../controllers/traitement_connexion.php" method="post">
		  <label for="courriel">Courriel : </label><input type="text" id="courriel" name="courriel" size="32" value=""><br />
      <label for="mdp">Mot de passe : </label><input type="password" id="mdp" name="mdp" size="64"  AUTOCOMPLETE=OFF> <br />
		  <input type="submit" name="BtSub" value="Connexion">
	  </form>
    <form id="formulaireDeconnexion" name="formulaireDeconnexion" action = "../controllers/traitement_deconnexion.php" method="post">
      <input type="submit" name="BtSub" value="Déconnexion">
    </form>
  </body>
</html>