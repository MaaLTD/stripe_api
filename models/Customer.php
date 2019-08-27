<?php
//namespace Model;
//
//use Lib\Database;

class Customer
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function addCustomer($data)
    {
        // Prepare query
        $sql = 'INSERT INTO customers (id, first_name, last_name, email) VALUES (:id, :first_name, :last_name, :email)';
        $this->db->query($sql);

        // bind values
        $this->db->bind(':id',          $data['id']);
        $this->db->bind(':first_name',  $data['first_name']);
        $this->db->bind(':last_name',   $data['last_name']);
        $this->db->bind(':email',       $data['email']);

        // Execute
        return $this->db->execute() ? true : false;
    }

}