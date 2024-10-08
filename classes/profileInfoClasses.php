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
            header("location: createProfile.php?error=profilenFindesIkke");
            exit();

        }

        $profileData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $profileData;
    }

    protected function setUpdateProfileInfo($profiles_about, $profiles_describtion, $profile_image, $userId){

        $stmt = $this->openPDO()->prepare(' UPDATE profiles SET profiles_about = ?, profiles_describtion = ?, profile_image = ? WHERE users_id = ?;');
        
        
        if(!$stmt->execute(array($profiles_about, $profiles_describtion, $profile_image, $userId))){

            $stmt = null;
            header("location: profile.php?error=stmtFAIL");
            exit();
        }
        $stmt = null;
       
    }


    protected function setProfileInfo($profiles_about, $profiles_describtion, $profile_image, $userId){

        $stmt = $this->openPDO()->prepare('INSERT INTO profiles (profiles_about, profiles_describtion, profile_image, users_id) VALUES (?,?,?,?);');
        
        
        if(!$stmt->execute(array($profiles_about, $profiles_describtion, $profile_image, $userId))){

            $stmt = null;
            header("location: profile.php?error=stmtFAIL");
            exit();
        }
        $stmt = null;
       
    }



}