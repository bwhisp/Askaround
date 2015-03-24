<?php
session_start();
require_once('config.php');
// on teste si le formulaire a été soumis
if (isset ($_POST['go']) && $_POST['go']=='Poster') {
  // on teste la déclaration de nos variables
  if (!isset($_SESSION['username']) || !isset($_POST['titre']) || !isset($_POST['message'])) {
    $erreur = 'Les variables nécessaires au script ne sont pas définies.';
  }
  else {
  // on teste si les variables ne sont pas vides
    if ( empty($_POST['titre']) || empty($_POST['message'])) {
      $erreur = 'Au moins un des champs est vide.';
    }

  // si tout est bon, on peut commencer l'insertion dans la base
    else {
    // on se connecte à notre base
      $base = mysql_connect ('localhost', 'root', '');
      mysql_select_db ('foor', $base) ;

    // on calcule la date actuelle
      $date = date("Y-m-d H:i:s");
      $username=$_SESSION['username'];

    // préparation de la requête d'insertion (pour la table forum_sujets)
      $sql = 'INSERT INTO forum_sujets VALUES("", "'.$_SESSION['username'].'", "'.mysql_real_escape_string($_POST['titre']).'","'.mysql_real_escape_string($_POST['message']).'", "'.$date.'")';

    // on lance la requête (mysql_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)
      mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());


    // on ferme la connexion à la base de données
      mysql_close();

    // on redirige vers la page d'accueil
      header('Location: home.php');

    // on termine le script courant
      exit;
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
 <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
 <meta charset="utf-8">


 <meta name="generator" content="Bootply" >
 <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
 <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">


 <link rel="shortcut icon" href="/bootstrap/img/favicon.ico">
 <link rel="apple-touch-icon" href="/bootstrap/img/apple-touch-icon.png">
 <link rel="apple-touch-icon" sizes="72x72" href="/bootstrap/img/apple-touch-icon-72x72.png">
 <link rel="apple-touch-icon" sizes="114x114" href="/bootstrap/img/apple-touch-icon-114x114.png">

 <title>Insertion d'un nouveau sujet</title>
 <style type="text/css">



  .blog-footer {
    padding: 40px 0;
    color: #999;
    text-align: center;
    background-color: #f9f9f9;
    border-top: 1px solid #e5e5e5;
  }
  body {
    padding-top: 70px;
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
    </div>
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li><a href="home.php">Home</a></li>
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




   <!-- on fait pointer le formulaire vers la page traitant les données -->
   <section id="post_question">
    <div class"container">
      <form name="questform" action="insert_sujet.php" method="post" onsubmit="return checkForm(questform);">
        <div class="row">
          <div class="col-lg-12 text center"> 
            <h3>Taper votre question : </h3>
            <hr class="star-primary">

          </div>
        </div>
        <div class="row">
          <div class="col-lg-8 col-lg-offset-2">

            <form role="form">
              <div class="row">
                <div class="form-group col-xs-12 floating-label-form-group">
                  <label for="Title">Auteur :</label>

                  <?php if (isset($_SESSION['username'])) echo $_SESSION['username']; ?>


                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-8 col-lg-offset-2">
                <form role="form">
                  <div class="row">
                    <div class="form-group col-xs-12 floating-label-form-group">
                      <label for="Title">Titre :</label>

                      <input   class="form-control" type="text" name="titre" placeholder="This field  can only contain letters, numbers and underscores" maxlength="30" size="50" value="<?php if (isset($_POST['titre'])) echo htmlentities(trim($_POST['titre'])); ?>">


                    </div>
                  </div>
                  
                  <form role="form">
                    <div class="row">
                      <div class="form-group col-xs-12 floating-label-form-group">  
                        <label for="message">Question:</label>  <br>            
                        <textarea rows="4" name ="message" class="resize-this three" type="text" maxlength="150" placeholder="When we were in Hawai, you paid me a drink .."cols="50" rows="10"><?php if (isset($_POST['message'])) echo htmlentities(trim($_POST['message'])); ?></textarea>            
                      </div>
                    </div>
                    
                    <br>                  
                    <br>                  
                    <br>                                  
                    <button type="submit" name="go" class="btn btn-primary btn-larg" value="Poster">Send &raquo;                   
                    </button>                               


                  </form>

                  <?php
// on affiche les erreurs éventuelles
                  if (isset($erreur)) echo '<br /><br />',$erreur;
                  ?>


                  <br><br><br><br><br>
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