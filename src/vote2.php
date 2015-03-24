 <html>
 <head>
   <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
   <meta charset="utf-8">
   <title>Askaround.fr</title>
   
   <meta name="generator" content="Bootply" />
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
   <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
   
 </head>
 <body>
   <?php
   session_start();
  //connection au serveur:
   $cnx = mysql_connect( "localhost", "root", "" ) ;
   
  //sélection de la base de données:
   $db = mysql_select_db( "foor", $cnx ) ;
   
  //récupération de la variable d'URL,
  //qui va nous permettre de savoir quel enregistrement modifier
   $id  = $_GET["idPersonne"] ;
   $Id  = $_GET["Id"] ;
  //requête SQL:
   $sql = "SELECT *
   FROM forum_reponses
   WHERE id = ".$id."";


   
  //exécution de la requête:
   $requete = mysql_query( $sql, $cnx ) ;
   
  //affichage des données:
   if( $result = mysql_fetch_array( $requete ) )
   {
     

    ?>
    <form name="insertion" action="vote3.php" method="POST">
     <input type="hidden" name="id" value="<?php echo($id) ;?>">
     <input type="hidden" name="jaime" value="<?php echo($jaime) ;?>">
     <input type="hidden" name="Id" value="<?php echo($Id) ;?>">
     <div class="jumbotron">
      <h3>Cliquez ici pour finaliser le vote:</h3>
      
      <p><input type="submit" class="btn btn-lg btn-success" value="Suivant"></p>
      
    </div>
    
  </form>
  <?php

}//fin si
?>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
</html>