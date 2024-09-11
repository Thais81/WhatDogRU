<?php
require_once 'dataBase/DatabaseConn.php';
require_once 'dataBase/DAO.php';
require_once 'src/model/breed.php';

class breedDAO extends DAO
{
    public function __construct()
    {
        parent::__construct('breed', 'breed_id');
    }


    public function createbreed($breed_name, $breed_rate, $family_id)
    {

        $data = [
            'breed_name' => $breed_name,
            'breed_rate' => $breed_rate,
            'family_id' => $family_id
        ];
        $breedId = $this->create($data);
        return $this->getbreedById($breedId);
    }

    // methode pour obtenir un instance du modele à partir des données bruts
    public function createObjectFromRow($row)
    {
        $result = new breed();
        $result->setBreedId($row['breed_id']);
        $result->setBreedName($row['breed_name']);
        $result->setBreedRate($row['breed_rate']);
        $result->setFamilyId($row['family_id']);
        return $result;
    }

    public function getAllBreeds()
    {
        return $this->getAll();
    }

    public function getBreedById($breed_id)
    {
        return $this->getById($breed_id);
    }

    public function updateBreed($breed_id, $breed_name, $breed_rate, $family_id)
    {
        $data = [
            'breed_name' => $breed_name,
            'breed_rate'  => $breed_rate,
            'family_id' => $family_id
        ];
        $this->update($breed_id, $data);
    }

    public function deleteBreed($breed_id)
    {
        $this->delete($breed_id);
    }
}
