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
            
                $newdate =  date("Y-m-1") ;
                        
                $today = date("Y-m-d");
                        
                if($today == $newdate){
                     
                    $this->email_monthly_notification();
                            
                }
	
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
        
        function email_monthly_notification() {
            
            $month = date("Y-m", strtotime("-1 months"));

        $officer_email = $this->Email_notification_model->get_admin_email_addresses();

        foreach ($officer_email as $list) {
            
            $SD_MyBrca = $this->Email_notification_model->get_total_patient(6,$month);
            $UM_MyBrca = $this->Email_notification_model->get_total_patient(1,$month);
            $MyOvca = $this->Email_notification_model->get_total_patient(3,$month);
            $MyEpiBrca_b = $this->Email_notification_model->get_total_patient(8,$month);
            $MyEpiBrca_f = $this->Email_notification_model->get_total_patient(9,$month);
            $My1000mammo = $this->Email_notification_model->get_total_patient(7,$month);
            
            
            
            $subject = 'Counselling Date Reminder';
            $sender = $list['email'];

            $MESSAGE_BODY = "This is monthly report for new patient:" . "<br>";
            $MESSAGE_BODY .= "" . "<br>";
            $data['SD_MyBrca'] = count($SD_MyBrca);
            $data['UM_MyBrca'] = count($UM_MyBrca);
            $data['MyOvca'] = count($MyOvca);
            $data['MyEpiBrca_b'] = count($MyEpiBrca_b);
            $data['MyEpiBrca_f'] = count($MyEpiBrca_f);
            $data['My1000mammo'] = count($My1000mammo);
            
            $MESSAGE_BODY .= $this->load->view('report/monthly_report', $data, true);
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

            if ($email_send) {
                echo "Email sent successfully! \n";
            } else {
                echo "failed to send email to officer at this address: \n";
                $this->Admin_model->write_error_into_log("Error in submitting email notification to officers.");
            }
        }
    }

}