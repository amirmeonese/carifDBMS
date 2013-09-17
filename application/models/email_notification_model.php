<?php
class Email_notification_model extends CI_Model
{
	public function __construct() 
	{
		parent::__construct();
		$this->load->database();
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
}