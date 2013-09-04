<?php
class Record_model extends CI_Model {

    /**
     * Holds an array of tables used
     *
     * @var array
     * */
    public $tables = array();

    /**
     * activation code
     *
     * @var string
     * */
    public $activation_code;

    /**
     * forgotten password key
     *
     * @var string
     * */
    public $forgotten_password_code;

    /**
     * new password
     *
     * @var string
     * */
    public $new_password;

    /**
     * Identity
     *
     * @var string
     * */
    public $identity;

    /**
     * Where
     *
     * @var array
     * */
    public $_ion_where = array();

    /**
     * Select
     *
     * @var array
     * */
    public $_ion_select = array();

    /**
     * Like
     *
     * @var array
     * */
    public $_ion_like = array();

    /**
     * Limit
     *
     * @var string
     * */
    public $_ion_limit = NULL;

    /**
     * Offset
     *
     * @var string
     * */
    public $_ion_offset = NULL;

    /**
     * Order By
     *
     * @var string
     * */
    public $_ion_order_by = NULL;

    /**
     * Order
     *
     * @var string
     * */
    public $_ion_order = NULL;

    /**
     * Hooks
     *
     * @var object
     * */
    protected $_ion_hooks;

    /**
     * Response
     *
     * @var string
     * */
    protected $response = NULL;

    /**
     * message (uses lang file)
     *
     * @var string
     * */
    protected $messages;

    /**
     * error message (uses lang file)
     *
     * @var string
     * */
    protected $errors;

    /**
     * error start delimiter
     *
     * @var string
     * */
    protected $error_start_delimiter;

    /**
     * error end delimiter
     *
     * @var string
     * */
    protected $error_end_delimiter;

    /**
     * caching of users and their groups
     *
     * @var array
     * */
    public $_cache_user_in_group = array();

    /**
     * caching of groups
     *
     * @var array
     * */
    protected $_cache_groups = array();

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->config('ion_auth', TRUE);
        $this->load->helper('cookie');
        $this->load->helper('date');
        $this->lang->load('ion_auth');

        //initialize db tables data
        $this->tables = $this->config->item('tables', 'ion_auth');

        //initialize data
        $this->identity_column = $this->config->item('identity', 'ion_auth');
        $this->store_salt = $this->config->item('store_salt', 'ion_auth');
        $this->salt_length = $this->config->item('salt_length', 'ion_auth');
        $this->join = $this->config->item('join', 'ion_auth');


        //initialize hash method options (Bcrypt)
        $this->hash_method = $this->config->item('hash_method', 'ion_auth');
        $this->default_rounds = $this->config->item('default_rounds', 'ion_auth');
        $this->random_rounds = $this->config->item('random_rounds', 'ion_auth');
        $this->min_rounds = $this->config->item('min_rounds', 'ion_auth');
        $this->max_rounds = $this->config->item('max_rounds', 'ion_auth');


        //initialize messages and error
        $this->messages = array();
        $this->errors = array();
        $this->message_start_delimiter = $this->config->item('message_start_delimiter', 'ion_auth');
        $this->message_end_delimiter = $this->config->item('message_end_delimiter', 'ion_auth');
        $this->error_start_delimiter = $this->config->item('error_start_delimiter', 'ion_auth');
        $this->error_end_delimiter = $this->config->item('error_end_delimiter', 'ion_auth');

        //initialize our hooks object
        $this->_ion_hooks = new stdClass;

        //load the bcrypt class if needed
        if ($this->hash_method == 'bcrypt') {
            if ($this->random_rounds) {
                $rand = rand($this->min_rounds, $this->max_rounds);
                $rounds = array('rounds' => $rand);
            } else {
                $rounds = array('rounds' => $this->default_rounds);
            }

            $this->load->library('bcrypt', $rounds);
        }

        $this->trigger_events('model_constructor');
    }

   
   
    public function limit($limit) {
        $this->trigger_events('limit');
        $this->_ion_limit = $limit;

        return $this;
    }

    public function offset($offset) {
        $this->trigger_events('offset');
        $this->_ion_offset = $offset;

        return $this;
    }

    public function where($where, $value = NULL) {
        $this->trigger_events('where');

        if (!is_array($where)) {
            $where = array($where => $value);
        }

        array_push($this->_ion_where, $where);

        return $this;
    }

    public function like($like, $value = NULL) {
        $this->trigger_events('like');

        if (!is_array($like)) {
            $like = array($like => $value);
        }

        array_push($this->_ion_like, $like);

        return $this;
    }

    public function select($select) {
        $this->trigger_events('select');

        $this->_ion_select[] = $select;

        return $this;
    }

    public function order_by($by, $order = 'desc') {
        $this->trigger_events('order_by');

        $this->_ion_order_by = $by;
        $this->_ion_order = $order;

        return $this;
    }

    public function row() {
        $this->trigger_events('row');

        $row = $this->response->row();
        $this->response->free_result();

        return $row;
    }

    public function row_array() {
        $this->trigger_events(array('row', 'row_array'));

        $row = $this->response->row_array();
        $this->response->free_result();

        return $row;
    }

    public function result() {
        $this->trigger_events('result');

        $result = $this->response->result();
        $this->response->free_result();

        return $result;
    }

    public function result_array() {
        $this->trigger_events(array('result', 'result_array'));

        $result = $this->response->result_array();
        $this->response->free_result();

        return $result;
    }

    public function num_rows() {
        $this->trigger_events(array('num_rows'));

        $result = $this->response->num_rows();
        $this->response->free_result();

        return $result;
    }

    

    public function remove_hook($event, $name) {
        if (isset($this->_ion_hooks->{$event}[$name])) {
            unset($this->_ion_hooks->{$event}[$name]);
        }
    }

    public function remove_hooks($event) {
        if (isset($this->_ion_hooks->$event)) {
            unset($this->_ion_hooks->$event);
        }
    }

    protected function _call_hook($event, $name) {
        if (isset($this->_ion_hooks->{$event}[$name]) && method_exists($this->_ion_hooks->{$event}[$name]->class, $this->_ion_hooks->{$event}[$name]->method)) {
            $hook = $this->_ion_hooks->{$event}[$name];

            return call_user_func_array(array($hook->class, $hook->method), $hook->arguments);
        }

        return FALSE;
    }

    public function trigger_events($events) {
        if (is_array($events) && !empty($events)) {
            foreach ($events as $event) {
                $this->trigger_events($event);
            }
        } else {
            if (isset($this->_ion_hooks->$events) && !empty($this->_ion_hooks->$events)) {
                foreach ($this->_ion_hooks->$events as $name => $hook) {
                    $this->_call_hook($events, $name);
                }
            }
        }
    }

    /**
     * set_message_delimiters
     *
     * Set the message delimiters
     *
     * @return void
     * @author Ben Edmunds
     * */
    public function set_message_delimiters($start_delimiter, $end_delimiter) {
        $this->message_start_delimiter = $start_delimiter;
        $this->message_end_delimiter = $end_delimiter;

        return TRUE;
    }

    /**
     * set_error_delimiters
     *
     * Set the error delimiters
     *
     * @return void
     * @author Ben Edmunds
     * */
    public function set_error_delimiters($start_delimiter, $end_delimiter) {
        $this->error_start_delimiter = $start_delimiter;
        $this->error_end_delimiter = $end_delimiter;

        return TRUE;
    }

    /**
     * set_message
     *
     * Set a message
     *
     * @return void
     * @author Ben Edmunds
     * */
    public function set_message($message) {
        $this->messages[] = $message;

        return $message;
    }

    /**
     * messages
     *
     * Get the messages
     *
     * @return void
     * @author Ben Edmunds
     * */
    public function messages() {
        $_output = '';
        foreach ($this->messages as $message) {
            $messageLang = $this->lang->line($message) ? $this->lang->line($message) : '##' . $message . '##';
            $_output .= $this->message_start_delimiter . $messageLang . $this->message_end_delimiter;
        }

        return $_output;
    }

    /**
     * messages as array
     *
     * Get the messages as an array
     *
     * @return array
     * @author Raul Baldner Junior
     * */
    public function messages_array($langify = TRUE) {
        if ($langify) {
            $_output = array();
            foreach ($this->messages as $message) {
                $messageLang = $this->lang->line($message) ? $this->lang->line($message) : '##' . $message . '##';
                $_output[] = $this->message_start_delimiter . $messageLang . $this->message_end_delimiter;
            }
            return $_output;
        } else {
            return $this->messages;
        }
    }

    /**
     * set_error
     *
     * Set an error message
     *
     * @return void
     * @author Ben Edmunds
     * */
    public function set_error($error) {
        $this->errors[] = $error;

        return $error;
    }

    /**
     * errors
     *
     * Get the error message
     *
     * @return void
     * @author Ben Edmunds
     * */
    public function errors() {
        $_output = '';
        foreach ($this->errors as $error) {
            $errorLang = $this->lang->line($error) ? $this->lang->line($error) : '##' . $error . '##';
            $_output .= $this->error_start_delimiter . $errorLang . $this->error_end_delimiter;
        }

        return $_output;
    }

    /**
     * errors as array
     *
     * Get the error messages as an array
     *
     * @return array
     * @author Raul Baldner Junior
     * */
    public function errors_array($langify = TRUE) {
        if ($langify) {
            $_output = array();
            foreach ($this->errors as $error) {
                $errorLang = $this->lang->line($error) ? $this->lang->line($error) : '##' . $error . '##';
                $_output[] = $this->error_start_delimiter . $errorLang . $this->error_end_delimiter;
            }
            return $_output;
        } else {
            return $this->errors;
        }
    }

    protected function _filter_data($table, $data) {
        $filtered_data = array();
        $columns = $this->db->list_fields($table);

        if (is_array($data)) {
            foreach ($columns as $column) {
                if (array_key_exists($column, $data))
                    $filtered_data[$column] = $data[$column];
            }
        }

        return $filtered_data;
    }

    function general() {

        //SAMPLE
        /* $this->load->library('MyMenu');
          $menu = new MyMenu; */
        //$data['menu'] 		= $menu->show_menu();
        /* $data['years']	 	= array('2007'=>'2007',
          '2008'=>'2008',
          '2009'=>'2009'); */

        //PERSONAL DETAILS
        $data['fullname'] = 'Fullname';
        $data['surname'] = 'Surname';
        $data['maiden_name'] = 'Maiden name';
		$data['family_no'] = 'Family No';
        $data['IC_no'] = 'IC No';

        $data['nationality'] = 'Nationality';
        $data['nationalities'] = array(
            'American' => 'American',
            'Australian' => 'Australian',
            'Bangladeshi' => 'Bangladeshi',
            'British' => 'British',
            'English' => 'English',
            'French' => 'French',
            'Indonesian' => 'Indonesian',
            'Japanese' => 'Japanese',
            'Malaysian' => 'Malaysian',
            'Philippine' => 'Philippine',
            'Singaporean' => 'Singaporean',
            'Saudi Arabian' => 'Saudi Arabian',
            'Thai' => 'Thai'
        );
        /*
         */
		 $data['gender'] = 'Gender';
		 $data['genderTypes'] = array(
            'Male' => 'Male',
            'Female' => 'Female'
        );
        $data['DOB'] = 'Date of birth';
		$data['place_of_birth'] = 'Place of birth';
		$data['still_alive_flag'] = 'Still alive?';
		$data['DOD'] = 'Date of death';
		$data['reason_of_death'] = 'Reason of death';
        $data['pedigree_label'] = 'Pedigree label';
        $data['gender'] = 'Gender';
        $data['ethinicity'] = 'Ethnicity';
		
        $data['blood_group'] = 'Blood group';
        $data['comment'] = 'Comment';
        $data['hospital_no'] = 'Hospital No';
		$data['private_patient_no'] = 'Private Patient No';
       
		$data['marital_status'] = 'Marital status';
		$data['marital_status_lists'] = array(
            'Single' => 'Single',
            'Married' => 'Married',
			'Divorced' => 'Divorced'
        );
		$data['is_blood_card_exist'] = 'Is blood card exist?';
		$data['blood_card_location'] = 'Blood card location';
		
		$data['address'] = 'Address';
		$data['home_phone'] = 'Home phone';
		$data['cell_phone'] = 'Mobile phone';
		$data['work_phone'] = 'Work phone';
		$data['height'] = 'Height';
		$data['weight'] = 'Weight';
		$data['BMI'] = 'BMI';
		$data['highest_level_of_education'] = 'Highest level of education';
		
		$data['income_level'] = 'Income level';
		$data['contact_person_name'] = 'Contact person\'s name';
		$data['contact_person_phone_number'] = 'Contact person\'s phone';
		$data['contact_person_relationship'] = 'Contact person\'s relationship';
		$data['address'] = 'Address';
		$data['address'] = 'Address';
		$data['address'] = 'Address';
		
        //FAMILY DETAILS
		$data['father_fullname'] = 'Father\'s fullname';
        $data['father_surname'] = 'Father surname';
        $data['father_maiden_name'] = 'Father maiden name';
        $data['father_ethnicity'] = 'Father ethnicity';
		$data['father_town_residence'] = 'Father\'s town of residence';
		$data['father_DOB'] = 'Father\'s date of birth';
		$data['father_still_alive_flag'] = 'Father is still alive?';
		$data['father_DOD'] = 'Father\'s date of dead';
        $data['father_is_cancer_diagnosed'] = 'Is father diagnosed with cancer?';
        $data['father_date_of_diagnosis'] = 'Date of diagnosis';
        $data['father_cancer_name'] = 'Father\'s cancer\'s name';
		$data['father_age_of_diagnosis'] = 'Father\'s age at diagnosis';
		$data['father_diagnosis_other_details'] = 'Father\'s diagnosis details';
		$data['father_no_of_brothers'] = 'Total no. of brothers';
		$data['father_no_of_sisters'] = 'Total no. of sisters';
        $data['father_no_female_children'] = 'Total no. of female children';
        $data['father_no_male_children'] = 'Total no. of male children';
        $data['father_no_of_first_degree'] = 'Total no. of first degree';
		$data['father_no_of_second_degree'] = 'Total no. of second degree';
		$data['father_no_of_third_degree'] = 'Total no. of third degree';
		$data['father_vital_status'] = 'Father\'s vital status';
		$data['father_mach_score_at_consent'] = 'Father\'s mach score at consent';
        $data['father_mach_score_past_consent'] = 'Father\'s mach score past consent';
        $data['father_FH_category'] = 'Father\'s FH category';
		
		$data['mother_fullname'] = 'Mother\'s fullname';
        $data['mother_surname'] = 'Mother surname';
        $data['mother_maiden_name'] = 'Mother maiden name';
        $data['mother_ethnicity'] = 'Mother ethnicity';
		$data['mother_town_residence'] = 'Mother\'s town of residence';
		$data['mother_DOB'] = 'Mother\'s date of birth';
		$data['mother_still_alive_flag'] = 'Mother is still alive?';
		$data['mother_DOD'] = 'Mother\'s date of dead';
        $data['mother_is_cancer_diagnosed'] = 'Is mother diagnosed with cancer?';
        $data['mother_date_of_diagnosis'] = 'Date of diagnosis';
        $data['mother_cancer_name'] = 'Mother\'s cancer\'s name';
		$data['mother_age_of_diagnosis'] = 'Mother\'s age at diagnosis';
		$data['mother_diagnosis_other_details'] = 'Mother\'s diagnosis details';
		$data['mother_no_of_brothers'] = 'Total no. of brothers';
		$data['mother_no_of_sisters'] = 'Total no. of sisters';
        $data['mother_no_female_children'] = 'Total no. of female children';
        $data['mother_no_male_children'] = 'Total no. of male children';
        $data['mother_no_of_first_degree'] = 'Total no. of first degree';
		$data['mother_no_of_second_degree'] = 'Total no. of second degree';
		$data['mother_no_of_third_degree'] = 'Total no. of third degree';
		$data['mother_vital_status'] = 'Mother\'s vital status';
		$data['mother_mach_score_at_consent'] = 'Mother\'s mach score at consent';
        $data['mother_mach_score_past_consent'] = 'Mother\'s mach score past consent';
        $data['mother_FH_category'] = 'Mother\'s FH category';
		
		//Studies, Mammo, Cancer & Diagnosis Details
		//$data[''] = ''; (TEMPLATE)
			
		//STUDIES
		$data['studies_name'] = 'Studies Name';
		$data['studies_name_lists'] = array(
            'MyBrCa' => 'MyBrCa',
            'EpiBrCa' => 'EpiBrCa',
			'OvaCa' => 'OvaCa',
			'Mammo' => 'Mammo'
        );
		$data['date_at_consent'] = 'Date at consent';
		$data['age_at_consent'] = 'Age at consent';
		$data['is_double_consent_flag'] = 'Is double consent?';
		$data['double_consent_details'] = 'Double consent details';
		$data['consent_given_by'] = 'Consent given by';
		$data['consent_response'] = 'Consent response';
		$data['consent_version'] = 'Consent version';
		$data['relations_to_study'] = 'Relations to study';
		$data['referral_to'] = 'Referral to'; 
		$data['referral_to_service'] = 'Referral to service'; 
		$data['referral_date'] = 'Referral date'; 
		$data['referral_source'] = 'Referral source'; 
		
		//MAMMO
		$data['year_of_first_mammogram'] = 'Year of first mammogram'; 
		$data['age_at_first_mammogram'] = 'Age at first mammogram'; 
		$data['date_of_recent_mammogram'] = 'Date of recent mammogram'; 
		$data['screening_center'] = 'Screening center'; 
		$data['total_no_of_mammogram'] = 'Total no. of mammogram'; 
		$data['screening_interval'] = 'Screening interval'; 
		$data['abnormality_mammo_flag'] = 'Is abnormality detected?'; 
		$data['mammo_left_right_breast_side'] = 'Left/right breast side'; 
		$data['mammo_left_right_breast_side_lists'] = array(
            'left' => 'Left',
            'right' => 'Right'
        );
		$data['mammo_upper_below_breast_side'] = 'Upper/below breast side'; 
		$data['mammo_upper_below_breast_side_lists'] = array(
            'upper' => 'Upper',
            'below' => 'Below'
        );
		$data['mammo_breast_other_descriptions'] = 'Other details'; 
		
		//Upload raw/processed images
		$data['upload_raw_images_one'] = 'Upload first raw images';
		$data['upload_raw_images_two'] = 'Upload second raw images';
		$data['upload_raw_images_three'] = 'Upload third raw images';
		$data['upload_raw_images_four'] = 'Upload fourth raw images';
		$data['upload_processed_images_one'] = 'Upload first processed images';
		$data['upload_processed_images_two'] = 'Upload second processed images';
		$data['upload_processed_images_three'] = 'Upload third processed images';
		$data['upload_processed_images_four'] = 'Upload fourth processed images';
       
		$data['name_of_radiologist'] = 'Radiologist name'; 
		$data['action_suggested_on_mammo_report'] = 'Action suggested on mammogram report'; 
		$data['had_ultrasound_flag'] = 'Had ultrasound done before?'; 
		$data['total_no_of_ultrasound'] = 'Total no. of ultrasound'; 
		$data['abnormality_ultrasound_flag'] = 'Is abnormality detected?'; 
		$data['mammo_ultrasound_details'] = 'Ultrasound details'; 
		$data['had_MRI_flag'] = 'Had MRI done before?'; 
		$data['total_no_of_MRI'] = 'Total no. of MRI'; 
		$data['abnormality_MRI_flag'] = 'Is abnormality detected?'; 
		$data['mammo_MRI_details'] = 'MRI details'; 
		$data['had_surgery_for_benign_lump_or_cyst_flag'] = 'Had done surgery for benign lumpr or cyst before?'; 
		$data['mammo_benign_lump_cyst_details'] = 'Details';
		$data['other_screening_flag'] = 'Had other screenings done before?'; 
		$data['screening_name'] = 'Screening name'; 
		$data['total_no_of_screening'] = 'Total no. of screenings'; 
		$data['age_at_screening'] = 'Age at screening';
		$data['place_of_screening'] = 'Place of screening';
		$data['screening_results'] = 'Screening results';
		
		//CANCER
		
		$data['breast_cancer_diagnosed_flag'] = 'Is breast cancer diagnosed?';
		$data['breast_cancer_diagnosed_flag'] = 'Is breast cancer diagnosed?';
		$data['breast_cancer_diagnosed_flag'] = 'Is breast cancer diagnosed?';
		$data['patient_cancer_name'] = 'Cancer name';
		$data['patient_cancer_name_lists'] = array(
            'Breast' => 'Breast',
            'Ovaries' => 'Ovaries',
            'Prostate' => 'Prostate',
            'Cervical' => 'Cervical',
            'Lung' => 'Lung',
            'Colorectal' => 'Colorectal',
            'Uterine' => 'Uterine',
            'Peritaneum' => 'Peritaneum',
            'Pancreatic' => 'Pancreatic',
            'Nasopharyngeal' => 'Nasopharyngeal',
            'Liver' => 'Liver',
            'Gastric' => 'Gastric',
            'Others' => 'Others',
			'None' => 'None'
        );
		$data['primary_diagnosis'] = 'Is primary diagnosis?';
		$data['cancer_site'] = 'Select site';
		$data['patient_cancer_site_lists'] = array(
            'Left Breast' => 'Left Breast',
            'Right Breast' => 'Right Breast',
            'Left Ovary' => 'Left Ovary',
            'Right Ovary' => 'Right Ovary'
        );
		$data['cancer_site_details'] = 'Details';
		
		
		$data['age_of_diagnosis'] = 'Age of diagnosis';
		$data['date_of_diagnosis'] = 'Date of diagnosis';
		$data['cancer_diagnosis_center'] = 'Diagnosis center';
		$data['cancer_doctor_name'] = 'Doctor\'s name';
		$data['detected_by'] = 'Detected by';
		$data['patient_cancer_treatment_name'] = 'Treatment name';
		$data['patient_cancer_treatment_name_lists'] = array(
            'Lumpectomy' => 'Lumpectomy',
            'Mastectomy' => 'Mastectomy',
            'Healthy Breast Removed' => 'Healthy Breast Removed',
            'Hysterectomy' => 'Hysterectomy',
            'Oophorectomy' => 'Oophorectomy',
            'Radiotherapy' => 'Radiotherapy',
            'Chemotherapy' => 'Chemotherapy',
            'Tamoxifen' => 'Tamoxifen',
            'Other Hormonal Treatment' => 'Other Hormonal Treatment',
            'Transplantation' => 'Transplantation',
            'Neo Adjurant' => 'Neo Adjurant',
            'Sterilisation' => 'Sterilisation',
            'Tubal Ligation' => 'Tubal Ligation',
			'Unilateral Salpingo Oophorectomy' => 'Unilateral Salpingo Oophorectomy',
			'Bilateral Salpingo Oophorectomy' => 'Bilateral Salpingo Oophorectomy',
			'TAHBSO' => 'TAHBSO',
			'None' => 'None'
        );
		$data['treatment_start_date'] = 'Treatment start date';
		$data['treatment_end_date'] = 'Treatment end date';
		$data['treatment_drug_dose'] = 'Treatment drug dose';
		$data['is_recurrence_flag'] = 'Is there a recurrence cancer?';
		$data['recurrence_site'] = 'Recurrence site';
		$data['recurrence_date'] = 'Recurrence date';
		$data['patient_cancer_recurrence_treatment_name'] = 'Treatment for recurrence';
		
		//DIAGNOSIS
		$data['patient_other_diagnosis_name'] = 'Diagnosis name'; 
		$data['diagnosis_name_lists'] = array(
            'Diabetes' => 'Diabetes',
            'Hypertension' => 'Hypertension',
            'Thyroid' => 'Thyroid',
            'Cardiovaskular Disease' => 'Cardiovaskular Disease',
            'Endochrine' => 'Endochrine',
            'Congenital' => 'Congenital',
            'Mental Disorder' => 'Mental Disorder'
        );
		$data['diagnosis_details'] = 'Diagnosis details';
		$data['diagnosis_age'] = 'Age at diagnosis'; 
		$data['year_of_diagnosis'] = 'Year of diagnosis'; 
		$data['is_on_medication_flag'] = 'Is on medication?'; 
		$data['medication_details'] = 'Medication details'; 
		$data['diagnosis_center'] = 'Diagnosis center'; 
		$data['diagnosis_doctor_name'] = 'Diagnosis doctor\'s name'; 
		
		
		//Lifestyle Factors
		$data['self_image_at_7years'] = 'Self image at 7 years old';
        $data['self_image_at_18years'] = 'Self image at 18 years old';
        $data['self_image_now'] = 'Self image now';
		$data['self_image_lists'] = array(
            '1' => '1',
            '2' => '2',
            '3' => '3',
            '4' => '4',
            '5' => '5',
            '6' => '6',
            '7' => '7',
            '8' => '8',
            '9' => '9',
            '10' => '10'
        );
		 $data['pa_activities_lists'] = array(
            'Never' => 'Never',
            'Less than 1 hour per week' => 'Less than 1 hour per week',
            '1-2 hour per week' => '1-2 hour per week',
            'More than 2 hours per week' => 'More than 2 hours per week'
        );
		
		$data['pa_at_childhood'] = 'Childhood (before 18 years old)';
        $data['pa_at_adulthood'] = '18 - 30 years old';
		$data['pa_now'] = 'Most recent years';
		
		$data['cigarettes_smoked_flag'] = 'Patient has ever smoked cigarettes?';
		$data['cigarettes_still_smoked_flag'] = 'Patient still smoking?'; 
		$data['total_smoked_years'] = 'Total years of smoking'; 
		$data['cigarettes_count_at_teen'] = 'Before 20 years old'; 
		$data['cigarettes_count_at_twenties'] = '20 - 29 years'; 
		$data['cigarettes_count_at_thirties'] = '30-39 years'; 
		$data['cigarettes_count_at_forties'] = '40 - 49 years'; 
		$data['cigarettes_count_at_fifties'] = '50 - 59 years'; 
		$data['cigarettes_count_at_sixties_and_above'] = '60 year and more'; 
		$data['cigarettes_count_one_year_before_diagnosed'] = '1 year prior to cancer diagnosis'; 
		$data['cigarettes_average_count_lists'] = array(
            '0' => '0',
            '1-5' => '1-5',
            '6-10' => '6-10',
            '11-20' => '11-20',
            '>20' => '>20'
        );
		$data['alcohol_drunk_flag'] = 'Alcohol drunk more than once a month on average?'; 
		$data['alcohol_average'] = 'Alcohol average'; 
		$data['alcohol_average_details'] = 'Average details'; 
		$data['coffee_drunk_flag'] = 'Coffee drunk regularly?'; 
		$data['coffee_age'] = 'Start age'; 
		$data['coffee_average'] = 'Coffee average'; 
		$data['tea_drunk_flag'] = 'tea drunk regularly'; 
		$data['tea_age'] = 'Start age'; 
		$data['tea_average'] = 'Tea average'; 
		$data['tea_type'] = 'Tea type'; 
		$data['alcohol_drink_average_lists'] = array(
            '1 glass per day' => '1 glass per day',
            '1 glass per week' => '1 glass per week',
            '1 glass per month' => '1 glass per month',
            'Other, please specify' => 'Other, please specify'
        );
		$data['coffee_tea_drink_average_lists'] = array(
            '1 cup per week/less' => '1 cup per week/less',
            '1 cup per day' => '1 cup per day',
            '1-5 cups per day' => '1-5 cups per day',
            '>5 cups per day' => '>5 cups per day'
        );
		$data['tea_type_lists'] = array(
            'Black tea' => 'Black tea',
            'Green tea' => 'Green tea',
            'Herbal tea' => 'Herbal tea',
            'Other, please specify' => 'Other, please specify'
        );
		$data['soya_bean_drunk_flag'] = 'Soya bean milk drunk regularly?'; 
		$data['soya_bean_average'] = 'Soya bean average'; 
		$data['soya_products_flag'] = 'Soya products eaten regularly?'; 
		$data['soya_products_average'] = 'Soya products average'; 
		$data['soya_products_lists'] = array(
            'Every meal' => 'Every meal',
            'Every day' => 'Every day',
            'Once a week' => 'Once a week',
            'Other, please specify' => 'Other, please specify'
        );
		$data['diabetes_flag'] = 'Patient has diabetes?'; 
		$data['medicine_for_diabetes_flag'] = 'Current taking any diabetes medication?'; 
		$data['diabates_medicine_name'] = 'Medicine name'; 
			
		$data['age_period_starts'] = 'Age period starts'; 
		$data['still_period_flag'] = 'Still having period?'; 
		$data['period_type'] = 'Period regularity'; 
		$data['period_cycle_days'] = 'Period cycle days'; 
		$data['period_cycle_days_other_details'] = 'Other details'; 
		$data['age_period_stops'] = 'Age period stops'; 
		$data['date_period_stops'] = 'Date period stops'; 
		$data['reason_period_stops'] = 'Reason period stops'; 
		$data['period_type_lists'] = array(
            'Regular' => 'Regular',
            'Irregular' => 'Irregular'
        );
		$data['period_cycle_days_lists'] = array(
            '28' => '28',
            '29' => '29',
            '30' => '30',
            '31' => '31',
			'Other' => 'Other'
        );
		$data['reason_period_stops_lists'] = array(
            'It stopped itself' => 'It stopped itself',
            'Uterus was removed' => 'Uterus was removed',
            'Ovaries removed' => 'Ovaries removed',
            'Medication/Chemotherapy' => 'Medication/Chemotherapy',
			'Other reason' => 'Other reason'
        );
		$data['reason_period_stops_other_details'] = 'Other details'; 
		
		$data['pregnant_flag'] = 'Patient has been pregnant?'; 
		$data['pregnancy_type'] = 'Pregnancy type'; 
		$data['pregnancy_type_lists'] = array(
            'Child' => 'Child',
            'Stillborn' => 'Stillborn',
            'Miscarriage' => 'Miscarriage'
        );
		$data['child_gender'] = 'Gender'; 
		$data['child_birthyear'] = 'Birthyear'; 
		$data['child_birthweight'] = 'Birthweight'; 
		$data['child_breastfeeding_duration'] = 'Breastfeeding'; 
		
		
		$data['infertility_testing_flag'] = 'Patient has been treated for infertility?'; 
		$data['infertility_treatment_details'] = 'Treatment details'; 
		$data['contraceptive_pills_flag'] = 'Has ever used contraceptive pills?'; 
		$data['contraceptive_pills_details'] = 'Details'; 
		$data['currently_taking_contraceptive_pills_flag'] = 'Is currently taking contraceptive pills?'; 
		$data['contraceptive_start_date'] = 'Consumption start date'; 
		$data['contraceptive_end_date'] = 'Consumption end date'; 
		$data['HRT_flag'] = 'Has ever used hormone replacement therapy(HRT)?'; 
		$data['HRT_details'] = 'Details'; 
		$data['currently_using_HRT_flag'] = 'Is currently using HRT?'; 
		$data['HRT_start_date'] = 'Therapy start date'; 
		$data['HRT_end_date'] = 'Therapy end date'; 
		$data['had_gnc_surgery_flag'] = 'Has ever had gynaecological surgery?'; 
		$data['gnc_surgery_year'] = 'Surgery year'; 
		$data['gnc_treatment_name'] = 'Surgery type'; 
		$data['gnc_treatment_name_other_details'] = 'Surgery other details'; 
		
		$data['gnc_treatment_lists'] = array(
            'Sterilisation' => 'Lumpectomy',
            'Tubal Ligation' => 'Mastectomy',
            'Removal of one ovary' => 'Healthy Breast Removed',
            'Removal of both ovaries (oophorectomy)' => 'Removal of both ovaries (oophorectomy)',
            'Removal of one ovary & fallopian tube (Unlateral salpingo-oophorectomy)' => 'Removal of one ovary & fallopian tube (Unlateral salpingo-oophorectomy)',
            'Removal of both ovaries & fallopian tube (Bilateral salpingo-oophorectomy)' => 'Removal of both ovaries & fallopian tube (Bilateral salpingo-oophorectomy)',
            'Removal of uterus (hysterectomy)' => 'Removal of uterus (hysterectomy)',
            'Removal of uterus & part of cervix (hysterectomy)' => 'Removal of uterus & part of cervix(hysterectomy)',
            'Removal of uterus, cervix, ovaries & fallopian tube (Total hysterectomy/TAHBSO)' => 'Removal of uterus, cervix, ovaries & fallopian tube (Total hysterectomy/TAHBSO)',
			'Other, please specify' => 'Other, please specify'
        );
		
		$data[''] = ''; 
		
		return $data;
    }
    
    public function insert_patient_record($record_data) {
        $data = array(
            
        );        
        $record_data = array_merge($this->_filter_data($this->tables['patient'], $data), $record_data);
        $this->db->insert($this->tables['patient'], $record_data);

	$id = $this->db->insert_id();
        return $id;
    }
    
    public function insert_patient_family_record($record_data){
                $data = array(
            
        );        
        $record_data = array_merge($this->_filter_data($this->tables['patient_relatives'], $data), $record_data);
        $this->db->insert($this->tables['patient_relatives'], $record_data);

	$id = $this->db->insert_id();
        return $id;
    }
    
    public function get_patient_record($ic_no){
    
		$p_record = $this->db->get_where('patient', array('ic_no' => $ic_no));
        $patient_record = $p_record->row_array();
        $p_record->free_result();  
        
        return $patient_record;
    }
    
    public function get_list_patient_record(){
    
		$l_record = $this->db->get('patient');
        $patient_list = $l_record->result_array();
        $l_record->free_result();  
        
        return $patient_list;
    }


}


?>
