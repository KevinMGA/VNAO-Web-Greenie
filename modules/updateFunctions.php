<?php


class Auto {
    

    private $db;
    
    public function __construct() {
        $this->db = new Database;   
    }
     

     // Remove WOFD

    public function RemoveWOFD() {
        $sql = "DELETE FROM traps WHERE grade = 'WOFD'";
        $this->db->query($sql);
        $result = $this->db->execute();
    }

    public function sameDay() {
        $sql = "SELECT a.id, b.board_ID FROM traps AS a LEFT JOIN board AS b ON a.pilot = b.pilot WHERE DATE(a.datetime) = DATE(b.appDate)";
        $this->db->query($sql);
        $results = $this->db->resultset(); 

        foreach($results as $a) {
            $sql = "UPDATE traps SET board_ID = '$a->board_ID' WHERE id = '$a->id'";
            $this->db->query($sql);
            $res = $this->db->execute();
        }
    }

    public function newDay() {

        
        $ranNum = rand(9999, 999999);

        $sql = "SELECT a.id, a.pilot, a.grade, a.points, a.wire, a.groove, a._case, a.datetime FROM traps AS a WHERE a.board_ID = '0' ORDER BY a.datetime ASC";
        $this->db->query($sql);
        $results = $this->db->single();
        
        if(!empty($results)) {
            $sql = "INSERT INTO board (pilot, grade, score, wire, groove, _case, appDate, board_ID) VALUES ('$results->pilot', '$results->grade', '$results->points', '$results->wire', '$results->groove', '$results->_case', '$results->datetime', '$ranNum')";
            $this->db->query($sql);
            $result = $this->db->execute();

        }

    }

    public function avgGrade() {
        $sql = "SELECT board_ID FROM board";
        $this->db->query($sql);
        $boardResults = $this->db->resultset();
        foreach($boardResults as $br) {
            $sql = "SELECT grade from traps WHERE board_ID = $br->board_ID";
            $this->db->query($sql);
            $results = $this->db->resultset();
            $grade = array();
            foreach($results as $r) {
                if($r->grade == "CUT") {
                    $grade[] = floatval(0);
                } elseif($r->grade == "WO") {
                    $grade[] = floatval(1);
                } elseif($r->grade == "NG") {
                    $grade[] = floatval(2);
                } elseif($r->grade == "--") {
                    $grade[] = floatval(2);
                } elseif($r->grade == "-- BOLTER") {
                    $grade[] = floatval(2.5);
                } elseif($r->grade == "(OK)") {
                    $grade[] = floatval(3);
                } elseif($r->grade == "OK") {
                    $grade[] = floatval(4);
                } elseif($r->grade == "_OK_") {
                    $grade[] = floatval(5);
                }
            }
            $n = count($grade);
            $sum = 0;
            for($i = 0; $i < $n; $i++) {
                $sum += $grade[$i];
            }
            if(!empty($grade)) {
                $ret = $sum / $n;
            } else {
                $ret = 0;
            }
            $re = round($ret);
            if($re == 0) {
                $final = "CUT";
            } elseif($re == 1) {
                $final = "WO";
            } elseif($re == 2) {
                $final = "NG";
            } elseif($re == 2.5) {
                $final = "BOLTER";
            } elseif($re == 3) {
                $final = "(OK)";
            } elseif($re == 4) {
                $final = "OK";
            } elseif($re == 5) {
                $final = "_OK_";
            } 
            echo 'COUNT: ' .$n. ' SCORE: ' .$re. ' GRADE: ' .$final. '<br>';
            $sql = "UPDATE board SET grade = '$final' WHERE board_ID = '$br->board_ID'";
            $this->db->query($sql);
            $end = $this->db->execute();
        }
    }

    public function avgScore() {
        $sql = "SELECT board_ID FROM board";
        $this->db->query($sql);
        $boardResults = $this->db->resultset();
        foreach($boardResults as $br) {
            $sql = "SELECT points from traps WHERE board_ID = $br->board_ID";
            $this->db->query($sql);
            $results = $this->db->resultset();
            $grade = array();
            foreach($results as $r) {
                $grade[] = floatval($r->points);
            }
            $n = count($grade);
            $sum = 0;
            for($i = 0; $i < $n; $i++) {
                $sum += $grade[$i];
            }
            if(!empty($grade)) {
                $ret = $sum / $n;
            } else {
                $ret = 0;
            }
            $final = $ret;
            echo 'SCORE - COUNT: ' .$n. ' POINTS: ' .$final. '<br>';
            $sql = "UPDATE board SET score = '$final' WHERE board_ID = '$br->board_ID'";
            $this->db->query($sql);
            $end = $this->db->execute();
        }
    }

    public function updateTime() {

        $sql = "SELECT callsign FROM pilots";
        $this->db->query($sql);
        $callsign = $this->db->resultset();
        

        foreach($callsign as $c) {

            $sql = "SELECT callsign, flightTime FROM flight_log WHERE callsign = '$c->callsign'";
            $this->db->query($sql);
            $results = $this->db->resultset();
            $total = 0;

            foreach($results as $r) {
                if(is_numeric(floatval($r->flightTime))) {
                    $total += floatval($r->flightTime);
                }
            }

            $sql = "UPDATE pilots SET flightTime = '$total' WHERE callsign = '$c->callsign'";
            $this->db->query($sql);
            $end = $this->db->execute();
        }
    }
}

?>