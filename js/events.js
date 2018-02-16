
function sendMessage()
{
	$.post(
		'ajax.php',
		{action : 'send_message', message : $("#message").val()},
		readMessages
	);
	$("#message").val('');
}

function readMessages()
{	
	$.getJSON(
		'ajax.php',
		{action : 'get_messages', last : 0},
		printListMessages
	);
}

function readUsers()
{	
	$.getJSON(
		'ajax.php',
		{action : 'get_users'},
		printListUsers
	);
}

