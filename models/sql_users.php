<?php

/**
 * Permet de récupérer la liste des utilisateurs
 *
 * @return array users list
 */
function getUsers()
{
	// On se connecte à la base de données
	$pdo = new PDO(DSN_SQL, USER_SQL, PWD_SQL);
	
	// On peut utiliser directement la fonction query 
	// qui effectue le prepare et l'execute directement
	// utilisez cette methode seulmenet si vous n'avez 
	// pas de parametre à transmettre à la requete
	$query = $pdo->query('SELECT * FROM users');

	// On retourne directement le résultat de la requete avec un fetchAll
	return $query->fetchAll(PDO::FETCH_ASSOC);
}
