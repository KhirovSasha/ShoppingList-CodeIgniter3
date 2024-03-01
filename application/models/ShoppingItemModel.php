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

            $this->load->model('CategoryModel');

            $sql = "CREATE TABLE shopping_items (
                        id INT(11) AUTO_INCREMENT PRIMARY KEY,
                        title VARCHAR(255) NOT NULL,
                        purchased_status BOOLEAN DEFAULT TRUE,
                        price DECIMAL(10,2),
                        added_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                        category_id INT(11),
                        FOREIGN KEY (category_id) REFERENCES categories(id)
                    )";

            $this->db->query($sql);
        }
    }

    public function create($data)
    {
        $this->db->insert('shopping_items', $data);
    }

    public function getItemsByCategories()
    {
        $this->db->select('shopping_items.*, categories.name as category_name');
        $this->db->from('shopping_items');
        $this->db->join('categories', 'shopping_items.category_id = categories.id');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function filterItemsByStatus($status)
    {
        $this->db->where('purchased_status', $status === 'available' ? 1 : 0);
        $this->db->select('shopping_items.*, categories.name as category_name');
        $this->db->from('shopping_items');
        $this->db->join('categories', 'shopping_items.category_id = categories.id');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function filterItemsByCategories($category_id)
    {
        $this->db->where('category_id', $category_id);
        $this->db->select('shopping_items.*, categories.name as category_name');
        $this->db->from('shopping_items');
        $this->db->join('categories', 'shopping_items.category_id = categories.id');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function deleteItem($id)
    {
        $this->db->where('id', $id);
        $result = $this->db->delete('shopping_items');

        return $result;
    }

    public function changeStatus($id)
    {
        $item = $this->getItemById($id);

        if (!$item) {
            return false;
        }

        $newStatus = $item->purchased_status == 1 ? 0 : 1;

        $this->db->where('id', $id);
        $this->db->update('shopping_items', array('purchased_status' => $newStatus));

        return true;
    }

    private function getItemById($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('shopping_items');

        return $query->row();
    }
}
