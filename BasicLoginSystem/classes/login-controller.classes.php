<?php

// Database handler
class LoginController extends Login{
    // Properties
    private $uid;
    private $pwd;

    // Constructor
    public function __construct($uid, $pwd) {
        $this ->uid = $uid;
        $this ->pwd = $pwd;
    }

    public function loginUser(){
        if($this->emptyInput() == false){
            // echo "Empty input!";
            header("location: ../index.php?error=emptyinput");
            exit();
        }
        
        $this->getUser($this->uid, $this->pwd);
    }

    // Method for handling empty inputs
    private function emptyInput(){
        $result;
        if(empty($this ->uid) || empty($this ->pwd)){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }
}