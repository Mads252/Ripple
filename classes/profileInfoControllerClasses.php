<?php

class profileInfoController extends profileInfo {
    
    private $userId;
    private $useruniqueId;

    public function __construct($userId,$useruniqueId){

        $this-> userId = $userId;
        $this-> useruniqueId = $useruniqueId;

    }


    public function preSetProfileInfo(){
        $profiles_about = "Hejsaaaa" . $this->useruniqueId . "Velkommen";
        $profiles_describtion = "Hej" . $this->useruniqueId . "her kan du fortælle lidt mere om dig selv";

        $this->setProfileInfo($profiles_about, $profiles_describtion, $this->userId);
    }



    public function updateProfileInfo($about, $describtion){

        //fejl
        if($this->emptyInputChecker($about, $describtion) == true){

            header("location: profileSettings.php?error=empyInputFAIL");
            exit();
        }

        // updater profil informationen

        $this->setUpdateProfileInfo($about, $describtion, $this->userId);


    }


    private function emptyInputChecker($about, $describtion){

        $result;
        if(empty($about) || empty($describtion) ) {

            $result = true;
        
        }

        else{
            $result = false;

        }
        return $result;
    }
}