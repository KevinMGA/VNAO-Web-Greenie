<?php
require_once('config/db.php');
require_once('lib/pdo_db.php');
require_once('modules/greenieBoard.php');

$Graph = new GreenieBoard();

$pilot = $_GET['callsign'];

$profile = $Graph->getProfile($pilot);

$grade = $Graph->countGrade($pilot);


$uni = 0;
$ok = 0;
$fair = 0;
$ng = 0;
$wo = 0;
$bolter = 0;

$noWire = 0;
$fourwire = 0;
$threewire = 0;
$twowire = 0;
$onewire = 0;

foreach($grade as $g) {
	//Grades
	if($g->grade == '_OK_') {
		$uni++;
	}
	if($g->grade == 'OK') {
		$ok++;
	}
	if($g->grade == '(OK)') {
		$fair++;
	}
	if($g->grade == '--') {
		$ng++;
	}
	if($g->grade == 'WO') {
		$wo++;
	}
	if($g->grade == '-- (BOLTER)') {
		$bolter++;
	}

	// Wires
	if($g->wire == '') {
		$noWire++;
	}
	if($g->wire == 99) {
		$fourwire++;
	}
	if($g->wire == 4) {
		$threewire++;
	}
	if($g->wire == 3) {
		$twowire++;
	}
	if($g->wire == 2) {
		$onewire++;
	}
	if($g->wire == 1) {
		$onewire++;
	}
	var_dump($g);
}

?>

<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	</head>
	<body>

		<div class="container mb-5">

			<?php foreach($profile as $p):?>

			<div class="row mt-5">
				<div class="col text-center">
					<?php $name = explode(" ", $p->callsign);?>
					<h1><?php echo $name[1];?></h1><p>Squad: <?php echo $p->squad;?></p>
				</div>
			</div>
			<div class="row mt-5 mb-5">
				<div class="col">
					<div class="card">
						<div class="card-header">
							Total Flight Time
						</div>
						<div class="card-body">
							<?php echo gmdate("H:i:s", intval($p->flightTime));?>
						</div>
					</div>
				</div>
				<div class="col">
					<div class="card">
						<div class="card-header">
							Last Flight
						</div>
						<div class="card-body">
							<?php echo $Graph->lastFlight($p->callsign); ?>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col">
					<div class="card">
						<div class="card-header">Grades</div>
                        <div class="card-body">
		                    <canvas id="chDonut1"></canvas>
		                </div>
					</div>
				</div>
				<div class="col">
					<div class="card">
						<div class="card-header">Wires</div>
                        <div class="card-body">
		                    <canvas id="chDonut2"></canvas>
		                </div>
					</div>
				</div>
			</div>
			

		<?php endforeach;?>
		</div>
		

	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


	<script>


		var colors = ['#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];
		var gradeColors = ['yellow', '#07861c', '#ffc727', '#f97741', '#cf1b1b', '#104a81'];
		var wireColors = ['#cf1b1b', '#f97741', '#07861c', '#ffc727']

		
		var donutOptions = {
		  cutoutPercentage: 85, 
		  legend: {position:'bottom', padding:5, labels: {pointStyle:'circle', usePointStyle:true}}
		};

		// grade
		var chDonutData1 = {
		    labels: ['Unicorn', 'OK', 'Fair', 'NG', 'WO', 'Bolter'],
		    datasets: [
		      {
		        backgroundColor: gradeColors.slice(0,6),
		        borderWidth: 0,
		        data: [<?php echo $uni;?>, <?php echo $ok;?>, <?php echo $fair;?>, <?php echo $ng;?>, <?php echo $wo;?>, <?php echo $bolter;?>]
		      }
		    ]
		};

		var chDonut1 = document.getElementById("chDonut1");
		if (chDonut1) {
		  new Chart(chDonut1, {
		      type: 'pie',
		      data: chDonutData1,
		      options: donutOptions
		  });
		}


		// donut 2
		var chDonutData2 = {
		    labels: ['1 Wire', '2 Wire', '3 Wire', '4 Wire'],
		    datasets: [
		      {
		        backgroundColor: wireColors.slice(0,4),
		        borderWidth: 0,
		        data: [<?php echo $onewire;?>, <?php echo $twowire;?>, <?php echo $threewire;?>, <?php echo $fourwire;?>]
		      }
		    ]
		};
		var chDonut2 = document.getElementById("chDonut2");
		if (chDonut2) {
		  new Chart(chDonut2, {
		      type: 'pie',
		      data: chDonutData2,
		      options: donutOptions
		  });
		}


		
	</script>

	
	</body>
</html>