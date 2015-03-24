<?php
session_start();

  //Connection au serveur
$cnx = mysql_connect( "localhost", "root", "" ) ;

  //sélection de la base de données:
$db  = mysql_select_db( "foor",$cnx ) ;
   //récupération des valeurs des champs:

  //message:

$username=$_SESSION['username'];

  //récupération de l'identifiant de la personne:
$id  = $_GET["id_reponse"] ;
$Id  = $_GET["id_sujet_a_lire"] ;


$query=mysql_query("SELECT * FROM jaime WHERE  username='{$_SESSION['username']}' AND id_reponse='$Id' ");

$rows = mysql_num_rows($query);
if($rows == true){
  $sql="UPDATE forum_reponses SET jaime=jaime-1 WHERE id='$id' ";
       //exécution de la requête SQL:
  $requete = mysql_query($sql, $cnx) or die( mysql_error() ) ;
  
  $sQl = "DELETE from jaime WHERE  username='{$_SESSION['username']}' AND id_reponse='$Id' AND id ='$id'";
  //exécution de la requête SQL:
  $requet = mysql_query($sQl, $cnx) or die( mysql_error() ) ;
  
  if($requete)
  {
   
    header("Location: lire_sujet.php?id_sujet_a_lire=".$Id);
    
    
  }
}

?>