<?php
class Email_notification_model extends CI_Model
{
	public function __construct() 
	{
		parent::__construct();
		$this->load->database();
	}
	
	public function get_days_appointments($day)
	{
		echo "get_days_appointments called \n";
		$day_start = date('Y-m-d 00:00:00', $day);
		$day_end = date('Y-m-d 23:59:59', $day);
		$query = $this->db->select('*')->from('patient_interview_manager')->get();

		if ($query->num_rows() > 0)
		{
			return $query->result();
		   /*foreach ($query->result() as $row)
		   {
			  echo $row->title;
			  echo $row->name;
			  echo $row->body;
		   }*/
		}
		else
			echo "query row is 0 \n";

	}

	public function mark_reminded($interview_manager_id)
	{
		return $this->db->where('patient_interview_manager_id', $interview_manager_id)->update('patient_interview_manager', array('is_reminded' => 1));
	}
}