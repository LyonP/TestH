<?php
    // DATEN FUER DIE VERBINDUNG DER DATENBANK SIND HIER EINGESPEICHERT
    require("includes/dbh.inc.php");    // DBH STEHT FUER DATABASE HANDLER
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TabTitel</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
        // $sql IST EINFACH EIN (!)STRING(!) IN DEM CMDs FUER SQL GESPEICHERT WERDEN    -> DIESER WIRD HIER NOCH (!)NICHT(!) AN MYSQL WEITERGEGEBEN
        $sql = "
            SELECT *
            FROM tbl_kunden
        ";

        // VOM OBJEKT $conn WIRD JETZT EINE METHODE (query >> zu deutsch ANFRAGE) AUFGERUFEN
        // DER METHODE WIRD HIER DER STRING FUER DIE ANFRAGE AN MYSQL IN DER KLAMMER DER METHODE UEBERGEBEN
        // ALLE DATEN DIE MAN VON DER ANFRAGE EMPFAENGT, WERDEN IN DER VARIABLE $kundenliste GESPEICHERT  >> HIER SIND WIRKLICH (!)ALLE(!) PERSONEN MIT IHREN DATEN GESPEICHERT

        // FALLS ETWAS BEI DER ANFRAGE SCHIEF LAEUFT BRICHT DAS PROGRAMM AB >> 'die("Fehler bei der DB Anfrage")'
        $kundenliste = $conn->query($sql) or die("Fehler bei der DB Anfrage");
        
        // HIER WIRD NUR DIE UEBERSCHRIFT (th = tableHeader) FUER DIE TABELLE ERSTELLT 
        // <table> DARF HIER NOCH NICHT GESCHLOSSEN WERDEN
        echo'<table>
            <th>Nachname</th>
            <th>Vorname</th>
            <th>Email</th>
        ';

        // MIT DER METHODE 'fetch_Object()' WIRD IMMER (!)EINE EINZIGE(!) PERSON AUS $kundenliste GEPICKT UND IN $kunde GESPEICHERT
        while ($kunde = $kundenliste->fetch_Object()) {
            echo'
                <tr>
                    <td>'. $kunde->Nachname .'</td>     
                    <td>'. $kunde->Vorname .'</td>
                    <td>'. $kunde->Email .'</td>
                </tr>
            ';
        }

        // HIER WIRD DIE TABELLE ENTGUELTIG GESCHLOSSEN
        echo'</table>';
    ?>
</body>
</html>