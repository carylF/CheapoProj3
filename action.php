<?php
session_start();
$connect = mysql_connect('localhost','admin','admin123');
if(!mysql_select_db('cheapousers'))
{
	die('Failure selecting Database'. mysql_error());
}



if($_GET['a'] == 'login')
{
	$cred_verify_qstring =  "SELECT * 
			         	   FROM users 
			         	   WHERE username = '$_POST[username]' AND pword ='$_POST[password]'";  // Login query 
	$cred_verify_query = mysql_query($cred_verify_qstring,$connect);
	if(!$cred_verify_query) 			//Verification of the query
	{
		die('Query Failure'.mysql_error($connect));
	}
	else
	{
		if($row =mysql_fetch_array($cred_verify_query,MYSQL_ASSOC))
		{
			while($row)
			{
				if(($_POST['username'] == $row['username']) && ($_POST['password'] == $row['pword']))
				{
					$_SESSION['Name'] = $row['firstname'].' '.$row['lastname']; 
					$_SESSION['ID'] = $row['id'];
					$_SESSION['Username'] = $row['username'];
					echo ('Login Successful');
					echo('<script>location.replace("message_board.php")</script>');
				}
			}
		}
		else
		{
			echo "<script>alert('Incorrect Credentials');
					location.replace('cheapomail.html');</script>";
		}
	}
}
else if ($_GET['a'] == 'register')
{
	$insert_qstring = "INSERT INTO users 
			(
				firstname,
				lastname,
				pword,
				username
			) 
			VALUES
			(
				'$_POST[fname]',
				'$_POST[lname]',
				'$_POST[pword]',
				'$_POST[username]')";
	$register_query = mysql_query($insert_qstring, $connect);
	if(!$register_query)
	{
		die('Query error'.mysql_error($connect));
	}
	else
	{
		echo"<script>alert('Registration complete')</script>";
		echo "<script>location.replace('register.php')</script>";
	}
}
else if($_GET['a']=='logout')
{
	echo '<script>alert("Logging you out '.$_SESSION['Name'].'")</script>';
	session_destroy();
	echo '<script>location.replace("cheapomail.html");</script>';
}
elseif($_GET['a'] == 'getmessage')
{//control sequence to get all the msesage for the 
	//Creating the XML file with the root node <MESSAGESTORE>
	$querystring = "SELECT * 
			 FROM message
			 WHERE  recipient_id = '$_SESSION[ID]'";
	$XML_GETquery = mysql_query($querystring, $connect);
	if(!$XML_GETquery)
	{
		die('Query Error'.mysql_error($connect));
	}
	else
	{
		$xml = new DOMDocument('1.0', 'iso-8859-1');
		$xml_messagestore = $xml->createElement('MESSAGESSTORE');
		while($row = mysql_fetch_array($XML_GETquery, MYSQL_ASSOC))
		{
			$xml_messages = $xml_messagestore->createElement('MESSAGE');
			$xml_messages->appendChild($xml->createElement('ID',$row['id']));
			$xml_messages->appendChild($xml->createElement('TO',$row['recipent_id']));
			$xml_messages->appendChild($xml->createElement('FROM',$row['user_id']));
			$xml_messages->appendChild($xml->createElement('SUBJECT',$row['subject']));
			$xml_messages->appendChild($xml->createElement('CONTENT',$row['body']));
		}
		echo $xml->saveXML();
	}

}
elseif($_GET['a']=='messagecompose')
{
	header('Access-Control-Allow-Origin: *');

	/*$send_message_string = "INSERT INTO message
				       (
				       	body,
				       	subject,
				       	user_id,
				       	recipient_id
				       )
				       VALUES
				       (
				       	'$_REQUEST[]',
				       	'$_REQUEST[]',
				       	'$_REQUEST[]',
				       	'$_REQUEST[]'
				       )"*/
}
else if(!isset($_GET['a']))
{
	echo '<script>alert("Error occured \nReturning you to the Message Board")</script>';
	echo '<script>location.replace("message_board.php")</script>';
}
?>