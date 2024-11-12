<?php

session_start();

	function afficherObj($obj)
	{
		echo "<PRE>";
		print_r($obj);
		echo "</PRE>";
	}

	include_once "connextionPDO.php";

    $_SESSION['loggedin'] = false;
	$_SESSION['isAdmin'] = false;
	$_SESSION['numero'];
	$_SESSION['courriel'];

	function connexion()
    {	

		$erreur = 0;

		if(!empty($_POST["courriel"]) and (filter_var($_POST["courriel"], FILTER_VALIDATE_EMAIL)) and !empty($_POST["mdp"]))
		{
			$courriel = $_POST["courriel"];
			$mdp = $_POST["mdp"];
		}
		else
		{
			$erreur = 1; // n'a pas renseigner tout les champs
		}

		if($erreur == 0)
		{
			$sql = "SELECT hero_id FROM USER WHERE user_mail = '".$courriel."'";
			$donnee;
			$existe = LireDonneesPDO2($mysqlClient,$sql,$donnee);
			if($existe == 0)
			{
				$erreur = 2; // existe pas dans la base
			} 
			else
			{
				$sql = "SELECT user_mdp FROM USER WHERE user_mail = '".$courriel."'";
				$donnee;
				$res = LireDonneesPDO2($mysqlClient,$sql,$donnee);
				if (isset($donnee[0])){
					// Comparez les mots de passe
					if ($donnee[0]["PER_MDP"] != $mdp) 
					{
						$erreur = 3; // Le mot de passe n'est pas bon
					}
					else
					{
						$sql = "SELECT hero_id  FROM USER WHERE user_mail = '".$courriel."'";
						$donnee;
						$res = LireDonneesPDO2($c,$sql,$donnee);
						$_SESSION['numero'] = $donnee[0]["hero_id"];
						$_SESSION['courriel'] = $courriel;

						$sql = "SELECT admin_id FROM ADMINS WHERE user_mail = '".$courriel."'";
			            $donnee;
                        $existe = LireDonneesPDO2($mysqlClient,$sql,$donnee);
                        if($existe == 1)
                        {
                            $_SESSION['loggedin'] = true; // l'utilisateur est un administrateur
                        } 
					}
				}
			}
		}
		
		/*switch($erreur)
		{
			case 0:
				echo $_SESSION['loggedin'];
                break;
			default:
				echo "<script type='text/javascript'>
					alert('Courriel ou MDP incorrect');
					window.location.href = 'connexion.htm';
				</script>";
                break;
		}*/
	}

	if($mysqlClient){
		connexion($mysqlClient);
	}
?>
