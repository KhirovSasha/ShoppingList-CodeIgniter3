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
        }
    }

    public function create($name)
    {
        $data = array(
            'name' => $name
        );

        $this->db->insert('categories', $data);
        return $this->db->insert_id();
    }

    public function getAllCategories()
    {
        $query = $this->db->get('categories');

        if ($query->num_rows() > 0) {
            foreach ($query->result() as $data) {
                $array[] = $data;
            }
            return $array;
        } 
    }
}
