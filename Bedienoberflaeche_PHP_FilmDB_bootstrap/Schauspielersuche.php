<br>
<h4>Schauspielersuche</h4>
<br>
<?php
if (!isset($_GET['suchen']))
{
    ?>
    <form mehtod="GET" action>
        <label for="searchString">Suche nache:</label>
        <input type="text" name="searchString" placeholder="Namen/steil" id="searchString">
        <br>
        <label for="nachname">Nachname:</label>
        <input type="text" name="nachname" placeholder="Nachname" id="nachname">
        <br>
        <input type="hidden" name="seite" value="Schauspielersuche">
        <input type="submit" name="suchen" value="Suchen">
        <input type="button" name="abbrechen" value="Abbrechen" onclick='window.location.href="index.php/?seite=Startseite"'>
    </form>
    <?php
}
else
{
    include 'config.php';
    $searchString = $_GET['searchString'];
    $query = 'select Vorname,Nachname from schauspieler where Vorname like"%"?"%" or Nachname like "%"?"%"';
    $stmt = $con->prepare($query);
    $stmt->bindParam(1, $searchString);
    $stmt->bindParam(2, $searchString);
    $stmt->execute();
    $countRows=$stmt->rowCount();
    if ($countRows=0)
    {
        ?>
        Schauspieler nicht gefunden.
        <?php
    }
    else
    {
        ?>
        Gesuchter Schauspieler: <b><?php echo $searchString;?></b><br>
        Gefundene Schauspieler:
            <b><br><?php
            while($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                echo $row['Vorname'];
                echo ' ';
                echo $row['Nachname'];
                echo'<br>';
            }
            ?></b>
        <?php
        $query = 'select Vorname "Vorname", Nachname "Nachname", f.Titel "Titel", pf.Bezeichnung "Produktionsfirma" from schauspieler s, 
				    schauspieler_has_filme sif,  
				    filme f, produktionsfirma pf
		          where 
			             s.id=sif.Schauspieler_id
                                 and sif.Filme_Song_ID=f.Song_ID
                                 and f.Produktionsfirma_ID=pf.produktionsfirma_ID
                                 and (Vorname like"%"?"%" or Nachname like "%"?"%")';
        $stmt = $con->prepare($query);
        $stmt->bindParam(1, $searchString);
        $stmt->bindParam(2, $searchString);
        $stmt->execute();
        $countAttribut = $stmt->columnCount();
        $countRows=$stmt->rowCount();
        ?>
        Gefundene Filme: <b><?php echo $countRows?></b><br>
        <?php
        $attribute= array();
        for ($i=0;$i < $countAttribut; $i++)
        {
            $attribute[$i]=$stmt->getColumnMeta($i);
        }
        echo '<table border="1">
            <tr>';
        foreach ($attribute as $a)
        {
            echo'<th style="padding: 3px">';
            echo $a['name'];
            echo'</th>';
        }
        echo '</tr>';
        while($row = $stmt->fetch(PDO::FETCH_NUM))
        {
            echo '<tr>';
            foreach ($row as $r)
            {
                echo '<td style="padding: 3px">';
                echo $r.' ';
                echo '</td>';
            }
            echo '</tr>';
        }
        echo '<table>';
        ?>
        <form>
            <input type="button" name="zurück" value="Zurück" onclick="history.back()">
        </form>
    <?php
    }
}
?>