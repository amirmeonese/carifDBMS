<?php

class Report_model extends CI_Model {

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

    /*public function like($like, $value = NULL) {
        $this->trigger_events('like');

        if (!is_array($like)) {
            $like = array($like => $value);
        }

        array_push($this->_ion_like, $like);

        return $this;
    }*/

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
        //Report templates : Hard coded for now. Should fetch from database later.
        $data['reportTemplates'] = array(
            'Pathology Report' => 'Pathology Report',
            'Mammo Report' => 'Mammo Report',
            'Investigation Report' => 'Investigation Report',
            'Annual Report' => 'Annual Report'
        );

        return $data;
    }

    function getPatientInfo($record_data) {
        $query = $this->db->select('fullname, surname, ic_no')
                ->like('fullname', $record_data['fullname'])
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
    
    public function get_patient_studies_id($ic_no,$studies_id=NULL){
    
        $this->db->select('patient_studies_id');
        $this->db->where_in('patient_ic_no',$ic_no);
        if(!empty($studies_id)){
        $this->db->where_in('studies_id',$studies_id);
        }
	$p_record = $this->db->get('patient_studies');
        $patient_detail = $p_record->result_array();
        //echo $this->db->last_query();exit;
        $p_record->free_result();  

        return $patient_detail;
    }
    
        public function get_icno_from_studies($patient_studies_id){
    
        $this->db->select('patient_ic_no');
        $this->db->where_in('patient_studies_id',$patient_studies_id);
	$p_record = $this->db->get('patient_studies');
        $patient_detail = $p_record->result_array();
        //echo $this->db->last_query();exit;
        $p_record->free_result();  
        
        return $patient_detail;
    }
    
    public function get_detail_record($ic_no,$table){
    
        $this->db->where_in('patient_ic_no',$ic_no);
	$p_record = $this->db->get_where($table);
        $patient_detail = $p_record->result_array();
        //echo $this->db->last_query();exit;
        $p_record->free_result();  

        return $patient_detail;
    }
    
    public function get_consent_detail_patient_record($ic_no,$patient_studies_id){
         
        $this->db->from('patient_studies a');
        $this->db->join('patient_private_no b','a.patient_studies_id = b.patient_studies_id','left');
        $this->db->where_in('a.patient_ic_no',$ic_no);
        $this->db->where_in('a.patient_studies_id',$patient_studies_id);
	$p_record = $this->db->get('');
        $patient_detail = $p_record->result_array();
        $p_record->free_result(); 
        
        //echo $this->db->last_query();exit;

        return $patient_detail;
    }
    
    public function get_export_mutation_record($patient_studies_id){
        $this->db->select('a.*,b.patient_ic_no,c.private_no');
        $this->db->from('patient_mutation_analysis a');
        $this->db->join('patient_studies b','a.patient_studies_id = b.patient_studies_id','left');
        $this->db->join('patient_private_no c','a.patient_studies_id = c.patient_studies_id','left');
        $this->db->where_in('a.patient_studies_id',$patient_studies_id);
	$p_record = $this->db->get('');
        $patient_detail = $p_record->result_array();
        //echo $this->db->last_query();exit;
        $p_record->free_result();  

        return $patient_detail;
    }
    
    public function get_export_riskassesment_record($ic_no){
    
        $this->db->from('patient_risk_assessment');
        $this->db->where_in('patient_ic_no',$ic_no);
	$p_record = $this->db->get('');
        $patient_detail = $p_record->result_array();
        //echo $this->db->last_query();exit;
        $p_record->free_result();  

        return $patient_detail;
    }
    
    function get_checkbox_value() {
        
        $alivestatuslist = array(
            
            '' => '',
            '0' => 'No',
            '1' => 'Yes'
        );
        
        return $alivestatuslist;
    }
    
    function get_patient_all_cancer_record($patient_studies_id) {
    $this->db->select('a.*,b.patient_ic_no,c.private_no');
    $this->db->from('patient_cancer a');
    $this->db->join('patient_studies b','a.patient_studies_id = b.patient_studies_id','left');
    $this->db->join('patient_private_no c','a.patient_studies_id = c.patient_studies_id','left');
    $this->db->where_in('a.patient_studies_id',$patient_studies_id);
    $patient_lifestyle_list = $this->db->get('');
    $list_patient_lifestyle = $patient_lifestyle_list->result_array();
    $patient_lifestyle_list->free_result();
    
//echo $this->db->last_query();exit;
    return $list_patient_lifestyle;
}

function get_patient_treatment_record($patient_studies_id) {
    $this->db->select('a.*,b.patient_ic_no,c.*,d.private_no');
    $this->db->from('patient_cancer a');
    $this->db->join('patient_studies b','a.patient_studies_id = b.patient_studies_id','left');
    $this->db->join('patient_cancer_treatment c','a.patient_cancer_id = c.patient_cancer_id','left');
    $this->db->join('patient_private_no d','a.patient_studies_id = d.patient_studies_id','left');
    $this->db->where_in('a.patient_studies_id',$patient_studies_id);
    $patient_treatment_list = $this->db->get('');
    $list_patient_treatment = $patient_treatment_list->result_array();
    $patient_treatment_list->free_result();
    
//echo $this->db->last_query();exit;
    return $list_patient_treatment;
}

function get_patient_pathology_record($patient_studies_id) {
    $this->db->select('a.*,b.patient_ic_no,c.*,d.*,e.private_no');
    $this->db->from('patient_cancer a');
    $this->db->join('patient_studies b','a.patient_studies_id = b.patient_studies_id','left');
    $this->db->join('patient_pathology c','a.patient_cancer_id = c.cancer_id','left');
    $this->db->join('patient_pathology_staining_status d','c.patient_pathology_id = d.patient_pathology_id','left');
    $this->db->join('patient_private_no e','a.patient_studies_id = e.patient_studies_id','left');
    $this->db->where_in('a.patient_studies_id',$patient_studies_id);
    $patient_pathology_list = $this->db->get('');
    $list_patient_pathology = $patient_pathology_list->result_array();
    $patient_pathology_list->free_result();
    
//echo $this->db->last_query();exit;
    return $list_patient_pathology;
}

function get_patient_others_desease_record($patient_studies_id) {
    $this->db->select('a.*,b.*,c.patient_ic_no,d.private_no');
    $this->db->from('patient_other_disease a');
    $this->db->join('patient_other_disease_medication b','a.patient_other_disease_id = b.patient_other_disease_id','left');
    $this->db->join('patient_studies c','a.patient_studies_id = c.patient_studies_id','left');
    $this->db->join('patient_private_no d','a.patient_studies_id = d.patient_studies_id','left');
    $this->db->where_in('a.patient_studies_id',$patient_studies_id);
    $other_desease_list = $this->db->get();
    $list_patient_other_desease = $other_desease_list->result_array();    
    $other_desease_list->free_result();
    
    return $list_patient_other_desease;
}

function get_patient_non_cancer_record($patient_studies_id) {
    $this->db->select('a.*,b.patient_ic_no,c.private_no');
    $this->db->from('patient_non_cancer_surgery a');
    $this->db->join('patient_studies b','a.patient_studies_id = b.patient_studies_id','left');
    $this->db->join('patient_private_no c','a.patient_studies_id = c.patient_studies_id','left');
    $this->db->where_in('a.patient_studies_id',$patient_studies_id);
    $patient_counselling_list = $this->db->get('');
    $list_patient_counselling = $patient_counselling_list->result_array();
    $patient_counselling_list->free_result();
    
    //print_r($list_patient_lifestyle);exit;

    return $list_patient_counselling;
}

function get_patient_risk_reducing_surgery_record($patient_studies_id) {
    $this->db->select('a.*,b.*,c.patient_risk_reducing_surgery_lesion_id,c.non_cancerous_site_id as lesion_non_cancerous_site_id, c.surgery_date as lesion_surgery_date,d.patient_ic_no,e.private_no');
    $this->db->from('patient_risk_reducing_surgery a');
    $this->db->join('patient_risk_reducing_surgery_complete_removal b','a.patient_risk_reducing_surgery_id = b.patient_risk_reducing_surgery_id','left');
    $this->db->join('patient_risk_reducing_surgery_lesion c','a.patient_risk_reducing_surgery_id = c.patient_risk_reducing_surgery_id','left');
    $this->db->join('patient_studies d','a.patient_studies_id = d.patient_studies_id','left');
    $this->db->join('patient_private_no e','a.patient_studies_id = e.patient_studies_id','left');
    $this->db->where_in('a.patient_studies_id',$patient_studies_id);
    $patient_lifestyle_list = $this->db->get('');
    $list_patient_lifestyle = $patient_lifestyle_list->result_array();
    $patient_lifestyle_list->free_result();
    
    //echo $this->db->last_query();exit;
    
    //print_r($list_patient_lifestyle);exit;
    
    return $list_patient_lifestyle;
}

function get_patient_ovarian_screening_record($patient_studies_id) {
    $this->db->select('a.*,b.patient_ic_no,c.private_no');
    $this->db->from('patient_ovarian_screening a');
    $this->db->join('patient_studies b','a.patient_studies_id = b.patient_studies_id','left');
    $this->db->join('patient_private_no c','a.patient_studies_id = c.patient_studies_id','left');
    $this->db->where_in('a.patient_studies_id',$patient_studies_id);
    $patient_counselling_list = $this->db->get('');
    $list_patient_counselling = $patient_counselling_list->result_array();
    $patient_counselling_list->free_result();
    
    //print_r($list_patient_lifestyle);exit;

    return $list_patient_counselling;
}

function get_patient_surveillance_record($patient_studies_id) {
    $this->db->select('a.*,b.patient_ic_no,c.private_no');
    $this->db->from('patient_surveillance a');
    $this->db->join('patient_studies b','a.patient_studies_id = b.patient_studies_id','left');
    $this->db->join('patient_private_no c','a.patient_studies_id = c.patient_studies_id','left');
    $this->db->where_in('a.patient_studies_id',$patient_studies_id);
    $patient_counselling_list = $this->db->get('');
    $list_patient_counselling = $patient_counselling_list->result_array();
    $patient_counselling_list->free_result();
    
    //print_r($list_patient_lifestyle);exit;

    return $list_patient_counselling;
}

function get_patient_other_screening_record($patient_studies_id) {
    $this->db->select('a.*,b.patient_ic_no,c.private_no');
    $this->db->from('patient_other_screening a');
    $this->db->join('patient_studies b','a.patient_studies_id = b.patient_studies_id','left');
    $this->db->join('patient_private_no c','a.patient_studies_id = c.patient_studies_id','left');
    $this->db->where_in('a.patient_studies_id',$patient_studies_id);
    $patient_counselling_list = $this->db->get('');
    $list_patient_counselling = $patient_counselling_list->result_array();
    $patient_counselling_list->free_result();
    
    //print_r($list_patient_lifestyle);exit;

    return $list_patient_counselling;
}

public function get_lifestyle_detail_patient_record($patient_studies_id){
         
        $this->db->select('a.*,b.patient_ic_no,c.private_no');
        $this->db->from('patient_lifestyle_factors a');
        $this->db->join('patient_studies b','a.patient_studies_id = b.patient_studies_id','left');
        $this->db->join('patient_private_no c','a.patient_studies_id = c.patient_studies_id','left');
        $this->db->where_in('a.patient_studies_id',$patient_studies_id);
	$p_record = $this->db->get('');
        $patient_lifestyle = $p_record->result_array();
        //echo $this->db->last_query();exit;
        $p_record->free_result();  

        return $patient_lifestyle;
    }
    
    public function get_patient_menstruation_record($patient_studies_id){
         
        $this->db->select('a.*,b.patient_ic_no,c.private_no');
        $this->db->from('patient_menstruation a');
        $this->db->join('patient_studies b','a.patient_studies_id = b.patient_studies_id','left');
        $this->db->join('patient_private_no c','a.patient_studies_id = c.patient_studies_id','left');
        $this->db->where_in('a.patient_studies_id',$patient_studies_id);
	$p_record = $this->db->get('');
        $patient_lifestyle = $p_record->result_array();
       // echo $this->db->last_query();exit;
        $p_record->free_result();  

        return $patient_lifestyle;
    }
    
     public function get_patient_parity_table_record($patient_studies_id) {
        $this->db->select('a.*,b.*,c.patient_ic_no,d.private_no');
        $this->db->from('patient_parity_table a');
        $this->db->join('patient_parity_record b', 'a.patient_parity_id = b.patient_parity_table_id', 'left');
        $this->db->join('patient_studies c','a.patient_studies_id = c.patient_studies_id','left');
        $this->db->join('patient_private_no d','a.patient_studies_id = d.patient_studies_id','left');
        $this->db->where_in('a.patient_studies_id', $patient_studies_id);
        $p_record = $this->db->get('');
        $patient_lifestyle = $p_record->result_array();
        // echo $this->db->last_query();exit;
        $p_record->free_result();

        return $patient_lifestyle;
    }
    
    public function get_patient_infertility_record($patient_studies_id){
         
        $this->db->select('a.*,b.patient_ic_no,c.private_no');
        $this->db->from('patient_infertility a');
        $this->db->join('patient_studies b','a.patient_studies_id = b.patient_studies_id','left');
        $this->db->join('patient_private_no c','a.patient_studies_id = c.patient_studies_id','left');
        $this->db->where_in('a.patient_studies_id',$patient_studies_id);
	$p_record = $this->db->get('');
        $patient_lifestyle = $p_record->result_array();
       // echo $this->db->last_query();exit;
        $p_record->free_result();  

        return $patient_lifestyle;
    }
    
    public function get_patient_gynaecological_record($patient_studies_id){
         
        $this->db->select('a.*,b.patient_ic_no,c.private_no');
        $this->db->from('patient_gynaecological_surgery_history a');
        $this->db->join('patient_studies b','a.patient_studies_id = b.patient_studies_id','left');
        $this->db->join('patient_private_no c','a.patient_studies_id = c.patient_studies_id','left');
        $this->db->where_in('a.patient_studies_id',$patient_studies_id);
	$p_record = $this->db->get('');
        $patient_lifestyle = $p_record->result_array();
       // echo $this->db->last_query();exit;
        $p_record->free_result();  

        return $patient_lifestyle;
    }
    
    
        function getReportData($record_data,$ethnic_name = NULL, $cancer_name = NULL,$start) {
            
            $ic_no = $this->input->post('ic_no');
            
            if ($record_data['date_start'] == '1970-01-01'){
              $start_date = "";  
            } else {
            
            $start_date = $record_data['date_start'];
            
            }
            
            if ($record_data['date_end'] == '1970-01-01'){
              $end_date = "";  
            } else {
            
            $end_date = $record_data['date_end'];
            
            }
            
            if ($record_data['consent_date_start'] == '1970-01-01'){
              $consent_date_start = "";  
            } else {
            
              $consent_date_start = $record_data['consent_date_start'];
            
            }
            
            if ($record_data['consent_date_end'] == '1970-01-01'){
              $consent_date_end = "";  
            } else {
            
            $consent_date_end = $record_data['consent_date_end'];
            
            }
            
            if ($record_data['creation_date_start'] == '1970-01-01'){
              $creation_start_date = "";  
            } else {
            
            $creation_start_date = $record_data['creation_date_start'];
            
            }
            
            if ($record_data['creation_date_end'] == '1970-01-01'){
              $creation_end_date = "";  
            } else {
            
            $creation_end_date = $record_data['creation_date_end'];
            
            }
            
            $start_age = $record_data['age_start'];
            $end_age = $record_data['age_end'];
            
        
        $this->db->select('a.given_name, a.surname, a.ic_no, a.ethnicity, b.studies_id,b.patient_studies_id, b.date_at_consent');
        $this->db->from('patient a');
        $this->db->where('a.is_deleted',0);
        $this->db->join('patient_studies b','a.ic_no = b.patient_ic_no','left');
        $this->db->select('c.date_of_diagnosis,c.age_of_diagnosis');
        $this->db->join('patient_cancer c','b.patient_studies_id = c.patient_studies_id','left');
        if (!empty ($ethnic_name)) {
        $this->db->where_in('a.ethnicity', $ethnic_name);
        }
        if (!empty ($cancer_name)) {
        $this->db->where_in('c.cancer_id', $cancer_name);
        }
        if (!empty ($start_age) || ($end_age)) {
        $this->db->where("c.age_of_diagnosis BETWEEN '$start_age' AND '$end_age'", NULL, FALSE);
        }
        if (!empty ($start_date) || ($end_date)) {
        $this->db->where("c.date_of_diagnosis BETWEEN '$start_date' AND '$end_date'", NULL, FALSE);
        }
        if (!empty ($creation_start_date) || ($creation_end_date)) {
        $this->db->where("a.created_on BETWEEN '$creation_start_date' AND '$creation_end_date'", NULL, FALSE);
        }
        if (!empty ($consent_date_start) || ($consent_date_end)) {
        $this->db->where("b.date_at_consent BETWEEN '$consent_date_start' AND '$consent_date_end'", NULL, FALSE);
        }
        if (!empty ($ic_no)) {
                $this->db->where_in('a.ic_no', $ic_no);
            }
        if (!empty ($record_data['studies_name'])) {
                $this->db->like('b.studies_id', $record_data['studies_name']);
        }
       // $this->db->like('c.cancer_id', $record_data['cancer']);
        $this->db->group_by('ic_no');
        $this->db->limit(1000, $start);
        $this->db->order_by("a.given_name", "asc");
        $patient_list = $this->db->get('');
        $list_patient = $patient_list->result_array();
        
//        echo $this->db->last_query();exit;
                
        $patient_list->free_result();

        return $list_patient;
    }
    

    function getExcelData($record_data,$ethnic_name) {
            
            if ($record_data['date_start'] == '1970-01-01'){
              $start_date = "";  
            } else {
            
            $start_date = $record_data['date_start'];
            
            }
            
            if ($record_data['date_end'] == '1970-01-01'){
              $end_date = "";  
            } else {
            
            $end_date = $record_data['date_end'];
            
            }
            if ($record_data['creation_date_start'] == '1970-01-01'){
              $creation_start_date = "";  
            } else {
            
            $creation_start_date = $record_data['creation_start_date'];
            
            }
            
            if ($record_data['creation_date_end'] == '1970-01-01'){
              $creation_end_date = "";  
            } else {
            
            $creation_end_date = $record_data['creation_end_date'];
            
            }
            
            $start_age = $record_data['age_start'];
            $end_age = $record_data['age_end'];
            
        
        $this->db->select('a.given_name, a.surname, a.ic_no, a.ethnicity, b.studies_id, c.date_of_diagnosis,c.age_of_diagnosis');
        $this->db->from('patient a');
        $this->db->where('a.is_deleted',0);
        $this->db->join('patient_studies b','a.ic_no = b.patient_ic_no','left');
        $this->db->join('patient_cancer c','b.patient_studies_id = c.patient_studies_id','left');
        if (!empty ($ethnic_name)) {
        $this->db->where_in('a.ethnicity', $ethnic_name);
        }
        if (!empty ($start_age) || ($end_age)) {
        $this->db->where("c.age_of_diagnosis BETWEEN '$start_age' AND '$end_age'", NULL, FALSE);
        }
        if (!empty ($start_date) || ($end_date)) {
        $this->db->where("c.date_of_diagnosis BETWEEN '$start_date' AND '$end_date'", NULL, FALSE);
        }
        if (!empty ($creation_start_date) || ($creation_end_date)) {
        $this->db->where("a.created_on BETWEEN '$creation_start_date' AND '$creation_end_date'", NULL, FALSE);
        }
        $this->db->like('c.cancer_id', $record_data['cancer']);
        $this->db->like('b.studies_id', $record_data['studies_name']);
        $this->db->order_by("a.given_name", "asc");
        $patient_list = $this->db->get('');
        $list_patient = $patient_list->result_array();
        
        //echo $this->db->last_query();exit;
                
        $patient_list->free_result();

        return $list_patient;
    }
    
    function get_treatment_type() {

        
        $this->db->select('treatment_id,treatment_name');
        $this->db->order_by('treatment_name asc');
        $query = $this->db->get('treatment');
        
        $treatmenttypelist = array('' => '');
        foreach ($query->result() as $row) {
            $treatmenttypelist = $treatmenttypelist + array($row->treatment_id => $row->treatment_name);
        }
        $query->free_result();
        return $treatmenttypelist;
    }
    
        function get_all_ethnic()
    {
        
//        $sql = "SELECT a.*, b.facultyid FROM intake_group a, ref_course b WHERE a.courseid = b.courseid ORDER BY facultyid ASC, courseid ASC, intakeid ASC";
        
        $this->db->select('ethnicity');
        $this->db->order_by('ethnicity');
        $this->db->group_by('ethnicity');
        $query = $this->db->get('patient');
        $list_ethnic = $query->result_array();
        $query->free_result();

        return $list_ethnic;
    }
    
    function get_all_cancer()
    {
        
//        $sql = "SELECT a.*, b.facultyid FROM intake_group a, ref_course b WHERE a.courseid = b.courseid ORDER BY facultyid ASC, courseid ASC, intakeid ASC";
        
        $this->db->select('cancer_id,cancer_name');
        $this->db->order_by('cancer_id');
                
        $query = $this->db->get('cancer');
        $list_patient = $query->result_array();

        $query->free_result();

        return $list_patient;
    }
    
    function get_patient_counselling_record($icno) {
    $this->db->from('patient_interview_manager a');
    $this->db->join('patient_private_no b','a.patient_ic_no = b.patient_ic_no','left');
    $this->db->where_in('a.patient_ic_no',$icno);
    $patient_counselling_list = $this->db->get('');
    $list_patient_counselling = $patient_counselling_list->result_array();
    $patient_counselling_list->free_result();
    
    //print_r($list_patient_lifestyle);exit;

    return $list_patient_counselling;
}

    function get_view_family_export($ic_no){
    
        $this->db->select('a.*,b.private_no');
        $this->db->from('patient_relatives a');
        $this->db->join('patient_private_no b','a.patient_ic_no = b.patient_ic_no','left');
        $this->db->where_in('a.patient_ic_no',$ic_no);
	$f_record = $this->db->get('');
        $patient_family_detail = $f_record->result_array();
        //echo $this->db->last_query();exit;
        $f_record->free_result();  

        return $patient_family_detail;
    }
    
    function get_patient_breast_screening_record($patient_studies_id,$ic_no) {
    
    $this->db->select('a.*,b.*,c.*,d.*,c.comments as ultrasound_comments,b.is_abnormality_detected as breast_is_abnormality_detected,e.private_no');
    $this->db->from('patient_breast_screening a');
    $this->db->join('patient_breast_abnormality b','a.patient_breast_screening_id = b.patient_breast_screening_id','left');
    $this->db->join('patient_ultrasound_abnormality c','a.patient_breast_screening_id = c.patient_breast_screening_id','left');
    $this->db->join('patient_mri_abnormality d','a.patient_breast_screening_id = d.patient_breast_screening_id','left');
    $this->db->join('patient_private_no e','a.patient_studies_id = e.patient_studies_id','left');
    $this->db->where_in('a.patient_studies_id',$patient_studies_id);
    $patient_lifestyle_list = $this->db->get('');
    $list_patient_lifestyle = $patient_lifestyle_list->result_array();
    $patient_lifestyle_list->free_result();
    
    return $list_patient_lifestyle;
}
}

?>
