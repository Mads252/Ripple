<?php

class profileInfo extends db {

    protected function getProfileInfo($userId){

        $stmt = $this->openPDO()->prepare('SELECT * FROM profiles WHERE users_id = ?;');
        if(!$stmt->execute(array($userId))){

            $stmt = null;
            header("location: profile.php?error=stmtFAIL");
            exit();
        }
        if( $stmt->rowCount()==0){

            $stmt = null;
            header("location: profile.php?error=prilenFindesIkke");
            exit();

        }

        $profileData = $stmt->fetchALL(PDO :: FECTH_ASSOC);
        return $profileData;
    }

    protected function setUpdateProfileInfo($profiles_about, $profiles_describtion, $userId){

        $stmt = $this->openPDO()->prepare(' UPDATE profiles SET profiles_about = ?, profiles_describtion = ? WHERE users_id = ?;');
        
        
        if(!$stmt->execute(array($profiles_about, $profiles_describtion, $userId))){

            $stmt = null;
            header("location: profile.php?error=stmtFAIL");
            exit();
        }
        $stmt = null;
       
    }


    protected function setProfileInfo($profiles_about, $profiles_describtion, $userId){

        $stmt = $this->openPDO()->prepare('INSERT INTO profiles (profiles_about, profiles_describtion, users_id) VALUES (?,?,?);');
        
        
        if(!$stmt->execute(array($profiles_about, $profiles_describtion, $userId))){

            $stmt = null;
            header("location: profile.php?error=stmtFAIL");
            exit();
        }
        $stmt = null;
       
    }



}