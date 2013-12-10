<?php
session_start();

if($_GET['a'] == 'login')
{
	$connect = mysql_connect('localhost','admin','admin123');		//Connecting to the server hosting the Database 
	if(!$connect)							// Verifying that the connection 
	{
		die('Problem occured connecting to the Database <br>'.mysql_error());
	}
	if(!mysql_select_db('cheapousers'))					//Selects the database we will be using
	{
		die('Failure selecting Database'.mysql_error());
	}
	$cred_verify_qstring =  "SELECT * 
			         FROM users 
			         WHERE username = '$_POST[username]' AND pword ='$_POST[password]'";  // Login query 
	$cred_verify_query = mysql_query($cred_verify_qstring, $connect);
	if(!$cred_verify_query) 			//Verification of the query
	{
		die('Query Failure'.mysql_error($connect));
	}
	else
	{
		while($row = mysql_fetch_array($cred_verify_query, MYSQL_ASSOC))
		{
			$_SESSION['Name'] = $row['firstname'].' '.$row['lastname']; 
			$_SESSION['Username'] = $_POST['username'];
		}
		echo ('Login Successful');
		echo('<script>location.replace("message_board.html")</script>');
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
				'$_POST[fname]'.
				'$_POST[lname]',
				'$_POST[pword]'.
				$_POST[username])";
	$register_query = mysql_query($insert_qstring, $connect);
	if(!$register_query)
	{
		die('Query error'.mysql_error($connect));
	}
	else
	{
		echo "Registration complete";
		echo "<script>location.replace('register.html')</script>";
	}
}
else if($_GET['a']=='logout')
{
	echo '<script>alert("Logging you out '.$_SESSION['Name'].'")</script>';
	session_destroy();
	echo '<script>location.replace("cheapomail.html");</script>';
}
else if(!isset($_GET['a']))
{
	echo '<script>alert("Error occured \n Returning you to the Message Board")</script>';
	echo '<script>location.replace("message_board.html")</script>';
}
?>