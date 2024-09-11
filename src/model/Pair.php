<?php
class Pair
{
    private $pair_id;
    private $answer_id;
    private $service_id;

    //getters
    public function getPairId()
    {
        return $this->pair_id;
    }

    public function getAnswerId()
    {
        return $this->answer_id;
    }

    public function getServiceId()
    {
        return $this->service_id;
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
    public function setServiceId($service_id)
    {
        $this->service_id = $service_id;
    }
}
