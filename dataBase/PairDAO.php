<?php

require_once 'dataBase/Database.php';
require_once 'dataBase/DAO.php';
require_once 'src/model/Pair.php';

class pairDAO extends DAO
{

    public function __construct()
    {
        parent::__construct('pair', 'pair_id');
    }

    public function createPair($answer_id, $feature_id)
    {
        $data = [
            'answer_id' => $answer_id,
            'feature_id' => $feature_id
        ];
        $pairId = $this->create($data);
        return $this->getPairById($pairId);
    }

    // methode pour obtenir un instance du modele à partir des données bruts
    public function createObjectFromRow($row)
    {
        $result = new Pair();
        $result->setPairId($row['pair_id']);
        $result->setAnswerId($row['answer_id']);
        $result->setFeatureId($row['feature_id']);
        return $result;
    }
    public function getPairById($pair_id)
    {
        return $this->getById($pair_id);
    }
    public function getAllPair()
    {
        return $this->getAll();
    }

    public function updatePair($pair_id, $answer_id, $feature_id)
    {
        $data = [
            'pair_id' => $pair_id,
            'answer_id' => $answer_id,
            'feature_id' => $feature_id
        ];
        $this->update($pair_id, $data);
    }

    public function deletePair($pair_id)
    {
        $this->delete($pair_id);
    }
}
