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
		$_SESSION['isAdmin'] = false;
		unset($_SESSION['numero']);
		unset($_SESSION['courriel']);
		$_SESSION['loggedin'] = false;
	}
?>
