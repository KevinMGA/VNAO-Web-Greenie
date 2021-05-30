<?php
require_once('config/db.php');
require_once('lib/pdo_db.php');
require_once('modules/greenieBoard.php');

$Greenie = new GreenieBoard();
$traps = $Greenie->getTraps();
$pilots = $Greenie->getPilots();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <title>VNAO Greenie Board</title>

    <style>
    		
    	tr, td {
    		border:1px solid black;
    	}
    	.grade {
    		max-width: 25px;
    		border:1px solid black;
    		white-space: nowrap;
    	}

    	.mod {
    		max-width: 15px;
    		border:1px solid black;
    		white-space: nowrap;
    	}

    	.grades {
    		max-width: 50px;
    		border:1px solid black;
    		white-space: nowrap;
    	}

    	.avg {
    		min-width: 60px;
    	}

    	.ok {
    		background-color:green !important;
    	}
    	.fair {
    		background-color:yellow !important;
    	}
    	.ng {
    		background:orange !important;
    	}
    	.cutpass {
    		background:lightblue !important;
    	}
    	.bolter {
    		background:blue !important;
    	}
    	.wo {
    		background:red !important;
    	}
    	.link{
		    display:inline-block;
		    width:100%;
		    height:100%;
		    text-decoration: none;
		    
		}
		.table td {
			margin:0px;
			padding:5px;
		}
		.night {
			color:black;
			font-size: 24px;
			padding:0px;
			margin:0px;
		}
		.hidden {
			
			visibility: hidden;
		}
		.visible {
			
			visibility: visible;
		}




		

		
		.tip .tiptext {
		  visibility: hidden;
		  width: 15%;
		  background-color: rgba(0, 0, 0, 0.7);
		  color: #fff;	  
		  border-radius: 6px; 
		  position: absolute;
		  margin-left:-50px;
		  margin-top:-50px;
		  z-index: 1;
		  padding:5px 10px;
		  text-align: center;
		}

		
		.tip:hover .tiptext {
		  visibility: visible;
		}

    </style>
  </head>
  <body>
    

    


	<table class="table table-striped text-center">
	  <thead>
	    <tr>
	      <th scope="col" class="mod">MODEX</th>
	      <th scope="col">CALLSIGN</th>
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
	    </tr>
	  </thead>
	  <tbody>
	  	<?php foreach($pilots as $p):?>
	    	<tr>
	    		<td><?php echo $p->modex;?></td>
	    		<td><a href="pilotlog.php?callsign?=<?php echo $p->callsign;?>"><?php echo $p->callsign;?></a></td>
	    		<td><?php echo $Greenie->avg($p->callsign); ?></td>	
	    		<?php
	    			echo $Greenie->getGrade($p->callsign);
	    		?>
	    	</tr>
	   	<?php endforeach;?>
	  </tbody>
	</table>



   






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
  </body>
</html>