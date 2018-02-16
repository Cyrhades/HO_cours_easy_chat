<?php

function getUsers()
{
	// On se connecte à la base de données
	$pdo = new PDO(DSN_SQL, USER_SQL, PWD_SQL);
	
	// On récupére les messages
	$query = $pdo->prepare('SELECT * FROM users');
	$query->execute();
	return $query->fetchAll(PDO::FETCH_ASSOC);
}
