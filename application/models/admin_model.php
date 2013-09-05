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
    
    public function insert_admin_record($password,$salt) {
        
        $data = array(
            'first_name' => $this->input->post('admin_firstname'),
            'last_name' => $this->input->post('admin_lastname'),
            'email' => $this->input->post('admin_email'),
            'password' => md5($password),
            'salt' => $salt,
            'add_privilege' => $this->input->post('add_privilege'),
            'view_privilege' => $this->input->post('view_privilege'),
            'edit_privilege' => $this->input->post('edit_privilege'),
            'delete_privilege' => $this->input->post('delete_privilege'),
            'ip_address' => $this->input->ip_address(),
            'username' => $this->input->post('admin_log_id')
        );
        $id = $this->db->insert('users', $data);
        
        //$data = array(
            
        //);        
        //$record_data = array_merge($this->_filter_data($this->tables['users'], $data), $record_data);
        //$this->db->insert('users', $record_data);

	//$id = $this->db->insert_id();
        return $id;
    }
    
    function get_random_password($chars_min=6, $chars_max=8, $use_upper_case=false, $include_numbers=false, $include_special_chars=false)
    {
        $length = rand($chars_min, $chars_max);
        $selection = 'aeuoyibcdfghjklmnpqrstvwxz';
        if($include_numbers) {
            $selection .= "1234567890";
        }
        if($include_special_chars) {
            $selection .= "!@04f7c318ad0360bd7b04c980f950833f11c0b1d1quot;#$%&[]{}?|";
        }
                                
        $password = "";
        for($i=0; $i<$length; $i++) {
            $current_letter = $use_upper_case ? (rand(0,1) ? strtoupper($selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))];            
            $password .=  $current_letter;
        }                
        
        return $password;
    }
    
    function get_random_salt()
{
    $this->load->helper('string');
    return sha1(random_string('alnum', 32));
}


}


?>
