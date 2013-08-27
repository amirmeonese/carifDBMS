<?php
class Report_model extends CI_Model {

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


}


?>
