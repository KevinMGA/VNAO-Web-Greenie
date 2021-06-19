<?php

require_once('config/db.php');
require_once('lib/pdo_db.php');
require_once('modules/greenieBoard.php');

$Graph = new GreenieBoard();

$trap = $_GET['trap'];


$image = $Graph->getTrap($trap);


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

			

			<?php foreach($image as $i):?>

				<div class="text-center">
					<h1 class="title is-size-2 mt-3"><?php echo $i->pilot;?></h1>
				</div>

				<hr>

				<div class="container ">

					<div class="row" style="padding-left:15px;">
						<div class="col-md-6 text-justify">
						
							<p>Details: <span class="bold"><?php echo $i->details; ?></span></p>
							
						</div>
					</div>

					<div class="row" style="padding-left:15px;">
						<div class="col-md-4 text-justify">
							<p>Date: <span class="bold"><?php echo $i->serverDate; ?></span></p>
							<p>Airframe: <span class="bold"><?php echo $i->airframe; ?></span></p>
						</div>
						<div class="col-md-4 text-justify">
							<p>Time: <span class="bold"><?php echo $i->serverTime; ?></span></p>
							<p>Groove Time: <span class="bold"><?php echo $i->groove; ?> seconds</span></p>
						</div>
						<div class="col-md-4 text-justify">
							<p>Case: <span class="bold"><?php echo $i->_case; ?></span></p>

							<?php
								 if($i->wire == '99') {
								 	echo '<p>Wire: <span class="bold">4</span></p>';

								 } elseif($i->wire == '4') {
								 	echo '<p>Wire: <span class="bold">3</span></p>';

								 } elseif($i->wire == '3') {
								 	echo '<p>Wire: <span class="bold">2</span></p>';
								 	
								 } elseif($i->wire == '2') {
								 	echo '<p>Wire: <span class="bold">1</span></p>';
								 	
								 } elseif($i->wire == '1') {
								 	echo '<p>Wire: <span class="bold">1</span></p>';
								 } else {
								 	echo '<p>Wire: <span class="bold">No Wire</span></p>';
								 }
							?>						
						</div>
					</div>

					<div class="container text-center">
						<div class="flex">
							<div class="card">
								<div class="card-image">
									<figure id="result" style="display:block" class="image">
										<img style="display:block;width:100%;" src="data:image/png;base64,<?php echo $i->graph;?>">
									</figure>
								</div>
							</div>
						</div>
					</div>

				</div>
				

			



		<?php endforeach;?>
		</div>
		

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
	</body>
</html>


