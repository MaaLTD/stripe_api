<?php
//namespace Model;
//
//use Lib\Database;

class Transaction
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function addTransaction($data)
    {
        // Prepare query
        $sql = 'INSERT INTO transactions (id, customer_id, product, amount, currency, status) 
                VALUES (:id, :customer_id, :product, :amount, :currency, :status)';
        $this->db->query($sql);

        // bind values
        $this->db->bind(':tid',         $data['tid']);
        $this->db->bind(':customer_id', $data['customer_id']);
        $this->db->bind(':product',     $data['product']);
        $this->db->bind(':amount',      $data['amount']);
        $this->db->bind(':currency',    $data['currency']);
        $this->db->bind(':status',      $data['status']);

        // Execute
        return $this->db->execute() ? true : false;
    }
}