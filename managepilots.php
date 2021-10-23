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
  $allPilots = $Greenie->managePilots();
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
              <th class="col">Action</th>
            </tr>
          </thead>
          <tbody>
           <?php foreach($allPilots as $s):?>
           	<?php
           		if($s->callsign == "&nbsp;") {
           			$call = "";
           		} else {
           			$call = $s->callsign;
           		}
           	?>
            <tr>
              <?php 
              if($_SESSION['type'] === '1') {
                echo '<td>' .$s->modex. '</td>';
              } 
              ?>
              <td><?php echo $s->callsign;?></td>
              <td><?php echo gmdate("H:i:s", intval($s->flightTime));?></td>
              <td><?php echo $Greenie->lastFlight($s->callsign); ?></td>
              <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#manage_pilot_<?php echo $s->id;?>">Edit</button></td>
            </tr>


            <div class="modal fade" id="manage_pilot_<?php echo $s->id;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Modex <?php echo $s->modex;?> </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        
                        <form id="form_pilot_<?php echo $s->id;?>" action="action.php?id=manage_pilot" method="POST">
                            <div class="row">

                                <div class="col">
                                    <label>CallSign</label>
                                    <input type="text" class="form-control" name="callsign" value="<?php echo $call;?>" placeholder="<?php echo $call;?>">
                                </div>
                                
                                <input type="hidden" name="id" value="<?php echo $s->id;?>"/>

                            </div>
                        </form>
                        
                        <form id="clear_form_<?php echo $s->id;?>" action="action.php?id=clear_pilot" method="POST">
                            <input type="hidden" name="id" value="<?php echo $s->id;?>"/>
                        </form>

                        <div class="modal-footer">
                        <input type="button" class="btn btn-secondary" value="Clear" onclick="clear_submit(<?php echo $s->id;?>)">
                        <input type="button" name="subButton" value="Sub" class="btn btn-primary" onclick="pilot_submit(<?php echo $s->id;?>)"/>
                        </div>
                    </div>
                </div>
            </div>


          <?php endforeach;?>
          </tbody>
        </table>
        </div>

      </div>

      <!-- Next Row -->

      
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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

    <script>
        function pilot_submit(id) {
            document.getElementById("form_pilot_"+id).submit();
        }
        function clear_submit(id) {
            document.getElementById("clear_form_"+id).submit();
        }
    </script>
  </body>
</html>
