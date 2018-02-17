<?php

function preparedMessage($sOrigine)
{
	// on transforme les sauts de lignes en <br /> 
	// @see : http://php.net/manual/fr/function.nl2br.php
	return nl2br(
		// on transforme les potentiels emoji
		changeEmoji(
			// on protége des injections XSS avec htmlspecialchars
			htmlspecialchars($sOrigine)
		)
	);
}

// cette fonction permet d'enregistrer des emojis à 
// la place d'une combinaison de caracteres
function changeEmoji($sOrigine)
{
	// On charge les emoji depuis la BDD
	$aEmoji = getEmoji();
	$aNeedle = [];
	$aReplace = [];
	// On boucle sur la liste d'emoji existant en BDD
	foreach($aEmoji as $url => $sName ) {
		$aNeedle[] = $sName;
		$aReplace[] = '<img src="'.$url.'" title="'.htmlspecialchars($sName).'" alt="'.htmlspecialchars($sName).'" />';
	}
	// On remplace les emoji par les adresses des images
	return str_replace($aNeedle,$aReplace,$sOrigine);
}

function getMessages()
{
	// On se connecte à la base de données
	$pdo = new PDO(DSN_SQL, USER_SQL, PWD_SQL);
	
	// On peut utiliser directement la fonction query 
	// qui effectue le prepare et l'execute directement
	// utilisez cette methode seulmenet si vous n'avez 
	// pas de parametre à transmettre à la requete
	$query = $pdo->query('SELECT users.id, message, name 
		FROM messages 
		INNER JOIN users 
			ON users_id=users.id ORDER BY messages.id DESC LIMIT 100');
	// dans cette requete nous voyons un LIMIT 100, nous aurons 
	// l'occasion de revoir le LIMIT en cours


	// Inutile de re-travailler les données elles ont déjà étaient préparées
	// à leur enregistrement (saveMessage), via la fonction "preparedMessage"
	return $query->fetchAll(PDO::FETCH_ASSOC);
}


function saveMessage($sIp, $sMessage)
{
	// On se connecte à la base de données
	$pdo = new PDO(DSN_SQL, USER_SQL, PWD_SQL);

	// On récupére l'id utilisateur via son IP
	$query = $pdo->prepare('SELECT id FROM users WHERE ip=?');
	$query->execute([$sIp]);
	$result = $query->fetch(PDO::FETCH_ASSOC);

	/**
	 * Afin d'optimiser le chat j'ai fais le choix d'enregistrer la données brut 
	 * puis la données déjà formatée cela permet d'éviter de devoir reformater 
	 * toutes les lignes à chaque appel, les messages pourront donc être directement
	 * retourner de la BDD sans traitement supplémentaire.
	 */
	$sPreparedMessage = preparedMessage($sMessage);


	// On prepare la requete SQL
	$query = $pdo->prepare('INSERT INTO messages (users_id, message, raw_message, date) VALUES (?,?,?,NOW())');

	// On insére le message en BDD avec l'execute
	$query->execute([$result['id'], $sPreparedMessage, $sMessage]);
}
