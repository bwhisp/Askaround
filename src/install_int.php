<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Home &middot; Askaround
	</title>
</head>
<body>
	Pour installer le site suivez ces instructions.<br><br>
	1) Premièrement, ouvrir config.php et changer les paramètres du serveur.<br><br>
	2) Creation de la base de données.<br>
	<form method="post" action="install.php">
		<input name="create_db" type="hidden"><br>
		<button type="submit">Creer la base de données</button><br>
	</form>
	<br>
	3) Configuration de la base de données:<br>
	<form method="post" action="install.php">
		<input name="create_tables"	type="hidden"><br>
		<button type="submit">Configurer la base de données</button><br>
	</form>


</body>
