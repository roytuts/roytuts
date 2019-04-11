<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');

/**
* Description of Search
*
* @author https://www.roytuts.com
*/

class Search extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('data_model');
	}
	
	public function index() {
		$this->load->view('autocomplete');
	}
	
	function search_results() {
		if (isset($_REQUEST['q'])) {
			$results = $this->data_model->get_data($_REQUEST['q']);
			echo json_encode($results);
		}
	}
	
}

/* End of file Search.php */
/* Location: ./application/controllers/Search.php */