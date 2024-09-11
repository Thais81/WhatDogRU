<?php
require_once 'src/model/UserAnswer.php';
require_once 'dataBase/DatabaseConn.php';
require_once 'dataBase/DAO.php';

class UserAnswerDAO extends DAO
{

    public function __construct()
    {
        parent::__construct('user_answer', 'user_answer_id');
    }

    public function createUserAnswer($userId, $answerId)
    {
        $data = [
            'user_id' => $userId,
            'answer_id' => $answerId
        ];
        $userAnswerId = $this->create($data);
        return $this->getUserAnswerId($userAnswerId);
    }
    public function createObjectFromRow($row)
    {
        $result = new UserAnswer();
        $result->setUserAnswerId($row['user_answer_id']);
        $result->setUserId($row['user_id']);
        $result->setAnswerId($row['answer_id']);
        return $result;
    }
    public function getUserAnswerId($userId)
    {
        $query = "SELECT user_answer_id FROM {$this->tableName} WHERE user_id = :user_id LIMIT 1";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':user_id' => $userId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $row['user_answer_id'] : null;
    }
    public function getAnswerIdsByUserId($userId)
    {
        $query = "SELECT answer_id FROM {$this->tableName} WHERE user_id = :user_id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
    public function deleteUserAnswer($user_answer_id)
    {
        $this->delete($user_answer_id);
    }
}
