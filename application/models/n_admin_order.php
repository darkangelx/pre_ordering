<?php

class M_admin_dashboard extends CI_Model
{
	//prod var
	var $prod_column_order = array('product_id','product_name','category','price',null);
	var $prod_column_search = array('product_id','product_name','category','price');
	var $prod_order = array('product_id' => 'asc');

	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

	public function get_category_name() {
		$query = $this->db->query("SELECT * FROM tbl_category ORDER BY category ASC");
		return ($query->num_rows() > 0) ? $query->result() : false;
	}


	private function get_productTable_query() {
		$this->db->from('tbl_products');
		$this->db->join('tbl_category','tbl_products.category_id = tbl_category.category_id');
		$i = 0;

		foreach ($this->prod_column_search as $sdata) {
			if($_POST['search']['value']) {
				if($i === 0) {
					$this->db->group_start();
					$this->db->like($sdata, $_POST['search']['value']);
				} else {
					$this->db->or_like($sdata, $_POST['search']['value']);
				}
				if(count($this->prod_column_search) - 1 == $i)
					$this->db->group_end();
			}
			$i++;
		}
		if(isset($_POST['order'])) {
			$this->db->order_by($this->prod_column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if(isset($this->prod_order)) {
			$order = $this->prod_order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	public function get_product_data() {
		$this->get_productTable_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	public function product_count_filtered() {
		$this->get_productTable_query();
		$query = $this->db->get();
		return $query->num_rows();
	}	

	public function product_count_all() {
		$this->db->from('tbl_products');
		return $this->db->count_all_results();
	}

	public function get_product($product_id) {
		$this->db->from('tbl_products');
		$this->db->where('product_id', $product_id);
		$query = $this->db->get();

		return $query->row();
	}

	public function save_product($data) {
		$this->db->insert('tbl_products', $data);
		return $this->db->insert_id();
	}

	public function update_product($where, $data) {
		$this->db->update('tbl_products', $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_product($product_id) {
		$this->db->query("DELETE FROM tbl_products WHERE product_id = '".$product_id."'");
	}
}
?>