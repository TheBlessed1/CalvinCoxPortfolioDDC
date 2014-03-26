<!DOCTYPE html>
<html>
	<head>
		<?php require_once("jslibs_reg.php"); ?>
		<script type="text/javascript" src="../js/prefForm.js"></script>
		<title>Preferences</title>
	</head>
	<body>
		<form id="prefForm" action="pref_controller.php" method="post">
			<table>
				<?php require_once("pref_view.php"); session_start(); populateRadioButtons($_SESSION['userId']);   ?>
				<input type="submit" value="Update Preferences"/>
			</table>
		</form>
		<p id = "prefOutput"></p>
	</body>
</html>