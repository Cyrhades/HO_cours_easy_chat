<?php

// On charge la config
require 'config.php';


// chargement des fonctions SQL
require 'models/sql_users.php';
require 'models/sql_messages.php';


// l'IP de l'utilisateur
$ip = $_SERVER['REMOTE_ADDR'];

if ($ip == '127.0.0.1') {
	// Mettre ici votre adresse IP
	$ip = '192.168.1.198';
}


// On vérifie si on recoit du POST
if (sizeof($_POST) > 0 && isset($_POST['action'])) {

	switch($_POST['action'])
	{
		case 'send_message' :

			if (!empty($_POST['message'])) {
				saveMessage($ip, $_POST['message']);
			}
			break;
	}
}
elseif (sizeof($_GET) > 0 && isset($_GET['action'])) {

	switch($_GET['action'])
	{
		case 'get_messages' :
				echo json_encode(getMessages());
			break;
		case 'get_users' :
				echo json_encode(getUsers());
			break;
	}
}

