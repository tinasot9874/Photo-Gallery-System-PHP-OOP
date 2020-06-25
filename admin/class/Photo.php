<?php


class Photo extends Db_object{

    protected static $db_table = "photos";
    protected static $db_table_fields = array('user_id', 'title', 'categories_id', 'filename', 'type', 'size', 'create_at');
    public $id;
    public $user_id;
    public $title;
    public $categories_id;
    public $filename;
    public $type;
    public $size;
    public $create_at;

    // file uploads
    public $tmp_path;
    public $upload_directory = "images" . DS . 'original';
    public $upload_directory_resize = "images" . DS . 'thumbnail';
    public $errors = array();
    public $upload_errors_array = array(

        UPLOAD_ERR_OK           => 'There is no error, the file uploaded with success',
        UPLOAD_ERR_INI_SIZE     => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
        UPLOAD_ERR_FORM_SIZE    => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
        UPLOAD_ERR_PARTIAL      => 'The uploaded file was only partially uploaded',
        UPLOAD_ERR_NO_FILE      => 'No file was uploaded',
        UPLOAD_ERR_NO_TMP_DIR   => 'Missing a temporary folder',
        UPLOAD_ERR_CANT_WRITE   => 'Failed to write file to disk.',
        UPLOAD_ERR_EXTENSION    => 'A PHP extension stopped the file upload.',
    );

    // this is passing $_FILES['uploaded_file'] as an argument

    public function set_file($file){

        // Allow certain file formats
        $file_ext= $file['type'];
        $extensions= array("image/jpeg","image/jpg","image/png");
        if(in_array($file_ext,$extensions) === false){
            $this->errors[] = "Sorry, only JPG, JPEG & PNG files are allowed.";
        }

        if (empty($file) || !$file || !is_array($file)){
            $this->errors[] = "There was no file uploaded !";
            return false;
        }elseif($file['error'] !=0 ){
            $this->errors[] = $this->upload_errors_array[$file['error']];
            return false;
        }else{
            // create a random file name for image
            $file_extension_arr = explode('.',basename($file['name']));
            $file_extension_string = strtolower($file_extension_arr[count($file_extension_arr)-1]);
            $file_name = substr(md5(basename($file['name'].time())), 5, 15).".".$file_extension_string;

            $this->filename = $file_name; // Name of the file
            $this->tmp_path = $file['tmp_name'];
            $this->type     = $file['type'];
            $this->size     = $file['size'];
            $this->create_at= date("Y-m-d");
        }
    }

    public function save(){
        if ($this->id){
            $this->update();
        }else{
            if (!empty($this->errors)){
                return false;
            }
            if (empty($this->filename) || empty($this->tmp_path)){
                $this->errors[] = "The file was not available!";
                return false;
            }


            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->filename;
            $target_path_original_string = strval($target_path);

            // resize target_dir folder
            $target_path_resize = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory_resize . DS . $this->filename;

            $target_path_filename_resize_string = strval($target_path_resize);

            if (file_exists($target_path)){
                $this->errors[] = "The file {$this->filename} already exists";
                return false;
            }

            if (move_uploaded_file($this->tmp_path, $target_path)){

                // move resize image to thumbnail dir
                $resize = new ResizeImage($target_path_original_string);
                $resize->resizeTo(500, 500);
                $resize->saveImage($target_path_filename_resize_string, 100);


                if ($this->create()){
                    unset($this->tmp_path);
                    return true;
                }
            }else{
                $this->errors[] = "The file directory does not have permission or can't find the folder!";
                return false;
            }
        }
    }

    public function picture_path(){
        return $this->upload_directory.DS.$this->filename;
    }
    public function picture_resize_path(){
        return $this->upload_directory_resize.DS.$this->filename;
    }
    public function delete(){
        if (parent::delete()){
            $target_path_original = SITE_ROOT.DS.'admin'.DS.$this->picture_path();
            $target_path_thumb    = SITE_ROOT.DS.'admin'.DS.$this->picture_resize_path();
            if (unlink($target_path_original) && unlink($target_path_thumb)){
                return true;
            }else{
                return false;
            }
        } else{
            return false;
        }
    }
    // Count photo upload by user id
    public static function count_photo_by_user_id($id){
        global $database;
        $sql = "SELECT COUNT(*) FROM " . static::$db_table . " WHERE user_id = $id ";
        $count = $database->query($sql);
        $row = mysqli_fetch_array($count);
        return array_shift($row);
    }
}