<?php


class Export {
    

    private $db;
    
    public function __construct() {
        $this->db = new Database;   
    }
     

     public function bestTrap() {
        $sql = "SELECT * FROM traps";
        $this->db->query($sql);
        $boardResults = $this->db->resultset();

        $ns = array();

       

        foreach($boardResults as $br) {
            
            // 6 Perfect
            // 5 No issues
            // 4 Lil
            // 3 Reg
            // 2 Lot
            // 1 Unsage


            $details = explode(' ', $br->details);

            $score = 0;
            

            if(isset($details[0])) {


               $score += strlen($details[0]);


                $d1 = $details[0];
            } else {
                $d1 = "";
                $score += 0;
            } 
            if(isset($details[1])) {
                $d2 = $details[1];

                $score += strlen($details[1]);
            } else {
                $d2 = "";
                $score += 0;
            }
            if(isset($details[2])) {
                $d3 = $details[2];
                $score += strlen($details[2]);
            } else {
                $d3 = "";
                $score += 0;
            }
            if(isset($details[3])) {
                $d4 = $details[3];
                $score += strlen($details[3]);
            } else {
                $d4 = "";
                $score += 0;
            }
            if(isset($details[4])) {

             
                $score += strlen($details[4]);
                $d5 = $details[4];
            } else {
                $d5 = "";
                $score += 0;
            }

            
            

            
        }
        
        
        
     }

}

?>