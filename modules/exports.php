<?php


class Export {
    

    private $db;
    
    public function __construct() {
        $this->db = new Database;   
    }
     

     public function bestTrap() {
        $sql = "SELECT * FROM traps AS a LEFT JOIN board AS b WHERE A.pilot = B.pilot";
        $this->db->query($sql);
        $boardResults = $this->db->resultset();



        foreach($boardResults as $br) {
            
            $details = explode(' ', $br->details);

            $d1 = $details[0];

            echo $d1;

        }
     }

}

?>