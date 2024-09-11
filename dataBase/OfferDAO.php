<?php
require_once 'dataBase/DatabaseConn.php';
require_once 'dataBase/DAO.php';
require_once 'src/model/Offer.php';

class OfferDAO extends DAO
{
    public function __construct()
    {
        parent::__construct('offer', 'offer_id');
    }


    public function createOffer($offer_name, $offer_price, $pack_id)
    {

        $data = [
            'offer_name' => $offer_name,
            'offer_price' => $offer_price,
            'pack_id' => $pack_id
        ];
        $offerId = $this->create($data);
        return $this->getOfferById($offerId);
    }

    // methode pour obtenir un instance du modele à partir des données bruts
    public function createObjectFromRow($row)
    {
        $result = new Offer();
        $result->setOfferId($row['offer_id']);
        $result->setOfferName($row['offer_name']);
        $result->setOfferPrice($row['offer_price']);
        $result->setPackId($row['pack_id']);
        return $result;
    }

    public function getAllOffers()
    {
        return $this->getAll();
    }

    public function getOfferById($offer_id)
    {
        return $this->getById($offer_id);
    }

    public function updateOffer($offer_id, $offer_name, $offer_price, $pack_id)
    {
        $data = [
            'offer_name' => $offer_name,
            $offer_price => 'offer_price',
            'pack_id' => $pack_id
        ];
        $this->update($offer_id, $data);
    }

    public function deleteOffer($offer_id)
    {
        $this->delete($offer_id);
    }
}
