<?php
require_once 'src/model/ContactForm.php';
require_once 'dataBase/DAO.php';
require_once 'dataBase/Database.php';

class ContactFormDAO extends DAO
{
    public function __construct()
    {
        parent::__construct('contact', 'contact_id');
    }
    public function createContactForm($contact_id, $contact_status, $contact_adress, $contact_email, $contact_society, $contact_name)
    {
        $data = [
            'contact_id' => $contact_id,
            'contact_status' => $contact_status,
            'contact_adress' => $contact_adress,
            'contact_email' => $contact_email,
            'contact_society' => $contact_society,
            'contact_name' => $contact_name
        ];
        $contactId = $this->create($data);
        return $this->getContactFormById($contactId);
    }
    public function createObjectFromRow($row)
    {
        $result = new ContactForm();
        $result->setContactId($row['contact_id']);
        $result->setContactStatus($row['contact_status']);
        $result->setContactAdress($row['contact_adress']);
        $result->setContactEmail($row['contact_email']);
        $result->setContactSociety($row['contact_society']);
        $result->setContactName($row['contact_name']);
        return $result;
    }
    public function getAllContactForms()
    {
        return $this->getAll();
    }

    public function getContactFormById($contact_id)
    {
        return $this->getById($contact_id);
    }

    public function updateContactForm($contact_id, $contact_status, $contact_adress, $contact_email, $contact_society, $contact_name)
    {
        $data = [
            'contact_status' => $contact_status,
            'contact_adress' =>   $contact_adress,
            'contact_email' =>    $contact_email,
            'contact_society' =>  $contact_society,
            'contact_name' =>   $contact_name
        ];
        $this->update($contact_id, $data);
    }

    public function deleteContactForm($contact_id)
    {
        $this->delete($contact_id);
    }
}
