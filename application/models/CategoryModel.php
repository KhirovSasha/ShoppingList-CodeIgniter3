<?php

class CategoryModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->createTable();
    }

    public function createTable()
    {
        if (!$this->db->table_exists('categories')) {
            $sql = "CREATE TABLE categories (
                        id INT(11) AUTO_INCREMENT PRIMARY KEY,
                        name VARCHAR(255) NOT NULL
                    )";

            $this->db->query($sql);

            $this->load->model('CategoryItemModel');
            $this->CategoryItemModel->createTable();
        }
    }
}
