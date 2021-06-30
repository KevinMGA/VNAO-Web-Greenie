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

        $sql = "select * from pilots where squad = '$squad' ORDER BY modex ASC";
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
        $currentMonth = date('m');
        $sql = "select * from board where pilot = '$modex' AND MONTH(appDate) = '$currentMonth'";
        $this->db->query($sql);
        $results = $this->db->resultset();
        $score = array();
        foreach($results as $r) {
            if($r->wire != "1") {
                $score[] = floatval($r->score);
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

    public function pullGrade($a) {
        $currentMonth = date('m');
        $sql = "SELECT * FROM board WHERE pilot = '$a' AND MONTH(appDate) = '$currentMonth' ORDER BY appDate";
        $this->db->query($sql);
        $results = $this->db->resultset();

        foreach($results as $r) {
            if($r->grade == "(OK)") {
                $currentGrades = "fair";
            }
            elseif($r->grade == "OK") {
                $currentGrades = "ok";
            }
            elseif($r->grade == "WO") {
                $currentGrades = "wo";
            }
            elseif($r->grade == "OWO") {
                $currentGrades = "wo";
            }
            elseif($r->grade == "WOP") {
                $currentGrades = "wo";
            }
            elseif($r->grade == "-- (BOLTER)") {
                $currentGrades = "bolter";
            }
            elseif($r->grade == "NG") {
                $currentGrades = "ng";
            }
            elseif($r->grade == "CUT") {
                $currentGrades = "cutpass";
            }
        
            
            // CASE 3
            if($r->_case == "1") {
                $case = 'hidden';
            }
            elseif($r->_case == "2") {
                $case = 'visible';
            }
            elseif($r->_case == "3") {
                $case = 'visible';
            }


            $sql = "select * FROM traps where board_ID = '$r->board_ID' ORDER BY datetime";
            $this->db->query($sql);
            $end = $this->db->resultset();

            $grades = "";

            foreach($end as $e) {
                if($e->grade == "(OK)") {
                    $currentGrade = "fair";
                }
                elseif($e->grade == "OK") {
                    $currentGrade = "ok";
                }
                elseif($e->grade == "WO") {
                    $currentGrade = "wo";
                }
                elseif($e->grade == "OWO") {
                    $currentGrade = "wo";
                }
                elseif($e->grade == "WOP") {
                    $currentGrade = "wo";
                }
                elseif($e->grade == "-- (BOLTER)") {
                    $currentGrade = "bolter";
                }
                elseif($e->grade == "--") {
                    $currentGrade = "ng";
                }
                elseif($e->grade == "CUT") {
                    $currentGrade = "cutpass";
                }
                $grades .= '<span class="gradeBox '.$currentGrade.'">&nbsp;&nbsp;&nbsp;</span>';
            }

            echo '<td class="tip grade '.$currentGrades.'"><a class="link text-center" target="_blank" href="graph.php?graphview='.$r->id.'"><span class="tiptext">'.$grades.'</span><span class="night '.$case.'">⬤</span></a></td>';
        }
          
    }

    public function dateTest($a) {
        $sql = "SELECT *, MONTH(appDate) as currentMonth FROM board WHERE pilot = '$a' ORDER BY appDate";

        
        $this->db->query($sql);
        $results = $this->db->resultset();

        var_dump($results);

    }


    public function getGraph($id) {

        $sql = "SELECT board_ID FROM board where id = '$id'";
        $this->db->query($sql);
        $results = $this->db->single();
        
        foreach($results as $r) {
            $sql = "SELECT * FROM traps WHERE board_ID = '$r'";
            $this->db->query($sql);
            $results = $this->db->resultset();
            return $results;
        }

    }


    public function getTrap($id) {

        $sql = "select * from traps where id = '$id'";
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

        $sql = "SELECT * FROM pilots WHERE callsign != ' ' ORDER BY squad ASC";
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



/*

$uni = $Graph->getUni($pilot);
$Ok = $Graph->getOk($pilot);
$Fair = $Graph->getFair($pilot);
$NG = $Graph->getNG($pilot);
$WO = $Graph->getWO($pilot);
$Bolter = $Graph->getBolter($pilot);

*/
    public function getProfile($c) {
        $sql = "SELECT * FROM pilots WHERE callsign = '$c'";
        $this->db->query($sql);
        $results = $this->db->resultset();
        return $results;
    }



    public function countGrade($c) {
        $sql = "SELECT grade, wire FROM traps WHERE pilot = '$c'";
        $this->db->query($sql);
        $results = $this->db->resultset();
        return $results;
    }
   


    public function totalTraps($c) {
        $currentMonth = date('m');
        $sql = "SELECT id FROM traps WHERE pilot = '$c' AND MONTH(datetime) = '$currentMonth'";
        $this->db->query($sql);
        $results = $this->db->resultset();
        return count($results);
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


    public function listGrades($a) {
        $sql = "select * FROM traps where board_ID = '$a' ORDER BY datetime";
        $this->db->query($sql);
        $end = $this->db->resultset();

        $grades = array();

        foreach($end as $e) {
            if($e->grade == "(OK)") {
                $currentGrade = "fair";
            }
            elseif($e->grade == "OK") {
                $currentGrade = "ok";
            }
            elseif($e->grade == "WO") {
                $currentGrade = "wo";
            }
            elseif($e->grade == "-- (BOLTER)") {
                $currentGrade = "bolter";
            }
            elseif($e->grade == "--") {
                $currentGrade = "ng";
            }
            elseif($e->grade == "CUT") {
                $currentGrade = "cutpass";
            }
            $grades[] = '<span class="gradeBox '.$currentGrade.'">&nbsp;</span>';
        }

        foreach($grades as $g) {
            echo $g;
        }

    }
}




?>