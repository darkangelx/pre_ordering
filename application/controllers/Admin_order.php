<?php defined('BASEPATH') OR exit('No direct script accesss allowed');

class Admin_order extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_admin_order');
	}	

	public function index()
	{
		$this->load->view('Admin_order');

	}

	public function order_list() {
		$list = $this->m_admin_order->get_order_data();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $o) {
			$no++;
			$row = array();
			$row[] = $o->order_id;
			$row[] = $o->product_id;
			$row[] = $o->total;
			$row[] = $o->cart_id;
			$row[] = $o->name;
			$row[] = $o->date;
            $data[] = $row;
		}
		$output = array("draw" => $_POST['draw'],
						"recordsTotal" => $this->m_admin_order->order_count_all(),
						"recordsFiltered" => $this->m_admin_order->order_count_filtered(),
						"data" => $data,);
		echo json_encode($output);
	}
}