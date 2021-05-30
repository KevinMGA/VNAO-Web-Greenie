<?php
class Graph {
    
    private $db;
    
    public function __construct() {
        $this->db = new Database;   
    }
    
    public function getP() {

        $sql = "select * from pilots";
        $this->db->query($sql);
        $results = $this->db->resultset();
        echo $results;

    }

    
    
}

?>