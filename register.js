window.onload = preload;

function preload()
{
	document.getElementById('cancel').onclick = messageboardredirect;
}

function messageboardredirect()
{
	location.replace('message_board.php');
}