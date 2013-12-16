
<!DOCTYPE html>
<html >
	<?php session_start();?>
	<head>
		<title> Cheapo Mail |
		<?php	echo $_SESSION['Name'];?> 
		</title>
		<meta http-equiv="Content-type" content="text/html;charset=ISO-8859-1" />
		<script src= 'messages_b.js' type='text/javascript'></script>
		<script src='//ajax.googleapis.com/ajax/libs/prototype/1.7.1.0/prototype.js' type='text/javascript'></script>
 		<link rel="stylesheet" type="text/css" href="message_board.css" />

	</head>

	<body id="container">

		<div>

			<div id="header">
				<h1 >CheapoMail</h1>
			</div>

			<div id="menu">
				<h4><a id='compose' href="#">Compose</a></h4>
				<h4><a href="message_board.php">Inbox</a></h4>

			<?php	//Capability of registering should only be accessible by the admin user 
				if($_SESSION['Username'] == 'admin')
				{
					echo '<h4><a href="register.php">Register</a></h4>';
				}
			?>
				<h4><a href='action.php?a=logout'>Logout</a></h4><!-- Sends request for logout control sequence to be run -->
				<span id='id'><?php echo $_SESSION['ID'];?></span>
			</div>

			<div id="content">
			No New Messages 
			</div>

			<div id="footer">
			Copyright © Nardo Caryl Danuel</div>

		</div>
	</body>
</html>
