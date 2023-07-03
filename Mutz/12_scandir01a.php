<?php
require("includes/config.inc.php");
require("includes/common.inc.php");

?>
<!doctype html>
<html lang="de">
	<head>
		<title>Scandir</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/common.css">
		<style>
			.dir {
				font-weight:bold;
			}
			.file {
				font-style:italic;
				font-weight:normal;
			}
			.link {
				color:blue;
			}
		</style>
	</head>
	<body>
		<?php
		$rootVZ = "uploads/";
		$inhalt = scandir($rootVZ); //liefert ein Array mit allen Datei- und Verzeichnisnamen, die sich innerhalb des auszulesenden Verzeichnisses befinden
		ta($inhalt);
		
		echo('<ul>');
		foreach($inhalt as $d) {
			if(is_dir($rootVZ . $d)) {
				echo('<li class="dir">' . $d . '</li>');
			}
			else {
				if(is_file($rootVZ . $d)) {
					echo('<li class="file">' . $d . '</li>');
				}
				else {
					echo('<li class="link">' . $d . '</li>');
				}
			}
		}
		echo('</ul>');
		?>
	</body>
</html>