<?php
require_once 'src/model/Pack.php';
require_once 'dataBase/DAO.php';
require_once 'dataBase/DatabaseConn.php';

class PackDAO extends DAO
{

    public function __construct()
    {
        parent::__construct('pack', 'pack_id');
    }

    public function createPack($pack_name)
    {
        $data = [
            'pack_name' => $pack_name
        ];
        $packId = $this->create($data);
        return $this->getPackById($packId);
    }
    public function createObjectFromRow($row)
    {
        $result = new Pack();
        $result->setPackId($row['pack_id']);
        $result->setPackName($row['pack_name']);
        return $result;
    }

    public function getAllPacks()
    {
        return $this->getAll();
    }

    public function getPackById($pack_id)
    {
        return $this->getById($pack_id);
    }


    public function getPackByAnswerId($answer_id)
    {
        try {
            $query = "SELECT p.* FROM {$this->tableName} p
                      JOIN answer a ON p.pack_id = a.pack_id
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


    public function updatePack($pack_id, $pack_name)
    {
        $data = [
            'pack_name' => $pack_name
        ];
        $this->update($pack_id, $data);
    }


    public function deletePack($pack_id)
    {
        $this->delete($pack_id);
    }
}
