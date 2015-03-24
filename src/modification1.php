<html>
<head>
  <title>modification de données </title>
</head>
<body>


  <?php

  require_once('config.php');
  if (!isset($_GET['id_sujet_a_lire']) && !isset($_GET['id'])) {
    echo 'Sujet non défini.';
  }
  else{
    ?>
    <?php
    session_start();
    $id = $_GET['id'];
    $Id= $_GET['id_sujet_a_lire'];
    //connection au serveur:
    $cnx = mysql_connect( "localhost", "root", "" ) ;
    
    //sélection de la base de données:
    $db = mysql_select_db( "foor" ) ;
    
    //requête SQL:
    $sql = "SELECT *
    FROM forum_reponses
    ORDER BY username" ;
    
    //exécution de la requête:
    $requete = mysql_query( $sql, $cnx ) ;
    
    //affichage des données:
    while( $result = mysql_fetch_array( $requete ) )
    {
      $username=$result['username'];

      if($_SESSION['username'] == $username && $id == $result['id']){
       header('Location: modification2.php?idPersonne='.$id=$result['id'].'&Id='.$Id.'');
       
     }else{
      echo"";
    }
  }
}
?>
<?php

require_once('config.php');
if (!isset($_GET['id_sujet_a_lire']) && !isset($_GET['FF'])) {
  echo 'Sujet non défini.';
}
else{
  ?>
  <?php
  session_start();
  
  $Id= $_GET['id_sujet_a_lire'];
    //connection au serveur:
  $cnx = mysql_connect( "localhost", "root", "" ) ;
  
    //sélection de la base de données:
  $db = mysql_select_db( "foor" ) ;
  
    //requête SQL:
  $sql = "SELECT *
  FROM forum_sujets
  ORDER BY username" ;
  
    //exécution de la requête:
  $requete = mysql_query( $sql, $cnx ) ;
  
    //affichage des données:
  while( $result = mysql_fetch_array( $requete ) )
  {
    $username=$result['username'];

    if($_SESSION['username'] == $username && $Id == $result['id']){
     header('Location: modification2.php?idsujet='.$Id=$result['id'].'&FF');
     
   }else{
    echo"";
  }
}
}
?>
</body>
</html>
