<?php
class Admin_model extends CI_Model {

    function general() {

       //Report templates : Hard coded for now. Should fetch from database later.
        $data['reportTemplates'] = array(
            'Pathology Report' => 'Pathology Report',
            'Mammo Report' => 'Mammo Report',
            'Investigation Report' => 'Investigation Report',
            'Annual Report' => 'Annual Report'
        );
        
		return $data;
    }
    
    public function insert_admin_record($record_data) {
        //$data = array(
            
        //);        
        //$record_data = array_merge($this->_filter_data($this->tables['users'], $data), $record_data);
        $this->db->insert('users', $record_data);

	$id = $this->db->insert_id();
        return $id;
    }


}


?>
