<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "filmverwaltung";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filmverwaltung</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h1>Filmverwaltung</h1>


    <table>
        <tr>
            <th>Film_ID</th>
            <th>Filmtitel</th>
            <th>Erscheinungsdatum</th>
            <th>Produktionsfirma_ID</th>
        </tr>
        <?php
        $sql = "SELECT * FROM film";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>" . "<td>" . $row["IDFilm"] . "</td>" . "<td>" . $row["Titel"] . "</td>" . "<td>" . $row["Erscheinungsdatum"] . "</td>" . "<td>" . $row["FIDProduktionsfirma_ID"] . "</td>" . "</tr>";
            }
        }
        ?>
    </table>

    <table>
        <tr>
            <th>Produktionsfirma_ID</th>
            <th>Bezeichnung</th>
        </tr>
        <?php
        $sql = "SELECT * FROM produktionsfirma";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>" . "<td>" . $row["IDProduktionsfirma"] . "</td>" . "<td>" . $row["Bezeichnung"] . "</td>" . "</tr>";
            }
        }
        ?>
    </table>

    <form action="" method="GET">
        <input type="text" name="searchactor" required value="<?php if (isset($_GET['searchactor'])) {
            echo $_GET['searchactor'];
        } ?>" class="form-control" placeholder="Schauspieler">
        <button type="submit">suchen</button>
    </form>

    <h2>Gesuchte Schauspieler</h2>

    <table>
        <thead>
            <tr>
                <th>Vorname</th>
                <th>Nachname</th>
                <th>Herkunftsland</th>
                <th>Filme</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_GET['searchactor'])) {
                $filtervalues = $_GET['searchactor'];
                $query = "SELECT * FROM schauspieler INNER JOIN mitwirkende ON FIDSchauspieler = IDSchauspieler INNER JOIN film ON FIDFilm = IDFilm WHERE CONCAT(Vorname,Nachname) LIKE '%$filtervalues%' ";
                $query_run = mysqli_query($conn, $query);

                if (mysqli_num_rows($query_run) > 0) {
                    foreach ($query_run as $items) {
            ?>
                        <tr>
                            <td><?= $items['Vorname']; ?></td>
                            <td><?= $items['Nachname']; ?></td>
                            <td><?= $items['Herkunftsland']; ?></td>
                            <td><?= $items['Titel']; ?></td>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td>ruhig hier...</td>
                    </tr>
            <?php
                }
            }
            ?>
        </tbody>
    </table>



    <form action="" method="GET">
        <input type="text" name="search" required value="<?php if (isset($_GET['search'])) {
                                                                echo $_GET['search'];
                                                            } ?>" class="form-control" placeholder="Produktionsfirmen">
        <button type="submit">suchen</button>
    </form>

    <h2>Gesuchte Produktionsfirmen</h2>

    <p>Gesuchter Begriff: <?php echo $_GET['search'] ?></p>

    <table>
        <thead>
            <tr>
                <th>Bezeichnung</th>
                <th>Filme</th>
                <th>Erscheinungsdatum</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($_GET['search'])) {
                $filtervalues = $_GET['search'];
                $query = "SELECT * FROM produktionsfirma INNER JOIN film ON FIDProduktionsfirma_ID = IDProduktionsfirma WHERE CONCAT(Bezeichnung) LIKE '%$filtervalues%' ";
                $query_run = mysqli_query($conn, $query);

                if (mysqli_num_rows($query_run) > 0) {
                    foreach ($query_run as $items) {
            ?>
                        <tr>
                            <td><?= $items['Bezeichnung']; ?></td>
                            <td><?= $items['Titel']; ?></td>
                            <td><?= $items['Erscheinungsdatum']; ?></td>

                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td>ruhig hier...</td>
                    </tr>
            <?php
                }
            }
            echo "<p>Gefundene Filme: " . mysqli_num_rows($query_run) . "</p>"
            ?>
        </tbody>
    </table>

</body>
</html>