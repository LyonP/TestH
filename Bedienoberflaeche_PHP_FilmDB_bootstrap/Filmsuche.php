<br>
<h4>Filmsuche</h4>
<br>
<?php
    if (!isset($_GET['suchen']))
    {
        ?>
        <form mehtod="GET" action>
            <label for="produktionsfirma">Produktionsfirma:</label>
            <input type="text" name="produktionsfirma" placeholder="Produktionsfirma" id="produktionsfirma">
            <br>
            <input type="hidden" name="seite" value="Filmsuche">
            <input type="submit" name="suchen" value="Suchen">
            <input type="button" name="abbrechen" value="Abbrechen" onclick='window.location.href="index.php/?seite=Startseite"'>
        </form>
        <?php
    }
    else
    {
        include 'config.php';
        $firstrow=true;
        $produktionsfirma = $_GET['produktionsfirma'];
        $query = 'select * from produktionsfirma where Bezeichnung like"%"?"%"';
        $stmt = $con->prepare($query);
        $stmt->bindParam(1, $produktionsfirma);
        $stmt->execute();
        $countRows=$stmt->rowCount();
        if ($countRows=0)
        {
            ?>
            Produktionsfirma nicht gefunden.
            <?php
        }
        else
        {
            ?>
            Gesuchte Produktionsfirma: <b><?php echo $produktionsfirma?></b><br>
            <table border="0">
                <tr><td>Gefundene Produktionsfirma:</td>

                <?php
                while($row = $stmt->fetch(PDO::FETCH_ASSOC))
                {
                    if ($firstrow)
                    {
                        echo'<td><b>';
                        echo $row['Bezeichnung'];
                        echo'</b><br>';
                        echo'</td>';
                        echo'</tr>';
                        $firstrow=false;
                    }
                    else
                    {
                        echo'<tr>';
                        echo'<td>';
                        echo'</td>';
                        echo'<td><b>';
                        echo $row['Bezeichnung'];
                        echo'</b><br>';
                        echo'</td>';
                        echo'</tr>';
                    }
                }
                ?></b>
            </table>
            <?php
            $query = 'select f.titel "Titel", f.`Erscheinungsdatum` "Erscheinungs-Datum",pf.Bezeichnung "Produktionsfirma" from produktionsfirma pf,filme f where pf.produktionsfirma_id=f.Produktionsfirma_ID and pf.Bezeichnung like"%"?"%" order by `Erscheinungsdatum`';
            $stmt = $con->prepare($query);
            $stmt->bindParam(1, $produktionsfirma);
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
