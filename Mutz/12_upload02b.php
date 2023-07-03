<?php
require("includes/config.inc.php");
require("includes/common.inc.php");

ta($_FILES);
$msg = "";
if(count($_FILES)>0) {
	foreach($_FILES as $f) {
		for($i=0; $i<count($f["name"]); $i++) {
			if($f["error"][$i]==0) {
				$ok = move_uploaded_file($f["tmp_name"][$i],"uploads/" . $f["name"][$i]);
				if($ok) {
					$msg .= '<p class="success">Die Datei ' . $f["name"][$i] .'  wurde erfolgreich hochgeladen.</p>';
				}
				else {
					$msg .= '<p class="error">Die Datei ' . $f["name"][$i] .'  wurde leider nicht erfolgreich hochgeladen.</p>';
				}
			}
			else {
				$msg .= '<p class="error">Leider ist beim Upload ein Fehler aufgetreten.</p>';
			}
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
			<input type="file" name="myUpload0[]" multiple>
			<input type="file" name="myUpload7[]" multiple>
			<input type="file" name="myUpload23[]" multiple>
			<input type="file" name="myUpload19[]" multiple>
			<input type="file" name="myUpload4[]" multiple>
			<input type="file" name="myUpload5[]" multiple>
			<input type="file" name="myUpload2[]" multiple>
			<input type="submit" value="hochladen">
		</form>
	</body>
</html>