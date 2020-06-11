<?php

class User{

    public $id;
    public $username;
    public $first_name;
    public $last_name;
    public $password;


    function __construct()
    {

    }

    /****** DATABASE Methods ********/
    public static function find_query($sql){
        global $database;
        $result = $database->query($sql);
        $the_object_array = array();

        while ($row = mysqli_fetch_array($result)){
            $the_object_array[] = self::instantiation($row);
        }
        return $the_object_array;

    }

    public static function find_all_users(){
       return self::find_query("SELECT * FROM users");
    }


    public static function find_id_users($id_user){
        $result =  self::find_query("SELECT * FROM users WHERE id = $id_user ");

//        if (!empty($result)){
//            $get_first_element = array_shift($the_record);
//            return $get_first_element;
//        }else{
//            return false;
//        }

        return !empty($result) ? array_shift($result) : false;
    }

    public function instantiation($the_record)
    {
        $the_object = new self();
        foreach($the_record as $the_attribute => $value ){
            if ($the_object->has_the_attribute($the_attribute)){
                $the_object->$the_attribute = $value;
            }
        }

//        $the_object->id = $the_record['id'];
//        $the_object->username = $the_record['username'];

        return $the_object;
    }
    // check $key exist in array
    private function has_the_attribute($the_attribute){
        $object_properties = get_object_vars($this);
        return array_key_exists($the_attribute, $object_properties);
    }


    /****** END DATABASE Methods ********/





    /****** USER Methods ********/
        // verify user method
        public static function verify_user($username, $password){

            global $database;

            $username = $database->escape_string($username);
            $password = $database->escape_string($password);

            $sql = "SELECT * FROM users WHERE username = '{$username}' AND password = '{$password}' ";

            $the_result_array = self::find_query($sql);
            return !empty($the_result_array) ? array_shift($the_result_array) : false;
        }

        // SAVE Method

        public function save(){
            return isset($this->id) ? $this->update() : $this->create();
        }



        // CREATE Method

        public function create(){

            global $database;

            $sql  = "INSERT INTO users(username, password, first_name, last_name)";
            $sql .= "VALUES ('";
            $sql .= $database->escape_string($this->username) . "', '";
            $sql .= $database->escape_string($this->password) . "', '";
            $sql .= $database->escape_string($this->first_name) . "', '";
            $sql .= $database->escape_string($this->last_name) . "')";


            if ($database->query($sql)){
                $this->id = $database->the_insert_id();
                return true;
            }else{
                return false;
            }
        }

        // UPDATE Method

        public function update(){
            global $database;

            $sql  = "UPDATE users SET ";
            $sql .= "password = '" . $database->escape_string($this->password) . "', ";
            $sql .= "first_name = '" . $database->escape_string($this->first_name) . "', ";
            $sql .= "last_name = '" . $database->escape_string($this->last_name) . "' ";
            $sql .= " WHERE id = " . $database->escape_string($this->id);

            $database->query($sql);
            return (mysqli_affected_rows($database->conn) == 1) ? true : false;

        }

        // DELETED Method

        public function delete(){
            global $database;
            $sql  = "DELETE FROM users ";
            $sql .= "WHERE id =".$database->escape_string($this->id)." LIMIT 1";

            $database->query($sql);

            return (mysqli_affected_rows($database->conn) == 1) ? true : false;

        }


}
