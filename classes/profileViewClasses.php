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
}