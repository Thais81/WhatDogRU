<?php
class Pair
{
    private $pair_id;
    private $answer_id;
    private $feature_id;

    //getters
    public function getPairId()
    {
        return $this->pair_id;
    }

    public function getAnswerId()
    {
        return $this->answer_id;
    }

    public function getFeatureId()
    {
        return $this->feature_id;
    }
    //setters
    public function setPairId($pair_id)
    {
        $this->pair_id = $pair_id;
    }
    public function setAnswerId($answer_id)
    {
        $this->answer_id = $answer_id;
    }
    public function setFeatureId($feature_id)
    {
        $this->feature_id = $feature_id;
    }
}
