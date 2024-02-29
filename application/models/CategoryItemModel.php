<?php

class CategoryItemModel extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->createTable();
    }

    public function createTable() {
        if (!$this->db->table_exists('category_items')) {
            $sql = "CREATE TABLE category_items (
                        id INT(11) AUTO_INCREMENT PRIMARY KEY,
                        category_id INT(11),
                        item_id INT(11),
                        FOREIGN KEY (category_id) REFERENCES categories(id),
                        FOREIGN KEY (item_id) REFERENCES shopping_items(id)
                    )";

            $this->db->query($sql);
        }
    }
}

?>
