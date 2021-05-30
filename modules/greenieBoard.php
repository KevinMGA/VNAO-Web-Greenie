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

    public function getPilots() {

        $sql = "select * from pilots";
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
    /*
    public function trapCount($modex) {
        $sql = "SELECT * FROM traps where modex = :modex ORDER BY datetime";
        $this->db->bind(':modex', $modex);
        $result = $this->db->resultset();
        
        return count($result);
    }
    */

    public function getGrade($modex) {

        $sql = "select * FROM traps where pilot = :modex ORDER BY datetime";
        $this->db->bind(':modex', $modex);
        $result = $this->db->resultset();
        
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
                
                if($j->wire == "1") {
                    $currentGrade = "ng";
                }

                // CASE 3
                if($j->_case == "1") {
                    $case = 'hidden';
                }
                elseif($j->_case == "3") {
                    $case = 'visible';
                }

                // Final Displayed Grade
                if($j->wire == "1") {
                    $newGrade = "NG";
                } elseif($j->grade == "--") {
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

    
}

?>