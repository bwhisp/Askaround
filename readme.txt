Fonctionnalités
---------------
Implémentées : 
Inscription des utilisateurs
Authentification
Ajout et édition des questions
Ajout et édition des réponses
Votes
Écran d'accueil
Visualiser une question et ses réponses
Déploiement

Non implémentées :
Aucune


Architecture
------------
src_install_int : interface du script de déploiement
src/install.php :  script php permettant la creation des tables, et l'insertion de quelques données dans ces tables.
src/config.php : déclaration de variables globales, declaration des paramètre du serveur.
src/index.php : page d'authentification
src/connect.php: script qui permet de verifier le nom d'utilisateur et le mot de passe entrés lors de la connexion
src/sign_up_page.php : page d'inscription
src/ajoutmembre.php : script permettant l'ajout du membre dans la base de données lors de l'inscription

src/first_page.php : script qui affiche les questions sans réponse,les questions posées par l'utilisateur loggé et les liens demandés
src/home.php :  page où toutes les questions des internautes sont affichées 
src/lire_sujet.php : page qui affiche les réponses associées à une question, et la question elle meme et les liens pour modifier ou ajouter une réponse
src/insert_sujet : script qui permet de poser une nouvelle question
src/insert_reponse : script qui permet de répondre à une question

src/vote1 : script selectionnant la réponse à voter dans la table des réponses
src/vote2 : dance ce script, on passe par la methode post les identifiants de la question et de la réponse. 
src/vote3 : script permettant d'inserer le vote dans la base de donnée
src/modifiervote : script qui va supprimer le vote de la base de données précedente et mettre à jour la base de données.
src/modification1 : on selectionne dans la table les identifiants et la question/réponse à modifier 
src/modification2 : on envoie par la methode POST les identifiants de la question et de la réponse ainsi que la question/réponse à modifier
src/modification3 : script permettant d'enregistrer la modification de la question/réponse dans la base de données et l'affichage de ces dernieres dans la page dédiée aux questions et aux réponses	.

