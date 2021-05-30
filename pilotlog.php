<?php
require_once('config/db.php');
require_once('lib/pdo_db.php');
require_once('modules/greenieBoard.php');

$Graph = new GreenieBoard();

$image = $Graph->getGraph($_GET['graphview']);


?>



