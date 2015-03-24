<?php

require_once('config.php');

if (isset($_POST['create_db'])){
	$db_name = $GLOBALS['db'];
	$link = mysqli_connect($GLOBALS['host'], $GLOBALS['login'], $GLOBALS['password']); // Connect to database	
	$query = "CREATE DATABASE IF NOT EXISTS $db_name;";
	$result = mysqli_query($link, $query);
	
	if (!$result) die('Error: ' . mysqli_error($link));
	else echo "Database ".$db_name." succesfully created. Go back to finish the install :"."<a href=\"install_int.php\">DEPLOY INTERFACE</a>";
}
if (isset($_POST['create_tables'])){

$link = mysqli_connect($GLOBALS['host'], $GLOBALS['login'], $GLOBALS['password'], $GLOBALS['db']); // Connect to database
if (!$link) die('Error: ' . mysqli_error($link));


// Création de la tables des utilisateurs 
$query = "CREATE TABLE IF NOT EXISTS users (id_user int(11) NOT NULL auto_increment,Email varchar(50) NOT NULL , Password varchar(50) NOT NULL,username varchar(15) NOT NULL, Signup_date varchar(10) NOT NULL, PRIMARY KEY (id_user));";
$result = mysqli_query($link, $query);

if (!$result) die('Error: ' . mysqli_error($link));
else echo "Users table succesfully created."."<br>";

// Création de la table des topics
$query = "CREATE TABLE IF NOT EXISTS forum_sujets (id int(11) NOT NULL auto_increment,
	username VARCHAR(15) NOT NULL,
	titre text NOT NULL,
	message VARCHAR(200) NOT NULL,
	date_derniere_reponse datetime NOT NULL default '0000-00-00 00:00:00',
	
	PRIMARY KEY  (id)) ;";
$result = mysqli_query($link, $query);

if (!$result) die('Error: ' . mysqli_error($link));
else echo "forum_sujets table succesfully created."."<br>";

// Création de la table des réponses
$query = "CREATE TABLE IF NOT EXISTS forum_reponses (id int(11) NOT NULL auto_increment,
	username VARCHAR(15) NOT NULL,
	message varchar(200) NOT NULL,
	date_reponse datetime NOT NULL default '0000-00-00 00:00:00',
	correspondance_sujet int(11) NOT NULL,
	jaime int(10) NOT NULL DEFAULT '0',
	PRIMARY KEY  (id))
;";
$result = mysqli_query($link, $query);

if (!$result) die('Error: ' . mysqli_error($link));
else echo "forum_reponses table succesfully created."."<br>";

// Création de la tabledes votes
$query = "CREATE TABLE IF NOT EXISTS jaime (id_jaime int(11) NOT NULL auto_increment,
	id int(11) NOT NULL ,
	id_reponse int(11) NOT NULL ,
	username varchar(15) NOT NULL ,

	PRIMARY KEY  (id_jaime)) ;";
$result = mysqli_query($link, $query);

if (!$result) die('Error: ' . mysqli_error($link));
else echo "Jaime table succesfully created."."<br>";

$id_q1="1";
$auteur_q1 = "max";
$titre1="Maxtitle";
$message_q1 = "Hello?";
$jaime1="1";

$id_r1="1";
$auteur_r1 = "Bob";
$message_r1 = "Hello!";
$id_reponse = "1";
$corresp1 = "1";


$email1 = "max@max.com";             // Clé primaire de la table
$pass1 = md5("max");                // Cryptage du mot de passe avec l'algorithme md5
$username1 = "max";
$id_user1= "1";

$email2 = "bob@bob.com";             
$pass2 = md5("bob");                
$username2 = "bob";
$id_user2= "2";

$id_jaime1= "1";


$signup_date=date("d-m-Y");    

//Insertion de toutes les donnée dans la table des utilisateurs...
$query = "INSERT INTO users (id_user ,Email, Password , username,  Signup_date) VALUES (\"$id_user1\",\"$email1\", \"$pass1\", \"$username1\",  \"$signup_date\");";
$result = mysqli_query($link, $query);
if (!$result) die('Error: ' . mysqli_error($link) . ". Query: $query.");
else $message = "$id_user1 successfully created."."<br>";

$query = "INSERT INTO users (id_user,Email, Password , username , Signup_date) VALUES (\"$id_user2\",\"$email2\", \"$pass2\", \"$username2\", \"$signup_date\");";
$result = mysqli_query($link, $query);
if (!$result) die('Error: ' . mysqli_error($link) . ". Query: $query.");
else $message = "$id_user2 successfully created."."<br>";


//...Dans la table des votes...
$query = "INSERT INTO  jaime (id_jaime,id,id_reponse, username) VALUES (\"$id_jaime1\", \"$id_r1\",\"$id_reponse\",\"$username1\");";
$result = mysqli_query($link, $query);
if (!$result) die('Error: ' . mysqli_error($link) . ". Query: $query.");
else $message = "like1 successfully submited."."<br>";

//...Dans la table des topics...
$query = "INSERT INTO forum_sujets (id, username ,titre, message , date_derniere_reponse ) VALUES (\"$id_q1\", \"$username1\",\"$titre1\" ,\"$message_q1\", \"$signup_date\");";
$result = mysqli_query($link, $query);
if (!$result) die('Error: ' . mysqli_error($link) . ". Query: $query.");
else $message = "$message_r1  successfully created."."<br>";

//...Et dans la table des réponses
$query = "INSERT INTO forum_reponses (id, username ,message , date_reponse , correspondance_sujet , jaime ) 
VALUES (\"$id_r1\", \"$username2\",\"$message_r1\", \"$signup_date\",\"$id_q1\",\"$jaime1\");";
$result = mysqli_query($link, $query);
if (!$result) die('Error: ' . mysqli_error($link) . ". Query: $query.");
else $message = "$message_r1  successfully created."."<br>";




echo "get started : <a href=\"index.php\">HERE ! </a>";
}
mysqli_close($link); // fermer la connexion

?>