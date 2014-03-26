<!DOCTYPE html>
<html>
	<head>
	<?php require_once("../lib/jslibs_reg.php");?>
	<script type= "text/javascript" src = "../js/password.js"></script>
	<title>Change Password</title>
	</head>
	<body>

		<h1>Change Password</h1>
			<form id="changePassword" action = "../lib/change_password.php" method="post">
				<table>
					<tr><td>Email</td><td><input type="text" name="email" /></td></tr>
					<tr><td>Old Password</td><td><input type="password" name="oldPassword" /></td></tr>
					<tr><td>New Password</td><td><input type="password" name="newPassword1" /></td></tr>
					<tr><td>New Password</td><td><input type="password" name="newPassword2" /></td></tr>
				</table>
				<p><input type="submit" value="Register" />&nbsp;<input id="changePasswordClear" type="reset" value="Clear" /></p>
			</form>
		<p id="changePasswordOutput"></p>
	</body>
</html>