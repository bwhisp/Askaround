<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset='utf-8'>
	<title>Add/edit users</title>
	<link href="dist/css/bootstrap.css" rel="stylesheet">
</head>
<body>
	<a href="index.php" >Hello.php</a>
	<?php 
	if (!isset($_POST['add_new'])){
		header('Location: sign_up_page.php');
	}

	require_once('config.php');
$link = mysqli_connect($GLOBALS['host'], $GLOBALS['login'], $GLOBALS['password'], $GLOBALS['db']);  // Connect to database
if (!$link) die('Error: ' . mysqli_error($link));

// Si un formulaire à été envoyé
if(isset($_POST['add_new'])) {          // Charger les entrées du formulaire d'inscription
	$email = $_POST['email'];             // Clé primaire de la table
	$pass1 = $_POST['password'];
	$pass2 = md5($pass1);                 // Cryptage du mot de passe avec l'algorithme md5
	
	$username = $_POST['username'];


	// Verification de l'unicité de l'adresse e-mail
	$query = "SELECT * FROM users WHERE Email =\"$email\";";

	if ($stmt = mysqli_prepare($link, $query)) {      // Nombre de résultats de la dernière requête
		mysqli_stmt_execute($stmt);
		mysqli_stmt_store_result($stmt);
		$number = mysqli_stmt_num_rows($stmt);
		mysqli_stmt_close($stmt);

	}

	if ($number >=1){                                //Si c'est >=1 redirection à la page d'inscription avec un message d'erreur
	header("Location: sign_up_page.php?AI");
}


	$signup_date=date("d-m-Y");                       // Enregistrement de la date en cours dans la table d'utilisateurs, au champ date d'inscription

	// Insertion de tous les éléments dans la table des utilisateurs
	$query = "INSERT INTO users (id_user, Email, Password, username, Signup_date) VALUES ( \" \", \"$email\", \"$pass2\", \"$username\", \"$signup_date\");";
	$result = mysqli_query($link, $query);
	if (!$result) die('Error: ' . mysqli_error($link) . ". Query: $query.");
	else $message = "User $email successfully added.";
	

	header('Location: index.php?WM');
}

mysqli_close($link); // close the connexion
?>