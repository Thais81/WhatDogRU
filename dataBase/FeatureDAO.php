<?php

require_once 'dataBase/DatabaseConn.php';
require_once 'dataBase/DAO.php';
require_once 'src/model/Feature.php';

class FeatureDAO extends DAO
{
    public function __construct()
    {
        parent::__construct('feature', 'feature_id');
    }

    public function createFeature($feature_content, $feature_rate, $pack_id)
    {
        $data = [
            'feature_content' => $feature_content,
            'feature_rate' => $feature_rate,
            'pack_id' => $pack_id

        ];
        $featureId = $this->create($data);
        return $this->getFeatureById($featureId);
    }

    // methode pour obtenir un instance du modele à partir des données bruts
    public function createObjectFromRow($row)
    {
        $result = new Feature();
        $result->setfeatureId($row['feature_id']);
        $result->setfeatureContent($row['feature_content']);
        $result->setfeatureRate($row['feature_rate']);
        $result->setPackId($row['pack_id']);
        return $result;
    }
    public function getAllFeatures()
    {
        return $this->getAll();
    }

    public function getFeatureById($feature_id)
    {
        return $this->getById($feature_id);
    }

    public function getFeatureByPackId($pack_id)
    {
        $query = "SELECT * FROM feature WHERE pack_id = :pack_id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['pack_id' => $pack_id]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $features = [];
        foreach ($rows as $row) {
            $features[] = $this->createObjectFromRow($row);
        }
        return $features;
    }

    public function getFeatureByAnswerId($answerId)
    {
        $query = "
        SELECT s.* 
        FROM feature s 
        INNER JOIN pair ad ON s.feature_id = ad.feature_id 
        WHERE ad.answer_id = :answer_id";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['answer_id' => $answerId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return $this->createObjectFromRow($row);
        } else {
            return null;
        }
    }

    public function updateFeature($feature_id, $feature_content, $feature_rate, $pack_id)
    {
        $data = [
            'feature_content',
            $feature_content,
            'feature_rate',
            $feature_rate,
            'pack_id',
            $pack_id
        ];
        $this->update($feature_id, $data);
    }

    public function deleteFeature($feature_id)
    {
        $this->delete($feature_id);
    }
}
