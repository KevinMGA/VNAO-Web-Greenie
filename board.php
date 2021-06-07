<?php
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
    	body {
    		x-overflow:hidden;
    	}
    	
    	table {
    		/* background:#f7f7f7; */
    		background:url("<?php echo $s->BGLogo;?>") <?php echo $s->tableBackgroundColor;?> /*#f7f7f7*/;
    		background-repeat: no-repeat;
    		background-size:contain;
    		background-position: center;
    		vertical-align: middle !important;
    	}
    	table tr th {
    		background-color:<?php echo $s->tableHeaderColor;?> /* #e1e1e1 */ !important;
    		color:<?php echo $s->tableHeaderFontColor;?> /* #817d7a */ !important;
    	}
    	table tr td {
    		color:<?php echo $s->tableFontColor;?> /* black */;
    	}
    	table tr td a {
    		color:<?php echo $s->tableFontColor;?> /* black */;
    	}
    	table tr td a:hover {
    		color:<?php echo $s->tableFontColor;?> /* black */;
    	}
    	.tableCall {
    		text-align: left !important
    	}
    	
    	.key {
			color:<?php echo $s->tableFontColor;?> /* black */;
		}

		<?php
		if($s->name != "Argonauts") {
			?>
			.board  {
				padding:2%;
			}
			<?php
		}	else {
			?>
			.container-fluid {
				padding:0px !important;
			}
			.row {
			    --bs-gutter-x: 0rem;
			}
			<?php
		}
		?>
    </style>
  </head>

  <body style="background-color:<?php echo $s->background_color;?>;">
  	<div class="container-fluid board">
  		<?php
		if($s->name != "Argonauts") {
			?>
			<div class="row mt-3 mb-5">
	  			<div class="col-md-2 text-center">
	  				<img class="logo" src="<?php echo $s->logo;?>">
	  			</div>
	  			<div class="col-md-8">
	  				<h1 class="greenieHeader text-center" style="color:<?php echo $s->head_font_color;?>;"> <?php echo $s->name;?> Greenie Board </h1>
	  				<h5 class="text-center motto" style="position:relative;top:50px;color:<?php echo $s->head_font_color;?>;"> <?php echo $s->motto;?> </h5>
	  			</div>
	  		</div>
			<?php
		}	
		?>
  		
  		<div class="table-responsive">
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
			  <tbody>
			  	<?php foreach($pilots as $p):?>
			    	<tr>
			    		<td><?php echo $p->modex;?></td>
			    		
			    		<td class="tableCall"><a href="pilotlog.php?callsign?=<?php echo $p->callsign;?>"><?php echo $p->callsign;?></a></td>
			    		<td><?php echo $Greenie->avg($p->callsign); ?></td>	
			    		<?php
			    			echo $Greenie->pullGrade($p->callsign);
			    		?>
			    	</tr>
			   	<?php endforeach;?>
			  </tbody>
			</table>
  		</div>

  		<div class="row mt-3">
  			<div class="col-md-3">
  				<div class="key">
					<p><span class="key ok">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> OK - Minimum deviations with good corrections</p>	
				</div>
				<div class="key">
					<p><span class="key fair">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> Fair - Reasonable deviations with average corrections</p>	
				</div>
				<div class="key">
					<p><span class="key ng">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> No Grade - Below average corrections but a safe pass</p>	
				</div>
				<div class="key">
					<p><span class="key cutpass">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> Cut - Unsafe, gross deviations inside the wave off window</p>	
				</div>
  			</div>
  			<div class="col-md-3">
				<div class="key">
					<p><span class="key wo">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> Wave Off</p>	
				</div>
				<div class="key">
					<p><span class="key bolter">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> Bolter - Tailhook did not catch a wire/aircraft went around for another pass</p>	
				</div>
  			</div>
  		</div>

  	</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>



  </body>
</html>
<?php endforeach; ?>