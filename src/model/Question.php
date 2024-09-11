<?php
require_once 'dataBase/DatabaseConn.php';

class Question {
    private $question_id;
    private $question_content;
    private $pack_id;

    // Getters
    public function getQuestionId() {
        return $this->question_id; 
    }

    public function getQuestionContent() {
        return $this->question_content;
    }

    public function getPackId() {
        return $this->pack_id;
    }

    // Setters
    public function setQuestionId($question_id) {
        $this->question_id = $question_id;
    }

    public function setPackId($pack_id) {
        $this->pack_id = $pack_id;
    }

    public function setQuestionContent($question_content) {
        $this->question_content = $question_content;
    }
    
}
