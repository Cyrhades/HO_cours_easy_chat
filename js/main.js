'use strict';

// equivalent à l'écouteur d'évenement DOMContentLoaded
$(function(){

	// Quand on clique sur le bouton on appel la fonction sendMessage
	$('#send').on('click',sendMessage);

	// Quand on appuie sur entrer (e = event)
	$(document).on('keypress',function(e){
		// 13 étant la valeur reçu dans keyCode pour la touche entrer
		if(e.keyCode == 13) {
			// cette fonction permet de stopper l'evenement par defaut d'une touche
			// ici la touche entrer effectue de base une soumisson de formulaire 
			// preventDefault() 
			e.preventDefault();
			// on appel la fonction sendMessage
			sendMessage();
		}
	});


	// On charge les utilisateurs 
	readUsers();
	// On charge les messages
	readMessages();
	// on récupére les messages toutes les secondes
	setInterval(readMessages, 1000);
});