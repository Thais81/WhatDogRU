<?php
require_once 'dataBase/DatabaseConn.php';

class ConductTo
{
    private $conduct_to_id;
    private $breed_id;
    private $answer_id;

    // Getters

    public function getConductToId()
    {
        return $this->conduct_to_id;
    }
    public function getBreedId()
    {
        return $this->breed_id;
    }

    public function getAnswerId()
    {
        return $this->answer_id;
    }

    // Setters

    public function setConductToId($conduct_to_id)
    {
        $this->conduct_to_id = $conduct_to_id;
    }
    public function setBreedId($breed_id)
    {
        $this->breed_id = $breed_id;
    }

    public function setAnswerId($answer_id)
    {
        $this->answer_id = $answer_id;
    }
}
