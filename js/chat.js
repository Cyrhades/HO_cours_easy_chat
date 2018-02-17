


function printListUsers(data)
{
	// On vide la zone de la liste des utilisateurs
	$('#zone_user').html('');
	// On boucle sur tous les utilisateurs retournés par le serveur
	for (var i = 0; i < data.length; i++)
	{
		$('#zone_user').append('<li data-id="'+Number(data[i].id)+'">'+data[i].name+'</li>');
	}
}



function printListMessages(data)
{
	// On vide la zone de chat
	$('#zone_chat').html('');
	// On boucle sur tous les messages retournés par le serveur
	for (var i = 0; i < data.length; i++)
	{
		// On réécris dans la zone de chat 
		$('#zone_chat').append(
			'<li data-id="'+Number(data[i].id)+'">'+
				'<span class="pseudo">'+data[i].name+'</span>'+
				data[i].message+
			'</li>'
		);
	}
}