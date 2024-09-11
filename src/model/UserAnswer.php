<?php
require_once 'dataBase/DatabaseConn.php';

class UserAnswer
{
    private $user_answer_id;
    private $user_id;
    private $answer_id;


    // Getters
    public function getUserAnswerId()
    {
        return $this->user_answer_id;
    }

    public function getUserId()
    {
        return $this->user_id;
    }
    public function getAnswerId()
    {
        return $this->answer_id;
    }

    // Setters
    public function setUserAnswerId($user_answer_id)
    {
        $this->user_answer_id = $user_answer_id;
    }
    public function setUserId($user_id)
    {
        $this->$user_id = $user_id;
    }
    public function setAnswerId($answer_id)
    {
        $this->answer_id = $answer_id;
    }
}
