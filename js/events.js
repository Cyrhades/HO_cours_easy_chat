/**
 * Envoi d'un message (au serveur pour enregistrement en BDD) 
 */
function sendMessage()
{
	// oN utilise Ajax (via jQuery) et en method POST
	$.post(
		// Nous appelons ajax.php sur notre serveur
		'ajax.php', 
		// Nous lui envoyons 2 parametres action et message
		{action : 'send_message', message : $("#message").val()},
		// la fonction de callback (quand le serveur nous repond)
		readMessages
	);
	// On vide le champ message (car le message est envoyé)
	$("#message").val('');
}

// Récupére les messages (en JSON) 
function readMessages()
{	
	// requete HTTP en method GET, mais le retour attendu sera du json
	// la fonction getJSON parsera pour nous la chaine de retour
	$.getJSON(
		// Nous appelons ajax.php sur notre serveur
		'ajax.php',
		// Nous lui envoyons seulement le parametre action 
		{action : 'get_messages'},
		// la fonction de callback (quand le serveur nous repond)
		printListMessages
	);
}

// Récupére la liste des utilisateurs (en JSON)
// pour le moment cela n'est pas vraiment utile mais
// pourrait nous permettre de créer des conversations privées
function readUsers()
{	
	// requete HTTP en method GET, mais le retour attendu sera du json
	// la fonction getJSON parsera pour nous la chaine de retour
	$.getJSON(
		// Nous appelons ajax.php sur notre serveur
		'ajax.php',
		// Nous lui envoyons seulement le parametre action 
		{action : 'get_users'},
		// la fonction de callback (quand le serveur nous repond)
		printListUsers
	);
}

