<?php
require("includes/config.inc.php");
require("includes/common.inc.php");

ta($_FILES);
$msg = "";
if(count($_FILES)>0) {
	$f = $_FILES["myUpload"]; //reine Hilfsvariable, die so nicht nötig wäre
	for($i=0; $i<count($f["name"]); $i++) {
		if($f["error"][$i]==0) {
			$ok = move_uploaded_file($f["tmp_name"][$i],"uploads/" . $f["name"][$i]);
			if($ok) {
				$msg .= '<p class="success">Die Datei ' . $f["name"][$i] .'  wurde erfolgreich hochgeladen.</p>';
			}
			else {
				$msg .= '<p class="success">Die Datei ' . $f["name"][$i] .'  wurde leider nicht erfolgreich hochgeladen.</p>';
			}
		}
		else {
			$msg .= '<p class="success">Leider ist beim Upload ein Fehler aufgetreten.</p>';
		}
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
			<input type="file" name="myUpload[]" multiple>
			<input type="submit" value="hochladen">
		</form>
	</body>
</html>