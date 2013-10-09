<?php

class Admin_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

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

    public function get_locked_patient_lists() {
        $query = $this->db->select('*')->from('patient')->where('is_record_locked = 1')->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return null;
        }
    }

    public function insert_admin_record($password, $salt) {

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

    function get_random_password($chars_min = 8, $chars_max = 20, $use_upper_case = false, $include_numbers = false, $include_special_chars = false) {
        $length = rand($chars_min, $chars_max);
        $selection = 'aeuoyibcdfghjklmnpqrstvwxz';
        if ($include_numbers) {
            $selection .= "1234567890";
        }
        if ($include_special_chars) {
            $selection .= "!@04f7c318ad0360bd7b04c980f950833f11c0b1d1quot;#$%&[]{}?|";
        }

        $password = "";
        for ($i = 0; $i < $length; $i++) {
            $current_letter = $use_upper_case ? (rand(0, 1) ? strtoupper($selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))];
            $password .= $current_letter;
        }

        return $password;
    }

    function get_random_salt() {
        $this->load->helper('string');
        return sha1(random_string('alnum', 32));
    }

    function write_error_into_log($error_msg) {
        $this->load->helper('file');
        $this->load->helper('date');
        //Get current error list and append new error message
        $format = 'DATE_W3C';
        $time = time();

        $time_now = standard_date($format, $time);

        $data = file_get_contents("error_log/carif_error.txt");
        $error_msg = $time_now . " [ERROR] " . $error_msg . "\r\n";
        $data = $error_msg . $data;

        if (!write_file('error_log/carif_error.txt', $data)) {
            echo 'Unable to write the error log file';
            return false;
        } else {
            return true;
        }
    }

}

?>
