<?php
class signUp extends db{




    protected function setUser($userId, $password, $email) {

        $stmt = $this->openPDO()->prepare('INSERT INTO users(users_uniqueId, users_password, users_email) VALUES (?, ?, ?)');
    
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
        if (!$stmt->execute(array($userId, $hashedPassword, $email))) {
            $stmt = null;
            header("location: ../index.php?error=stmtFailed");
            exit();
        }
    
        $stmt = null;
    }
    


    protected function checkUser($userId, $email){

        $stmt = $this->openPDO()->prepare('SELECT users_uniqueId FROM users WHERE users_uniqueId = ? or users_email = ?;');


        if (!$stmt->execute(array($userId, $email))){
            $stmt = null;
            header("location:.../index.php?error=stmtFailed");
            exit();
        }

        $resultCheck;
        if($stmt->rowCount() > 0 ){
            $resultCheck = false;
        }
        else{
            $resultCheck = true;
        }
        return $resultCheck;
    }

  
}