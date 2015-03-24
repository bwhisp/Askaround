<?php
session_start();
require_once('config.php');
// on teste si le formulaire a été soumis
if (isset ($_POST['go']) && $_POST['go']=='Poster') {
  // on teste le contenu de la variable $auteur
  if (!isset($_SESSION['username']) || !isset($_POST['message']) || !isset($_GET['numero_du_sujet'])) {
    $erreur = 'Les variables nécessaires au script ne sont pas définies.';
  }
  else {
    if ( empty($_POST['message']) || empty($_GET['numero_du_sujet'])) {
      $erreur = 'Au moins un des champs est vide.';
    }
  // si tout est bon, on peut commencer l'insertion dans la base
    else {
    // on se connecte à notre base de données
      $base = mysql_connect ('localhost', 'root', '');
      mysql_select_db ('foor', $base) ;

    // on recupere la date de l'instant présent
      $date = date("Y-m-d H:i:s");

    // préparation de la requête d'insertion (table forum_reponses)
      $sql = 'INSERT INTO forum_reponses VALUES("", "'.$_SESSION['username'].'", "'.mysql_real_escape_string($_POST['message']).'", "'.$date.'", "'.$_GET['numero_du_sujet'].'","")';


    // on lance la requête (mysql_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)
      mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());


    // on lance la requête (mysql_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)
    //mysql_query($sQl) or die('Erreur SQL !'.$sl.'<br />'.mysql_error());


    // préparation de la requête de modification de la date de la dernière réponse postée (dans la table forum_sujets)
      $sql = 'UPDATE forum_sujets SET date_derniere_reponse="'.$date.'" WHERE id="'.$_GET['numero_du_sujet'].'"';

    // on lance la requête (mysql_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)
      mysql_query($sql) or die('Erreur SQL !'.$sql.'<br />'.mysql_error());

    // on ferme la connexion à la base de données
      mysql_close();

      $sql="SELECT * FROM jaime WHERE  username='{$_SESSION['username']}' AND id='{$_GET['numero_du_sujet']}' ";
      $requete = mysql_query( $sql, $base ) ;
      $result = mysql_fetch_array( $requete );
      $rows = mysql_num_rows($requete);
  // on affiche le titre du sujet, et sur ce sujet, on insère le lien qui nous permettra de lire les différentes réponses de ce sujet
      if($rows == true){
    // on redirige vers la page de lecture du sujet en cours
        header('Location: lire_sujet.php?id_sujet_a_lire='.$_GET['numero_du_sujet'].'&id_reponse='.$result['id_reponse'].'');
      }else{
       header('Location: lire_sujet.php?id_sujet_a_lire='.$_GET['numero_du_sujet'].'');

     }
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
  <title>Askaround : Répondre</title>

  <meta name="generator" content="Bootply" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">


  <link rel="shortcut icon" href="/bootstrap/img/favicon.ico">
  <link rel="apple-touch-icon" href="/bootstrap/img/apple-touch-icon.png">
  <link rel="apple-touch-icon" sizes="72x72" href="/bootstrap/img/apple-touch-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="114x114" href="/bootstrap/img/apple-touch-icon-114x114.png">

  <style type="text/css">


    body {
      padding-top: 70px;
    }
  </style>



</head>

<body>

  <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="navbar-header">
      <a class="navbar-brand" rel="home.php" href="#">Home</a>
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li><a href="#">Profile</a></li>
        <li><a href="insert_sujet.php">Ask a question</a></li>
        <li><a href="#">about</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
            <li class="divider"></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
        <li> 

          <p class="navbar-text pull-right">      
            <a class="btn btn-xs btn-danger" href="connect.php?DCNT"> Log off </a>                         
          </p>
          <p class="navbar-text pull-right">              Bonjour
           <?php if(isset($_SESSION['username'])) { echo $_SESSION['username']."&nbsp;";} else header('Location: index.php?RC'); ?>

           </p>  
         </li>          
       </ul>
       <div class="col-sm-3 col-md-3 pull-right">
        <form class="navbar-form" role="search">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
            <div class="input-group-btn">
              <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </nav>


  <section id="post_question">
    <div class"container">
      <!-- on fait pointer le formulaire vers la page traitant les données -->
      <form name="reponsform" action="insert_reponse.php?numero_du_sujet=<?php echo $_GET['numero_du_sujet']; ?>&GG" method="post" onsubmit="return checkForm(reponsform);">
        <div class="row">
          <div class="col-lg-12 text center"> 
            <h2>Ask a question, we will be happy to respond you :) </h2>
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




                <form role="form">

                  <div class="form-group col-xs-12 floating-label-form-group">  
                    <label for="message">Message :</label>  <br>            
                    <textarea rows="4" name ="message" class="resize-this three" type="text" maxlength="150" placeholder="Insert your respond here .."cols="50" rows="10"><?php if (isset($_POST['message'])) echo htmlentities(trim($_POST['message'])); ?></textarea>
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

              <script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>


              <script type='text/javascript' src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>



            </body>
            </html>