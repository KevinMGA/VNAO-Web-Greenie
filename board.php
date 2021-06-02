<?php
require_once('config/db.php');
require_once('lib/pdo_db.php');
require_once('modules/greenieBoard.php');

$Greenie = new GreenieBoard();

if(!isset($_GET['board'])) {
	$set = false;
} else {
	$squad = $Greenie->getSquad($_GET['board']);
	$traps = $Greenie->getTraps();
	$set = true;
}
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
    <title>VNAO Greenie Board</title>
  </head>

  <body>
  	<div class="container-fluid board">
  		<h2 class="text-center"> VFA <?php echo $s->tag; ?></h2>
  		<h1 class="text-center"> Greenie Board </h1>
  		<div class="table-responsive">
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
  		</div>
  	</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>



  </body>
</html>
<?php endforeach; ?>