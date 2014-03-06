<?php
class Email_Sender_Cron_Job extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('input');
		$this->load->model('Email_notification_model');
		$this->load->model('Admin_model');
	}
	public function index()
	{
		/* if(!$this->input->is_cli_request())
		{
			echo "This script can only be accessed via the command line" . PHP_EOL;
			return;
		} */
	
                $this->email_follow_up_notification();
            
		$timestamp = strtotime("+1 days");
		$appointments = $this->Email_notification_model->get_days_appointments($timestamp);
		if(!empty($appointments))
		{
			foreach($appointments as $appointment)
			{
				echo "send email \n";
				if($appointment->is_reminded == 0)
				{
					$email_address = $appointment->officer_email_addresses;
					$config = array(
						'protocol' => 'smtp',
						'smtp_host' => 'ssl://smtp.googlemail.com',
						'smtp_port' => 465,
						'smtp_user' => 'apurbamy@gmail.com',
						'smtp_pass' => 'apurbamy2012'
					);
					
					echo " email address " . $appointment->officer_email_addresses . "\n";
					$this->load->library('email', $config); 
					$email_address = $appointment->officer_email_addresses;
					$IC_no = $appointment->patient_ic_no;
					$this->email->set_newline("\r\n");
					$this->email->to($email_address);
					$this->email->from('carif.notifier@carif.com.my');
					$this->email->subject('CarifDBMS Auto-notification : This is a friendly reminder for tomorrow\'s interview follow-up.');
					$this->email->message('You have an interview appointment tomorrow for patient with an IC no '. $IC_no);
					$send_status = $this->email->send();
					
				
					echo $this->email->print_debugger();
					if ($send_status)
					{
						echo "Email sent successfully! \n";
						$this->Email_notification_model->mark_reminded($appointment->patient_interview_manager_id);
					}
					else
					{
						echo "failed to send email to officer at this address: " . $appointment->officer_email_addresses . "\n";
						$this->Admin_model->write_error_into_log("Error in submitting email notification to officers.");
					}
				}
			}
		}
	}
        
        function email_follow_up_notification(){
            
                        $new_date = date("Y-m", strtotime("-5 months"));
                                                                    
                        $officer_email = $this->Email_notification_model->get_officer_email_addresses($new_date);

                        foreach ($officer_email as $list){
                        $email = $this->Email_notification_model->get_email_patient($list['officer_email_addresses'],$new_date);
                        $email_send = $this->Email_notification_model->counselling_email($email,$list['officer_email_addresses']);
                        
                        if ($email_send)
					{
						echo "Email sent successfully! \n";
						$this->db->where('patient_interview_manager_id', $list['patient_interview_manager_id']);
                                                $this->db->update('patient_interview_manager', array('is_reminded' => 1));
					}
					else
					{
						echo "failed to send email to officer at this address: \n";
						$this->Admin_model->write_error_into_log("Error in submitting email notification to officers.");
					}
                        
                        
                        }
            
        }
}