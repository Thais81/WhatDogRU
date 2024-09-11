<?php
require_once 'dataBase\DatabaseConn.php';

abstract class DAO
{
    protected $pdo;
    protected $tableName;
    protected $primaryKey; // Abstract class does not know primary key

    public function __construct($tableName, $primaryKey)
    {
        $this->pdo = Database::getConnection();
        $this->tableName = $tableName;
        $this->primaryKey = $primaryKey;
    }

    public function getById($id)
    {
        $query = "SELECT * FROM {$this->tableName} WHERE {$this->primaryKey} = :id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            return $this->createObjectFromRow($row);
        } else {
            throw new Exception("Aucun enregistrement avec cet id {$id}");
        }
    }

    public function getAll()
    {
        $query = "SELECT * FROM {$this->tableName}";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $objects = [];
        foreach ($rows as $row) {
            $objects[] = $this->createObjectFromRow($row);
        }
        return $objects;
    }

    public function create($data)
    {
        $columns = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        $query = "INSERT INTO {$this->tableName} ({$columns}) VALUES ({$placeholders})";
        $stmt = $this->pdo->prepare($query);
        $result = $stmt->execute($data);

        if (!$result) {
            throw new Exception("Échec de la création de l'enregistrement");
        }

        // Return the last inserted ID
        return $this->pdo->lastInsertId();
    }

    public function update($id, $data)
    {
        $set = '';
        foreach ($data as $key => $value) {
            $set .= "{$key} = :{$key}, ";
        }
        $set = rtrim($set, ', ');

        $query = "UPDATE {$this->tableName} SET {$set} WHERE {$this->primaryKey} = :id";
        $stmt = $this->pdo->prepare($query);
        $data['id'] = $id;
        $result = $stmt->execute($data);
        if (!$result) {
            throw new Exception("Failed to update record with id {$id}");
        }
    }

    public function delete($id)
    {
        $query = "DELETE FROM {$this->tableName} WHERE {$this->primaryKey} = :id";
        $stmt = $this->pdo->prepare($query);
        $result = $stmt->execute(['id' => $id]);
        if (!$result) {
            throw new Exception("Failed to delete record with id {$id}");
        }
    }

    abstract protected function createObjectFromRow($row);
}
