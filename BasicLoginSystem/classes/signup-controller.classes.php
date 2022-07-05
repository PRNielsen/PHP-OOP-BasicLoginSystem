<?php

// Database handler
class SignupController extends Signup{
    // Properties
    private $uid;
    private $pwd;
    private $pwdrepeat;
    private $email;

    // Constructor
    public function __construct($uid, $pwd, $pwdrepeat, $email) {
        $this ->uid = $uid;
        $this ->pwd = $pwd;
        $this ->pwdrepeat = $pwdrepeat;
        $this ->email = $email;
    }

    public function signUpUser(){
        if($this->emptyInput() == false){
            // echo "Empty input!";
            header("location: ../index.php?error=emptyinput");
            exit();
        }
        if($this->invalidUid() == false){
            // echo "Invalid username!";
            header("location: ../index.php?error=username");
            exit();
        }
        if($this->invalidEmail() == false){
            // echo "Invalid email!";
            header("location: ../index.php?error=email");
            exit();
        }
        if($this->pwdMatch() == false){
            // echo "Passwords don't match!";
            header("location: ../index.php?error=passwordmatch");
            exit();
        }
        if($this->uidTakenCheck() == false){
            // echo "Username or email taken!";
            header("location: ../index.php?error=useroremailtaken");
            exit();
        }

        $this->setUser($this->uid, $this->pwd, $this->email);
    }

    // Method for handling empty inputs
    private function emptyInput(){
        $result;
        if(empty($this ->uid) || empty($this ->pwd) || empty($this ->pwdrepeat) || empty($this ->email)){
            $result = false;
        }
        else{
            $result = true;
        }
        return $result;
    }

    // Method for handling if certain characters exist in the username
    private function invalidUid(){
        $result;
        // If uid contains a character that is not contained in the preg_match, then set $result to false
        if(!preg_match("/^[a-zA-Z0-9]*$/", $this->uid)){
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    // Method for validating email addresses using built in PHP method
    private function invalidEmail(){
        $result;
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    // Method for validating that the pwd and pwdrepeat are the same
    private function pwdMatch(){
        $result;
        if($this->pwd !== $this->pwdrepeat){
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    // Method for validating that the uuid is not already taken
    private function uidTakenCheck(){
        $result;
        if(!$this->checkUser($this->uid, $this->email)){
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}
