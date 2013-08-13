<?php

class Record_model extends CI_Model
  {
	function __construct()
    {
          parent::__construct();
    }
	
	 function general(){
	 
	 //SAMPLE
	/* $this->load->library('MyMenu');
	$menu = new MyMenu; */
	//$data['menu'] 		= $menu->show_menu();
	/*$data['years']	 	= array('2007'=>'2007',
	                            '2008'=>'2008',
								'2009'=>'2009');*/
								
	//PERSONAL DETAILS
	$data['fullname']	= 'Fullname';
	$data['surname']	 	= 'Surname';
	$data['maiden_name']	= 'Maiden Name';				
	$data['IC_no']	 	= 'IC No';
	
	$data['nationality']	= 'Nationality';
	$data['nationalities']	 	= array(
	                            'American'=>'American',
								'Australian'=>'Australian',
								'Bangladeshi'=>'Bangladeshi',
								'British'=>'British',
								'English'=>'English',
								'French'=>'French',
								'Indonesian'=>'Indonesian',
								'Japanese'=>'Japanese',
								'Malaysian'=>'Malaysian',
								'Philippine'=>'Philippine',
								'Singaporean'=>'Singaporean',
								'Saudi Arabian'=>'Saudi Arabian',
								'Thai'=>'Thai'
								);
	/*
	*/
	$data['DOB']	= 'DOB';		
	$data['pedigree_label']	= 'Pedigree Label';	
	$data['gender']	= 'Gender';	
	$data['ethinicity']	= 'Ethnicity';		
	$data['blood_group']	= 'Blood Group';	
	$data['comment']	= 'Comment';
	$data['hospital_no']	= 'Hospital Number';		
/* 	$data['DOB']	= 'DOB';	
	$data['DOB']	= 'DOB';
	$data['DOB']	= 'DOB';		
	$data['DOB']	= 'DOB';	
	$data['DOB']	= 'DOB';
	$data['DOB']	= 'DOB';		
	$data['DOB']	= 'DOB';	
	$data['DOB']	= 'DOB';
	$data['DOB']	= 'DOB';		
	$data['DOB']	= 'DOB';	
	$data['DOB']	= 'DOB'; */
	
	//FAMILY DETAILS
	$data['mother_fullname']	= 'Mother\'s Fullname';
	$data['mother_surname']	 	= 'Surname';
	$data['mother_maiden_name']	= 'Maiden Name';				
	$data['mother_IC_no']	 	= 'IC No';
	
	$data['mother_nationality']	= 'Nationality';	
	$data['mother_DOB']	= 'DOB';	
	$data['mother_town_residence']	= 'Town of Residence';
	return $data;	
  }
  }
?>
