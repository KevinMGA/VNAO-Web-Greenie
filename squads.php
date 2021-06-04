<?php
session_start();
require_once('config/db.php');
require_once('lib/pdo_db.php');
require_once('modules/greenieBoard.php');

if (!isset($_SESSION['email'])) {
  header("location:login.php");
}

$Greenie = new GreenieBoard();

$squads = $Greenie->getSquads();
?>

<!doctype html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>VNAO Admin</title>

    <!-- Data Tables Include -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
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

      
      <div class="table-responsive">
          <table style="background-color:grey !important;" class="table text-center" id="squadTable">
          <thead>
            <tr>
              <th scope="col" class="mod">MODEX</th>
              <th scope="col">NAME</th>
              <th class="avg">BOARD LINK</th>
            </tr>
          </thead>
          <tbody>
           <?php foreach($squads as $s):?>
            <tr>
              <td><?php echo $s->tag;?></td>
              <td><?php echo $s->name;?></td>
              <td><a target="_blank" href="board.php?board=<?php echo $s->tag;?>">Click Here</a></td>
            </tr>
          <?php endforeach;?>
          </tbody>
        </table>
        </div>

      </div>

      <!-- Next Row -->


    

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script
  src="https://code.jquery.com/jquery-3.6.0.min.js"
  integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
  crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>


    <script>
      $(document).ready( function () {
          $('#squadTable').DataTable();
      } );
    </script>
  </body>
</html>
