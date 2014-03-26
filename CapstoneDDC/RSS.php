<!DOCTYPE html>
<html id = "html">
	<head>
		<script type="text/javascript" src="http://www.google.com/jsapi">
		</script>
		<script type="text/javascript">
				google.load("feeds", "1") //Load Google Ajax Feed API (version 1)
		</script>
		<?php
		require_once("lib/jslibs.php");
		?>
		<title>Information feeds</title>
	</head>
	<body>
		<div id="viewport">
			<?php
			require_once("lib/header.php");
			?>
			<?php
			require_once("lib/siteMap.php");
			?>
			<?php
			require_once("specificLib/NewRSSWindow.php");
			?>
			<?php
			require_once("specificLib/RSSContentWindow.php");
			?>
	</body>
</html>


				