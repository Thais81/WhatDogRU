<?php

require_once 'dataBase/DatabaseConn.php';
require_once 'src/model/Answer.php';
require_once 'dataBase/DAO.php';


class AnswerDAO extends DAO
{
    public function __construct()
    {
        parent::__construct('answer', 'answer_id');
    }

    //surcharge des methodes du CRUD présente dans la classe parent DAO:
    public function createAnswer($question_id, $answer_content)
    {
        $data = [
            'question_id' => $question_id,
            'answer_content' => $answer_content
        ];
        $answerId = $this->create($data);
        return $this->getAnswerById($answerId);
    }

    // methode pour obtenir un instance du modele à partir des données bruts, methode surchargée
    public function createObjectfromRow($row)
    {
        $result = new Answer();
        $result->setAnswerId($row['answer_id']);
        $result->setAnswerContent($row['answer_content']);
        $result->setPackId($row['pack_id']);
        $result->setQuestionId($row['question_id']);
        $result->setIsLastAnswer($row['is_last_answer']);
        return $result;
    }
    public function getAllAnswers()
    {
        return $this->getAll();
    }

    public function getAnswerById($answer_id)
    {
        return $this->getById($answer_id);
    }

    public function getAnswersByQuestionId($question_id)
    {
        $query = "SELECT * FROM {$this->tableName} WHERE question_id = :question_id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['question_id' => $question_id]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $answers = [];
        foreach ($rows as $row) {
            $answers[] = $this->createObjectFromRow($row);
        }
        return $answers;
    }

    public function getAnswerByPackId($pack_id)
    {
        $query = "SELECT * FROM {$this->tableName} WHERE pack_id = :pack_id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['pack_id' => $pack_id]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $answers = [];
        foreach ($rows as $row) {
            $answers[] = $this->createObjectFromRow($row);
        }
        return $answers;
    }
    public function isLastAnswer($answerId)
    {
        $query = "SELECT COUNT(*) FROM {$this->tableName} WHERE answer_id = :answer_id AND is_last_answer = 1";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([':answer_id' => $answerId]);

        // Récupération du nombre de lignes retournées par la requête
        // Si COUNT(*) retourne une valeur > 0, cela signifie que answer_id correspond à la dernière réponse
        return $stmt->fetchColumn() > 0;
    }

    public function updateAnswer($answer_id, $question_id, $pack_id, $answer_content)
    {
        $data = [
            'question_id' => $question_id,
            'pack_id' => $pack_id,
            'answer_content' => $answer_content
        ];
        $this->update($answer_id, $data);
    }

    public function deleteAnswer($answer_id)
    {
        $this->delete($answer_id);
    }
}
