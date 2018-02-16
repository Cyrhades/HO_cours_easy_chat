<?php

function changeEmoji($sOrigine)
{
	$sOrigine = str_replace( 
		array(
			':-D', 
			';-)'
		),
		array(
			'<img src="images/1f601.png" />',
			'<img src="images/1f609.png" />'
		),
		$sOrigine
	);
	return $sOrigine;
}

function getMessages()
{
	// On se connecte à la base de données
	$pdo = new PDO(DSN_SQL, USER_SQL, PWD_SQL);
	
	// On récupére les messages
	$query = $pdo->prepare('SELECT users.id, message, name 
		FROM messages 
		INNER JOIN users 
			ON users_id=users.id ORDER BY messages.id DESC LIMIT 100');

	$query->execute();

	$aResult = $query->fetchAll(PDO::FETCH_ASSOC);

	foreach($aResult AS $iLine => $aData)
	{
		$aResult[$iLine]['message'] = changeEmoji(htmlspecialchars($aData['message']));
	}

	return $aResult;
}


function saveMessage($sIp, $sMessage)
{
	// On se connecte à la base de données
	$pdo = new PDO(DSN_SQL, USER_SQL, PWD_SQL);

	// On récupére l'id utilisateur via son IP
	$query = $pdo->prepare('SELECT id FROM users WHERE ip=?');
	$query->execute([$sIp]);
	$result = $query->fetch(PDO::FETCH_ASSOC);


	// Insérer le message
	$query = $pdo->prepare('INSERT INTO messages (users_id,message, date) VALUES (?,?,NOW())');
	$query->execute([$result['id'], $sMessage]);
}