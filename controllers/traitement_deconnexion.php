<?php
session_start();

	if($_SESSION['loggedin'] == false)
	{
		echo "<script type='text/javascript'>
			alert('Vous êtes déjà déconnecté.');
			window.location.href = 'connexion.htm';
		</script>";
	}
	else
	{
		//on reinitialise toutes les variables de session.
		unset($_SESSION['numero']);
		unset($_SESSION['courriel']);
		unset($_SESSION['hero']);
		//On met le booeleen loggedIn a false.
		$_SESSION['loggedin'] = false;
	}
?>
