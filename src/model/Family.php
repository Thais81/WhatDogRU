<?php
require_once 'dataBase/Database.php';

class family
{
    private $family_id;
    private $family_name;

    public function setFamilyId($family_id)
    {
        $this->family_id = $family_id;
    }

    public function getFamilyId()
    {
        return $this->family_id;
    }

    public function setFamilyName($family_name)
    {
        $this->family_name = $family_name;
    }

    public function getFamilyName()
    {
        return $this->family_name;
    }
}
