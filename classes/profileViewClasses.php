<?php

class profileView extends profileInfo {

    private $db;

    public function __construct($db) {
        $this->db = $db;
    }
    
    public function fetchAbout($userId){
        $profileInfo = $this->getProfileInfo($userId);
        echo $profileInfo[0]["profiles_about"];
    }
    public function fetchDescribtion($userId){
        $profileInfo = $this->getProfileInfo($userId);
        echo $profileInfo[0]["profiles_describtion"];
    }

    public function fetchImage($userId){
        $profileInfo = $this->getProfileInfo($userId);
        $imageData = $profileInfo[0]["profile_image"];

        if($imageData){
            $base64Image = base64_encode($imageData);
            $mime_type = "image/png"; 
            return "data:$mime_type;base64,$base64Image";
        } else {
            return null;
        }
    }
}