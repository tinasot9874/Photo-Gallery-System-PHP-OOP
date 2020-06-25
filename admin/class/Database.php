<?php
class Database{

    public $conn;

    function __construct()
    {
        // Create connection
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS,DB_NAME);
        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " .$this->conn->connect_error);
        }
    }

    public function query($sql){
        $result = $this->conn->query($sql);
        $this->confirm_query($result);
        return $result;
    }

    private function confirm_query($result){
        if (!$result){
            die("Something wrong with query string! </br>" . $this->conn->error);
        }
    }

    public function escape_string($string){
       $escape_string = $this->conn->real_escape_string($string);
       return $escape_string;
    }

    public function the_insert_id(){
        return $this->conn->insert_id;
    }



}

$database = new Database();