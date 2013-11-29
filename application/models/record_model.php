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

        //PERSONAL DETAILS
        $data['fullname'] = 'Given name';
        $data['surname'] = 'Surname';
        $data['maiden_name'] = 'Maiden name';
        $data['family_no'] = 'Family No';
        $data['IC_no'] = 'IC No';

        $data['nationality'] = 'Nationality';
        $data['nationalities'] = array(
			 'Dynamic Dropdown' => 'Dynamic Dropdown'
        );
        $data['gender'] = 'Gender';
        $data['genderTypes'] = array(
			'Dynamic Dropdown' => 'Dynamic Dropdown'
        );
        $data['DOB'] = 'Date of birth';
        $data['place_of_birth'] = 'Place of birth';
        $data['still_alive_flag'] = 'Still alive?';
        $data['is_dead'] = 'Is dead?';
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
			'Dynamic Dropdown' => 'Dynamic Dropdown'
        );
        $data['marital_status'] = 'Marital status';
        $data['marital_status_lists'] = array(
			'Dynamic Dropdown' => 'Dynamic Dropdown'
        );
        $data['is_blood_card_exist'] = 'Blood card exist?';
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
        $data['BMI'] = 'BMI(auto-calculated)';
        $data['highest_level_of_education'] = 'Highest level of education';

        $data['income_level'] = 'Income level';
        $data['income_level_lists'] = array(
			'Dynamic Dropdown' => 'Dynamic Dropdown'
        );
		$data['patient_comments'] = 'Comments';
		$data['total_no_of_male_siblings'] = 'Total male siblings';
		$data['total_no_of_female_siblings'] = 'Total female siblings';
		$data['total_no_of_affected_siblings'] = 'Total of affected siblings';
                $data['total_no_of_siblings'] = 'Total of siblings(auto-calculated)';
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
			'Dynamic Dropdown' => 'Dynamic Dropdown'
        );
        $data['alive_status'] = 'Status';
        $data['alive_status_lists'] = array(
			'Dynamic Dropdown' => 'Dynamic Dropdown'
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

       //STUDIES
        $data['studies_name'] = 'Studies Name';
        $data['studies_name_lists'] = array(
			'Dynamic Dropdown' => 'Dynamic Dropdown'
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
        $data['date_of_first_mammogram'] = 'Date of first mammogram';
        $data['reason_of_mammogram'] = 'Reason for mammogram';
        $data['reason_for_mammogram'] = array(
            '' => ''
        );
        $data['details_for_mammogram'] = 'Details of mammogram';
        $data['action_suggested_on_mammogram_report'] = 'Action suggested on mammogram report';
        $data['reason_of_action_suggested'] = 'Reason of action suggested';
        $data['is_cancer'] = 'Cancer?';
        $data['side_effected'] = 'Site effected';
        $data['mammo_report_site'] = array(
            '' => '',
            'left' => 'Left',
            'right' => 'Right',
            'both' => 'both'
        );
        $data['age_at_first_mammogram'] = 'Age at first mammogram';
        $data['motivaters_at_first_mammogram'] = 'Motivaters at first mammogram';
        $data['motivaters_at_recent_mammogram'] = 'Motivaters at recent mammogram';
        $data['details_at_first_mammogram'] = 'Details at first mammogram';
        $data['details_at_recent_mammogram'] = 'Details at recent mammogram';
        $data['mammogram_in_sdmc'] = 'Mammogram in SDMC,SJ';
        $data['screening_center_at_first_mammogram'] = 'Screening center at first mammogram';
        $data['screening_center_at_recent_mammogram'] = 'Screening center at recent mammogram';
        $data['date_of_recent_mammogram'] = 'Date of recent mammogram';
		$data['age_at_recent__mammogram'] = 'Age at recent mammogram';
        $data['screening_center'] = 'Screening centre';
        $data['total_no_of_mammogram'] = 'Total no. of mammogram';
        $data['screening_interval'] = 'Screening interval';
        $data['abnormalities_mammo_flag'] = 'Abnormalities detected';
		$data['mammo_comments'] = 'Comments';
        $data['mammo_left_right_breast_side'] = 'Left/right breast side';
		$data['mammo_left_right_breast_side_lists'] = array(
			'Dynamic Dropdown' => 'Dynamic Dropdown'
        );
        $data['mammo_upper_below_breast_side'] = 'Upper/below breast side';
		$data['mammo_upper_below_breast_side_lists'] = array(
			'Dynamic Dropdown' => 'Dynamic Dropdown'
        );
		$data['mammo_is_abnormality_detected'] = 'Is abnormality detected?';
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
        $data['abnormalities_ultrasound_flag'] = 'Is abnormalities detected?';
		$data['mammo_ultrasound_date'] = 'Ultrasound date';
		$data['mammo_ultrasound_is_abnormality_detected'] = 'Is abnormality detected?';
        $data['mammo_ultrasound_details'] = 'Comment';
        $data['had_MRI_flag'] = 'Had MRI?';
        $data['total_no_of_MRI'] = 'Total no. of MRI';
        $data['abnormalities_MRI_flag'] = 'Is abnormalities detected?';
		$data['mammo_MRI_date'] = 'MRI date';
		$data['mammo_MRI_is_abnormality_detected'] = 'Is abnormality detected?';
        $data['mammo_MRI_details'] = 'Comment';
		$data['non_cancer_surgery_type'] = 'Surgery type';
		$data['reason_for_non_cancer_surgery'] = 'Reason for surgery';
		$data['date_of_non_cancer_surgery'] = 'Date of surgery';
		$data['age_at_non_cancer_surgery'] = 'Age at surgery';
		$data['non_cancer_surgery_comments'] = 'Comments';
        $data['other_screening_flag'] = 'Had other screenings done before?';
        $data['screening_name'] = 'Screening type';
		$data['screening_name_lists'] = array(
			'Dynamic Dropdown' => 'Dynamic Dropdown'
        );
        $data['total_no_of_screening'] = 'Total no. of screenings';
        $data['age_at_screening'] = 'Age at screening';
        $data['place_of_screening'] = 'Screening centre';
        $data['screening_results'] = 'Screening results';

        //CANCER
        $data['cancer_invasive_type'] = 'Cancer type (invasive/non-invasive)';
		$data['cancer_invasive_type_lists'] = array(
			'Dynamic Dropdown' => 'Dynamic Dropdown'
        );
		$data['detected_by_other_details'] = 'If detected by other, please specify';
		$data['detected_by_lists'] = array(
			'Dynamic Dropdown' => 'Dynamic Dropdown'
        );
		$data['breast_cancer_treatment_comments'] = 'Comments';
		$data['treatment_duration'] = 'Treatment duration';
        $data['breast_cancer_diagnosed_flag'] = 'Is breast cancer diagnosed?';
        $data['patient_cancer_name'] = 'Cancer name';
		$data['patient_cancer_name_lists'] = array(
			'Dynamic Dropdown' => 'Dynamic Dropdown'
        );
        $data['primary_diagnosis'] = 'Is primary diagnosis?';
        $data['cancer_site'] = 'Select site';
        $data['patient_cancer_sites_lists'] = array(
			 '' => '',
            'Left Breast' => 'Left Breast',
            'Right Breast' => 'Right Breast',
            'Left Ovary' => 'Left Ovary',
            'Right Ovary' => 'Right Ovary'
        );
		$data['patient_cancer_site_lists'] = array(
			'Dynamic Dropdown' => 'Dynamic Dropdown'
        );
        $data['cancer_site_details'] = 'Details';


        $data['age_of_diagnosis'] = 'Age at diagnosis';
        $data['date_of_diagnosis'] = 'Date of diagnosis';
		$data['source_of_date_of_diagnosis'] = 'Source of date of diagnosis';
        $data['cancer_diagnosis_center'] = 'Diagnosis centre';
        $data['cancer_doctor_name'] = 'Doctor\'s name';
        $data['detected_by'] = 'Detected by';
        $data['patient_cancer_treatment_name'] = 'Treatment type';
		$data['patient_cancer_treatment_name_lists'] = array(
			'Dynamic Dropdown' => 'Dynamic Dropdown'
        );
		$data['cancer_is_bilateral'] = 'Bilateral';
		$data['cancer_is_recurrent'] = 'Recurrent';
        $data['treatment_start_date'] = 'Treatment start date';
        $data['treatment_end_date'] = 'Treatment end date';
        $data['treatment_details'] = 'Treatment details';
        $data['treatment_drug_dose'] = 'Treatment drug dose';
        $data['treatment_cycle'] = 'Treatment cycle';
        $data['treatment_frequency'] = 'Treatment frequency';
        $data['treatment_visidual_desease'] = 'Treatment visidual desease';
        $data['treatment_primary_therapy_outcome'] = 'Primary therapy outcome';
        $data['treatment_cal125_pretreatment'] = 'Cal125 pretreatment';
        $data['treatment_cal125_posttreatment'] = 'Cal125 posttreatment';
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
		$data['ovary_detected_by_other_details'] = 'If detected by other, please specify';
		$data['ovary_patient_cancer_treatment_name'] = 'Treatment type';
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
		$data['other_patient_cancer_treatment_name'] = 'Treatment type';
		$data['other_treatment_start_date'] = 'Treatment start date';
		$data['other_treatment_end_date'] = 'Treatment end date';
		$data['other_treatment_duration'] = 'Treatment duration';
		$data['other_cancer_treatment_comments'] = 'Comments';
		
        //DIAGNOSIS
        $data['patient_other_diagnosis_name'] = 'Type of diseases';
		$data['diagnosis_name_lists'] = array(
			'Dynamic Dropdown' => 'Dynamic Dropdown'
        );
        $data['diagnosis_details'] = 'Diagnosis details';
        $data['diagnosis_age'] = 'Age at diagnosis';
        $data['year_of_diagnosis'] = 'Date of diagnosis';
        $data['is_on_medication_flag'] = 'Is on medication?';
        $data['medication_type_name'] = 'Type of medication';
        $data['diagnosis_center'] = 'Diagnosis centre';
        $data['diagnosis_doctor_name'] = 'Diagnosis doctor\'s name';
		$data['medication_start_date'] = 'Medication start date';
		$data['medication_end_date'] = 'Medication end date';
		$data['medication_duration'] = 'Medication duration';
		$data['medication_comments'] = 'Comments';


        //Lifestyle Factors
		$data['questionnaire_date'] = 'Questionnaire date';
        $data['self_image_at_7years'] = 'Self image at 7 years old';
        $data['self_image_at_18years'] = 'Self image at 18 years old';
        $data['self_image_now'] = 'Self image now';
		$data['self_image_lists'] = array(
			'Dynamic Dropdown' => 'Dynamic Dropdown'
        );
		$data['pa_activities_lists'] = array(
			'Dynamic Dropdown' => 'Dynamic Dropdown'
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
			'Dynamic Dropdown' => 'Dynamic Dropdown'
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
			'Dynamic Dropdown' => 'Dynamic Dropdown'
        );
		$data['coffee_tea_drink_average_lists'] = array(
			'Dynamic Dropdown' => 'Dynamic Dropdown'
        );
		$data['tea_type_lists'] = array(
			'Dynamic Dropdown' => 'Dynamic Dropdown'
        );
		$data['tea_type_other'] = 'If there\'s other tea type, please specify';
        $data['soya_bean_drunk_flag'] = 'Regular consumption?';
        $data['soya_bean_average'] = 'Soya bean frequency';
        $data['soya_products_flag'] = 'Soya product frequency';
        $data['soya_products_average'] = 'Soya products average';
		$data['soya_products_lists'] = array(
			'Dynamic Dropdown' => 'Dynamic Dropdown'
        );
		$data['soya_products_average_other'] = 'If there\'s other soya products average, please specify';
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
			'Dynamic Dropdown' => 'Dynamic Dropdown'
        );
		$data['period_cycle_days_lists'] = array(
			'Dynamic Dropdown' => 'Dynamic Dropdown'
        );
		$data['reason_period_stops_lists'] = array(
			'Dynamic Dropdown' => 'Dynamic Dropdown'
        );
        $data['reason_period_stops_other_details'] = 'Specify other reason why period stops';
		
		$data['never_been_pregnant_flag'] = 'Null parity';
        $data['pregnant_flag'] = 'Parity';
        $data['pregnancy_type'] = 'Pregnancy type';
        $data['pregnancy_type_lists'] = array(
			 '' => '',
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
        $data['contraceptive_start_age'] = 'Start age';
        $data['contraceptive_end_age'] = 'End Age';
		$data['contraceptive_duration'] = 'Duration';
        $data['HRT_flag'] = 'HRT use?';
        $data['HRT_details'] = 'Details';
        $data['currently_using_HRT_flag'] = 'Active use?';
        $data['HRT_start_date'] = 'Start date';
        $data['HRT_end_date'] = 'End date';
        $data['HRT_start_age'] = 'Start age';
        $data['HRT_end_age'] = 'End Age';
		$data['HRT_duration'] = 'Duration';
        $data['had_gnc_surgery_flag'] = 'Has ever had gynaecological surgery?';
        $data['gnc_surgery_year'] = 'Surgery year';
        $data['gnc_treatment_name'] = 'Surgery type';
        $data['gnc_treatment_name_other_details'] = 'If there\'s other surgery type, please specify';
		$data['gnc_treatment_lists'] = array(
			'Dynamic Dropdown' => 'Dynamic Dropdown'
        );
		
        //INVESTIGATIONS
        $data['date_test_ordered'] = 'Date test ordered';
        $data['test_ordered_by'] = 'Ordered by';
        $data['testing_results_notification_flag'] = 'Request for result notification';
        $data['investigation_project_name'] = 'Service provider';
		$data['investigation_project_name_lists'] = array(
			'Dynamic Dropdown' => 'Dynamic Dropdown'
        );
        $data['investigation_project_batch'] = 'Testing batch';
		$data['investigation_gene_tested'] = 'Gene tested';
        $data['investigation_test_type'] = 'Types of testing';
		$data['investigation_gene_tested_lists'] = array(
			'Dynamic Dropdown' => 'Dynamic Dropdown'
        );
		$data['investigation_gene_tested_other'] = 'Other';
		$data['investigation_test_type_lists'] = array(
			'Dynamic Dropdown' => 'Dynamic Dropdown'
        );
        $data['investigation_sample_type'] = 'Sample type';
		$data['investigation_sample_type_lists'] = array(
			'Dynamic Dropdown' => 'Dynamic Dropdown'
        );
        $data['investigation_test_reason'] = 'Test reason';
        $data['investigation_new_mutation_flag'] = 'Is new mutation?';
        $data['investigation_test_results'] = 'Test results';
		$data['investigation_test_results_lists'] = array(
			'Dynamic Dropdown' => 'Dynamic Dropdown'
        );
        $data['investigation_test_results_other_details'] = 'Other details for tests results';
        $data['investigation_carrier_status'] = 'Carrier status';
		$data['investigation_carrier_status_lists'] = array(
			'Dynamic Dropdown' => 'Dynamic Dropdown'
        );
        $data['investigation_mutation_nomenclature'] = 'Mutation nomenclature';
		$data['investigation_mutation_nomenclature_lists'] = array(
			'Dynamic Dropdown' => 'Dynamic Dropdown'
        );
        $data['investigation_reported_by'] = 'Reported by';
        $data['investigation_mutation_name'] = 'Mutation name';
        $data['investigation_mutation_type'] = 'Mutation type';
        $data['investigation_mutation_pathogenicity'] = 'Mutation pathogenicity';
		$data['investigation_mutation_pathogenicity_lists'] = array(
			'Dynamic Dropdown' => 'Dynamic Dropdown'
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
        $data['surveillance_recruitment_center'] = 'Recruitment centre';
		$data['surveillance_recruitment_center_lists'] = array(
			'Dynamic Dropdown' => 'Dynamic Dropdown'
        );
        $data['surveillance_type'] = 'Surveillance type';
		$data['surveillance_type_lists'] = array(
			'Dynamic Dropdown' => 'Dynamic Dropdown'
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

		//RISK ASSESSMENT
		$data['ms_at_consent_BRCA1'] = 'BRCA1';
        $data['ms_at_consent_BRCA2'] = 'BRCA2';
        $data['ms_at_consent_Total'] = 'Total';
        $data['ms_adjusted_BRCA1'] = 'BRCA1';
        $data['ms_adjusted_BRCA2'] = 'BRCA2';
        $data['ms_adjusted_Total'] = 'Total';
        $data['ms_after_gc_BRCA1'] = 'BRCA1';
        $data['ms_after_gc_BRCA2'] = 'BRCA2';
        $data['ms_after_gc_Total'] = 'Total';
        $data['BOADICEA_at_consent_BRCA1'] = 'BRCA1';
        $data['BOADICEA_at_consent_BRCA2'] = 'BRCA2';
        $data['BOADICEA_at_consent_no_mutation'] = 'No mutation';
        $data['BOADICEA_adjusted_BRCA1'] = 'BRCA1';
        $data['BOADICEA_adjusted_BRCA2'] = 'BRCA2';
		$data['BOADICEA_adjusted_no_mutation'] = 'No mutation';
        $data['BOADICEA_after_gc_BRCA1'] = 'BRCA1';
        $data['BOADICEA_after_gc_BRCA2'] = 'BRCA2';
        $data['BOADICEA_after_gc_no_mutation'] = 'No mutation';
		$data['gail_model_at_consent_5years'] = '5 years';
        $data['gail_model_at_consent_10years'] = '10 years';
        $data['gail_model_first_mammo_5years'] = '5 years';
        $data['gail_model_first_mammo_10years'] = '10 years';
		
		//OVARIAN SCREENINGS INFOS
		$data['ovarian_screening_type_name'] = 'Ovarian screening type';
		$data['ovarian_screening_type_name_lists'] = array(
			'Dynamic Dropdown' => 'Dynamic Dropdown'
        );
		$data['had_physical_pelvic_exams'] = 'Had new physical examinations?';
		$data['physical_exam_date'] = 'Date';
        $data['physical_exam_is_abnormality_detected'] = 'Is abnormality detected?';
        $data['physical_exam_additional_info'] = 'Additional Info';
       
		$data['had_abdominal_ultrasound'] = 'Had new abdominal ultrasound?';
		$data['abdominal_ultrasound_date'] = 'Date';
        $data['abdominal_ultrasound_is_abnormality_detected'] = 'Is abnormality detected?';
        $data['abdominal_ultrasound_additional_info'] = 'Additional Info';
		
		$data['had_transvaginal_ultrasound'] = 'Had new trans-vaginal ultrasound?';
		$data['transvaginal_ultrasound_date'] = 'Date';
        $data['transvaginal_ultrasound_is_abnormality_detected'] = 'Is abnormality detected?';
        $data['transvaginal_ultrasound_additional_info'] = 'Additional Info';
		
		$data['had_CA125_blood_test'] = 'Had new blood test for CA125?';
		$data['CA125_blood_test_date'] = 'Date';
        $data['CA125_blood_test_is_abnormality_detected'] = 'Is abnormality detected?';
        $data['CA125_blood_test_additional_info'] = 'Additional Info';
		
		$data['had_biopsy'] = 'Had new biopsy?';
		$data['biopsy_date'] = 'Date';
        $data['biopsy_is_abnormality_detected'] = 'Is abnormality detected?';
        $data['biopsy_additional_info'] = 'Additional Info';
		
		//RISK REDUCING STRATEGY
		$data['had_new_risk_reducing_surgery'] = 'Had new lesion surgery?';
		$data['non_cancerous_benign_site'] = 'Select site';
		$data['non_cancerous_benign_site_lists'] = array(
			'Dynamic Dropdown' => 'Dynamic Dropdown'
        );
        $data['non_cancerous_benign_date'] = 'Date';
		
		//RISK REDUCING STRATEGY
		$data['had_new_complete_removal_surgery'] = 'Had complete removal?';
		$data['non_cancerous_complete_removal_site'] = 'Select site';
		$data['non_cancerous_complete_removal_date'] = 'Date';
        $data['non_cancerous_complete_removal_reason'] = 'Reason';
		$data['non_cancerous_complete_removal_reason_lists'] = array(
			'Dynamic Dropdown' => 'Dynamic Dropdown'
        );
		
        //PATHOLOGY
        $data['breast_pathology_tissue_site'] = 'Site';
        $data['breast_pathology_tissue_tumour_stage'] = 'T Staging';
        $data['breast_pathology_morphology'] = 'Morphology';
        $data['breast_pathology_node_stage'] = 'N staging';
		$data['pathology_tissue_tumour_stage_lists'] = array(
			'Dynamic Dropdown' => 'Dynamic Dropdown'
        );
		$data['pathology_morphology_lists'] = array(
			'Dynamic Dropdown' => 'Dynamic Dropdown'
        );
		$data['pathology_node_stage_lists'] = array(
			'Dynamic Dropdown' => 'Dynamic Dropdown'
        );
        $data['pathology_lymph_node_lists'] = array(
			 '' => '',
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
			'Dynamic Dropdown' => 'Dynamic Dropdown'
        );
        $data['breast_pathology_tumour_stage'] = 'Tumour stage';
		$data['pathology_tumour_stage_lists'] = array(
			'Dynamic Dropdown' => 'Dynamic Dropdown'
        );
        $data['breast_pathology_tumour_grade'] = 'Tumour grade';
		$data['pathology_tumour_grade_lists'] = array(
			'Dynamic Dropdown' => 'Dynamic Dropdown'
        );
        $data['breast_pathology_tumour_size'] = 'Size of tumor';
        $data['breast_pathology_doctor'] = 'Name of doctor';
        $data['breast_pathology_lab'] = 'Pathology lab';
		$data['breast_pathology_path_report_date'] = 'Date of report';
        $data['breast_pathology_path_report_type'] = 'Type of report';
		$data['pathology_path_report_type_lists'] = array(
			'Dynamic Dropdown' => 'Dynamic Dropdown'
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
			'Dynamic Dropdown' => 'Dynamic Dropdown'
        );
		//Ovary pathology
		$data['ovary_pathology_report_no'] = 'No of report';
		$data['ovary_tumor_subtypes'] = 'Tumor subtypes';
		$data['ovary_tumor_behavior'] = 'Tumor behaviour';
		$data['ovary_tumor_differentiation'] = 'Tumor differentiation';
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
    
    public function insert_patient_studies($record_data) {
        $data = array(
        );
        $record_data = array_merge($this->_filter_data($this->tables['patient_studies'], $data), $record_data);
        $this->db->insert($this->tables['patient_studies'], $record_data);

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
    
    public function insert_patient_cogs_studies($record_data) {
        
//       print_r($record_data);exit;
        $data = array(
        );
        $record_data = array_merge($this->_filter_data($this->tables['patient_cogs_studies'], $data), $record_data);
        $this->db->insert($this->tables['patient_cogs_studies'], $record_data);

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
    
    public function insert_patient_risk_assessment_record($record_data) {
        $data = array(
        );
        $record_data = array_merge($this->_filter_data($this->tables['patient_risk_assessment'], $data), $record_data);
        $this->db->insert($this->tables['patient_risk_assessment'], $record_data);

        $id = $this->db->insert_id();
        return $id;
    }
    
    public function get_view_patient_record($ic_no,$table,$patient_ic_no){
    
	$p_record = $this->db->get_where($table, array($patient_ic_no => $ic_no));
        $patient_detail = $p_record->result_array();
        //echo $this->db->last_query();exit;
        $p_record->free_result();  

        return $patient_detail;
    }
    
    public function get_consent_detail_patient_record($ic_no,$patient_studies_id){
         
        $this->db->where('patient_ic_no',$ic_no);
        //$this->db->where('studies_id',$patient_studies_id);
	$p_record = $this->db->get('patient_studies');
        $patient_detail = $p_record->result_array();
       // echo $this->db->last_query();exit;
        $p_record->free_result();  

        return $patient_detail;
    }
    
    public function get_lifestyle_detail_patient_record($ic_no,$patient_studies_id){
         
        //$this->db->where('patient_ic_no',$ic_no);
        $this->db->where('patient_studies_id',$patient_studies_id);
	$p_record = $this->db->get('patient_lifestyle_factors');
        $patient_lifestyle = $p_record->row_array();
       // echo $this->db->last_query();exit;
        $p_record->free_result();  

        return $patient_lifestyle;
    }
    
    public function get_patient_menstruation_record($ic_no,$patient_studies_id){
         
        //$this->db->where('patient_ic_no',$ic_no);
        $this->db->where('patient_studies_id',$patient_studies_id);
	$p_record = $this->db->get('patient_menstruation');
        $patient_lifestyle = $p_record->row_array();
       // echo $this->db->last_query();exit;
        $p_record->free_result();  

        return $patient_lifestyle;
    }
    
    public function get_patient_parity_table_record($ic_no,$patient_studies_id){
         
        //$this->db->where('patient_ic_no',$ic_no);
        $this->db->where('patient_studies_id',$patient_studies_id);
	$p_record = $this->db->get('patient_parity_table');
        $patient_lifestyle = $p_record->row_array();
       // echo $this->db->last_query();exit;
        $p_record->free_result();  

        return $patient_lifestyle;
    }
    
    public function get_patient_parity_record($ic_no,$patient_studies_id){
         
        //$this->db->where('patient_ic_no',$ic_no);
        $this->db->where('patient_studies_id',$patient_studies_id);
	$p_record = $this->db->get('patient_parity_record');
        $patient_lifestyle = $p_record->row_array();
       // echo $this->db->last_query();exit;
        $p_record->free_result();  

        return $patient_lifestyle;
    }
    
    public function get_patient_infertility_record($ic_no,$patient_studies_id){
         
        //$this->db->where('patient_ic_no',$ic_no);
        $this->db->where('patient_studies_id',$patient_studies_id);
	$p_record = $this->db->get('patient_infertility');
        $patient_lifestyle = $p_record->row_array();
       // echo $this->db->last_query();exit;
        $p_record->free_result();  

        return $patient_lifestyle;
    }
    
    public function get_patient_gynaecological_record($ic_no,$patient_studies_id){
         
        //$this->db->where('patient_ic_no',$ic_no);
        $this->db->where('patient_studies_id',$patient_studies_id);
	$p_record = $this->db->get('patient_gynaecological_surgery_history');
        $patient_lifestyle = $p_record->row_array();
       // echo $this->db->last_query();exit;
        $p_record->free_result();  

        return $patient_lifestyle;
    }
    
    public function get_detail_record($ic_no,$table,$patient_ic_no){
    
	$p_record = $this->db->get_where($table, array($patient_ic_no => $ic_no));
        $patient_detail = $p_record->row_array();
        //echo $this->db->last_query();exit;
        $p_record->free_result();  

        return $patient_detail;
    }
    
    public function get_detail_patient_record($ic_no){
    
        $this->db->where('ic_no',$ic_no);
	$p_record = $this->db->get('patient');
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
    
    public function insert_patient_non_cancer_surgery($record_data) {
        $data = array(
        );
        $record_data = array_merge($this->_filter_data($this->tables['patient_non_cancer_surgery'], $data), $record_data);
        $this->db->insert($this->tables['patient_non_cancer_surgery'], $record_data);

        $id = $this->db->insert_id();
        return $id;
    }
    
    public function insert_patient_risk_reducing_surgery($record_data) {
        $data = array(
        );
        $record_data = array_merge($this->_filter_data($this->tables['patient_risk_reducing_surgery'], $data), $record_data);
        $this->db->insert($this->tables['patient_risk_reducing_surgery'], $record_data);

        $id = $this->db->insert_id();
        return $id;
    }
    
    public function insert_patient_risk_reducing_surgery_complete_removal($record_data) {
        $data = array(
        );
        $record_data = array_merge($this->_filter_data($this->tables['patient_risk_reducing_surgery_complete_removal'], $data), $record_data);
        $this->db->insert($this->tables['patient_risk_reducing_surgery_complete_removal'], $record_data);

        $id = $this->db->insert_id();
        return $id;
    }
    
    public function insert_patient_risk_reducing_surgery_lesion($record_data) {
        $data = array(
        );
        $record_data = array_merge($this->_filter_data($this->tables['patient_risk_reducing_surgery_lesion'], $data), $record_data);
        $this->db->insert($this->tables['patient_risk_reducing_surgery_lesion'], $record_data);

        $id = $this->db->insert_id();
        return $id;
    }
     
    public function insert_patient_ovarian_screening($record_data) {
        $data = array(
        );
        $record_data = array_merge($this->_filter_data($this->tables['patient_ovarian_screening'], $data), $record_data);
        $this->db->insert($this->tables['patient_ovarian_screening'], $record_data);

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
    
    public function insert_patient_other_disease($record_data) {
        $data = array(
        );
        $record_data = array_merge($this->_filter_data($this->tables['patient_other_disease'], $data), $record_data);
        $this->db->insert($this->tables['patient_other_disease'], $record_data);

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

    public function insert_patient_mutation_analysis($record_data) {
        $data = array(
        );
        $record_data = array_merge($this->_filter_data($this->tables['patient_mutation_analysis'], $data), $record_data);
        $this->db->insert($this->tables['patient_mutation_analysis'], $record_data);

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

        $result = null;;
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            //echo $result['relatives_id'];
        }

        //print_r($result['relatives_id']);

        return $result['cancer_id'];
    }

    public function get_relatives_id($record_data) {
        $data = array(
        );
        $query = $this->db->select('relatives_id')
                ->where('relatives_type', $record_data)
                ->limit(1)
                ->get($this->tables['relatives']);
        //echo $query;
        $result = null;
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            //echo $result['relatives_id'];
             
            //print_r($result);
        }

        //print_r($result['relatives_id']);
       return $result['relatives_id'];
        
    }
    
       public function get_family_no($record_data) {
        $data = array(
        );
        $query = $this->db->select('family_no')
                ->where('family_name', $record_data)
                ->limit(1)
                ->get($this->tables['family']);

        $result = null;
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            //echo $result['relatives_id'];
        }

        //print_r($result['relatives_id']);

        return $result['family_no'];
    }
    
    public function get_cancer_site_id($record_data) {
        $data = array(
        );
        $query = $this->db->select('cancer_site_id')
                ->where('cancer_site_name', $record_data)
                ->limit(1)
                ->get($this->tables['cancer_site']);
        $result = null;
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            //echo $result['relatives_id'];
        }

        //print_r($result['cancer_site_id']);

        return $result['cancer_site_id'];
    }

    public function get_treatment_id($record_data) {
        $data = array(
        );
        $query = $this->db->select('treatment_id')
                ->where('treatment_name', $record_data)
                ->limit(1)
                ->get($this->tables['treatment']);
        $result = null;
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
        $result = null;
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
    
    public function get_studies_id($record_data) {
        $data = array(
        );
        $query = $this->db->select('studies_id')
                ->where('studies_name', $record_data)
                ->limit(1)
                ->get($this->tables['studies']);
        $result = null;
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            //echo $result['relatives_id'];
        }

        //print_r($result['relatives_id']);

        return $result['studies_id'];
    }
    
    public function get_non_cancerous_benign_site_id($record_data) {
        $this->db->select('non_cancerous_site_id');
        $this->db->where('non_cancerous_site_name',$record_data);
        $l_record = $this->db->get('non_cancerous_site');
        $patient_list = $l_record->row_array();
        $l_record->free_result();

        return $patient_list['non_cancerous_site_id'];
    }
    
    public function get_studies_name() {
        $patientStudiesList = array();
        $this->db->select('studies_id,studies_name');
        $this->db->order_by('studies_id ASC');
        //$this->db->order_by('studies_name asc');
        $query = $this->db->get('studies');
        foreach ($query->result() as $row) {
            $patientStudiesList = $patientStudiesList + array($row->studies_id => $row->studies_name);
        }
        $query->free_result();
        return $patientStudiesList;
    }
    
    public function get_ovarian_screening_type($record_data) {
        $this->db->select('ovarian_screening_type_id');
        $this->db->where('ovarian_screening_type_name',$record_data);
        $o_record = $this->db->get('ovarian_screening_type');
        $ovarian_screening_type_list = $o_record->row_array();
        $o_record->free_result();

        return $ovarian_screening_type_list['ovarian_screening_type_id'];
    }
       
    function getPatientInfo($record_data) {
        $query = $this->db->select('given_name,surname,ic_no')
                ->like('given_name', $record_data['given_name'])
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
    
    function getPatientList($record_data) {
        $this->db->select('a.given_name, a.surname, a.ic_no, a.created_on, b.studies_id, b.patient_studies_id');
        $this->db->from('patient a, patient_studies b');
        $this->db->where('a.ic_no = b.patient_ic_no');
        $this->db->like('a.given_name', $record_data['given_name']);
        $this->db->like('a.ic_no', $record_data['ic_no']);
        $patient_list = $this->db->get('');
        $list_patient = $patient_list->result_array();
        $patient_list->free_result();

        return $list_patient;
    }
	
	function getCurrentRangeOfPatientList($record_data,$limit,$start) {
		
		$this->db->select('a.given_name, a.surname, a.ic_no, a.created_on, b.studies_id, b.patient_studies_id');
        $this->db->from('patient a, patient_studies b');
        $this->db->where('a.ic_no = b.patient_ic_no');
        $this->db->like('a.given_name', $record_data['given_name']);
        $this->db->like('a.ic_no', $record_data['ic_no']);
        $this->db->limit($limit, $start);
        $patient_list = $this->db->get('');
        $list_patient = $patient_list->result_array();
        $patient_list->free_result();

        return $list_patient;
    }
    /* public function test($fileName)
      {
      echo $fileName;
      } */

function get_family_patient_record($ic_no) {
        $this->db->select('a.*,b.*,c.*');
        $this->db->from('patient a, patient_studies b');
        $this->db->where('a.ic_no = b.patient_ic_no');
        $this->db->like('a.given_name', $record_data['given_name']);
        $this->db->like('a.ic_no', $record_data['ic_no']);
        $this->db->limit(5);
        $patient_list = $this->db->get('');
        $list_patient = $patient_list->result_array();
        $patient_list->free_result();

        return $list_patient;
    }
    
    function get_patient_lifstyle_record($patient_studies_id) {
    $this->db->select('a.*,b.*,c.*,d.*,e.*,f.*');
    $this->db->from('patient_lifestyle_factors a, patient_menstruation b, patient_parity_table c, patient_parity_record d, patient_infertility e,patient_gynaecological_surgery_history f');
    $this->db->where('a.patient_studies_id = b.patient_studies_id');
    $this->db->where('a.patient_studies_id = c.patient_studies_id');
    $this->db->where('c.patient_parity_id = d.patient_parity_table_id');
    $this->db->where('a.patient_studies_id = e.patient_studies_id');
    $this->db->where('a.patient_studies_id = f.patient_studies_id');
    $this->db->where('a.patient_studies_id',$patient_studies_id);
    $patient_lifestyle_list = $this->db->get('');
    $list_patient_lifestyle = $patient_lifestyle_list->result_array();
    $patient_lifestyle_list->free_result();
    
    //print_r($list_patient_lifestyle);exit;

    return $list_patient_lifestyle;
}

function get_patient_breast_diagnosis_record($patient_studies_id) {
    $this->db->select('a.*,b.*,c.*,d.*');
    $this->db->from('patient_cancer a, patient_pathology b, patient_pathology_staining_status c, patient_cancer_treatment d');
    $this->db->where('a.patient_cancer_id = b.patient_cancer_id');
    $this->db->where('b.patient_pathology_id = c.patient_pathology_id');
    $this->db->where('a.patient_cancer_id = d.patient_cancer_id');
    $this->db->where('a.patient_studies_id',$patient_studies_id);
    $this->db->where('a.cancer_id',1);
    $patient_lifestyle_list = $this->db->get('');
    $list_patient_lifestyle = $patient_lifestyle_list->result_array();
    $patient_lifestyle_list->free_result();
    
    //print_r($list_patient_lifestyle);exit;

    return $list_patient_lifestyle;
}

function get_patient_ovary_diagnosis_record($patient_studies_id) {
    $this->db->select('a.*,b.*,c.*');
    $this->db->from('patient_cancer a, patient_pathology b, patient_cancer_treatment c');
    $this->db->where('a.patient_cancer_id = b.patient_cancer_id');
    $this->db->where('a.patient_cancer_id = c.patient_cancer_id');
    $this->db->where('a.patient_studies_id',$patient_studies_id);
    $this->db->where('a.cancer_id',2);
    $patient_lifestyle_list = $this->db->get('');
    $list_patient_lifestyle = $patient_lifestyle_list->result_array();
    $patient_lifestyle_list->free_result();
    
    //print_r($list_patient_lifestyle);exit;

    return $list_patient_lifestyle;
}

function get_patient_others_diagnosis_record($patient_studies_id) {
    $this->db->select('a.*,b.*,c.*');
    $this->db->from('patient_cancer a, patient_pathology b, patient_cancer_treatment c');
    $this->db->where('a.patient_cancer_id = b.patient_cancer_id');
    $this->db->where('a.patient_cancer_id = c.patient_cancer_id');
    $this->db->where('a.patient_studies_id',$patient_studies_id);
    $this->db->where('a.cancer_id !=', '1');
    $this->db->where('a.cancer_id !=', '2');
    $patient_lifestyle_list = $this->db->get('');
    $list_patient_lifestyle = $patient_lifestyle_list->result_array();
    $patient_lifestyle_list->free_result();
    
    //print_r($list_patient_lifestyle);exit;

    return $list_patient_lifestyle;
}

function get_patient_others_desease_record($patient_studies_id) {
    $this->db->select('a.*,b.*');
    $this->db->from('patient_other_disease a, patient_other_disease_medication b');
    $this->db->where('a.patient_other_disease_id = b.patient_other_disease_id');
    $this->db->where('a.patient_studies_id',$patient_studies_id);
    $other_desease_list = $this->db->get('');
    $list_patient_other_desease = $other_desease_list->result_array();
    $other_desease_list->free_result();
    
    //print_r($list_patient_lifestyle);exit;

    return $list_patient_other_desease;
}

function get_patient_counselling_record($icno) {
    $this->db->from('patient_interview_manager');
    $this->db->where('patient_ic_no',$icno);
    $patient_counselling_list = $this->db->get('');
    $list_patient_counselling = $patient_counselling_list->result_array();
    $patient_counselling_list->free_result();
    
    //print_r($list_patient_lifestyle);exit;

    return $list_patient_counselling;
}

function get_patient_breast_screening_record($patient_studies_id) {
    
    $this->db->select('a.*,b.*,c.*,d.*');
    $this->db->from('patient_breast_screening a, patient_breast_abnormality b, patient_ultrasound_abnormality c, patient_mri_abnormality d');
    $this->db->where('a.patient_breast_screening_id = b.patient_breast_screening_id');
    $this->db->where('a.patient_breast_screening_id = c.patient_breast_screening_id');
    $this->db->where('a.patient_breast_screening_id = d.patient_breast_screening_id');    
    $this->db->where('a.patient_studies_id',$patient_studies_id);
    $patient_lifestyle_list = $this->db->get('');
    $list_patient_lifestyle = $patient_lifestyle_list->result_array();
    $patient_lifestyle_list->free_result();
    
    //print_r($list_patient_lifestyle);exit;

    return $list_patient_lifestyle;
}

function get_patient_non_cancer_record($patient_studies_id) {
    $this->db->from('patient_non_cancer_surgery');
    $this->db->where('patient_studies_id',$patient_studies_id);
    $patient_counselling_list = $this->db->get('');
    $list_patient_counselling = $patient_counselling_list->result_array();
    $patient_counselling_list->free_result();
    
    //print_r($list_patient_lifestyle);exit;

    return $list_patient_counselling;
}

function get_patient_risk_reducing_surgery_record($patient_studies_id) {
    $this->db->select('a.*,b.*,c.*');
    $this->db->from('patient_risk_reducing_surgery a, patient_risk_reducing_surgery_complete_removal b, patient_risk_reducing_surgery_lesion c');
    $this->db->where('a.patient_risk_reducing_surgery_id = b.patient_risk_reducing_surgery_id');
    $this->db->where('a.patient_risk_reducing_surgery_id = c.patient_risk_reducing_surgery_id');
    $this->db->where('a.patient_studies_id',$patient_studies_id);
    $patient_lifestyle_list = $this->db->get('');
    $list_patient_lifestyle = $patient_lifestyle_list->result_array();
    $patient_lifestyle_list->free_result();
    
    //print_r($list_patient_lifestyle);exit;

    return $list_patient_lifestyle;
}

function get_patient_ovarian_screening_record($patient_studies_id) {
    $this->db->from('patient_ovarian_screening');
    $this->db->where('patient_studies_id',$patient_studies_id);
    $patient_counselling_list = $this->db->get('');
    $list_patient_counselling = $patient_counselling_list->result_array();
    $patient_counselling_list->free_result();
    
    //print_r($list_patient_lifestyle);exit;

    return $list_patient_counselling;
}

function get_patient_surveillance_record($patient_studies_id) {
    $this->db->from('patient_surveillance');
    $this->db->where('patient_studies_id',$patient_studies_id);
    $patient_counselling_list = $this->db->get('');
    $list_patient_counselling = $patient_counselling_list->result_array();
    $patient_counselling_list->free_result();
    
    //print_r($list_patient_lifestyle);exit;

    return $list_patient_counselling;
}

function get_patient_other_screening_record($patient_studies_id) {
    $this->db->from('patient_other_screening');
    $this->db->where('patient_studies_id',$patient_studies_id);
    $patient_counselling_list = $this->db->get('');
    $list_patient_counselling = $patient_counselling_list->result_array();
    $patient_counselling_list->free_result();
    
    //print_r($list_patient_lifestyle);exit;

    return $list_patient_counselling;
}

}


?>
