<?php defined('BASEPATH') OR exit('No direct script accesss allowed');

class Admin_dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_admin_dashboard');
	}	

	public function index()
	{
		$category = $this->m_admin_dashboard->get_category_name();
		$data['category'] = $category;
		$this->load->view('Admin_dashboard', $data);

	}

	public function product_list() {
		$list = $this->m_admin_dashboard->get_product_data();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $p) {
			$no++;
			$row = array();
			$row[] = $p->product_id;
			$row[] = $p->product_name;
			$row[] = $p->category;
			$row[] = $p->price;
 			$row[] = '<button class="btn btn-info btn-sm" onclick="edit_product('."'".$p->product_id."'".')" data-toggle="tooltip" data-placement="bottom" title="Click to edit"><span class="fa fa-pencil"></span></button>
                      <button class="btn btn-danger btn-sm" onclick="delete_product('."'".$p->product_id."'".')" data-toggle="tooltip" data-placement="bottom" title="Click to delete"><span class="fa fa-trash-o"></span></button>';
            $data[] = $row;
		}
		$output = array("draw" => $_POST['draw'],
						"recordsTotal" => $this->m_admin_dashboard->product_count_all(),
						"recordsFiltered" => $this->m_admin_dashboard->product_count_filtered(),
						"data" => $data,);
		echo json_encode($output);
	}

	public function edit_product($product_id) {
		$data = $this->m_admin_dashboard->get_product($product_id);
		echo json_encode($data);
	}

	public function add_product() {
		$data = array(
			'product_name' => $this->input->post('product_name'),
			'category_id' => $this->input->post('category'),
			'price' => $this->input->post('price'),
			);
		$insert = $this->m_admin_dashboard->save_product($data);
		echo json_encode(array("status" => TRUE));
	}


	public function update_product() {
		$data = array(
			'product_name' => $this->input->post('product_name'),
			'category_id' => $this->input->post('category'),
			'price' => $this->input->post('price'),
			);
		$this->m_admin_dashboard->update_product(array('product_id' => $this->input->post('product_id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function delete_product($product_id) {
		$this->m_admin_dashboard->delete_product($product_id);
		echo json_encode(array("status" => TRUE));
	}
}