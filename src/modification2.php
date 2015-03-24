<!DOCTYPE html>
<html>
<head>
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
<body>

 <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="navbar-header">
    <a class="navbar-brand" rel="home.php" href="first_page.php">Ma page</a>
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>

    <?php
    session_start();
    ?>
  </div>
  <div class="collapse navbar-collapse">
    <ul class="nav navbar-nav">
      <li><a href="home.php">La liste des questions posées</a></li>
      <li><a href="insert_sujet.php">poser une question</a></li>
      
      <li> 
       
        <p class="navbar-text pull-right">      
          <a class="btn btn-xs btn-danger" href="connect.php?DCNT"> Log off </a>                         
        </p>
        <p class="navbar-text pull-right">             Bonjour
         <?php if(isset($_SESSION['username'])) { echo $_SESSION['username']."&nbsp;";} else header('Location: index.php?RC'); ?>

         </p>  
       </li>          
     </ul>

     
   </div>
 </nav>

 <div class="jumbotron">
  <h2>Modification</h2><br><br><br>
  <p>Taper votre nouvelle question :</p>
</div>


<?php
if (!isset($_GET['FF'])) {
 

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
  WHERE id = ".$id."" ;
  
  //exécution de la requête:
  $requete = mysql_query( $sql, $cnx ) ;
  
  //affichage des données:
  if( $result = mysql_fetch_array( $requete ) )
  {
    ?>
    <form name="insertion" action="modification3.php" method="POST">
      <input type="hidden" name="id" value="<?php echo($id) ;?>">
      <input type="hidden" name="Id" value="<?php echo($Id) ;?>">
      <table border="1" align="center" cellspacing="4" cellpadding="4">
        <tr align="center">
         <label for="Title"><strong>Auteur :<strong></label>
         <td><?php echo($username=$result['username']) ;?></td>
       </tr>
       <tr align="center">
        <td><strong>Message :<strong></td>
        <td><textarea cols="80" rows="6" name="message" ><?php echo($message=$result['message']) ;?></textarea> </td>
      </tr>
      
      <tr align="center">
        <td colspan="2"><input type="submit"  class="btn btn-primary btn-larg" value="modifier"></td>
      </tr>
    </table>
  </form>
  <?php
  }//fin if 
}
?>
<?php
if (isset($_GET['FF'])) {
  
  //connection au serveur:
  $cnx = mysql_connect( "localhost", "root", "" ) ;
  
  //sélection de la base de données:
  $db = mysql_select_db( "foor", $cnx ) ;
  
  //récupération de la variable d'URL,
  //qui va nous permettre de savoir quel enregistrement modifier
  $id  = $_GET["idsujet"] ;
  
  //requête SQL:
  $sql = "SELECT *
  FROM forum_sujets
  WHERE id = ".$id."" ;
  
  //exécution de la requête:
  $requete = mysql_query( $sql, $cnx ) ;
  
  //affichage des données:
  while( $result = mysql_fetch_array($requete) )
  {
    ?>
    <form name="insertion" action="modification3.php?FF" method="POST">
      <input type="hidden" name="id" value="<?php echo($id) ;?>">
      
      <table border="0" align="center" cellspacing="2" cellpadding="2">
        <tr align="center">
          <td><strong>Auteur :</strong></td>
          <td><?php echo($username=$result['username']) ;?></td>
        </tr><br><br>
        <tr align="center">

          <td><strong>Message :</strong></td>
          
          <td><textarea name="message" cols="80" rows="6"><?php echo($message=$result['message']) ;?></textarea> </td>
        </tr>
        
        <tr align="center">
          <td colspan="2"><input  type="submit" class="btn btn-primary btn-larg" value="modifier"></td>
        </tr>
      </table>
    </form>
    <?php
  }//fin while
} // fin if
?>


<br><br><br><br><br>
<div class="row">
  <div class="blog-footer">
    <p>Question and respond site built  by Aberrahmanne Kammous and Anass Seddiki.</p>
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