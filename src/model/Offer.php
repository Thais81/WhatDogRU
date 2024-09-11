<?php
require_once 'dataBase\DatabaseConn.php';

class Offer
{
    private $offer_id;
    private $offer_name;
    private $offer_price;
    private $pack_id;


    // Getters
    public function getOfferId()
    {
        return $this->offer_id;
    }

    public function getOfferName()
    {
        return $this->offer_name;
    }

    public function getOfferPrice()
    {
        return $this->offer_price;
    }
    public function getPackId()
    {
        return $this->pack_id;
    }

    // Setters
    public function setOfferId($offer_id)
    {
        $this->offer_id = $offer_id;
    }

    public function setOfferName($offer_name)
    {
        $this->offer_name = $offer_name;
    }

    public function setOfferPrice($offer_price)
    {
        $this->offer_price = $offer_price;
    }
    public function setPackId($pack_id)
    {
        $this->pack_id = $pack_id;
    }
}
