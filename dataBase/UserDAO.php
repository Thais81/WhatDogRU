<?php
require_once 'src/model/User.php';
require_once 'dataBase/DatabaseConn.php';
require_once 'dataBase/DAO.php';

class UserDAO extends DAO
{
    public function __construct()
    {
        parent::__construct('user', 'user_id');
    }

    public function createUser($is_admin)
    {
        $data = ['is_admin' => $is_admin];
        // Store the returned user ID from the create method
        $userId = $this->create($data);
        return $this->getUserById($userId);
    }

    public function createObjectFromRow($row)
    {
        $result = new User();
        $result->setUserId($row['user_id']);
        $result->setIsConnected($row['is_admin']);
        return $result;
    }

    public function getAllUsers()
    {
        return $this->getAll();
    }

    public function getUserById($user_id)
    {
        return $this->getById($user_id);
    }

    public function updateUser($user_id, $is_admin)
    {
        // Update user data by removing the ':' prefix in the array keys
        $data = ['is_admin' => $is_admin];
        $this->update($user_id, $data);
    }

    public function deleteUser($user_id)
    {
        $this->delete($user_id);
    }
}
