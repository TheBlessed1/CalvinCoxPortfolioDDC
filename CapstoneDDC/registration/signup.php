<!DOCTYPE html>
<html>
	<head>
	<?php require_once("../lib/jslibs_reg.php");?>
	<script type= "text/javascript" src = "../js/signup.js"></script>
	<title>Signup Form</title>
	</head>
	<body>
		<h1>Signup!</h1>
			<form id="signupForm" action="../lib/make_principal.php" method="post">
				<input id="nonce" type="hidden" name="nonce" value="<?php echo $_GET["nonce"]; ?>">
				<table>
					<tr><td>Email</td><td><input type="text" name="email" /></td></tr>
					<tr><td>Password</td><td><input type="password" name="password1" /></td></tr>
					<tr><td>Password</td><td><input type="password" name="password2" /></td></tr>
				</table>
				<p><input type="submit" value="Register" />&nbsp;<input id="signupClear" type="reset" value="Clear" /></p>
			</form>
		<p id="signupOutput"></p>
	</body>
</html>