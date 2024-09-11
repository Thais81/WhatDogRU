<?php
require_once 'dataBase/DatabaseConn.php';

class Pack {
    private $pack_id;
    private $pack_name;

    public function setPackId($pack_id) {
        $this->pack_id = $pack_id;
    }

    public function getPackId() {
        return $this->pack_id;
    }

    public function setPackName($pack_name) {
        $this->pack_name = $pack_name;
    }

    public function getPackName() {
        return $this->pack_name;
    }

}
