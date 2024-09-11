<?php
class Ask
{
    private $ask_id;
    private $question_id;
    private $answer_id;


    // Getters
    public function getAskId()
    {
        return $this->ask_id;
    }

    public function getQuestionId()
    {
        return $this->question_id;
    }

    public function getAnswerId()
    {
        return $this->answer_id;
    }

    // Setters
    public function setQuestionId($question_id)
    {
        $this->question_id = $question_id;
    }

    public function setAnswerId($answer_id)
    {
        $this->answer_id = $answer_id;
    }
}
