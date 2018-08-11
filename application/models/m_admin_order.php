<?php

class M_admin_order extends CI_Model
{
	//order var
	var $o_column_order = array('order_id','product_name','total','cart_id','name','date',null);
	var $o_column_search = array('order_id','product_name','total','cart_id','name','date');
	var $o_order = array('date' => 'asc');

	public function __construct() {
		parent::__construct();
		$this->load->database();
	}

	private function get_orderTable_query() {
		$this->db->from('tbl_orders');
		$i = 0;

		foreach ($this->o_column_search as $sdata) {
			if($_POST['search']['value']) {
				if($i === 0) {
					$this->db->group_start();
					$this->db->like($sdata, $_POST['search']['value']);
				} else {
					$this->db->or_like($sdata, $_POST['search']['value']);
				}
				if(count($this->o_column_search) - 1 == $i)
					$this->db->group_end();
			}
			$i++;
		}
		if(isset($_POST['order'])) {
			$this->db->order_by($this->o_column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} else if(isset($this->o_order)) {
			$order = $this->o_order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	public function get_order_data() {
		$this->get_orderTable_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	public function order_count_filtered() {
		$this->get_orderTable_query();
		$query = $this->db->get();
		return $query->num_rows();
	}	

	public function order_count_all() {
		$this->db->from('tbl_orders');
		return $this->db->count_all_results();
	}
}
?>