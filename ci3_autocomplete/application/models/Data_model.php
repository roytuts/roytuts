<?php

if (!defined('BASEPATH'))
	exit('No direct script access allowed');
	
/**
* Description of Data_model
*
* @author https://www.roytuts.com
*/

class Data_model extends CI_Model {		
		
		function get_data($search_term) {
			$arr = array(
				"Lorem Ipsum is simply dummy text of the printing and typesetting",
				"Lorem Ipsum has been the industry's standard dummy",
				"nd scrambled it to make a type specimen book. It",
				"typesetting, remaining essentially unchanged. It ",
				"sum passages, and more recently with desktop publi",
				"Contrary to popular belief, Lorem Ipsum is not sim",
				"professor at Hampden-Sydney College in Virginia, looked up one",
				"passage, and going through the cites of the word in",
				"comes from sections 1.10.32 and 1.10.33 of 'de Finibus Bonorum",
				"BC. This book is a treatise on the theory of ethics, very popu",
				"here are many variations of passages of Lorem Ipsum availa",
				"believable. If you are going to use a passage of Lorem Ips",
				"middle of text. All the Lorem Ipsum generators on the Intern",
				"tend to repeat predefined chunks as necessary, making this the",
				"first true generator on the Internet. It uses a dictionary of over 20",
				"he standard chunk of Lorem Ipsum used since the 1500s i",
				"1.10.33 from 'de Finibus Bonorum et Malorum' by Cicero are als",
				"reproduced in their exact original form, accompanied by English",
				"eadable content of a page when looking at its layout. The point"
			);

			$filteredArray = array_filter($arr, function($element) use($search_term){
				return isset($element) && strpos($element, $search_term) !== false;
			});
			
			return $filteredArray;
		}
}

/* End of file data_model.php */
/* Location: ./application/models/data_model.php */