<?php
class UserModel {

    public function __construct()
    {
        $this->db = new Database;
    }

    public function getUserByUsername($username)
    {
        $stmt = "SELECT * FROM users WHERE username = :username";
        $this->db->query($stmt);
        $this->db->bind('username', $username);
        $this->db->execute();
        return $this->db->single();
    }
}
