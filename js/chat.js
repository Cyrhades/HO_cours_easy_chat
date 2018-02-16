
function htmlspecialchars(str) {
	if (typeof(str) == "string") {
		str = str.replace(/&/g, "&amp;"); /* must do &amp; first */
		str = str.replace(/"/g, "&quot;");
		str = str.replace(/'/g, "&#039;");
		str = str.replace(/</g, "&lt;");
		str = str.replace(/>/g, "&gt;");
	}
	return str;
}

function printListUsers(data)
{
	for (var i = 0; i < data.length; i++)
	{
		$('#zone_user').append('<li data-id="'+htmlspecialchars(data[i].id)+'">'+htmlspecialchars(data[i].name)+'</li>');
	}
}



function printListMessages(data)
{
	$('#zone_chat').html('');
	for (var i = 0; i < data.length; i++)
	{
		$('#zone_chat').append('<li data-id="'+htmlspecialchars(data[i].id)+'"><span class="pseudo">'+
			htmlspecialchars(data[i].name)+'</span>'+data[i].message+'</li>'
		);
	}
}