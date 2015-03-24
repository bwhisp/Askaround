<html>
<head>
	<title>Askaround : Vote</title>
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
		$Id= $_GET['id_sujet_a_lire'];
		$id = $_GET['id'];
    //connection au serveur:
		$cnx = mysql_connect( "localhost", "root", "" ) ;

    //sélection de la base de données:
		$db = mysql_select_db( "foor" ) ;

    //requête SQL:
		$sql = 'SELECT * FROM forum_reponses';

    //exécution de la requête:
		$requete = mysql_query( $sql, $cnx ) ;

    //affichage des données:
		while($result = mysql_fetch_array($requete))
		{
			$username=$result['username'];

			if($_SESSION['username'] !== $username && $id == $result['id'] ){

				echo(
					"<div align=\"center\">"
					.$username=$_SESSION['username']." ".$jaime=$result['jaime']
					." <a href=\"vote2.php?idPersonne=".$id=$result['id']."&"."Id=".$Id."\">suivant</a></div>\n"
					) ;
				header('Location: vote2.php?idPersonne='.$id=$result['id'].'&Id='.$Id.'');
			}else{
				echo"";
			}
		}
	}
	?>
</body>
</html>