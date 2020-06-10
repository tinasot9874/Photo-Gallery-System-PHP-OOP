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




}
