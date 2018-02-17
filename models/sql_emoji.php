<?php

/**
 * Permet de récupérer la liste des emoji
 *
 * @return array emoji list
 */
function getEmoji()
{
	// On se connecte à la base de données
	$pdo = new PDO(DSN_SQL, USER_SQL, PWD_SQL);
	
	// On peut utiliser directement la fonction query 
	// qui effectue le prepare et l'execute directement
	// utilisez cette methode seulmenet si vous n'avez 
	// pas de parametre à transmettre à la requete
	$query = $pdo->query('SELECT * FROM emoji');
	$aResult = $query->fetchAll(PDO::FETCH_ASSOC);
	$aEmoji = [];
	// on va utiliser l'url en key
	foreach($aResult as $aData) {
		$aEmoji[$aData['url']] = $aData['name'];
	}

	// On retourne directement le résultat de la requete avec un fetchAll
	return $aEmoji;
}


function saveEmoji($sUrl, $sName)
{
	// On se connecte à la base de données
	$pdo = new PDO(DSN_SQL, USER_SQL, PWD_SQL);

	// On prepare la requete SQL
	$query = $pdo->prepare('REPLACE INTO emoji (url, name) VALUES (?,?)');

	// On insére l'emoji en BDD avec l'execute
	$query->execute([$sUrl, $sName]);
}