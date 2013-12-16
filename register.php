<!DOCTYPE html>
<html>
	<head>
		<?php session_start() ?>
		<title>Cheapo Mail || <?php echo $_SESSION['Name'] ;?></title>
		<meta http-equiv="Content-type" content="text/html;charset=ISO-8859-1" />
		<script src=register.js></script>
 		<link rel="stylesheet" type="text/css" href="message_board.css" />

	</head>

	<body id="container">

		<div>

			<div id="header">
				<h1 >CheapoMail</h1>
			</div>

			<div id="menu">
				<h4><a href="#">Compose</a></h4>
				<h4><a href="message_board.php">Inbox</a></h4>
				<h4><a href="register.php">Register</a></h4>
				<h4><a href='action.php?a=logout'>Logout</a></h4>
				<!--<h4>stuff</h4>-->
			</div>

			<div id="content">
				<form action='action.php?a=register' method='post'> 
				Register<br> 
				<label>First Name</label> 
				<input type='text' name='fname'><br /><br />
				<label>Last Name</label>
				<input type='text' name='lname'><br /><br />
				<label>Password </label>
				<input type='password' name='pword'><br /><br />
				<label>Username</label>
				<input type='text' name='username'><br />
				<input type='text' name ='a' hidden='true' value='register'><br /><!-- Ensures that the register control sequence is run-->
				<input type=submit value='Register'></input>
				</form>
				<button id='cancel'>Cancel</button>

			</div>

			<div id="footer">
			Copyright © Nardo Caryl Danuel</div>

		</div>
	</body>
</html>