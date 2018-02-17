<?php

// On charge la config (elle contient les acces à la base de données)
require 'config.php';


// models chargement des fonctions SQL
require 'models/sql_emoji.php';     // contient les fonctions vers la table emoji
require 'models/sql_users.php';     // contient les fonctions vers la table users
require 'models/sql_messages.php';  // contient les fonctions vers la table messages


// cette variable contient l'IP de l'utilisateur
$ip = $_SERVER['REMOTE_ADDR'];

// si vous accéder à votre propre machine via 127.0.0.1
if ($ip == '127.0.0.1') {
	// Vous devez redéfvinir votre IP
	$ip = MY_IP;
}


// On vérifie si on recoit du POST
if (sizeof($_POST) > 0 && isset($_POST['action'])) {

	// pour le moment le POST sert uniquement à enregistrer des messages
	switch($_POST['action'])
	{
		// send_message est la valeur soumise via la requete
		// ajax dans le parametre action
		case 'send_message' :
			// On enregistre seulement si le message n'est pas vide
			if (!empty($_POST['message'])) {
				// la fonction saveMessage se trouve 
				// dans le fichier 'models/sql_messages.php
				saveMessage($ip, $_POST['message']);
			}
			break;
	}
}
// Sinon on vérifie si on recoit du GET
elseif (sizeof($_GET) > 0 && isset($_GET['action'])) {

	// 2 possibilités dans le cas du GET
	switch($_GET['action'])
	{
		// soit on souhaite récupérer les messages
		case 'get_messages' :
				// la fonction getMessages se trouve 
				// dans le fichier 'models/sql_messages.php'
				// On retourne les données en json 
				// le travail de mise en page sera traité du coté client
				echo json_encode(getMessages());
			break;
		// soit on souhaite récupérer les utilisteurs
		case 'get_users' :
				// la fonction getUsers se trouve 
				// dans le fichier 'models/sql_users.php'
				// On retourne les données en json 
				// le travail de mise en page sera traité du coté client
				echo json_encode(getUsers());
			break;
	}
}

