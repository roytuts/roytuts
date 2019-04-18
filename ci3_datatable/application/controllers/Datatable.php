<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Datatable extends CI_Controller {
	
	function __construct() {
        parent::__construct();
        $this->load->model('datatable_model', 'dm');
    }
	
	function index() {
		$this->load->view('datatable', NULL);
	}
	
	function get_products() {
		$products = $this->dm->get_products();
		echo json_encode($products);
	}
	
	function delete_product() {
		$id = isset($_POST['id']) ? $_POST['id'] : NULL;
		
		if($this->dm->delete_product($id) === TRUE) {
			return TRUE;
		}
		
		return FALSE;
	}
	
	function update_product() {
		$id = $_POST['id'];
		$name = $_POST['name'];
		$price = $_POST['price'];
		$sale_price = $_POST['sale_price'];
		$sale_count = $_POST['sale_count'];
		$sale_date = $_POST['sale_date'];
		
		if($this->dm->update_product($id, $name, $price, $sale_price, $sale_count, $sale_date) === TRUE) {
			return TRUE;
		}
		
		return FALSE;
	}
	
	function add_product() {
		$name = $_POST['name'];
		$price = $_POST['price'];
		$sale_price = $_POST['sale_price'];
		$sale_count = $_POST['sale_count'];
		$sale_date = $_POST['sale_date'];
		
		if($this->dm->add_product($name, $price, $sale_price, $sale_count, $sale_date) === TRUE) {
			return TRUE;
		}
		
		return FALSE;
	}
}

/* End of file Datatable.php */
/* Location: ./application/controllers/Datatable.php */