<?php
class Session{

    private $signed_in = false;
    public $user_id;
    public $username;
    public $message;


    function __construct()
    {
        ob_start();
        session_start();
        $this->check_the_login();
        $this->check_message();
    }

    public function is_signed_in(){
        return $this->signed_in;
    }

    public function login($user){
        if ($user){
            $this->user_id  = $_SESSION['user_id'] = $user->id;
            $this->username = $_SESSION['username'] = $user->username;
            $this->signed_in = true;
        }
    }

    public function logout(){
        unset($_SESSION['username']);
        unset($_SESSION['user_id']);
        unset($this->username);
        unset($this->user_id);
        $this->signed_in = false;
    }

    private function check_the_login(){
        if (isset($_SESSION['username'])){
            $this->user_id  = $_SESSION['user_id'];
            $this->username = $_SESSION['username'];
            $this->signed_in = true;
        } else{
            unset($this->username);
            $this->signed_in = false;
        }
    }

    public function message($msg=""){
        if (!empty($msg)){
            $_SESSION['message'] = $msg;
        }else{
            return $this->message;
        }
    }

    private function check_message(){
        if (isset($_SESSION['message'])){
            $this->message = $_SESSION['message'];
            unset($_SESSION['message']);
        }else{
            $this->message = "";
        }
    }

}
$session = new Session();

