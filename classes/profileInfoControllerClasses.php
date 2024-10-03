<?php

class profileInfoController extends profileInfo {
    
    private $userId;
    private $useruniqueId;
    private $profile_image;

    public function __construct($userId,$useruniqueId){

        $this-> userId = $userId;
        $this-> useruniqueId = $useruniqueId;

    }


    public function preSetProfileInfo(){
        $profiles_about = "Hejsaaaa" ." ". $this->useruniqueId ." ". "Velkommen";
        $profiles_describtion = "Hej" ." ". $this->useruniqueId ." ". "her kan du fortælle lidt mere om dig selv";
        $profile_image = "";

        $this->setProfileInfo($profiles_about, $profiles_describtion, $profile_image, $this->userId);
    }



    public function updateProfileInfo($about, $describtion, $profile_image){

        //fejl
        if($this->emptyInputChecker($about, $describtion, $profile_image) == true){

            header("location: profileSettings.php?error=empyInputFAIL");
            exit();
        }

        // updater profil informationen

        $this->setUpdateProfileInfo($about, $describtion, $profile_image, $this->userId);


    }


    private function emptyInputChecker($about, $describtion, $profile_image){

        $result;
        if(empty($about) || empty($describtion) || empty($profile_image)) {

            $result = true;
        
        }

        else{
            $result = false;

        }
        return $result;
    }
}