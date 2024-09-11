<?php
class ContactForm
{
    private $contact_id;
    private $contact_status;
    private $contact_adress;
    private $contact_email;
    private $contact_society;
    private $contact_name;


    //Getter:
    function getContactId()
    {
        return $this->contact_id;
    }

    function getContactStatus()
    {
        return $this->contact_status;
    }
    function getContactAdress()
    {
        return $this->contact_adress;
    }
    function getContactEmail()
    {
        return $this->contact_email;
    }
    function getContactSociety()
    {
        return $this->contact_society;
    }
    function getContactName()
    {
        return $this->contact_name;
    }

    //Setter:
    function setContactId($contact_id)
    {
        $this->contact_id = $contact_id;
    }

    function setContactStatus($contact_status)
    {
        $this->contact_status = $contact_status;
    }
    function setContactAdress($contact_adress)
    {
        $this->contact_adress = $contact_adress;
    }
    function setContactEmail($contact_email)
    {
        $this->contact_email = $contact_email;
    }
    function setContactSociety($contact_society)
    {
        $this->contact_society = $contact_society;
    }
    function setContactName($contact_name)
    {
        $this->contact_name = $contact_name;
    }
}
