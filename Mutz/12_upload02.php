<?php
require("includes/config.inc.php");
require("includes/common.inc.php");

ta($_FILES);
$msg = "";
if(count($_FILES)>0) {
	for($i=0; $i<count($_FILES["myUpload"]["name"]); $i++) {
		if($_FILES["myUpload"]["error"][$i]==0) {
			$ok = move_uploaded_file($_FILES["myUpload"]["tmp_name"][$i],"uploads/" . $_FILES["myUpload"]["name"][$i]);
			if($ok) {
				$msg .= '<p class="success">Die Datei ' . $_FILES["myUpload"]["name"][$i] .'  wurde erfolgreich hochgeladen.</p>';
			}
			else {
				$msg .= '<p class="success">Die Datei ' . $_FILES["myUpload"]["name"][$i] .'  wurde leider nicht erfolgreich hochgeladen.</p>';
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