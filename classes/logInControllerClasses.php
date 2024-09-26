<?php
class logInController extends logIn {

    private $userId;
    private $password;
    


    public function __construct($userId, $password){

        $this -> userId = $userId;
        $this -> password = $password;
        

    }


    public function logInUser() {
        
        if ($this->emptyInput() == false) {
            header("location: ../index.php?error=emptyInput"); 
            exit(); 
        }
    
        
        $this->getUser($this->userId, $this->password);
    }
    
   

    private function  emptyInput(){
        $result;
        if (empty($this->userId) || empty($this->password)) {

            $result = false;

        }
        else{
            $result = true;
        }
        return $result;
    }

    


}