<?php
session_start();
require_once('config/db.php');
require_once('lib/pdo_db.php');
require_once('modules/greenieBoard.php');

if (!isset($_SESSION['email'])) {
  header("location:login.php");
}

$Greenie = new GreenieBoard();

?>

<!doctype html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>VNAO Admin</title>


    <style>
      .card {
        padding:10%;
        transition: all 300ms ease;
      }
      .catA {
        text-decoration: none;
        color:black;
      }
      .catA:hover {
        color:white;
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

    </style>
  </head>

  <body>

    <div class="container board">

      <div class="row welcome mt-3">

        <h2>Welcome, <?php echo $_SESSION['name'];?> <span class="logout"><a href="action.php?id=logout">Logout</a></span></h2>

      </div>

      <div class="row mt-5">

        <div class="col-md-6">
          <a class="catA" href="squads.php">
            <div class="card cat text-center" style="">
                <div class="card-body">
                  <h5 class="card-title">Boards</h5>
                </div>
            </div>
          </a>
        </div>
        <div class="col-md-6">
          <a class="catA" href="pilots.php">
            <div class="card cat text-center" style="">
                <div class="card-body">
                  <h5 class="card-title">Pilots</h5>
                </div>
            </div>
          </a>
        </div>
      </div>

      
      <div class="row mt-5">

        <div class="col-md-4">
          <a class="catA" href="#">
            <div class="card cat text-center" style="">
                <div class="card-body">
                  <h5 class="card-title">Add Pilot</h5>
                </div>
            </div>
          </a>
        </div>
        <div class="col-md-4">
          <a class="catA" href="#">
            <div class="card cat text-center" style="">
              
                <div class="card-body">
                  <h5 class="card-title">Remove Pilot</h5>
                </div>
            
            </div>
          </a>
        </div>
        <div class="col-md-4">
          <a class="catA" href="#">
            <div class="card cat text-center" style="">
              
                <div class="card-body">
                  <h5 class="card-title">Update Pilot</h5>
                </div>
             
            </div>
          </a>
        </div>

      </div>

      <?php 

      if($_SESSION['type'] === '1') {
      ?>

      <div class="row mt-5">

        <div class="col-md-4">
          <a class="catA" href="#">
            <div class="card cat text-center" style="">
              
                <div class="card-body">
                  <h5 class="card-title">Add Squad</h5>
                </div>
              
            </div>
          </a>
        </div>
        <div class="col-md-4">
          <a class="catA" href="#">
            <div class="card cat text-center" style="">
              
                <div class="card-body">
                  <h5 class="card-title">Remove Squad</h5>
                </div>
             
            </div>
          </a>
        </div>
        <div class="col-md-4">
          <a class="catA" href="#">
            <div class="card cat text-center" style="">
              
                <div class="card-body">
                  <h5 class="card-title">Update Squad</h5>
                </div>
              
            </div>
          </a>
        </div>
      </div>

      <?php 
      }
      ?>

      <!-- Next Row -->


    

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

  </body>
</html>
