<?php

require_once 'dataBase/DatabaseConn.php';
require_once 'dataBase/DAO.php';
require_once 'src/model/Question.php';

class QuestionDAO extends DAO
{
    public function __construct()
    {
        parent::__construct('question', 'question_id');
    }

    public function createQuestion($question_content, $family_id)
    {
        $data = [
            'question_content' => $question_content,
            'family_id' => $family_id
        ];
        $questionId = $this->create($data);
        return $this->getQuestionById($questionId);
    }

    public function createObjectFromRow($row)
    { {
            $result = new Question();
            $result->setQuestionId($row['question_id']);
            $result->setQuestionContent($row['question_content']);
            $result->setFamilyId($row['family_id']);
            return $result;
        }
    }

    public function getFirstQuestion()
    {
        $query = "SELECT * FROM {$this->tableName} ORDER BY question_id ASC LIMIT 1";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return $this->createObjectFromRow($row);
        } else {
            throw new Exception("Question non trouvée");
        }
    }

    public function getNextQuestionId($answer_id)
    {
        $query = "SELECT next_question_id FROM answer WHERE answer_id = :answer_id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['answer_id' => $answer_id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return $row['next_question_id'];
        } else {
            throw new Exception("Prochaine question non trouvée avec cet answer_id {$answer_id}");
        }
    }

    public function getAllQuestions()
    {
        return $this->getAll();
    }

    public function getQuestionById($question_id)
    {
        return $this->getById($question_id);
    }

    public function updateQuestion($question_id, $question_content, $family_id)
    {
        $data = [
            'question_id' => $question_id,
            'question_content' => $question_content,
            'family_id' => $family_id
        ];
        $this->update($question_id, $data);
    }

    public function deleteQuestion($question_id)
    {
        $this->delete($question_id);
    }
}
