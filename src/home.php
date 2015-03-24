<!DOCTYPE html>
<html lang="en">

<?php
session_start();

require_once('config.php')
?> 
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8"> 
  <meta charset="utf-8">
  <title>Askaround.fr</title>

  <meta name="generator" content="Bootply" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">

  <link rel="shortcut icon" href="/bootstrap/img/favicon.ico">
  <link rel="apple-touch-icon" href="/bootstrap/img/apple-touch-icon.png">
  <link rel="apple-touch-icon" sizes="72x72" href="/bootstrap/img/apple-touch-icon-72x72.png">
  <link rel="apple-touch-icon" sizes="114x114" href="/bootstrap/img/apple-touch-icon-114x114.png">


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


<body  >

  <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="navbar-header">
      <a class="navbar-brand" rel="home.php" href="first_page.php">Home</a>
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li><a href="first_page.php">Ma page</a></li>
        <li><a href="insert_sujet.php">Poser une question</a></li>
       

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




   <div class="container">

    <div class="row">
      <div class="col-md-16">

        <br /><br />

        <?php
        require_once('config.php');
// on se connecte à notre base de données
        $base = mysql_connect ('localhost', 'root', '');
        mysql_select_db ('foor', $base) ;
        $username=$_SESSION['username'];
// préparation de la requete
        $sql = "SELECT id, username, titre, date_derniere_reponse FROM forum_sujets ORDER BY date_derniere_reponse DESC";

// on lance la requête (mysql_query) et on impose un message d'erreur si la requête ne se passe pas bien (or die)
        $req = mysql_query($sql, $base) or die('Erreur SQL !<br />'.$sql.'<br />'.mysql_error());
// on compte le nombre de sujets du forum
        $nb_sujets = mysql_num_rows ($req);



        if ($nb_sujets == 0) {
          echo 'Aucun sujet';
        }
        else {
          ?>
          <h2>Les questions posées :</h2><br>

          <table class="table table-striped"><tr>
            <td>
              Auteur
            </td><td>
            Titre du sujet
          </td><td>
          Date dernière réponse
        </td><td>
        Modification

      </td></tr>

      <?php
  // on va scanner tous les tuples un par un
      while ($data = mysql_fetch_array($req) ){

  // on décompose la date
        sscanf($data['date_derniere_reponse'], "%4s-%2s-%2s %2s:%2s:%2s", $annee, $mois, $jour, $heure, $minute, $seconde);

  // on affiche les résultats
        echo '<tr>';
        echo '<td>';

  // on affiche le nom de l'auteur de sujet

        echo $data['username'];
        echo '</td><td>';

        $sql="SELECT * FROM jaime WHERE  username='{$_SESSION['username']}' AND id='{$data['id']}' ";
        $requete = mysql_query( $sql, $base ) ;
        $result = mysql_fetch_array( $requete );
        $rows = mysql_num_rows($requete);
  // on affiche le titre du sujet, et sur ce sujet, on insère le lien qui nous permettra de lire les différentes réponses de ce sujet
        if($rows == true){
         echo '<a href="./lire_sujet.php?id_sujet_a_lire=' , $data['id'] , '&id_reponse=',$result['id_reponse'],'">' , htmlentities(trim($data['titre'])) , '</a>';
       }else{
        echo '<a href="./lire_sujet.php?id_sujet_a_lire=' , $data['id'] , '">' , htmlentities(trim($data['titre'])) , '</a>';

      }


      echo '</td><td>';
  // on affiche la date de la dernière réponse de ce sujet
      echo $jour , '-' , $mois , '-' , $annee , ' ' , $heure , ':' , $minute;
      echo '</td><td>';
      if($_SESSION['username'] == $data['username']){
        echo '<a href="./modification1.php?id_sujet_a_lire=',$data['id'],'&FF">'.'Modifier'.'</a>';
      }else{
        echo "Modifier";
      }
    }
    ?>
  </td></tr></table>
  <?php
}

// on libère l'espace mémoire alloué pour cette requête
mysql_free_result ($req);
// on ferme la connexion à la base de données.
mysql_close ();
?>





<br><br><br><br><br><br><br><br><br><br>


<div class="blog-footer">
  <p>Question and respond site built  by Abderrahmane Kammous and Anass Seddiki.</p>
  <p>
    <a href="home.php">Back to top</a>
  </p>
</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="dist/js/bootstrap.min.js"></script>
<script src="dist/js/docs.min.js"></script>
</body>
</html>