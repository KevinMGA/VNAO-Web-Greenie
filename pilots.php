<?php
session_start();
require_once('config/db.php');
require_once('lib/pdo_db.php');
require_once('modules/greenieBoard.php');

if (!isset($_SESSION['email'])) {
  header("location:login.php");
}

$Greenie = new GreenieBoard();

if($_SESSION['type'] === '1') {
  $allPilots = $Greenie->allPilots();
  $colOne = 'SQUAD';
} elseif ($_SESSION['type'] === '2') {
  $allPilots = $Greenie->getPilots($_SESSION['squad']);
  $colOne = 'MODEX';
}


?>

<!doctype html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Data Tables Include -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">


    <title>VNAO Admin</title>


    <style>
      .card {
        padding:10%;
        transition: all 300ms ease;
      }
      .card a {
        text-decoration: none;
        color:black;
      }
      .card:hover {
        background-color:green;
      }
      .card-title {
        font-size: 24px;
      }
      .logout {
        float:right;
      }
      .back {
        float:right;
        padding-right:15px;
      }
      .back a {
        text-decoration: none:
        color:black;
      }
      .table>:not(caption)>*>* {
        background-color:grey;
      }
    </style>
  </head>

  <body>

    <div class="container board">

      <div class="row welcome mt-3">

        <h2>Welcome, <?php echo $_SESSION['name'];?> <span class="logout"><a href="action.php?id=logout">Logout</a></span> <span class="back"><a href="index.php">Back</a></span></h2>

      </div>

      
      <div class="table-responsive mt-3 mb-5">
          <table style="background-color:grey;" class="table text-center mt-5 mb-3" id="pilotTable">
          <thead>
            <tr>
              <th scope="col" class="mod"><?php echo $colOne;?></th>
              <th scope="col">CALLSIGN</th>
              <th class="avg">Flight Time</th>
              <th class="avg">Last Flight Date</th>
            </tr>
          </thead>
          <tbody>
           <?php foreach($allPilots as $s):?>
            <tr>
              <?php 
              if($_SESSION['type'] === '1') {
                echo '<td>' .$s->squad. '</td>';
              } else {
                echo '<td>' .$s->modex. '</td>';
              }
              ?>
              <td><?php echo $s->callsign;?></td>
              <td><?php echo gmdate("H:i:s", intval($s->flightTime));?></td>
              <td><?php echo $Greenie->lastFlight($s->callsign); ?></td>
            </tr>
          <?php endforeach;?>
          </tbody>
        </table>
        </div>

      </div>

      <!-- Next Row -->


    

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
    <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>


    <script>
      $(document).ready( function () {
          $('#pilotTable').DataTable();
      } );
    </script>
  </body>
</html>
