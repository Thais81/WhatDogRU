<?php
require_once 'dataBase/DatabaseConn.php';

class ConductTo {
    private $conduct_to_id;
    private $offer_id;
    private $answer_id;

    // Getters

    public function getConductToId(){
        return $this->conduct_to_id;
    }
    public function getOfferId() {
        return $this->offer_id;
    }

    public function getAnswerId() {
        return $this->answer_id;
    }

    // Setters

    public function setConductToId($conduct_to_id) {
        $this->conduct_to_id = $conduct_to_id;
    }
    public function setOfferId($offer_id) {
        $this->offer_id = $offer_id;
    }

    public function setAnswerId($answer_id) {
        $this->answer_id = $answer_id;
    }
    
}
