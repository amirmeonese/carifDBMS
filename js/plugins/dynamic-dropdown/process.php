<?php
	function renameDropdownItem($id, $text) {
        
		//Trim last comma
		$text = rtrim($text, ",");
		
		// Loading existing data:
		$json = file_get_contents("data.json");
		$data = json_decode($json, true);
		
		switch($id){
			case 'nationality':
				$data['nationality'] = $text;
				break;
			case 'gender':
				$data['gender'] = $text;
				break;
			case 'marital_status':
				$data['marital_status'] = $text;
				break;
			case 'COGS_study_id':
				$data['COGS_study_id'] = $text;
				break;
			case 'income_level':
				$data['income_level'] = $text;
				break;
			case 'status_source':
				$data['status_source'] = $text;
				break;
			case 'alive_status':
				$data['alive_status'] = $text;
				break;
			case 'studies_name':
				$data['studies_name'] = $text;
				break;
		}
		
		// Writing modified data:
		file_put_contents('data.json', json_encode($data, JSON_FORCE_OBJECT));

		return true;
    }
	
	if(isset($_POST['action']) && !empty($_POST['action'])) {
		$action = $_POST['action'];
		$id = $_POST['id'];
		$text = $_POST['text'];
		
		switch($action) {
			case 'dropdown' : 
			{
				renameDropdownItem($id, $text);
				break;
			}
			case 'add' : addItem();break;
		}	
	}

	
?>