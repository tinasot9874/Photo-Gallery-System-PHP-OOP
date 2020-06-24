<?php

class User extends Db_object {
    protected static $db_table = "users";
    protected static $db_table_fields = array('user_image', 'username', 'password', 'first_name', 'last_name', 'email' , 'status', 'role');
    public $id;
    public $user_image;
    public $username;
    public $first_name;
    public $last_name;
    public $email;
    public $status;
    public $role;


    public $upload_directory = "images".DS."user";

    function __construct()
    {

    }

    /****** USER Methods ********/

    // verify user method
    public static function verify_user($username, $password){

            global $database;

            $username = $database->escape_string($username);
            $password = $database->escape_string($password);

            $sql = "SELECT * FROM ".self::$db_table." WHERE username = '{$username}' AND password = '{$password}' ";

            $the_result_array = self::find_by_query($sql);
            return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }
    public function default_avatar(){
        return $this->upload_directory.DS.'default-avatar.png';
    }


}
