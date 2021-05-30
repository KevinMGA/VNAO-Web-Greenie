<?php
class Reviews {
    
    private $db;
    
    public function __construct() {
        $this->db = new Database;   
    }
    
     public function getFeatReviews() {
        $sql = "select * from reviews where featured = 1 limit 6";
        $this->db->query($sql);
        $results = $this->db->resultset();
        return $results;
    }
    

}

?>