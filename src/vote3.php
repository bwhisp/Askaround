<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
  <meta charset="utf-8">
  <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
  <meta charset="utf-8">

  <meta name="generator" content="Bootply" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">

  <title>Vote Askaround</title>

  <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">

  <link href="../../dist/css/bootstrap-theme.min.css" rel="stylesheet">


  <link href="theme.css" rel="stylesheet">


</head>    



<?php
session_start();

  //connection au serveur
$cnx = mysql_connect( "localhost", "root", "" ) ;

  //sélection de la base de données:
$db  = mysql_select_db( "foor",$cnx ) ;

  //récupération des valeurs des champs:
  //usernaPOST
$jaime   = $_POST["jaime"] ;
  //message:

$username=$_SESSION['username'];

  //récupération de l'identifiant de la personne:
$id  = $_POST["id"] ;
$Id  = $_POST["Id"] ;

$query=mysql_query("SELECT * FROM jaime WHERE  username='{$_SESSION['username']}' AND id_reponse='$Id' ");
$rows = mysql_num_rows($query);
if($rows == true){

  echo "<div class=\"alert alert-danger\">"."<h3>"."vous avez deja fait un vote !"."</h3>"."</div>";
  echo "<a href=\"lire_sujet.php?id_sujet_a_lire=".$Id."&id_reponse=".$id."\">"."<h4>".'Retour au menu réponse'."<h4>"."</a>";
  echo "<br>";
}else{
  //création de la requête SQL:
  $sql="UPDATE forum_reponses SET jaime=jaime+1 WHERE id='$id' ";


           //exécution de la requête SQL:
  $requete = mysql_query($sql, $cnx) or die( mysql_error() ) ;
  

  $sQl = 'INSERT INTO jaime VALUES("","'.$id.'","'.$Id.'","'.$username.'")';
  //exécution de la requête SQL:
  $requet = mysql_query($sQl, $cnx) or die( mysql_error() ) ;


  //affichage des résultats, pour savoir si la modification a marchée:
  if($requete)
    { echo "<div class=\"alert alert-success\">"."<h3>"."Votre vote est ajouté"."<h3>"."</div>";;

  echo "<br>"."<br>";
  echo "<a href=\"lire_sujet.php?id_sujet_a_lire=".$Id.'&'.'id_reponse='.$id."\">"."<h4>".'Retour au menu réponse'."<h4>"."</a>";
  echo "<br>"."<br>";
  echo "<a href=\"home.php\">"."<h4>".'Retour à la page d\'accueil'."<h4>"."</a>";
}
}

?>
<body>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="dist/js/bootstrap.min.js"></script>
<script src="dist/js/docs.min.js"></script>
</html>