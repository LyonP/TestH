<?php


//Functions


function getMovies(){

  $servername = "localhost";
  $username = "root";
  $password = "";
  

  try {
    $conn = new PDO("mysql:host=$servername;dbname=filmverwaltung", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }

  $stmt = $conn->query("SELECT * FROM filme"); 
  return $stmt;

}

function getMoviesBasedOnId($id){

  $servername = "localhost";
  $username = "root";
  $password = "";
  

  try {
    $conn = new PDO("mysql:host=$servername;dbname=filmverwaltung", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }

  $stmt = $conn->query("SELECT * FROM filme"); 
  return $stmt;

}

function searchCompaniesBasedOnName($name){

  $servername = "localhost";
  $username = "root";
  $password = "";
  

  try {
    $conn = new PDO("mysql:host=$servername;dbname=filmverwaltung", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }

  $stmt = $conn->query("SELECT * FROM filme"); 
  return $stmt;

}



?> 

<!DOCTYPE html>

<head>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>


</head>

<style>

.box{
  
  max-width: 1500px;
  padding:50px;
  margin-top:50px;
  margin-left:350px;
  border-radius:20px;
  margin-bottom:50px;
}

.main {
  display: flex;
  justify-content: center;
  flex-direction: row;
  font-size: 30px;
  padding: 5px;
}
  
  .main div {
  margin: 50px 50px;
  width: 300px;

  }
  </style>

<body>



<div style="-webkit-box-shadow: 10px 10px 57px -18px rgba(0,0,0,0.75);-moz-box-shadow: 10px 10px 57px -18px rgba(0,0,0,0.75);box-shadow: 10px 10px 57px -18px rgba(0,0,0,0.75);"class="table-reponsive box">

  <h2><b>Verfügbare</b> Filme</h2>
  <br>
  <table id="example" class="table table-striped table-bordered">
          <thead>

              <tr>
                  <th>Film ID</th>
                  <th>Titel</th>
                  <th>Erscheinungsdatum</th>
                  <th>Produktionsfirma ID</th>
              </tr>
          </thead>
          <tbody>
            

              <?php

                $result = getMovies();

                while ($row = $result->fetch()) {
                  echo"<tr>";
                  echo "<td>".$row['Song_ID']."</td>";
                  echo "<td>".$row['Titel']."</td>";
                  echo "<td>".$row['ErscheinungsDatum']."</td>";
                  echo "<td>".$row['Produktionsfirma_ID']."</td>";
                  echo"</tr>";
                }

                ?>
          
          </tbody>
      </table>

<div style="margin:auto;"class="main">

<div style="padding:20px; font-size:20px; border:solid; border-radius:10px; border-color:gray; border-width:1px; -webkit-box-shadow: 10px 10px 57px -18px rgba(0,0,0,0.75);-moz-box-shadow: 10px 10px 57px -18px rgba(0,0,0,0.75);box-shadow: 10px 10px 57px -18px rgba(0,0,0,0.75);"> 
            <h2 style="color:black;"><b>Firmensuche</b></h2>
            <p style="font-size:12px;">Suchen Sie eine Produktionsfirma anhand des Namen. Wenn Sie nichts eingeben, werden Ihnen alle Firmen angezeigt.</p>
            <hr>
            <form action="https://localhost/displayValues.php" method="POST">

            <label for="searchMovie">Produktionsfirma</label>
            <input type="text" name="companyName" placeholder="z.B. Wippis Filmstudio">
            <button style="cursor:pointer; border:none; background-color:#007bff; border-radius:5px; margin-top:5px; color:white; width:100%;"type="submit">Suchen</button>


            </form>

        </div>
        <div style="padding:20px; font-size:20px;border:solid; border-radius:10px; border-color:gray; border-width:1px; -webkit-box-shadow: 10px 10px 57px -18px rgba(0,0,0,0.75);-moz-box-shadow: 10px 10px 57px -18px rgba(0,0,0,0.75);box-shadow: 10px 10px 57px -18px rgba(0,0,0,0.75);"> 
            <h2 style="color:black;"><b>Filmsuche</b></h2>
            <p style="font-size:12px;">Suchen Sie einen Film anhand seines Namen. Wenn Sie nichts eingeben, werden Ihnen alle Filme angezeigt.</p>
            <hr>
            <form action="https://localhost/displayValues2.php" method="POST">

            <label for="searchMovie">Filmname</label>
            <input type="text" name="filmName" placeholder="z.B. Harry Potter">
            <button style="cursor:pointer; border:none; background-color:#007bff; border-radius:5px; margin-top:5px; color:white; width:100%;"type="submit">Suchen</button>
            </form>

        </div>

        <div style="padding:20px; font-size:20px;  border:solid; border-radius:10px; border-color:gray; border-width:1px; -webkit-box-shadow: 10px 10px 57px -18px rgba(0,0,0,0.75);-moz-box-shadow: 10px 10px 57px -18px rgba(0,0,0,0.75);box-shadow: 10px 10px 57px -18px rgba(0,0,0,0.75);"> 
            <h2 style="color:black;"><b>Personensuche</b></h2>
            <p style="font-size:12px;">Suchen Sie einen Schauspieler anhand seines Namen. Wenn Sie nichts eingeben, werden Ihnen alle Schauspieler angezeigt.</p>
            <hr>
            <form action="https://localhost/displayValues3.php" method="POST">

            <label for="searchMovie">Schauspielername</label>
            <input type="text" name="personName" placeholder="z.B. Julian Pichler">
            <button style="cursor:pointer; border:none; background-color:#007bff; border-radius:5px; margin-top:5px; color:white; width:100%;"type="submit">Suchen</button>
            </form>

        </div>
  </div>

  </div>


<script>

$(document).ready(function() {
    $('#example').DataTable();
} );

</script>


</body>


