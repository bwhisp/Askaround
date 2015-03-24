<?php
session_start();

if (!isset($_POST['Email']) && !isset($_GET['DCNT'])){
	header('Location: index.php');
}

require_once ('config.php');
$link = mysqli_connect($GLOBALS['host'], $GLOBALS['login'], $GLOBALS['password'], $GLOBALS['db']);  /// Connection à la BDD
if (!$link) die('Error: ' . mysqli_error($link));

if (isset($_POST['Email'])) {   // Si un formulaire de connexion a été envoyé
   $pass1 = $_POST['Password'];   //Charger le mot de passe entré dans une variable
   $pass2 = md5($pass1); //Cryptage du mot de passe afin de le comparer à celui de la base de données

    // Sécurisation de la BDD contre les injection d'adresse mail
   if (get_magic_quotes_gpc()) {

   	$email = stripslashes($_POST['Email']);
   }
   else {
   	$email = $_POST['Email'];
   }
   $email_ready = mysqli_real_escape_string($link, $email);

	// Chargement des données en fonction de l'e-mail
   $query = "SELECT Password,id_user,username from users  where Email=\"$email_ready\"";
   $result = mysqli_query($link, $query);
   if (!$result) die('Error: ' . mysqli_error($link) . ". Query: $query.");
   $row = mysqli_fetch_array($result);
   $id= $row['id_user'];
   $username = $row['username'];
   $email = $row['Email'];
	if ($row['Password'] == $pass2) { // Si les mots de passes correspondent...
		     $_SESSION['id_user'] = $id;     // ...Mettre l'ID et le nom d'utilisateur dans la session
		     $_SESSION['username'] = $username;

		     header('Location: first_page.php');
	}    // ...Redirection à la page d'accueil
	else {                                                    // Si les mots de passe ne correspondent pas ...
		header('Location: index.php?WP&Email=$email');
	}   // ...redirect à la page de connexion
}

if (isset($_GET['DCNT'])) {
	session_unset();     
	session_destroy();   

	header('Location: index.php?RC');  // Redirection à Hello.php avec un message de déconnexion
	
}


mysqli_close($link);  

?>