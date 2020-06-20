<?php


class Db_object
{

    public static function find_by_query($sql){
        global $database;
        $result = $database->query($sql);
        $the_object_array = array();

        while ($row = mysqli_fetch_array($result)){
            $the_object_array[] = static::instantiation($row);
        }
        return $the_object_array;

    }

    public static function find_all(){
        return static::find_by_query("SELECT * FROM ".static::$db_table." ");
    }

    public static function find_all_except_by($id){
        return static::find_by_query("SELECT * FROM ".static::$db_table." WHERE id NOT IN ($id) ");
    }

    public static function find_by_id($id){
        $result =  static::find_by_query("SELECT * FROM ".static::$db_table." WHERE id = $id ");

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
        $calling_class = get_called_class();
        $the_object = new $calling_class;
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

    //function creates an array with the key is the value of array $db_table_fields and the value is the value of the object is assigned
    protected function properties(){
        $properties = array();
        foreach (static::$db_table_fields as $db_field){
            if (property_exists($this, $db_field)){
                $properties[$db_field] = $this->$db_field;
                // $properties[$db_field] : get the value of array $db_table_fields to assign to the key of array $properties
                // $this->$db_field : The value of the object is assigned
            }
        }
        return $properties;  // return a array
    }

    // function to escape string from function properties()
    protected function escape_string_properties(){
        global $database;

        $escape_string_properties = array();

        foreach ($this->properties() as $key => $value){
            $escape_string_properties[$key] = $database->escape_string($value);
        }
        return $escape_string_properties;
    }

    // SAVE Method
    public function save(){
        return isset($this->id) ? $this->update() : $this->create();
    }

    // CREATE Method
    public function create(){

        global $database;

        $properties = $this->escape_string_properties();

        $sql  = "INSERT INTO ".static::$db_table." (". implode(",",array_keys($properties)) .")";
        $sql .= "VALUES ('". implode("','",array_values($properties)) ."')";


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
        $properties = $this->escape_string_properties();

        $properties_pairs = array();
        foreach ($properties as $key => $value){
            $properties_pairs[] = "{$key}='{$value}'";
            // $properties_pairs[] = array (
            //                              [..] => $key='$value' of $properties
            //                               [0] => username='value'
            //                               [1] => password='value'
            //
            //                             )
        }

        $sql  = "UPDATE ".static::$db_table." SET ";
        $sql .= implode(", ",$properties_pairs); // = column1='value', column2='value2',...
        $sql .= " WHERE id = " . $database->escape_string($this->id);

        $database->query($sql);
        return (mysqli_affected_rows($database->conn) == 1) ? true : false;

    }

    // DELETED Method
    public function delete(){
        global $database;
        $sql  = "DELETE FROM ".static::$db_table." ";
        $sql .= "WHERE id =".$database->escape_string($this->id)." LIMIT 1";

        $database->query($sql);

        return (mysqli_affected_rows($database->conn) == 1) ? true : false;

    }

    // COUNT Method

    public static function count_all(){
        global $database;
        $sql = "SELECT COUNT(*) FROM " . static::$db_table . " ";
        $result = $database->query($sql);
        $row = mysqli_fetch_array($result);
        return array_shift($row);
    }

}