<!DOCTYPE html>
<html>
	<head>
	<?php require_once("../lib/jslibs_reg.php");?>
	<script type= "text/javascript" src = "../js/login.js"></script>
	<title>Login Form</title>
	</head>
	<body>
		<h1>Login</h1>
			<form id="password" action="../lib/user_login.php" method="post">
				<table>
					<tr><td>Email</td><td><input type="text" name="email" /></td></tr>
					<tr><td>Password</td><td><input type="password" name="password" /></td></tr>
				</table>
				<p><input type="submit" value="Login" />&nbsp;<input id="passwordClear" type="reset" value="Clear" /></p>
			</form>
		<p id="passwordOutput"></p>
	</body>
</html>