<?php
session_start();
?>
<html>
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
  <meta charset="utf-8">
  <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
  <meta charset="utf-8">
  <title>Askaround.fr</title>
  
  <meta name="generator" content="Bootply" >
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
  
  
  <link rel="shortcut icon" href="dist/image_vote/vote.png">
  <style type="text/css">
    .blog-footer {
      padding: 40px 0;
      color: #999;
      text-align: center;
      background-color: #f9f9f9;
      border-top: 1px solid #e5e5e5;
    }

  </style>
  

</head>    
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="navbar-header">
    <a class="navbar-brand" rel="home.php" href="first_page.php">Ma page</a>
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>

    
  </div>
  <div class="collapse navbar-collapse">
    <ul class="nav navbar-nav">
      <li><a href="home.php">La liste des questions posées</a></li>
      <li><a href="insert_sujet.php">poser une question</a></li>
      
      <li> 
       
        <p class="navbar-text pull-right">      
          <a class="btn btn-xs btn-danger" href="connect.php?DCNT"> Log off </a>                         
        </p>
        <p class="navbar-text pull-right">              Bonjour 
         <?php if(isset($_SESSION['username'])) { echo $_SESSION['username']."&nbsp;";} else header('Location: index.php?RC'); ?>

         </p>  
       </li>          
     </ul>

     
   </div>
 </nav>

 <div class="jumbotron">
  <h2>Modification</h2>
  <br><br>
  <p><a href="home.php" class="btn btn-primary btn-lg" role="button">Retour &raquo;</a></p>
</div>
<body>


  <?php

  if (!isset($_GET['FF'])) {

  //connection au serveur
    $cnx = mysql_connect( "localhost", "root", "" ) ;
    
  //sélection de la base de données:
    $db  = mysql_select_db( "foor",$cnx ) ;
    
  //récupération des valeurs des champs:
  //username:
    $username   = $_SESSION["username"] ;
  //message:
    $message = $_POST["message"] ;
    
    
  //récupération de l'identifiant de la personne:
    $id  = $_POST["id"] ;
    $Id  = $_POST["Id"] ;
  //création de la requête SQL:
    $sql = "UPDATE forum_reponses
    SET 
    message = \"$message\"
    
    WHERE id = \"$id\"  " ;
    
  //exécution de la requête SQL:
    $requete = mysql_query($sql, $cnx) or die( mysql_error() ) ;
    

    $sql="SELECT * FROM jaime WHERE  username='{$_SESSION['username']}' AND id='$Id' ";
    $req = mysql_query( $sql, $cnx ) ;
    $result = mysql_fetch_array( $req );
    $rows = mysql_num_rows($req);
    
  //affichage des résultats, pour savoir si la modification a marchée:
    if($requete && $rows ==true)
    {
      echo("La modification à été correctement effectuée") ;
      echo "<br>";
      echo "<a href=\"./lire_sujet.php?id_sujet_a_lire=".$Id."&message=".$message."&id_reponse=".$result['id_reponse']."\">".'Retour'."</a>";
    }
    elseif($requete){
     echo("La modification à été correctement effectuée") ;
     echo "<br>";
     echo "<a href=\"./lire_sujet.php?id_sujet_a_lire=".$Id."&message=".$message."\">".'Retour'."</a>";
     
   }else{
    echo("La modification à échouée") ;
  }
}
?>
<?php

if (isset($_GET['FF'])) {

  //connection au serveur
  $cnx = mysql_connect( "localhost", "root", "" ) ;
  
  //sélection de la base de données:
  $db  = mysql_select_db( "foor",$cnx ) ;
  
  //récupération des valeurs des champs:
  //username:
  $username   = $_SESSION["username"] ;
  //message:
  $message = $_POST["message"] ;
  
  
  //récupération de l'identifiant de la personne:
  $id  = $_POST["id"] ;
  
  //création de la requête SQL:
  $sql = "UPDATE forum_sujets
  SET 
  message = \"$message\"
  
  WHERE id = \"$id\"  " ;
  
  //exécution de la requête SQL:
  $requete = mysql_query($sql, $cnx) or die( mysql_error() ) ;
  

  $sql="SELECT * FROM jaime WHERE  username='{$_SESSION['username']}' AND id='$id' ";
  $req = mysql_query( $sql, $cnx ) ;
  $result = mysql_fetch_array( $req );
  $rows = mysql_num_rows($req);
  
  //affichage des résultats, pour savoir si la modification a marchée:
  if($requete)
  {
   $sQl = "DELETE from jaime WHERE  username='{$_SESSION['username']}' AND id ='$id'";
    //exécution de la requête SQL:
   $requet = mysql_query($sQl, $cnx) or die( mysql_error() ) ;

   echo("La modification à été correctement effectuée") ;
   echo "<br>";
   
   
 }else{
  echo("La modification à échouée") ;
  echo "<br>";
  
}
}
?>

<br><br><br><br><br><br><br><br><br><br>
<div class="row">
  <div class="blog-footer">
    <p>Question and respond site built  by Abderrahmane Kammous and Anass Seddiki.</p>
    <p>
      <a href="first_page.php">Back to top</a>
    </p>
  </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="dist/js/bootstrap.min.js"></script>
<script src="dist/js/docs.min.js"></script>
</body>
</html>