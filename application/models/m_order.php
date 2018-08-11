<?php

class M_order extends CI_Model
{
	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

    public function displayProducts(){
        $query = $this->db->query("SELECT * FROM tbl_products as p LEFT JOIN tbl_category as c on p.category_id = c.category_id");
        return ($query->num_rows() > 0) ? $query->result() : false;
    }
    public function displayProductCategory(){
        $query = $this->db->query("SELECT * FROM tbl_category");
        return ($query->num_rows() > 0) ? $query->result() : false;
    }

	public function save_order($data) {
		$this->db->insert('tbl_orders', $data);
		return $this->db->insert_id();
	}
}
?>