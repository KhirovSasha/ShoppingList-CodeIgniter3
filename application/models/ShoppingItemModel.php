<?php

class ShoppingItemModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->createTable();
    }

    public function createTable()
    {
        if (!$this->db->table_exists('shopping_items')) {
            $sql = "CREATE TABLE shopping_items (
                        id INT(11) AUTO_INCREMENT PRIMARY KEY,
                        title VARCHAR(255) NOT NULL,
                        purchased_status BOOLEAN,
                        price DECIMAL(10,2)
                    )";

            $this->db->query($sql);

            $this->load->model('CategoryItemModel');
            $this->CategoryItemModel->createTable();
        }
    }
}
