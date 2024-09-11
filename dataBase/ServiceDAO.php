<?php

require_once 'dataBase/DatabaseConn.php';
require_once 'dataBase/DAO.php';
require_once 'src/model/Service.php';

class ServiceDAO extends DAO
{
    public function __construct()
    {
        parent::__construct('service', 'service_id');
    }

    public function createService($service_content, $service_price, $pack_id)
    {
        $data = [
            'service_content' => $service_content,
            'service_price' => $service_price,
            'pack_id' => $pack_id

        ];
        $serviceId = $this->create($data);
        return $this->getServiceById($serviceId);
    }

    // methode pour obtenir un instance du modele à partir des données bruts
    public function createObjectFromRow($row)
    {
        $result = new Service();
        $result->setServiceId($row['service_id']);
        $result->setServiceContent($row['service_content']);
        $result->setServicePrice($row['service_price']);
        $result->setPackId($row['pack_id']);
        return $result;
    }
    public function getAllServices()
    {
        return $this->getAll();
    }

    public function getServiceById($service_id)
    {
        return $this->getById($service_id);
    }

    public function getServiceByPackId($pack_id)
    {
        $query = "SELECT * FROM {$this->tableName} WHERE pack_id = :pack_id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['pack_id' => $pack_id]);
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $services = [];
        foreach ($rows as $row) {
            $services[] = $this->createObjectFromRow($row);
        }
        return $services;
    }

    public function getServiceByAnswerId($answerId)
    {
        $query = "
        SELECT s.* 
        FROM service s 
        INNER JOIN pair ad ON s.service_id = ad.service_id 
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

    public function updateService($service_id, $service_content, $service_price, $pack_id)
    {
        $data = [
            'service_content',
            $service_content,
            'service_price',
            $service_price,
            'pack_id',
            $pack_id
        ];
        $this->update($service_id, $data);
    }

    public function deleteService($service_id)
    {
        $this->delete($service_id);
    }
}
