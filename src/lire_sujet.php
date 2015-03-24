<!DOCTYPE html>
<html lang="en">

<?php
session_start();

require_once('config.php');
?>

<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
  <meta charset="utf-8">
  <title>Askaround : Questions</title>
  <meta name="generator" content="Bootply" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">


  <link rel="shortcut icon" href="/bootstrap/img/favicon.ico">
  <link rel="apple-touch-icon" href="/bootstrap/img/apple-touch-icon.png">
  <link rel="apple-touch-icon" sizes="72x72" href="/bootstrap/img/apple-touch-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="114x114" href="/bootstrap/img/apple-touch-icon-114x114.png">

  <title>Lecture du sujet</title>


  <style type="text/css">

    a  {
     text-decoration:none;
     color:#172898;
   }
   a:hover {
    text-decoration:underline;
  }
  body {
    padding-top: 70px;
  }
  .blog-footer {
    padding: 40px 0;
    color: #999;
    text-align: center;
    background-color: #f9f9f9;
    border-top: 1px solid #e5e5e5;
  }

</style>
</head>



<body  >

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
   <div class="jumbotron">
    <h2>Askaround </h2>
    <p>Ici vous pouvez répondre autant de fois que vous voulez à la question posée,modifier vos réponse et voter pour la meilleur réponse. :<br><br><br></p>
  </div>

  <div class="container">

    <div class="row">
      <div class="col-md-6">

        <?php
        if (!isset($_GET['id_sujet_a_lire'])) {
          echo 'Sujet non défini.';
        }
        else {
          ?>
          <h3>La question :</h3>
          <table class="table table-striped"><tr>
            <td>
              Auteur
            </td><td>
            Dates des réponses
          </td><td>
          Messages


        </td></tr>
        <?php
        require_once('config.php');
  // on se connecte à notre base de données
        $base = mysql_connect ('localhost', 'root', '');
        mysql_select_db ('foor', $base) ;


  // on prépare notre requête
        $sql = 'SELECT * FROM forum_sujets WHERE id="'.$_GET['id_sujet_a_lire'].'" ';

  // on lance la requête (mysql_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)
        $req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());


  // on va scanner tous les n-uplets un par un
        while ($data = mysql_fetch_array($req)) {
          $username = $data['username'];
          $id = $data['id'];
  // on décompose la date
          sscanf($data['date_derniere_reponse'], "%4s-%2s-%2s %2s:%2s:%2s", $annee, $mois, $jour, $heure, $minute, $seconde);

  // on affiche les résultats
          echo '<tr>';
          echo '<td>';

  // on affiche le nom de l'auteur de sujet ainsi que la date de la réponse
          echo $data['username'];
          echo '</td>'.'<td>';
          echo $jour , '-' , $mois , '-' , $annee , ' ' , $heure , ':' , $minute;

          echo '</td><td>';

  // on affiche le message
          echo nl2br(htmlentities(trim($data['message'])));

          echo '</td></tr>';
        }

  // on libère l'espace mémoire alloué pour cette requête
        mysql_free_result ($req);
  // on ferme la connection à la base de données.
        mysql_close ();
        ?>

        <!-- on ferme notre table html -->
      </table>
      <br /><br />
      <!-- on insère un lien qui nous permettra de rajouter des réponses à ce sujet -->
      <?php 
    }
    ?>

  </div>
  <div class="col-md-6">

    <?php


    if (!isset($_GET['id_sujet_a_lire'])) {
      echo 'Sujet non défini.';
    }
    else {

      ?>
      <h3>Les réponses :</h3>
      <table class="table table-striped"><tr>
        <td>
          Auteur
        </td><td>
        Dates des réponses
      </td><td>
      Réponses
    </td><td>
    Modifier la réponse
  </td><td>
  Votes
</td></tr>
<?php
require_once('config.php');
  // on se connecte à notre base de données
$base = mysql_connect ('localhost', 'root', '');
mysql_select_db ('foor', $base) ;


  // on prépare notre requête
$sql = 'SELECT * FROM forum_reponses WHERE correspondance_sujet="'.$_GET['id_sujet_a_lire'].'" ORDER BY jaime DESC';

  // on lance la requête (mysql_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)
$req = mysql_query($sql) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());


  // on va scanner tous les n-uuplets un par un
while ($data = mysql_fetch_array($req)) {
  $username = $data['username'];
  $id = $data['id'];
  // on décompose la date
  sscanf($data['date_reponse'], "%4s-%2s-%2s %2s:%2s:%2s", $annee, $mois, $jour, $heure, $minute, $seconde);

  // on affiche les résultats
  echo '<tr>';
  echo '<td>';

  // on affiche le nom de l'auteur de sujet ainsi que la date de la réponse
  echo $data['username'];
  echo '</td>'.'<td>';
  echo $jour , '-' , $mois , '-' , $annee , ' ' , $heure , ':' , $minute;

  echo '</td><td>';

  // on affiche le message
  echo nl2br(htmlentities(trim($data['message'])));
  echo '</td><td>';
  
  if($_SESSION['username'] == $username){
    echo '<a href="./modification1.php?id_sujet_a_lire=',$_GET['id_sujet_a_lire'],'&id=',$data['id'],'">'.'Modifier'.'</a>';
  }else{
    echo "Modifier";
  }
  echo '</td><td>';

  if($_SESSION['username'] !== $username ){
    echo '<p>'.'<a href="vote1.php?id_sujet_a_lire=',$_GET['id_sujet_a_lire'],'&id=',$data['id'],'">'."J'aime".'</a>'.'('.'<span id='.'id'.$data['id'].'>'.$data['jaime'].'</span>'.')'.'</p>';
  }else{
    echo "j'aime";
  }
  
  echo '</td></tr>';
}

  // on libère l'espace mémoire alloué pour cette requête
mysql_free_result ($req);
  // on ferme la connection à la base de données.
mysql_close ();
?>

<!-- on ferme notre table html -->
</table>
<br /><br />
<!-- on insère un lien qui nous permettra de rajouter des réponses à ce sujet -->
<?php 

echo '<a href="./insert_reponse.php?numero_du_sujet='.$_GET['id_sujet_a_lire'].'">'.'Repondre'.'</a>';


?>

<?php
if(isset($_GET['id_reponse']) && isset($_GET['id_sujet_a_lire'])){
  echo '<br>'.'<br>'.'<a href="modifier_vote.php?id_sujet_a_lire='.$_GET['id_sujet_a_lire'].'&'.'id_reponse='.$_GET['id_reponse'].'">'.'Modifier le vote'.'</a>';
}else{
  echo "<br>"."<br>";
  echo "Modifier le vote";
}
?>

<?php

echo "<br />"."<br />";
// on insère un lien qui nous permettra de retourner à l'accueil du forum 

echo '<a href="./home.php">'.'Retour à l\'accueil'.'</a>';


?>
<?php
}
?>

</div>
</div>
<br><br><br><br><br>
<div class="row">
  <div class="blog-footer">
    <p>Question and respond site built  by Abderrahmane Kammous and Anass Seddiki.</p>
    <p>
      <a href="lire_sujet.php">Back to top</a>
    </p>
  </div>
</div>


<script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>

<script type='text/javascript' src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>



</body>
</html>