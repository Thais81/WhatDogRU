<?php
require_once 'dataBase\DatabaseConn.php';

class Answer
{
    private $answer_id;
    private $answer_content;
    private $pack_id;
    private $question_id;
    private $isLastAnswer;

    // Getters
    public function getAnswerId()
    {
        return $this->answer_id;
    }

    public function getAnswerContent()
    {
        return $this->answer_content;
    }

    public function getPackId()
    {
        return $this->pack_id;
    }

    public function getQuestionId()
    {
        return $this->question_id;
    }

    public function getIsLastAnswer()
    {
        return $this->isLastAnswer;
    }

    // Setters
    public function setAnswerId($answer_id)
    {
        $this->answer_id = $answer_id;
    }

    public function setAnswerContent($answer_content)
    {
        $this->answer_content = $answer_content;
    }

    public function setPackId($pack_id)
    {
        $this->pack_id = $pack_id;
    }

    public function setQuestionId($question_id)
    {
        $this->question_id = $question_id;
    }

    public function setIsLastAnswer($isLastAnswer)
    {
        $this->isLastAnswer = $isLastAnswer;
    }
}
