window.onload = function()
{
	//Removes No new Messages if there are messages present
	message_retrieve();
	document.getElementById('compose').onclick = compose;
}

function validate()
{
	//Regular Expressions -- REGEX for ensuring that pssword have at least
	//one number one letter, and a captial letter and have to be at least 8 
	//characters long 
}

function compose()
{
	var array = new Array('to','from','subject');

	var send = document.createElement('button');
	send.style.height='2.5em';
	send.style.width = '5em';
	//send.onclick = Call to the Ajax function dealing with the sending of messages

	var compose_holder = document.createElement('div');
	compose_holder.className = 'compose_holder';
	compose_holder.style.zIndex = 10;
	document.getElementById('content').insertAdjacentElement('beforeEnd',compose_holder);

	var compose_body = document.createElement('textarea');
	compose_body.rows  ='5';
	compose_body.cols = '50';

	var compose_form = document.createElement('form')
	compose_form.action = '#';

	doc_divs = document.getElementsByTagName('div');
	doc_divs[4].insertAdjacentElement('afterBegin',compose_form);

	for(var i=0;i<array.length;i++)
	{
		var compose_label = document.createElement('label');
		compose_label.innerText =array[i].toUpperCase();
		var compose_input = document.createElement('input');
		compose_input.type='text';
		compose_input.name = array[i];
		compose_input.style.position = 'absolute';
		compose_input.style.left          = ''

		compose_form.insertAdjacentElement('beforeEnd',compose_label);
		compose_form.insertAdjacentElement('beforeEnd',compose_input);
		compose_form.insertAdjacentHTML('beforeEnd','<br>');
	}

	compose_form.insertAdjacentElement('beforeEnd',compose_body);

	compose_form.insertAdjacentElement('beforeEnd', send);


	// document.getElementById('content').insertAdjacentElement('beforeEnd',compose_holder);
	// //compose_holder.innerHTML = document.createElement('form');
	// doc_divs = document.getElementsByTagName('div');
	// compose_form = document.createElement('form');
	// doc_divs[4].insertAdjacentElement('afterBegin',compose_form);

	// compose_holder.innerHTML.innerHTML = document.createElement('input');
	// compose_holder.innerHTML.innerHTML.type = 'text';
	// compose_holder.innerHTML.innerHTML.name = 'to';
	// compose_holder.innerHTML.innerHTML = document.createElement('input');
	// compose_holder.innerHTML.innerHTML.type = 'text';
	// compose_holder.innerHTML.innerHTML.name = 'from';
	// compose_holder.innerHTML.innerHTML = document.createElement('input');
	// compose_holder.innerHTML.innerHTML.type = 'text';
	// compose_holder.innerHTML.innerHTML.name='subject';
	// compose_holder.innerHTML.innerHTML = document.createElement('input');
	// compose_holder.innerHTML.innerHTML.type = 'text';
	// compose_holder.innerHTML.innerHTML.name='content';

}

function printData(data)
{
	alert(data.responseXML);
}

function message_retrieve()
{
	new Ajax.Request("action.php",
	{
		parameters: {a:'getmessage'},
		method: "get",
		onSuccess: printData,
		onCreate: function(response){
			var t = response.transport;
			t.setRequestheader = t.setRequestHeader.wrap(function(original, k, v){
				if(/^(accept|accept-language|content-lanuage)$/i.test(k))
					return original(k,v);
				if(/^content-type$/i.test(k) &&
					/^ (application\/x-form-urlencoded|multipart\/form-data|text\/plain)(;.+?$/i.text(v))
					return original(k,v);
				return;});
			}
	});
}
	