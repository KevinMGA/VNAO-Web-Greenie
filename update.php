<?php
require_once('config/db.php');
require_once('lib/pdo_db.php');
require_once('modules/greenieBoard.php');
$Greenie = new GreenieBoard();

/*
$clients = $clientData->getFeaturedClients();
$reviewData = new Reviews();
$reviews = $reviewData->getFeatReviews();
*/
$updateGreenie = $Greenie->updateBoard();



?>



<!--
<?php // foreach($clients as $c):?> 
<div class="col-md-6 featured-box">
    <img class="box" src="<?php // echo $c->thumb; ?>">
    <div class="text">
        <div class="text-inner">
            <h3><?php // echo $c->client_name;?></h3>
            <div class="text-bottom">
                <p><?php // echo $c->client_type;?></p>
                <a href="client.php?client=<?php // echo $c->client_id;?>" class="btn btn-view">View Work</a>
            </div>
        </div>
    </div>
</div>
<?php // endforeach;?>
-->