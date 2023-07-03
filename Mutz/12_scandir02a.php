<?php
require("includes/config.inc.php");
require("includes/common.inc.php");

function sucheBilder($vz,$tiefe=0) {
	$inhalt = scandir($vz);
	$whitelist = ["image/jpeg","image/gif","image/png","image/web"];
	foreach($inhalt as $d) {
		if($d!="." && $d!="..") {
			if(is_file($vz . $d)) {
				//wir haben eine Datei gefunden; wir wissen noch nicht, ob es sich um ein Bild handelt
				$mime = mime_content_type($vz . $d);
				if(in_array($mime,$whitelist)) {
					echo('<img src="' . $vz . $d . '" alt="..">');
				}
			}
			else {
				if(is_dir($vz . $d)) {
					if($tiefe<=1) {
						sucheBilder($vz . $d . "/",$tiefe+1);
					}
				}
			}
		}
	}
}
?>
<!doctype html>
<html lang="de">
	<head>
		<title>Scandir</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/common.css">
		<style>
		img {
			width:10em;
			height:10em;
			object-fit:cover;
			object-position:center;
			display:inline-block;
		}
		</style>
	</head>
	<body>
		<?php
		$rootVZ2 = "./";
		sucheBilder($rootVZ2);
		?>
	</body>
</html>