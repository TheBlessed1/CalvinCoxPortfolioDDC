<!DOCTYPE html>
<html id = "html">
	<head>
	<?php
	require_once("phpMods/jslibs.php");
	GLOBAL $title;
	$title = "G-Capstone Template";
	echo "<title>$title
		</title>"
	?>
		
	</head>
	<body>
		<div id="viewport">
			<span id = "regAbout"><p>Registration </br>Login </br>About Us</p>	
			</span>
			<?php
			require_once("phpMods/header.php");
			?>
			<?php
			require_once("phpMods/siteMap.php");
			?>
			<?php
			require_once("phpMods/contentWindow.php");
			
			?>
			<?php
			require_once("phpMods/RSSWindow.php");
			?>
		</div>
	</body>
</html>