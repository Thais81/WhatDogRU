<?php
require_once 'dataBase/Database.php';
require_once 'dataBase/DAO.php';
require_once 'src/model/Ask.php';
class AskDAO extends DAO
{
    public function __construct()
    {
        parent::__construct('ask', 'ask_id');
    }

    public function createAsk($question_id, $answer_id)
    {

        $data = [
            'question_id' => $question_id,
            'answer_id' => $answer_id
        ];
        $askId = $this->create($data);
        return $this->getAskById($askId);
    }

    public function createObjectFromRow($row)
    {
        $result = new Ask();
        $result->setQuestionId($row['question_id']);
        $result->setAnswerId($row['answer_id']);
        return $result;
    }

    public function getQuestionByAnswerId($answer_id)
    {
        $query = "
            SELECT q.question_id, q.question_content
            FROM question q
            INNER JOIN {$this->tableName} a ON q.question_id = a.question_id
            WHERE a.answer_id = :answer_id
        ";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['answer_id' => $answer_id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $question = new Question();
            $question->setQuestionId($row['question_id']);
            $question->setQuestionContent($row['question_content']);
            return $question;
        }

        return null;
    }
    public function getAskById($askId)
    {
        return $this->getById($askId);
    }

    public function deleteAsk($ask_id)
    {
        $this->delete($ask_id);
    }
}
