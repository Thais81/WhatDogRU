<?php
require_once 'src/model/family.php';
require_once 'dataBase/DAO.php';
require_once 'dataBase/Database.php';

class familyDAO extends DAO
{

    public function __construct()
    {
        parent::__construct('family', 'family_id');
    }

    public function createfamily($family_name)
    {
        $data = [
            'family_name' => $family_name
        ];
        $familyId = $this->create($data);
        return $this->getfamilyById($familyId);
    }
    public function createObjectFromRow($row)
    {
        $result = new Family();
        $result->setFamilyId($row['family_id']);
        $result->setFamilyName($row['family_name']);
        return $result;
    }

    public function getAllfamilys()
    {
        return $this->getAll();
    }

    public function getFamilyById($family_id)
    {
        return $this->getById($family_id);
    }


    public function getFamilyByAnswerId($answer_id)
    {
        try {
            $query = "SELECT p.* FROM {$this->tableName} p
                      JOIN answer a ON p.family_id = a.family_id
                      WHERE a.answer_id = :answer_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(['answer_id' => $answer_id]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC); // Utilisation de fetch pour une seule ligne
            if ($row) {
                return $this->createObjectFromRow($row);
            } else {
                return null; // Aucun résultat trouvé
            }
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }


    public function updateFamily($family_id, $family_name)
    {
        $data = [
            'family_name' => $family_name
        ];
        $this->update($family_id, $data);
    }


    public function deleteFamily($family_id)
    {
        $this->delete($family_id);
    }
}
