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
        $data['fullname'] = 'Given name';
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
        $data['gender'] = 'Gender';
        $data['ethinicity'] = 'Ethnicity';

        $data['blood_group'] = 'Blood group';
        $data['comment'] = 'Comment';

        $data['hospital_no'] = 'Hospital No (MRN)';
        $data['private_patient_no'] = 'Patient No';
        $data['COGS_study_id'] = 'COGS study ID';
        $data['COGS_study_id_lists'] = array(
            'CIMBA' => 'CIMBA',
            'OCAC' => 'OCAC',
            'BCAC' => 'BCAC',
			'PRACTICAL' => 'PRACTICAL'
        );
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
        $data['other_phone'] = 'Other phone';
        $data['fax'] = 'Fax';
        $data['email'] = 'Email';
        $data['height'] = 'Height';
        $data['weight'] = 'Weight';
        $data['BMI'] = 'BMI';
        $data['highest_level_of_education'] = 'Highest level of education';

        $data['income_level'] = 'Income level';
        $data['income_level_lists'] = array(
            '<5,000' => '<5,000',
            '5-10,000' => '5-10,000',
            '10-50,000' => '10-50,000',
            '>50,000' => '>50,000'
        );
		$data['patient_comments'] = 'Comments';
		$data['total_no_of_male_siblings'] = 'Total male siblings';
		$data['total_no_of_female_siblings'] = 'Total female siblings';
		$data['total_no_of_affected_siblings'] = 'Total of affected siblings';
		$data['total_no_male_children'] = 'Total of male children';
		$data['total_no_female_children'] = 'Total of female children';
		$data['total_no_of_affected_children'] = 'Total of affected children';
		$data['total_no_of_first_degree'] = 'Total of first degree';
		$data['total_no_of_second_degree'] = 'Total of second degree';
		$data['total_no_of_third_degree'] = 'Total of third degree';
		
        $data['contact_person_name'] = 'Contact person\'s name';
        $data['contact_person_phone_number'] = 'Contact person\'s phone';
        $data['contact_person_relationship'] = 'Contact person\'s relationship';

        $data['status_source'] = 'Source';
        $data['status_source_lists'] = array(
            'JPN' => 'JPN',
            'Others' => 'Others',
            'Unknown' => 'Unknown'
        );
        $data['alive_status'] = 'Status';
        $data['alive_status_lists'] = array(
            'Alive' => 'Alive',
            'Dead' => 'Dead',
            'Unknown' => 'Unknown'
        );
        $data['status_gathered_date'] = 'Status collected on';


        //FAMILY DETAILS
        $data['father_fullname'] = 'Fullname';
        $data['father_surname'] = 'Surname';
        $data['father_maiden_name'] = 'Maiden name';
		$data['father_unknown_reason_is_adopted'] = 'Adoption';
		$data['father_unknown_reason_in_other_countries'] = 'In other country';
        $data['father_ethnicity'] = 'Ethnicity';
        $data['father_town_residence'] = 'Town of residence';
        $data['father_DOB'] = 'Date of birth';
        $data['father_still_alive_flag'] = 'Is still alive?';
        $data['father_DOD'] = 'Date of death';
        $data['father_is_cancer_diagnosed'] = 'Is diagnosed with cancer?';
        $data['father_date_of_diagnosis'] = 'Date of diagnosis';
        $data['father_cancer_name'] = 'Type of cancer';
		$data['father_other_cancer_name'] = 'Other cancer type';
        $data['father_age_of_diagnosis'] = 'Age at diagnosis';
        $data['father_diagnosis_other_details'] = 'Diagnosis details';
        $data['father_no_of_brothers'] = 'Total no. of brothers';
        $data['father_no_of_sisters'] = 'Total no. of sisters';
		$data['father_no_of_half_brothers'] = 'Total no. of half brothers';
        $data['father_no_of_half_sisters'] = 'Total no. of half sisters';
        $data['father_vital_status'] = 'Vital status';
        $data['father_comments'] = 'Comments';
        $data['father_mach_score_past_consent'] = 'Mach score past consent';
        $data['father_FH_category'] = 'FH category';
		
        $data['mother_fullname'] = 'Fullname';
        $data['mother_surname'] = 'Surname';
        $data['mother_maiden_name'] = 'Maiden name';
		$data['mother_unknown_reason_is_adopted'] = 'Adoption';
		$data['mother_unknown_reason_in_other_countries'] = 'In other country';
        $data['mother_ethnicity'] = 'Ethnicity';
        $data['mother_town_residence'] = 'Town of residence';
        $data['mother_DOB'] = 'Date of birth';
        $data['mother_still_alive_flag'] = 'Is still alive?';
        $data['mother_DOD'] = 'Date of death';
        $data['mother_is_cancer_diagnosed'] = 'Is diagnosed with cancer?';
        $data['mother_date_of_diagnosis'] = 'Date of diagnosis';
        $data['mother_cancer_name'] = 'Type of cancer';
		$data['mother_other_cancer_name'] = 'Other cancer type';
        $data['mother_age_of_diagnosis'] = 'Age at diagnosis';
        $data['mother_diagnosis_other_details'] = 'Diagnosis details';
        $data['mother_no_of_brothers'] = 'Total no. of brothers';
        $data['mother_no_of_sisters'] = 'Total no. of sisters';
		$data['mother_no_of_half_brothers'] = 'Total no. of half brothers';
        $data['mother_no_of_half_sisters'] = 'Total no. of half sisters';
        $data['mother_vital_status'] = 'Vital status';
        $data['mother_comments'] = 'Comments';
        $data['mother_mach_score_past_consent'] = 'Mach score past consent';
        $data['mother_FH_category'] = 'FH category';

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
        $data['referral_date'] = 'Referral to genetic counselling';
        $data['referral_source'] = 'Referral source';

        //MAMMO
        $data['year_of_first_mammogram'] = 'Date of first mammogram';
        $data['age_at_first_mammogram'] = 'Age at first mammogram';
        $data['date_of_recent_mammogram'] = 'Date of recent mammogram';
		$data['age_at_recent__mammogram'] = 'Age at recent mammogram';
        $data['screening_center'] = 'Screening centre';
        $data['total_no_of_mammogram'] = 'Total no. of mammogram';
        $data['screening_interval'] = 'Screening interval';
        $data['abnormality_mammo_flag'] = 'Abnormalities detected';
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
		$data['percentage_of_mammo_density'] = 'Percentage (%) of mammo density';
		$data['BIRADS_clinical_classification'] = 'BIRADS clinical classification';
		$data['BIRADS_density_classification'] = 'BIRADS density classification';
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
        $data['had_ultrasound_flag'] = 'Had ultrasound?';
        $data['total_no_of_ultrasound'] = 'Total no. of ultrasound';
        $data['abnormality_ultrasound_flag'] = 'Is abnormality detected?';
        $data['mammo_ultrasound_details'] = 'Comment';
        $data['had_MRI_flag'] = 'Had MRI?';
        $data['total_no_of_MRI'] = 'Total no. of MRI';
        $data['abnormality_MRI_flag'] = 'Is abnormality detected?';
        $data['mammo_MRI_details'] = 'Comment';
		$data['non_cancer_surgery_type'] = 'Surgery type';
		$data['reason_for_non_cancer_surgery'] = 'Reason for surgery';
		$data['date_of_non_cancer_surgery'] = 'Date of surgery';
		$data['age_at_non_cancer_surgery'] = 'Age at surgery';
        $data['had_surgery_for_benign_lump_or_cyst_flag'] = 'Had done surgery for benign lumpr or cyst before?';
        $data['mammo_benign_lump_cyst_details'] = 'Comment';
        $data['other_screening_flag'] = 'Had other screenings done before?';
        $data['screening_name'] = 'Screening type';
		$data['screening_name_lists'] = array(
			'Pap Smear' => 'Pap Smear',
			'Chest XRay' => 'Chest XRay',
			'Prostate Specific Antigen (PSA)' => 'Prostate Specific Antigen (PSA)',
			'Colonoscopy' => 'Colonoscopy',
			'Fecal Occult Blood Test (FOBT)' => 'Fecal Occult Blood Test (FOBT)',
			'Sigmoidoscopy' => 'Sigmoidoscopy',
			'Double Contrast Berium Enema (DCBE)' => 'Double Contrast Berium Enema (DCBE)'
		);
        $data['total_no_of_screening'] = 'Total no. of screenings';
        $data['age_at_screening'] = 'Age at screening';
        $data['place_of_screening'] = 'Screening centre';
        $data['screening_results'] = 'Screening results';

        //CANCER

        $data['cancer_invasive_type'] = 'Cancer type (invasive/non-invasive)';
		$data['cancer_invasive_type_lists'] = array(
			'Invasive' => 'Invasive',
			'Non-invasive' => 'Non-invasive'
		);
		$data['detected_by_other_details'] = 'Other';
        $data['detected_by_lists'] = array(
			'At a screening (mammography/ultrasound/MRI)' => 'At a screening (mammography/ultrasound/MRI)',
            'I felt a lump' => 'I felt a lump',
            'My doctor felt a lump' => 'My doctor felt a lump',
			'Other' => 'Other',
        );
		$data['breast_cancer_treatment_comments'] = 'Comments';
		$data['treatment_duration'] = 'Treatment duration';
        $data['breast_cancer_diagnosed_flag'] = 'Is breast cancer diagnosed?';
        $data['patient_cancer_name'] = 'Cancer name';
        $data['patient_cancer_name_lists'] = array(
			'None' => 'None',
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
            'Others' => 'Others'
        );
        $data['primary_diagnosis'] = 'Is primary diagnosis?';
        $data['cancer_site'] = 'Select site';
        $data['patient_cancer_sites_lists'] = array(
            'Left Breast' => 'Left Breast',
            'Right Breast' => 'Right Breast',
            'Left Ovary' => 'Left Ovary',
            'Right Ovary' => 'Right Ovary'
        );
		 $data['patient_cancer_site_lists'] = array(
            'Left' => 'Left',
            'Right' => 'Right'
        );
        $data['cancer_site_details'] = 'Details';


        $data['age_of_diagnosis'] = 'Age at diagnosis';
        $data['date_of_diagnosis'] = 'Date of diagnosis';
		$data['source_of_date_of_diagnosis'] = 'Source of date of diagnosis';
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
		$data['cancer_is_bilateral'] = 'Bilateral';
		$data['cancer_is_recurrent'] = 'Recurrent';
        $data['treatment_start_date'] = 'Treatment start date';
        $data['treatment_end_date'] = 'Treatment end date';
        $data['treatment_drug_dose'] = 'Treatment drug dose';
        $data['is_recurrence_flag'] = 'Is there a recurrence cancer?';
        $data['recurrence_site'] = 'Recurrence site';
        $data['recurrence_date'] = 'Recurrence date';
        $data['patient_cancer_recurrence_treatment_name'] = 'Treatment for recurrence';

		// OVARY CANCER
		$data['ovary_cancer_site'] = 'Select site';
		$data['ovary_cancer_invasive_type'] = 'Cancer type (invasive/non-invasive)';
		$data['ovary_primary_diagnosis'] = 'Is primary diagnosis?';
		$data['ovary_date_of_diagnosis'] = 'Date of diagnosis';
		$data['ovary_age_of_diagnosis'] = 'Age at diagnosis';
		$data['ovary_cancer_diagnosis_center'] = 'Diagnosis centre';
		$data['ovary_cancer_doctor_name'] = 'Doctor\'s name';
		$data['ovary_detected_by'] = 'Detected by';
		$data['ovary_detected_by_other_details'] = 'Other';
		$data['ovary_patient_cancer_treatment_name'] = 'Treatment name';
		$data['ovary_treatment_start_date'] = 'Treatment start date';
		$data['ovary_treatment_end_date'] = 'Treatment end date';
		$data['ovary_treatment_duration'] = 'Treatment duration';
		$data['ovary_cancer_treatment_comments'] = 'Comments';
		$data['ovary_cancer_is_bilateral'] = 'Bilateral';
		$data['ovary_cancer_is_recurrent'] = 'Recurrent';
		
		// OTHER CANCER
		
		$data['other_cancer_type'] = 'Cancer type';
		$data['other_date_of_diagnosis'] = 'Date of diagnosis';
		$data['other_age_of_diagnosis'] = 'Age at diagnosis';
		$data['other_cancer_diagnosis_center'] = 'Diagnosis centre';
		$data['other_cancer_doctor_name'] = 'Doctor\'s name';
		$data['other_cancer_comments'] = 'Comments';
		$data['other_patient_cancer_treatment_name'] = 'Treatment name';
		$data['other_treatment_start_date'] = 'Treatment start date';
		$data['other_treatment_end_date'] = 'Treatment end date';
		$data['other_treatment_duration'] = 'Treatment duration';
		$data['other_cancer_treatment_comments'] = 'Comments';
		
        //DIAGNOSIS
        $data['patient_other_diagnosis_name'] = 'Type of diseases';
        $data['diagnosis_name_lists'] = array(
			'None' => 'None',
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
        $data['year_of_diagnosis'] = 'Date of diagnosis';
        $data['is_on_medication_flag'] = 'Is on medication?';
        $data['medication_type_name'] = 'Type of medication';
        $data['diagnosis_center'] = 'Diagnosis center';
        $data['diagnosis_doctor_name'] = 'Diagnosis doctor\'s name';
		$data['medication_start_date'] = 'Medication start date';
		$data['medication_end_date'] = 'Medication end date';
		$data['medication_duration'] = 'Medication duration';
		$data['medication_comments'] = 'Comments';


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
        $data['alcohol_drunk_flag'] = 'Consumption more than once a month on average?';
        $data['alcohol_average'] = 'Alcohol frequency';
        $data['alcohol_average_details'] = 'Comments';
        $data['coffee_drunk_flag'] = 'Regular consumptions?';
        $data['coffee_age'] = 'Start age';
        $data['coffee_average'] = 'Coffee frequency';
        $data['tea_drunk_flag'] = 'Regular consumption?';
        $data['tea_age'] = 'Start age';
        $data['tea_average'] = 'Tea frequency';
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
		$data['tea_type_other'] = 'Other';
        $data['soya_bean_drunk_flag'] = 'Regular consumption?';
        $data['soya_bean_average'] = 'Soya bean frequency';
        $data['soya_products_flag'] = 'Soya product frequency';
        $data['soya_products_average'] = 'Soya products average';
        $data['soya_products_lists'] = array(
            'Every meal' => 'Every meal',
            'Every day' => 'Every day',
            'Once a week' => 'Once a week',
            'Other, please specify' => 'Other, please specify'
        );
		$data['soya_products_average_other'] = 'Other';
        $data['diabetes_flag'] = 'Patient has diabetes?';
        $data['medicine_for_diabetes_flag'] = 'Current taking any diabetes medication?';
        $data['diabates_medicine_name'] = 'Medicine name';

        $data['age_period_starts'] = 'Age of menarche';
        $data['still_period_flag'] = 'Still having period?';
        $data['period_type'] = 'Period regularity';
        $data['period_cycle_days'] = 'Period cycle days';
        $data['period_cycle_days_other_details'] = 'Comment';
        $data['age_period_stops'] = 'Age at menopause';
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
        $data['reason_period_stops_other_details'] = 'Comment';
		
		$data['never_been_pregnant_flag'] = 'Null parity';
        $data['pregnant_flag'] = 'Parity';
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


        $data['infertility_testing_flag'] = 'Treatment for infertility?';
        $data['infertility_treatment_details'] = 'Type of treatment';
		$data['infertility_treatment_duration'] = 'Duration';
		$data['infertility_treatment_comments'] = 'Comment';
        $data['contraceptive_pills_flag'] = 'Contraceptive pills use?';
        $data['contraceptive_pills_details'] = 'Details';
        $data['currently_taking_contraceptive_pills_flag'] = 'Active use?';
        $data['contraceptive_start_date'] = 'Start date';
        $data['contraceptive_end_date'] = 'End date';
		$data['contraceptive_duration'] = 'Duration';
        $data['HRT_flag'] = 'HRT use?';
        $data['HRT_details'] = 'Details';
        $data['currently_using_HRT_flag'] = 'Active use?';
        $data['HRT_start_date'] = 'Start date';
        $data['HRT_end_date'] = 'End date';
		$data['HRT_duration'] = 'Duration';
        $data['had_gnc_surgery_flag'] = 'Has ever had gynaecological surgery?';
        $data['gnc_surgery_year'] = 'Surgery year';
        $data['gnc_treatment_name'] = 'Surgery type';
        $data['gnc_treatment_name_other_details'] = 'Other';

        $data['gnc_treatment_lists'] = array(
            'Sterilisation' => 'Sterilisation',
            'Tubal Ligation' => 'Tubal Ligation',
            'Removal of one ovary' => 'Removal of one ovary',
            'Removal of both ovaries (oophorectomy)' => 'Removal of both ovaries (oophorectomy)',
            'Removal of one ovary & fallopian tube (Unlateral salpingo-oophorectomy)' => 'Removal of one ovary & fallopian tube (Unlateral salpingo-oophorectomy)',
            'Removal of both ovaries & fallopian tube (Bilateral salpingo-oophorectomy)' => 'Removal of both ovaries & fallopian tube (Bilateral salpingo-oophorectomy)',
            'Removal of uterus (hysterectomy)' => 'Removal of uterus (hysterectomy)',
            'Removal of uterus & part of cervix (hysterectomy)' => 'Removal of uterus & part of cervix(hysterectomy)',
            'Removal of uterus, cervix, ovaries & fallopian tube (Total hysterectomy/TAHBSO)' => 'Removal of uterus, cervix, ovaries & fallopian tube (Total hysterectomy/TAHBSO)',
            'Other, please specify' => 'Other, please specify'
        );

        //INVESTIGATIONS
        $data['date_test_ordered'] = 'Date test ordered';
        $data['test_ordered_by'] = 'Ordered by';
        $data['testing_results_notification_flag'] = 'Request for result notification';
        $data['investigation_project_name'] = 'Service provider';
        $data['investigation_project_name_lists'] = array(
            'GTG' => 'GTG',
            'Sequenom' => 'Sequenom',
			'BGI' => 'BGI'
        );
        $data['investigation_project_batch'] = 'Testing batch';
		$data['investigation_gene_tested'] = 'Gene tested';
        $data['investigation_test_type'] = 'Types of testing';
		$data['investigation_gene_tested_lists'] = array(
            'APC' => 'APC',
            'ATM' => 'ATM',
            'PALB2' => 'PALB2',
            'BRCA1' => 'BRCA1',
            'BRCA2' => 'BRCA2',
            'TP5 3' => 'TP5 3',
            'BRCX' => 'BRCX',
            'APOE' => 'APOE',
            'Others' => 'Others'
        );
		$data['investigation_gene_tested_other'] = 'Other';
        $data['investigation_test_type_lists'] = array(
            'Full analysis' => 'Full analysis',
            'MLPA' => 'MLPA',
            'Genotyping' => 'Genotyping',
            'Predictive testing' => 'Predictive testing'
        );
        $data['investigation_sample_type'] = 'Sample type';
        $data['investigation_sample_type_lists'] = array(
            'DNA' => 'DNA',
            'Serum' => 'Serum',
            'Plasma' => 'Plasma'
        );
        $data['investigation_test_reason'] = 'Test reason';
        $data['investigation_new_mutation_flag'] = 'Is new mutation?';
        $data['investigation_test_results'] = 'Test results';
        $data['investigation_test_results_lists'] = array(
            'AA changes' => 'AA changes',
            'Exon details' => 'Exon details',
            'Other details' => 'Other details'
        );
        $data['investigation_test_results_other_details'] = 'Other details';
        $data['investigation_carrier_status'] = 'Carrier status';
        $data['investigation_carrier_status_lists'] = array(
            'Affected carrier' => 'Affected carrier',
            'Unaffected carrier' => 'Unaffected carrier',
            'Affected non carrier' => 'Affected non carrier',
            'Unaffected non carrier' => 'Unaffected non carrier'
        );
        $data['investigation_mutation_nomenclature'] = 'Mutation nomenclature';
        $data['investigation_mutation_nomenclature_lists'] = array(
            'BIC' => 'BIC',
            'HGVC' => 'HGVC',
			'aa' => 'aa'
        );
        $data['investigation_reported_by'] = 'Reported by';
        $data['investigation_mutation_type'] = 'Mutation type';
        $data['investigation_mutation_pathogenicity'] = 'Mutation pathogenicity';
		
		 $data['investigation_mutation_pathogenicity_lists'] = array(
            'Del' => 'Del',
            'VUS' => 'VUS',
			'SNP' => 'SNP'
        );
        $data['investigation_sample_ID'] = 'Sample ID';
        $data['investigation_report_due'] = 'Report due date';
        $data['investigation_report_date'] = 'Report date';
        $data['investigation_date_notified'] = 'Date client notified';
        $data['investigation_test_comment'] = 'Comments';
        $data['investigation_conformation_attachment'] = 'Attach conformation?';
		$data['mutation_is_counselling_flag'] = 'Counselling';
		$data['investigation_project_date'] = 'Testing date';
		$data['investigation_exon'] = 'Exon';
		
        //SURVEILLANCE
        $data['surveillance_recruitment_center'] = 'Recruitment center';
        $data['surveillance_recruitment_center_lists'] = array(
            'UMMC' => 'UMMC',
            'SD' => 'SD',
            'UMSC' => 'UMSC'
        );
        $data['surveillance_type'] = 'Surveillance type';
        $data['surveillance_type_lists'] = array(
            'New' => 'New',
            'Follow up' => 'Follow up'
        );
        $data['surveillance_first_consultation_date'] = 'Date of 1st consultation';
        $data['surveillance_first_consultation_place'] = 'Place of 1st consultation';
        $data['surveillance_interval'] = 'Interval (months)';
        $data['surveillance_diagnosis'] = 'Diagnosis';
        $data['surveillance_due_date'] = 'Due date';
        $data['surveillance_reminder_sent_date'] = 'Reminder sent date';
        $data['surveillance_done_date'] = 'Done date';
        $data['surveillance_reminded_by'] = 'Reminded by';
        $data['surveillance_timing'] = 'Timing';
        $data['surveillance_symptoms'] = 'Symptoms';
        $data['surveillance_doctor_name'] = 'Doctor\'s name';
        $data['surveillance_place'] = 'Place';
        $data['surveillance_outcome'] = 'Outcome';
        $data['surveillance_comments'] = 'Comments';

        //PATHOLOGY
        $data['breast_pathology_tissue_site'] = 'Site';
        $data['breast_pathology_tissue_tumour_stage'] = 'T Staging';
        $data['breast_pathology_morphology'] = 'Morphology';
        $data['breast_pathology_node_stage'] = 'N staging';
        $data['pathology_tissue_tumour_stage_lists'] = array(
            'T0' => 'T0',
            'T1' => 'T1',
            'T2' => 'T2',
            'T3' => 'T3',
            'T4' => 'T4',
            'Tx' => 'Tx'
        );
        $data['pathology_morphology_lists'] = array(
            'DCIS' => 'DCIS',
            'LCIS' => 'LCIS',
            'IDC' => 'IDC',
            'ILC' => 'ILC',
            'IPC' => 'IPC',
            'Intraductal papillary carcinoma' => 'Intraductal papillary carcinoma',
            'Tubular carcinoma' => 'Tubular carcinoma',
            'Cribiform carcinoma' => 'Cribiform carcinoma',
            'Medullary carcinoma' => 'Medullary carcinoma'
        );
        $data['pathology_node_stage_lists'] = array(
            'N0' => 'N0',
            'N1' => 'N1',
            'N2' => 'N2',
            'N3' => 'N3',
            'Nx' => 'Nx'
        );
        $data['pathology_lymph_node_lists'] = array(
            'Yes' => 'Yes',
            'No' => 'No',
            'Not stated' => 'Not stated'
        );
        $data['breast_pathology_total_lymph_nodes'] = 'No. of lymph nodes';
        $data['breast_pathology_ER_status'] = 'ER status';
        $data['breast_pathology_PR_status'] = 'PR status';
        $data['breast_pathology_HER2_status'] = 'HER2 status';
        $data['breast_pathology_number_of_tumours'] = 'Number of tumours';
        $data['breast_pathology_metastasis_stage'] = 'M staging';
        $data['pathology_metastasis_stage_lists'] = array(
            'M0' => 'M0',
            'M1' => 'M1',
            'Mx' => 'Mx'
        );
       
        $data['breast_pathology_tumour_stage'] = 'Tumour stage';
        $data['pathology_tumour_stage_lists'] = array(
            '0' => '0',
            '1' => '1',
            '2a' => '2a',
            '2b' => '2b',
            '3a' => '3a',
            '4' => '4',
            'Not stated' => 'Not stated'
        );
        $data['breast_pathology_tumour_grade'] = 'Tumour grade';
        $data['pathology_tumour_grade_lists'] = array(
            '1: Well differentiated' => '1: Well differentiated',
            '2: Moderately differentiated' => '2: Moderately differentiated',
            '3: Poorly/un-differentiated' => '3: Poorly/un-differentiated',
            'High' => 'High',
            'Low' => 'Low'
        );
        $data['breast_pathology_tumour_size'] = 'Size of tumor';
        $data['breast_pathology_doctor'] = 'Name of doctor';
        $data['breast_pathology_lab'] = 'Pathology lab';
		$data['breast_pathology_path_report_date'] = 'Date of report';
        $data['breast_pathology_path_report_type'] = 'Type of report';
        $data['pathology_path_report_type_lists'] = array(
            'Pathology' => 'Pathology',
            'FNAC' => 'FNAC',
            'Core biopsy' => 'Core biopsy',
            'Stereostatic biopsy' => 'Stereostatic biopsy'
        );

        $data['breast_pathology_tissue_path_comments'] = 'Comments';

		//Ovary pathology
		$data['ovary_pathology_tissue_site'] = 'Site';
        $data['ovary_pathology_tissue_tumour_stage'] = 'T Staging';
        $data['ovary_pathology_morphology'] = 'Morphology';
        $data['ovary_pathology_node_stage'] = 'N staging';
		$data['ovary_pathology_total_lymph_nodes'] = 'No. of lymph nodes';
        $data['ovary_pathology_ER_status'] = 'ER status';
        $data['ovary_pathology_PR_status'] = 'PR status';
        $data['ovary_pathology_HER2_status'] = 'HER2 status';
        $data['ovary_pathology_number_of_tumours'] = 'Number of tumours';
        $data['ovary_pathology_metastasis_stage'] = 'M staging';
		$data['ovary_pathology_tumour_stage'] = 'Tumour stage';
		$data['ovary_pathology_tumour_grade'] = 'Tumour grade';
		$data['ovary_pathology_tumour_size'] = 'Size of tumor';
        $data['ovary_pathology_doctor'] = 'Name of doctor';
        $data['ovary_pathology_lab'] = 'Pathology lab';
		$data['ovary_pathology_path_report_date'] = 'Date of report';
        $data['ovary_pathology_path_report_type'] = 'Type of report';
		$data['ovary_pathology_tissue_path_comments'] = 'Comments';
		$data['ovary_stage_classification'] = 'Stage classification';
		$data['ovary_stage_classification_lists'] = array(
            'SEER' => 'SEER',
            'FIGO' => 'FIGO'
        );
		
		//Ovary pathology
		$data['other_pathology_tissue_site'] = 'Site';
		$data['other_pathology_doctor'] = 'Name of doctor';
        $data['other_pathology_lab'] = 'Pathology lab';
		$data['other_pathology_path_report_date'] = 'Date of report';
        $data['other_pathology_path_report_type'] = 'Type of report';
		$data['other_pathology_tissue_path_comments'] = 'Comments';
		
        //$data[''] = ''; 
        return $data;

        //Bulk import
        $data['upload_xlsx_file'] = 'Upload an xlsx file';
        return $data;
    }

    public function insert_at_patient_record($record_data) {
        $data = array(
        );
        $record_data = array_merge($this->_filter_data($this->tables['patient'], $data), $record_data);
        $this->db->insert($this->tables['patient'], $record_data);

        $id = $this->db->insert_id();
        return $id;
    }

    public function insert_patient_relatives_summary($record_data) {
        $data = array(
        );
        $record_data = array_merge($this->_filter_data($this->tables['patient_relatives_summary'], $data), $record_data);
        $this->db->insert($this->tables['patient_relatives_summary'], $record_data);

        $id = $this->db->insert_id();
        return $id;
    }
    
    public function patient_lifestyle_factors($record_data) {
        $data = array(
        );
        $record_data = array_merge($this->_filter_data($this->tables['patient_lifestyle_factors'], $data), $record_data);
        $this->db->insert($this->tables['patient_lifestyle_factors'], $record_data);

        $id = $this->db->insert_id();
        return $id;
    }

    public function insert_patient_menstruation($record_data) {
        $data = array(
        );
        $record_data = array_merge($this->_filter_data($this->tables['patient_menstruation'], $data), $record_data);
        $this->db->insert($this->tables['patient_menstruation'], $record_data);

        $id = $this->db->insert_id();
        return $id;
    }

    public function insert_patient_parity_record($record_data) {
        $data = array(
        );
        $record_data = array_merge($this->_filter_data($this->tables['patient_parity_record'], $data), $record_data);
        $this->db->insert($this->tables['patient_parity_record'], $record_data);

        $id = $this->db->insert_id();
        return $id;
    }

    public function insert_patient_infertility($record_data) {
        $data = array(
        );
        $record_data = array_merge($this->_filter_data($this->tables['patient_infertility'], $data), $record_data);
        $this->db->insert($this->tables['patient_infertility'], $record_data);

        $id = $this->db->insert_id();
        return $id;
    }

    public function patient_gynaecological_surgery_history($record_data) {
        $data = array(
        );
        $record_data = array_merge($this->_filter_data($this->tables['patient_gynaecological_surgery_history'], $data), $record_data);
        $this->db->insert($this->tables['patient_gynaecological_surgery_history'], $record_data);

        $id = $this->db->insert_id();
        return $id;
    }

    public function insert_at_patient_contact_person($record_data) {
        $data = array(
        );
        $record_data = array_merge($this->_filter_data($this->tables['patient_contact_person'], $data), $record_data);
        $this->db->insert($this->tables['patient_contact_person'], $record_data);

        $id = $this->db->insert_id();
        return $id;
    }

    public function insert_patient_survival_status($record_data) {
        $data = array(
        );
        $record_data = array_merge($this->_filter_data($this->tables['patient_survival_status'], $data), $record_data);
        $this->db->insert($this->tables['patient_survival_status'], $record_data);

        $id = $this->db->insert_id();
        return $id;
    }

    public function insert_patient_family_record($record_data) {
        $data = array(
        );
        $record_data = array_merge($this->_filter_data($this->tables['patient_relatives'], $data), $record_data);
        $this->db->insert($this->tables['patient_relatives'], $record_data);

        $id = $this->db->insert_id();
        return $id;
    }
    
    public function get_view_patient_record($ic_no,$table,$patient_ic_no){
    
	$p_record = $this->db->get_where($table, array($patient_ic_no => $ic_no));
        $patient_detail = $p_record->row_array();
        //echo $this->db->last_query();exit;
        $p_record->free_result();  

        return $patient_detail;
    }
    
    public function insert_patient_parity_table($record_data) {
        $data = array(
        );
        $record_data = array_merge($this->_filter_data($this->tables['patient_parity_table'], $data), $record_data);
        $this->db->insert($this->tables['patient_parity_table'], $record_data);

        $id = $this->db->insert_id();
        return $id;
    }

    public function insert_patient_mammo_raw_images($record_data) {
        $data = array(
        );
        $record_data = array_merge($this->_filter_data($this->tables['patient_mammo_raw_images'], $data), $record_data);
        $this->db->insert($this->tables['patient_mammo_raw_images'], $record_data);

        $id = $this->db->insert_id();
        return $id;
    }

    public function insert_patient_mammo_processed_images($record_data) {
        $data = array(
        );
        $record_data = array_merge($this->_filter_data($this->tables['patient_mammo_processed_images'], $data), $record_data);
        $this->db->insert($this->tables['patient_mammo_processed_images'], $record_data);

        $id = $this->db->insert_id();
        return $id;
    }

    public function get_patient_record($ic_no) {

        $p_record = $this->db->get_where('patient', array('ic_no' => $ic_no));
        $patient_record = $p_record->row_array();
        $p_record->free_result();

        return $patient_record;
    }

    public function get_list_patient_record() {

        $l_record = $this->db->get('patient');
        $patient_list = $l_record->result_array();
        $l_record->free_result();

        return $patient_list;
    }
    
    public function get_patient_other_screening($patien_breast_screening){
    
        $this->db->select('pos.*');
        $this->db->from('patient_other_screening pos, patient_breast_screening pbs');
        $this->db->where('pos.patient_breast_screening_id',$patien_breast_screening);
	$s_record = $this->db->get('');
        $patient_id = $s_record->row_array();
        $s_record->free_result();  
        
        return $patient_id;
    }
    
    public function get_patient_cancer_treatment($patient_cancer){
    
        $this->db->select('pct.*');
        $this->db->from('patient_cancer_treatment pct, patient_cancer pc');
        $this->db->where('pct.patient_cancer_id',$patient_cancer);
	$t_record = $this->db->get('');
        $patient_cancer_id = $t_record->row_array();
        $t_record->free_result();  
        
        return $patient_cancer_id;
    }

    public function insert_patient_studies_record($record_data) {
        $data = array(
        );
        $record_data = array_merge($this->_filter_data($this->tables['patient_studies'], $data), $record_data);
        $this->db->insert($this->tables['patient_studies'], $record_data);

        $id = $this->db->insert_id();
        return $id;
    }

    public function insert_at_patient_breast_screening($record_data) {
        $data = array(
        );
        $record_data = array_merge($this->_filter_data($this->tables['patient_breast_screening'], $data), $record_data);
        $this->db->insert($this->tables['patient_breast_screening'], $record_data);

        $id = $this->db->insert_id();
        return $id;
    }

    public function insert_patient_mri_abnormality($record_data) {
        $data = array(
        );
        $record_data = array_merge($this->_filter_data($this->tables['patient_mri_abnormality'], $data), $record_data);
        $this->db->insert($this->tables['patient_mri_abnormality'], $record_data);

        $id = $this->db->insert_id();
        return $id;
    }

    public function insert_patient_other_screening($record_data) {
        $data = array(
        );
        $record_data = array_merge($this->_filter_data($this->tables['patient_other_screening'], $data), $record_data);
        $this->db->insert($this->tables['patient_other_screening'], $record_data);

        $id = $this->db->insert_id();
        return $id;
    }

    public function insert_patient_ultrasound_abnormality($record_data) {
        $data = array(
        );
        $record_data = array_merge($this->_filter_data($this->tables['patient_ultrasound_abnormality'], $data), $record_data);
        $this->db->insert($this->tables['patient_ultrasound_abnormality'], $record_data);

        $id = $this->db->insert_id();
        return $id;
    }

    public function insert_at_patient_breast_abnormality($record_data) {
        $data = array(
        );
        $record_data = array_merge($this->_filter_data($this->tables['patient_breast_abnormality'], $data), $record_data);
        $this->db->insert($this->tables['patient_breast_abnormality'], $record_data);

        $id = $this->db->insert_id();
        return $id;
    }

    public function insert_patient_cancer_site($record_data) {
        $data = array(
        );
        $record_data = array_merge($this->_filter_data($this->tables['patient_cancer_site'], $data), $record_data);
        $this->db->insert($this->tables['patient_cancer_site'], $record_data);

        $id = $this->db->insert_id();
        return $id;
    }

    public function insert_patient_cancer_treatment($record_data) {
        $data = array(
        );
        $record_data = array_merge($this->_filter_data($this->tables['patient_cancer_treatment'], $data), $record_data);
        $this->db->insert($this->tables['patient_cancer_treatment'], $record_data);

        $id = $this->db->insert_id();
        return $id;
    }

    public function insert_patient_cancer_recurrent($record_data) {
        $data = array(
        );
        $record_data = array_merge($this->_filter_data($this->tables['patient_cancer_recurrent'], $data), $record_data);
        $this->db->insert($this->tables['patient_cancer_recurrent'], $record_data);

        $id = $this->db->insert_id();
        return $id;
    }

    public function insert_patient_cancer($record_data) {
        $data = array(
        );
        $record_data = array_merge($this->_filter_data($this->tables['patient_cancer'], $data), $record_data);
        $this->db->insert($this->tables['patient_cancer'], $record_data);

        $id = $this->db->insert_id();
        return $id;
    }

    public function insert_patient_diagnosis($record_data) {
        $data = array(
        );
        $record_data = array_merge($this->_filter_data($this->tables['patient_diagnosis'], $data), $record_data);
        $this->db->insert($this->tables['patient_diagnosis'], $record_data);

        $id = $this->db->insert_id();
        return $id;
    }

    public function insert_patient_surveillance($record_data) {
        $data = array(
        );
        $record_data = array_merge($this->_filter_data($this->tables['patient_surveillance'], $data), $record_data);
        $this->db->insert($this->tables['patient_surveillance'], $record_data);

        $id = $this->db->insert_id();
        return $id;
    }

    public function insert_patient_interview_manager($record_data) {
        $data = array(
        );
        $record_data = array_merge($this->_filter_data($this->tables['patient_interview_manager'], $data), $record_data);
        $this->db->insert($this->tables['patient_interview_manager'], $record_data);

        $id = $this->db->insert_id();
        return $id;
    }

    public function insert_patient_lifestyle_factors($record_data) {
        $data = array(
        );
        $record_data = array_merge($this->_filter_data($this->tables['patient_lifestyle_factors'], $data), $record_data);
        $this->db->insert($this->tables['patient_lifestyle_factors'], $record_data);

        $id = $this->db->insert_id();
        return $id;
    }

    public function insert_patient_investigations($record_data) {
        $data = array(
        );
        $record_data = array_merge($this->_filter_data($this->tables['patient_investigations'], $data), $record_data);
        $this->db->insert($this->tables['patient_investigations'], $record_data);

        $id = $this->db->insert_id();
        return $id;
    }

    public function insert_patient_gynaecological_surgery_history($record_data) {
        $data = array(
        );
        $record_data = array_merge($this->_filter_data($this->tables['patient_gynaecological_surgery_history'], $data), $record_data);
        $this->db->insert($this->tables['patient_gynaecological_surgery_history'], $record_data);

        $id = $this->db->insert_id();
        return $id;
    }

    public function insert_patient_pathology($record_data) {
        $data = array(
        );
        $record_data = array_merge($this->_filter_data($this->tables['patient_pathology'], $data), $record_data);
        $this->db->insert($this->tables['patient_pathology'], $record_data);

        $id = $this->db->insert_id();
        return $id;
    }

    public function get_cancer_id($record_data) {
        $data = array(
        );
        $query = $this->db->select('cancer_id')
                ->where('cancer_name', $record_data)
                ->limit(1)
                ->get($this->tables['cancer']);

        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            //echo $result['relatives_id'];
        }

        //print_r($result['relatives_id']);

        return $result['cancer_id'];
    }

    public function get_cancer_site_id($record_data) {
        $data = array(
        );
        $query = $this->db->select('cancer_site_id')
                ->where('cancer_site_name', $record_data)
                ->limit(1)
                ->get($this->tables['cancer_site']);

        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            //echo $result['relatives_id'];
        }

        //print_r($result['relatives_id']);

        return $result['cancer_site_id'];
    }

    public function get_treatment_id($record_data) {
        $data = array(
        );
        $query = $this->db->select('treatment_id')
                ->where('treatment_name', $record_data)
                ->limit(1)
                ->get($this->tables['treatment']);

        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            //echo $result['relatives_id'];
        }

        //print_r($result['relatives_id']);

        return $result['treatment_id'];
    }

    public function get_diagnosis_id($record_data) {
        $data = array(
        );
        $query = $this->db->select('diagnosis_id')
                ->where('diagnosis_name', $record_data)
                ->limit(1)
                ->get($this->tables['diagnosis']);

        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            //echo $result['relatives_id'];
        }

        //print_r($result['relatives_id']);

        return $result['diagnosis_id'];
    }

    public function get_patient_suudies_id($record_data) {

        $query = $this->db->select('patient_studies_id')
                ->where('patient_ic_no', $record_data['patient_ic_no'])
                ->where('studies_id', $record_data['studies_id'])
                ->limit(1)
                ->get($this->tables['patient_studies']);

        $result = null;

        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            //return $query->row_array();
            //print_r($result);
        }

        //

        return $result['patient_studies_id'];
    }
    
    function getPatientInfo($record_data) {
        $query = $this->db->select('fullname, surname, ic_no')
                ->like('fullname', $record_data['fullname'])
                ->like('ic_no', $record_data['ic_no'])
                ->limit(5)
                ->get($this->tables['patient']);
                
        $result = null;
        if ($query->num_rows() > 0) {
            $result = $query->result_array();
                        //return $query->row_array();
            //print_r($result);
            
        }
        return $result;
    }

    /* public function test($fileName)
      {
      echo $fileName;
      } */
}

?>
