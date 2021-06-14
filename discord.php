<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('config/db.php');
require_once('lib/pdo_db.php');
require_once('modules/greenieBoard.php');

$Greenie = new GreenieBoard();
$squad = $Greenie->getSquad($_GET['board']);
$traps = $Greenie->getTraps();

?>

<!doctype html>
<?php foreach($squad as $s):?>
<?php $pilots = $Greenie->getPilots($s->tag); ?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/media.css">
    <title>VNAO Greenie Board</title>

    <style>
    	
    	
    	table {
    		/* background:#f7f7f7; */
    		background:url("<?php echo $s->BGLogo;?>") #f7f7f7 /*#f7f7f7*/;
    		background-repeat: no-repeat;
    		background-size:contain;
    		background-position: center;
    		vertical-align: middle !important;
    		border:2px solid black;
    	}
    	tr {
    		height: 60px !important;
    		border:2px solid black;
    	}


    	.mod {
			max-width: 75px;
			border:2px solid black;
		}

		.avg {
			min-width: 60px;
			border:2px solid black;
		}


    	thead tr {
    		height: 40px !important;
    	}
    	table tr th {
    		background-color:#e1e1e1 /* #e1e1e1 */ !important;
    		color:black /* #817d7a */ !important;
    		
    	}
    	table tr td {
    		color:black /* black */;
    		border:2px solid black;
    	}
    	table tr td a {
    		color:black /* black */;
    	}
    	table tr td a:hover {
    		color:black /* black */;
    	}
    	.tableCall {
    		text-align: center !important
    	}
    	
    	.key {
			color:black /* black */;
		}

		.table>:not(caption)>*>* {
		    padding: .1rem .1rem;

		}
		.container-fluid {
			padding:0px;
		}
		.callsignHeader {
			min-width:75px !important;
			padding:0px;
		}

		.tableCall {
			font-weight: bold;
		}
		table tbody td {
		      white-space:nowrap;
		      min-width:30px;
		}
    </style>
  </head>

  <body style="">
  	<div class="container-fluid board">
  		
  		
  		<div>
  			<table class="table text-center ">
			  <thead>
			    <tr>
			      <th scope="col" class="mod">MOD</th>
			      <th scope="col" class="callsignHeader">CALLSIGN</th>
			      <th class="avg">AVG</th>
			      <th class="grades">1</th>
			      <th class="grades">2</th>
			      <th class="grades">3</th>
			      <th class="grades">4</th>
			      <th class="grades">5</th>
			      <th class="grades">6</th>
			      <th class="grades">7</th>
			      <th class="grades">8</th>
			      <th class="grades">9</th>
			      <th class="grades">10</th>
			      <th class="grades">11</th>
			      <th class="grades">12</th>
			      <th class="grades">13</th>
			      <th class="grades">14</th>
			      <th class="grades">15</th>
			      <th class="grades">16</th>
			      <th class="grades">17</th>
			      <th class="grades">18</th>
			      <th class="grades">19</th>
			      <th class="grades">20</th>
			      <th class="grades">21</th>
			      <th class="grades">22</th>
			      <th class="grades">23</th>
			      <th class="grades">24</th>
			      <th class="grades">25</th>
			      <th class="grades">26</th>
			      <th class="grades">27</th>
			      <th class="grades">28</th>
			      <th class="grades">29</th>
			      <th class="grades">30</th>
			      <th class="grades">31</th>
			    </tr>
			  </thead>
			  
			  	<?php foreach($pilots as $p):?>
			    	<tr style="border:2px solid black !important; border-collapse: collapse !important;">
			    		<td style="font-weight:bold;"><?php echo $p->modex;?></td>
			    		
			    		<td class="tableCall"><a href="pilotlog.php?callsign?=<?php echo $p->callsign;?>"><?php echo $p->callsign;?></a></td>
			    		<td style="font-weight:bold;"><?php echo $Greenie->avg($p->callsign); ?></td>	
			    		<?php
			    			echo $Greenie->pullGrade($p->callsign);
			    		?>
			    	</tr>
			   	<?php endforeach;?>
			  
			</table>
  		</div>

  		

  	</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>



  </body>
</html>
<?php endforeach; ?>