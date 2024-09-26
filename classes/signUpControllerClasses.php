<?php
class signUpController extends signUp {

    private $userId;
    private $password;
    private $passwordRepeat;
    private $email;


    public function __construct($userId, $password, $passwordRepeat, $email){

        $this -> userId = $userId;
        $this -> password = $password;
        $this -> passwordRepeat = $passwordRepeat;
        $this -> email = $email;

    }


    public function signUpUser() {
        
        if ($this->emptyInput() == false) {
            header("location: ../index.php?error=emptyInput"); 
            exit(); 
        }
    
        
        if ($this->passwordMatch() == false) {
            header("location: ../index.php?error=passwordMismatch"); 
            exit(); 
        }
    
        
        if ($this->userIdTakenChecker() == false) {
            header("location: ../index.php?error=emailTaken"); 
            exit(); 
        }
    
        
        $this->setUser($this->userId, $this->password, $this->email);
    }
    
   

    private function  emptyInput(){
        $result;
        if (empty($this->userId) || empty($this->password) || empty($this->passwordRepeat) || empty($this->email) ) {

            $result = false;

        }
        else{
            $result = true;
        }
        return $result;
    }

    private function passwordMatch(){
        $result;
        if($this->password !== $this->passwordRepeat)
        $result = false;



        else{
            $result = true;
        }
        return $result;
    }

    private function userIdTakenChecker(){
        $result;
        if(!$this->checkUser($this -> userId, $this -> email))
        $result = false;



        else{
            $result = true;
        }
        return $result;
    }

}