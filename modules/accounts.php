<?php
class Account {
    private $db;
    
    public function __construct() {
        $this->db = new Database;
    }
    
    public function login($email, $password) {
        $this->db->query('SELECT * FROM users WHERE email = :email AND password = :password');
        $this->db->bind(':email', $email);
        $this->db->bind(':password', $password);
        $results = $this->db->single();
        return $results;
    }
    
    public function Register($name, $email, $pass, $type) {
        $hash = md5(rand(1, 1000));
        $this->db->query('INSERT INTO users (name, email, password, type, hash) VALUES (:name, :email, :password, :type, :hash)');
        $this->db->bind(':type', $type);
        $this->db->bind(':name', $name);
        $this->db->bind(':email', $email);
        $this->db->bind(':password', $pass);
        $this->db->bind(':hash', $hash);
         if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    public function getHash($email) {
        $this->db->query('SELECT hash FROM users WHERE email = :email');
        $this->db->bind(':email', $email);
        $results = $this->db->single();
        return $results;
    }
    
    public function Verify($hash) {
        $this->db->query('SELECT name, email, hash FROM users WHERE hash = :hash');
        $this->db->bind(':hash', $hash);
        $results = $this->db->single();
        return $results;
    }
    
    public function VerifyTwo($email) {
        $this->db->query('UPDATE users SET verified = :one, enabled = :en WHERE email = :email');
        $this->db->bind(':one', '1');
        $this->db->bind(':en', '1');
        $this->db->bind(':email', $email);
        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    
    
    public function getAccounts() {
        $this->db->query('SELECT * FROM accounts');
        $results = $this->db->resultset(); 
        return $results;
    }
    
    public function getAccount($id) {
        $this->db->query('SELECT * FROM accounts WHERE id = :id');
        $this->db->bind(':id', $id);
        $results = $this->db->single();
        return $results;
    }
    
    public function AddRestaurant($name, $city, $state, $zip, $image, $sponsorLvl, $userID) {
        
        $this->db->query('INSERT INTO restaurants (name, image, sponsor_level, user_id) VALUES (:name, :image, :sponsorLVL. :userID)');
        $this->db->bind(':name', $name);
        $this->db->bind(':image', $image);
        $this->db->bind(':sponsorLVL', $sponsorLvl);
        $this->db->bind(':userID', $userID);
         if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}