<?php
require_once 'dataBase/Database.php';

class Question
{
    private $question_id;
    private $question_content;
    private $family_id;

    // Getters
    public function getQuestionId()
    {
        return $this->question_id;
    }

    public function getQuestionContent()
    {
        return $this->question_content;
    }

    public function getFamilyId()
    {
        return $this->family_id;
    }

    // Setters
    public function setQuestionId($question_id)
    {
        $this->question_id = $question_id;
    }

    public function setFamilyId($family_id)
    {
        $this->family_id = $family_id;
    }

    public function setQuestionContent($question_content)
    {
        $this->question_content = $question_content;
    }
}
