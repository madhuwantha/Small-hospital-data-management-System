<?php session_start(); ?>
<?php require_once('inc/connection.php'); ?>
<?php require_once('inc/checkLogin.php'); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Loging</title>
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<link rel="stylesheet" type="text/css" href="css/header.css">
</head>
<body style="background: #7BD6FF ;">
	
	<div class="login clearfix">		
		<form action="login.php" method="post">
			
				<legend><h2>Log In</h2></legend><hr><br>
				<?php 
				if (isset($errors) && !empty($errors)) {
					echo '<p class="errors"> Invalid username/password </p>'; 
				}
			 ?>

			<p>
				
				<input type="text" name="username" class="txt" placeholder="User Name">
			</p> 			

			<p>
				
				<input type="password" name="password" class="txt" placeholder="Password">
			</p>			

			<button type="submit" name="submit"  class="button">Log in</button><br><br>
		</form>
		<a href="#"></a>
			</fieldset>
			
	</div>
</body>
</html>
