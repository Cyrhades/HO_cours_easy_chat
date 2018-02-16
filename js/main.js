'use strict';

$(function(){

	// Quand on clique sur le bouton
	$('#send').on('click',sendMessage);

	// Quand on appuie sur entrer
	$(document).on('keypress',function(e){
		if(e.keyCode == 13) {
			e.preventDefault();
			sendMessage();
		}
	});

	// On charge les utilisateurs 
	readUsers();
	readMessages();
	setInterval(readMessages, 1000);
});