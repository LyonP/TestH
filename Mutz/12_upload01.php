<?php
require("includes/config.inc.php");
require("includes/common.inc.php");

ta($_FILES);
$msg = "";
$whitelist = ["image/jpeg","image/gif","image/png","image/webp"];
if(count($_FILES)>0) {
	//es wurde ein Formular abgeschickt, worin der User die Möglichkeit findet, eine Datei hochzuladen; ob er tatsächlich eine Datei hochgeladen hat, wissen wir an dieser Stelle noch nicht
	if($_FILES["myUpload"]["error"]==0) {
		//es wurde eine Datei hochgeladen und dabei ist kein Fehler aufgetreten
		if(in_array($_FILES["myUpload"]["type"],$whitelist)) {
			$ok = move_uploaded_file($_FILES["myUpload"]["tmp_name"],"uploads/" . $_FILES["myUpload"]["name"]);
			if($ok) {
				$msg = '<p class="success">Ihre Datei wurde erfolgreich hochgeladen.</p>';
			}
			else {
				$msg = '<p class="error">Leider konnte die Datei nicht gespeichert werden.</p>';
			}
		}
		else {
			$msg = '<p class="error">Die Datei ist vom falschen Typen.</p>';
		}
	}
	else {
		//es ist ein Fehler aufgetreten --> ggf. weiter auswerten (zB. error==4 --> keine Datei hochgeladen)
		$msg = '<p class="error">Leider ist beim Upload ein Fehler aufgetreten.</p>';
	}
}
?>
<!doctype html>
<html lang="de">
	<head>
		<title>Upload</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="css/common.css">
	</head>
	<body>
		<?php echo($msg); ?>
		<form method="post" enctype="multipart/form-data">
			<input type="file" name="myUpload">
			<input type="submit" value="hochladen">
		</form>
	</body>
</html>