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
  padding: 20px 10px;
  max-width: 1000px;
  margin: 0 auto;
}

.main {
              display: flex;
            justify-content: center;
            flex-direction: row;
            font-size: 30px;
            padding: 5px;
        }
  
        .main div {
            margin: 10px 20px;
            width: 300px;
            
        }
  </style>

<body>

<?php


function searchPersonByName($searchValue){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "filmverwaltung";
  
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
      echo "Connection failed: " . $e->getMessage();
    }
  
    $query = "SELECT s.ID, s.Vorname, s.Nachname, r.Rolle, f.Titel
 from schauspieler s, schauspieler_has_filme r, filme f where (s.Nachname LIKE ? or s.Vorname LIKE ?) and s.id=r.Schauspieler_id and r.Filme_Song_ID=f.Song_ID";
    $result = $conn->prepare($query);
    $result->bindValue(1, "%$searchValue%", PDO::PARAM_STR);
	$result->bindValue(2, "%$searchValue%", PDO::PARAM_STR);
    $result->execute();
    return $result;
  }

?>

<div style="margin-top:200px; border-radius:10px; -webkit-box-shadow: 10px 10px 57px -18px rgba(0,0,0,0.75);-moz-box-shadow: 10px 10px 57px -18px rgba(0,0,0,0.75);box-shadow: 10px 10px 57px -18px rgba(0,0,0,0.75); padding:20px;" class="table-responsive box">
  <h2><b>Gefundene</b> Schauspieler <span onclick="goBack()"  style="margin-left:580px; color:coral; cursor:pointer;">X</span></h2>
  <br>
  <table id="example" class="table table-striped table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Rolle</th>
        <th>Film</th>

      </tr>
    </thead>
    <tbody>
      <?php
        if(isset($_POST['personName'])){
          $result = searchPersonByName($_POST['personName']);
          while ($row = $result->fetch()) {
            echo "<tr>";
            echo "<td>".$row['ID']."</td>";
            echo "<td>".$row['Vorname']."&nbsp;".$row['Nachname']."</td>";
            echo "<td>".$row['Rolle']."</td>";
            echo "<td>".$row['Titel']."</td>";
            echo "</tr>";
          }
        }else{
            echo"NICHT GESETZT";
        }
      ?>
    </tbody>
  </table>
</div>

<script>

  function goBack(){
   
    window.location.href = "https://localhost/";
  }

  $(document).ready(function() {
    $('#example').DataTable();
  });
</script>
