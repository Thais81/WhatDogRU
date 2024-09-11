<?php
require_once 'dataBase\DatabaseConn.php';

class feature
{
    private $feature_id;
    private $feature_content;
    private $feature_rate;
    private $family_id;

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

    public function getFamilyId()
    {
        return $this->family_id;
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

    public function setFamilyId($family_id)
    {
        $this->family_id = $family_id;
    }

    public function setFeatureRate($feature_rate)
    {
        $this->feature_rate = $feature_rate;
    }
}
