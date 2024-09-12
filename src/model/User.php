<?php
require_once 'dataBase\Database.php';

class User
{
    private $user_id;
    private $is_connected = false;

    // Getters
    public function getUserId()
    {
        return $this->user_id;
    }

    public function getIsConnected()
    {
        return $this->is_connected;
    }
    // Setters
    public function setUserId($user_id)
    {
        $this->user_id = $user_id;
    }
    public function setIsConnected($is_connected)
    {
        $this->is_connected = $is_connected;
    }
}
