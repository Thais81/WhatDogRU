<?php
require_once 'dataBase\DatabaseConn.php';

class feature
{
    private $feature_id;
    private $feature_content;
    private $feature_rate;
    private $pack_id;

    // Getters
    public function getFeatureId()
    {
        return $this->feature_id;
    }

    public function getFeatureContent()
    {
        return $this->feature_content;
    }

    public function getFeatureRate()
    {
        return $this->feature_rate;
    }

    public function getPackId()
    {
        return $this->pack_id;
    }

    // Setters
    public function setFeatureId($feature_id)
    {
        $this->feature_id = $feature_id;
    }

    public function setFeatureContent($feature_content)
    {
        $this->feature_content = $feature_content;
    }

    public function setPackId($pack_id)
    {
        $this->pack_id = $pack_id;
    }

    public function setFeatureRate($feature_rate)
    {
        $this->feature_rate = $feature_rate;
    }
}
