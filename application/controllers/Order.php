<?php defined('BASEPATH') OR exit('No direct script accesss allowed');

class order extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_order');

	}	

	public function index()
	{
		$products = $this->m_order->displayProducts();
		$data['products'] = $products;

		$category = $this->m_order->displayProductCategory();
		$data['category'] = $category;
		
		$this->load->view('order', $data);
	}

	public function add_order() {
		$date = date('Y-m-d');
		//$product_id = explode(",",$this->input->post('product_id'));
		$totalPrice = explode(",",$this->input->post('totalPrice'));
        $totalPrice = array_sum($totalPrice);
		$data = array(
			'product_id' => $this->input->post('product_id'),
			'cart_id' => $this->input->post('cart_id'),
			'total' => $totalPrice,
			'name' => $this->input->post('name'),
			'date' => $date = date('Y-m-d'),
			);

		$insert = $this->m_order->save_order($data);
		echo json_encode(array("status" => TRUE));
	}
}