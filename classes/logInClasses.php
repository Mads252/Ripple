<?php
class logIn extends db{




    protected function getUser($userId, $password) {

        $stmt = $this->openPDO()->prepare('SELECT users_password FROM users WHERE users_uniqueId = ? OR users_email = ?;');
    
        
    
        if (!$stmt->execute(array($userId, $password))) {
            $stmt = null;
            header("location: ../index.php?error=stmtFailed");
            exit();
        }

        if($stmt->rowCount() == 0){
            $stmt = null;
            header("location: ../index.php?error=nah,brugerenFindesSguIkke");
            exit();
        }

        $hashedPassword = $stmt->fetchALL(PDO::FETCH_ASSOC);
        $checkPassword = password_verify($password, $hashedPassword[0]["users_password"]);
    
        

        if($checkPassword == false){
            $stmt = null;
            header("location: ../index.php?error=prøvIgenMedAdgangskoden");
            exit();
        } 
        elseif($checkPassword == true){

        $stmt = $this->openPDO()->prepare('SELECT * FROM users WHERE users_uniqueId = ? OR users_email = ?;');
            
        if (!$stmt->execute(array($userId, $password))) {
            $stmt = null;
            header("location: ../index.php?error=stmtFailed");
            exit();
        }
        if($stmt->rowCount() == 0){
            $stmt = null;
            header("location: ../index.php?error=nah,brugerenFindesSguIkke");
            exit();
        }

        $user = $stmt->fetchALL(PDO::FETCH_ASSOC);

        session_start();
        $_SESSION["userId"] =    $user[0]["users_id"];
        $_SESSION["useruniqueId"] =    $user[0]["users_uniqueId"];
        $_SESSION["userEmail"] =    $user[0]["users_email"];
       
       
       
      
        $stmt = null;
        }

        $stmt = null;
    }
    

   
    
    

  
}