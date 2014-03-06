<?php
class Email_notification_model extends CI_Model
{
	public function __construct() 
	{
		parent::__construct();
		$this->load->database();
                $this->load->library('email');
	}
	
	public function get_days_appointments($next_day)
	{
		$next_day = date('Y-m-d', $next_day);
		$query = $this->db->select('*')->from('patient_interview_manager')->where('next_interview_date =', $next_day)->get();

		if ($query->num_rows() > 0)
		{
			return $query->result();
		}
		else
			echo "query row is 0 \n";

	}

	public function mark_reminded($interview_manager_id)
	{
		return $this->db->where('patient_interview_manager_id', $interview_manager_id)->update('patient_interview_manager', array('is_reminded' => 1));
	}
        
        public function get_officer_email_addresses($new_date){
    
        $this->db->select('officer_email_addresses,patient_interview_manager_id');
        $this->db->where('is_send_email_reminder_to_officers',1);
        $this->db->where('is_reminded !=',1);
        $this->db->like('interview_date',$new_date);
        $this->db->group_by('officer_email_addresses');
	$f_record = $this->db->get('patient_interview_manager');
        $patient_family_detail = $f_record->result_array();
        //echo $this->db->last_query();exit;
        $f_record->free_result();  

        return $patient_family_detail;
    }
    
    public function get_email_patient($list,$new_date){
    
        $this->db->select('a.*,b.cell_phone,b.home_phone,b.given_name');
        $this->db->from('patient_interview_manager a');
        $this->db->join('patient b', 'a.patient_ic_no = b.ic_no', 'left');
        $this->db->where('a.officer_email_addresses',$list);
        $this->db->where('a.is_send_email_reminder_to_officers',1);
        $this->db->where('a.is_reminded !=',1);
        $this->db->like('a.interview_date',$new_date);
	$f_record = $this->db->get('');
        $patient_family_detail = $f_record->result_array();
        //echo $this->db->last_query();exit;
        $f_record->free_result();  

        //print_r($patient_family_detail);exit;
        
        return $patient_family_detail;
    }
    
    function counselling_email($test,$sender)
{
    
        $subject = 'Counselling Date Reminder';

        $MESSAGE_BODY = "The following patients need to be contact:" . "<br>";
        $MESSAGE_BODY .= "" . "<br>";        
        $data['searched_result'] = $test;
        $MESSAGE_BODY .= $this->load->view('record/generated_email', $data,true);
        $MESSAGE_BODY .= "This is a system generated email. Please do not reply to it." . "<br>";
        
        $this->email->clear();

                $config['protocol'] = 'smtp';
                $config['smtp_host'] = 'ssl://smtp.gmail.com';
                $config['smtp_port'] = '465';
                $config['smtp_timeout'] = '7';
                $config['smtp_user'] = 'cariftest@gmail.com';
                $config['smtp_pass'] = 'carif123456';
                $config['charset'] = 'utf-8';
                $config['newline'] = "\r\n";
                $config['mailtype'] = 'html'; // or text
                $config['validation'] = TRUE; // bool whether to validate email or not     
                $this->email->initialize($config);

                $this->email->from('cariftest@gmail.com', 'Carif Counselling Date Reminder sent via CarifDBMS');
                $this->email->to($sender);
                $this->email->subject($subject);
                $this->email->message($MESSAGE_BODY);
                $email_send = $this->email->send();
                
                return $email_send;
            
            
}
}