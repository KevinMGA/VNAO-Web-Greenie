<?php


class GreenieBoard {
    

    private $db;
    
    public function __construct() {
        $this->db = new Database;   
    }
    

    public function getTraps() {

        $sql = "select * from traps ORDER BY datetime";
        $this->db->query($sql);
        $results = $this->db->resultset();
        return $results;

    }

    public function getPilots($squad) {

        $sql = "select * from pilots where squad = '$squad'";
        $this->db->query($sql);
        $results = $this->db->resultset();
        return $results;

    }
    public function getSquads() {

        $sql = "select * from squads";
        $this->db->query($sql);
        $results = $this->db->resultset();
        return $results;

    }

    public function avg($modex) {

        $sql = "select * from traps where pilot = '$modex' ORDER BY datetime";
        $this->db->query($sql);
        $results = $this->db->resultset();
        $score = array();
        foreach($results as $r) {
            if($r->wire != "1") {
                $score[] = floatval($r->points);
            } 
        }
        $n = count($score);
        $sum = 0;
        for($i = 0; $i < $n; $i++) {
            $sum += $score[$i];
        }

        if(!empty($score)) {
            $ret = $sum / $n;
        } else {
            $ret = 0;
        }

        return number_format($ret, 2);
    }

    public function getGrade($callsign) {

        $up = new Updates();

        $sql = "select * FROM traps where pilot = :callsign ORDER BY datetime";
        $this->db->bind(':callsign', $callsign);
        $result = $this->db->resultset();
        
        $up->updateGrades($callsign);

        foreach($result as $j) {

            
                
            if($j->grade != "WOFD") {
                // Grade Colors
                if($j->grade == "(OK)") {
                    $currentGrade = "fair";
                }
                elseif($j->grade == "OK") {
                    $currentGrade = "ok";
                }
                elseif($j->grade == "WO") {
                    $currentGrade = "wo";
                }
                elseif($j->grade == "-- (BOLTER)") {
                    $currentGrade = "bolter";
                }
                elseif($j->grade == "--") {
                    $currentGrade = "ng";
                }
                elseif($j->grade == "CUT") {
                    $currentGrade = "cutpass";
                }
                if($j->wire == "1") {
                    $currentGrade = "ng";
                }

                // CASE 3
                if($j->_case == "1") {
                    $case = 'hidden';
                }
                elseif($j->_case == "2") {
                    $case = 'visible';
                }
                elseif($j->_case == "3") {
                    $case = 'visible';
                }

                // Final Displayed Grade
                if($j->grade == "--") {
                    $newGrade = "NG";
                } else {
                    $newGrade = $j->grade;
                }

                echo '<td class="tip grade '.$currentGrade.'"><a class="link" target="_blank" href="graph.php?graphview='.$j->id.'"><span class="tiptext">'.$j->details.'<br>'.$newGrade.'</span><span class="night '.$case.'">⬤</span></a></td>';
            }
        }
    }

    public function getGraph($id) {

        $sql = "select * from traps where id = $id";
        $this->db->query($sql);
        $results = $this->db->resultset();
        
        return $results;

    }


    public function pilotPage($id) {

        $sql = "select * from traps where modex = '$id'";
        $this->db->query($sql);
        $results = $this->db->resultset();
       

        foreach($results as $r) {
        	echo $r->details;
        	echo '<br>';
        	echo $r->grade;
        }

    }


    public function getSquad($tag) {
        $sql = "select * from squads where tag = '$tag'";
        $this->db->query($sql);
        $results = $this->db->resultset();

        if(empty($results)) {
            $empty = "Wrong tag given";
            echo $empty;
        } else {
            return $results;
        }
    }


    public function allPilots() {

        $sql = "select * from pilots";
        $this->db->query($sql);
        $results = $this->db->resultset();
        return $results;

    }

   public function lastFlight($a) {

        $sql = "select * from flight_log where callsign = '$a' ORDER BY dateStamp DESC";
        $this->db->query($sql);
        $results = $this->db->single();

        if(is_object($results)) {
            return date('M j, Y', strtotime($results->dateStamp));
        }
        

    }

    
}



class Updates {
    
    private $db;
    
    public function __construct() {
        $this->db = new Database;   
    }
    
    public function updateGrades($a) {
        $sql = "select * FROM traps where pilot = :callsign ORDER BY datetime";
        $this->db->query($sql);
        $this->db->bind(':callsign', $a);

        $result = $this->db->resultset();
        
        foreach ($result as $b) {
            $details_split = explode(" ", $b->details);
            if(isset($details_split[4])) {
                if(strpos($details_split[4], "LO") === 0) {
                    echo $b->id . ' LO is at the start of the RAMP - NO GRADE <br>';

                    $sql = "update traps set grade = '--', points = '2' where id = '$b->id'";
                    $this->db->query($sql);
                    $result = $this->db->execute();
                }
            }
            if($b->wire == '1') {
                echo $b->id . ": Wire is equal to 1<br>";
                $sql = "update traps set grade = '--', points = '2' where id = '$b->id'";
                $this->db->query($sql);
                $result = $this->db->execute();
            }
            if($b->grade == 'WOP') {
                echo $b->id . ": Grade is WOP<br>";
                $sql = "update traps set details = 'WOP' where id = '$b->id'";
                $this->db->query($sql);
                $result = $this->db->execute();
            }
        }
    }
}




?>