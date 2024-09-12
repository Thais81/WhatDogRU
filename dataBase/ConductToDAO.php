<?php
require_once 'src/model/ConductTo.php';
require_once 'dataBase/DAO.php';
require_once 'dataBase/Database.php';

class ConductToDAO extends DAO
{
    public function __construct()
    {
        parent::__construct('conduct_to', 'conduct_to_id');
    }

    public function createConductTo($breed_id, $answer_id)
    {
        $data = [
            'breed_id' => $breed_id,
            'answer_id' => $answer_id
        ];
        $conductToId = $this->create($data);
        return $this->getConductToById($conductToId);
    }

    public function createObjectFromRow($row)
    {
        $result = new ConductTo();
        $result->setConductToId($row['conduct_to_id']);
        $result->setAnswerId($row['answer_id']);
        $result->setBreedId($row['breed_id']);
        return $result;
    }

    public function getAllConductTo()
    {
        return $this->getAll();
    }
    public function getBreedIdByAnswerId($answer_id)
    {
        $query = "SELECT breed_id FROM {$this->tableName} WHERE answer_id = :answer_id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['answer_id' => $answer_id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $row['breed_id'] : null;
    }

    public function getConductToById($conduct_to_id)
    {
        $this->getById($conduct_to_id);
    }

    public function updateConductToDAO($conduct_to_id, $breed_id, $answer_id)
    {
        $data = [
            'breed_id' => $breed_id,
            'answer_id' => $answer_id
        ];
        $this->update($conduct_to_id, $data);
    }


    public function deleteConductTo($conductTo_id)
    {
        $this->delete($conductTo_id);
    }
}
