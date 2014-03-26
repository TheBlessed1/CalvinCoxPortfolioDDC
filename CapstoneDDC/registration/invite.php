<!DOCTYPE html>
<html>
	<head>
	<?php require_once("../lib/jslibs_reg.php");?>
	<script type= "text/javascript" src = "../js/invite.js"></script>
	<title>Invite</title>
	</head>
	<body>
		<h1>Invite</h1>
			<form id="signupForm" action = "../lib/user_invite.php" method="post">
				<table>
					<tr><td>Email</td><td><input type="text" name="email" /></td></tr>
				</table>
				<p><input type="submit" value="Send me an invite!" />&nbsp;<input id="signupClear" type="reset" value="Clear" /></p>
			</form>
		<p id="signupOutput"></p>
	</body>
</html>