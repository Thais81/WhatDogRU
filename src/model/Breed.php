<?php
require_once 'dataBase\DatabaseConn.php';

class breed
{
    private $breed_id;
    private $breed_name;
    private $breed_rate;
    private $family_id;


    // Getters
    public function getBreedId()
    {
        return $this->breed_id;
    }

    public function getBreedName()
    {
        return $this->breed_name;
    }

    public function getBreedRate()
    {
        return $this->breed_rate;
    }
    public function getFamilyId()
    {
        return $this->family_id;
    }

    // Setters
    public function setBreedId($breed_id)
    {
        $this->breed_id = $breed_id;
    }

    public function setBreedName($breed_name)
    {
        $this->breed_name = $breed_name;
    }

    public function setBreedRate($breed_rate)
    {
        $this->breed_rate = $breed_rate;
    }
    public function setFamilyId($family_id)
    {
        $this->family_id = $family_id;
    }
}
