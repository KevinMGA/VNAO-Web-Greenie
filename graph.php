<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('config/db.php');
require_once('lib/pdo_db.php');
require_once('modules/greenieBoard.php');

$Graph = new GreenieBoard();

$board = $_GET['graphview'];


$image = $Graph->getGraph($board);


?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

		<title>VNAO Graph View</title>

		<style>
			p {
				font-size: 18px;
			}
			.bold {
				font-weight: bold;
			}
		</style>
	</head>
	<body>

		<div class="container is-centered card mt-3">

			<div class="row">

				<h2 class="text-center mt-3 mb-3">Approach Charts</h2>
				<p class="text-center">Click on a chart below, to view it's associated information</p>
				<?php foreach($image as $i):?>

					
					<div class="col-sm-4">
			            <div class="col-sm-12 mt-3">
			            	<a target="_blank" href="trapview.php?trap=<?php echo $i->id;?>">
			            		<img style="display:block;width:100%;" src="data:image/png;base64,<?php echo $i->graph;?>">
			            	</a>
			            </div>
			        </div>
					


				<?php endforeach;?>

			</div>

		</div>
		

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
	</body>
</html>


