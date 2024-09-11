<?php
require_once 'dataBase\DatabaseConn.php';

class Service {
    private $service_id;
    private $service_content;
    private $service_price;
    private $pack_id;

    // Getters
    public function getServiceId() {
        return $this->service_id; 
    }

    public function getServiceContent() {
        return $this->service_content;
    }

    public function getServicePrice() {
        return $this->service_price;
    }

    public function getPackId() {
        return $this->pack_id;
    }

    // Setters
    public function setServiceId($service_id) {
        $this->service_id = $service_id;
    }

    public function setServiceContent($service_content) {
        $this->service_content = $service_content;
    }

    public function setPackId($pack_id) {
        $this->pack_id = $pack_id;
    }

    public function setServicePrice($service_price) {
        $this->service_price = $service_price;
    }
}
