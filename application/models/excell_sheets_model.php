<?php

class Excell_sheets_model extends CI_Model {

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

    public function insert_patient_record($record_data) {
        $data = array(
        );
        $record_data = array_merge($this->_filter_data($this->tables['patient'], $data), $record_data);
        $this->db->insert_batch($this->tables['patient'], $record_data);

        $id = $this->db->insert_id();
        return $id;
    }
    
     public function insert_record($record_data,$table_name) {
        $data = array(
        );
        $record_data = array_merge($this->_filter_data($this->tables[$table_name], $data), $record_data);
        $this->db->insert_batch($this->tables[$table_name], $record_data);

        $id = $this->db->insert_id();
        return $id;
    }
    
    public function insert_patient_relatives_record($record_data) {
        $data = array(
        );
        $record_data = array_merge($this->_filter_data($this->tables['patient_relatives'], $data), $record_data);
        $this->db->insert_batch($this->tables['patient_relatives'], $record_data);

        $id = $this->db->insert_id();
        return $id;
    }

    public function insert_patient_studies($record_data) {
        $data = array(
        );
        $record_data = array_merge($this->_filter_data($this->tables['patient_studies'], $data), $record_data);
        $this->db->insert_batch($this->tables['patient_studies'], $record_data);

        $id = $this->db->insert_id();
        return $id;
    }

    public function insert_patient_breast_abnormality($record_data) {
        $data = array(
        );
        $record_data = array_merge($this->_filter_data($this->tables['patient_breast_abnormality'], $data), $record_data);
        $this->db->insert_batch($this->tables['patient_breast_abnormality'], $record_data);

        $id = $this->db->insert_id();
        return $id;
    }

    public function insert_patient_breast_screening($record_data) {
        $data = array(
        );
        $record_data = array_merge($this->_filter_data($this->tables['patient_breast_screening'], $data), $record_data);
        $this->db->insert_batch($this->tables['patient_breast_screening'], $record_data);

        $id = $this->db->insert_id();
        return $id;
    }

    public function get_patient_relatives_id($record_data) {
        $data = array(
        );
        
        $query = $this->db->select('relatives_id')
                ->where('relatives_type', $record_data)
                ->limit(1)
                ->get($this->tables['relatives']);
        $result = null;
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            //echo $result['relatives_id'];
        }

        //print_r($result['relatives_id']);

        return $result['relatives_id'];
    }
    
    public function get_patient_parity_table_id($record_data) {
        $data = array(
        );
        
        $query = $this->db->select('patient_parity_id')
                ->where('patient_studies_id', $record_data)
                ->limit(1)
                ->get($this->tables['patient_parity_table']);
        
        $result = null;
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            //echo $result['relatives_id'];
        }

        //print_r($result['relatives_id']);

        return $result['patient_parity_id'];
    }

     public function get_id($table_name,$selected_col_name,$comparable_col_name,$record_data) {
        $data = array(
        );
        $query = $this->db->select($selected_col_name)
                ->where($comparable_col_name, $record_data)
                ->limit(1)
                ->get($this->tables[$table_name]);

        $result = null;
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
        }

        return $result[$selected_col_name];
    }
    
    public function get_patient_family_no($record_data) {
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

    public function get_patient_relatives_cancer_id($record_data) {
        $data = array(
        );
        $query = $this->db->select('cancer_id')
                ->where('cancer_name', $record_data)
                ->limit(1)
                ->get($this->tables['cancer']);
        $result = null;
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            //echo $result['relatives_id'];
        }

        //print_r($result['relatives_id']);

        return $result['cancer_id'];
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
    
    public function get_patient_studies_id($patient_ic_no,$studies_id) {
        $data = array(
        );
        //echo $patient_ic_no.'    '.$studies_id.'<br/>';
        $query = $this->db->select('patient_studies_id')
                ->where('patient_ic_no', $patient_ic_no)
                ->where('studies_id',$studies_id)
                ->limit(1)
                ->get($this->tables['patient_studies']);
        $result = null;
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            //echo $result['relatives_id'];
        }

        //print_r($result['relatives_id']);

        return $result['patient_studies_id'];
    }
    
      public function get_patient_breast_screening_id($patient_ic_no,$patient_studies_id) {
        $data = array(
        );
        //echo $patient_ic_no.'    '.$studies_id.'<br/>';
        $query = $this->db->select('patient_breast_screening_id')
                ->where('patient_ic_no', $patient_ic_no)
                ->where('patient_studies_id',$patient_studies_id)
                ->limit(1)
                ->get($this->tables['patient_breast_screening']);
        $result = null;
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            //echo $result['relatives_id'];
        }

        //print_r($result['relatives_id']);

        return $result['patient_breast_screening_id'];
    }
    
       public function get_patient_cancer_id($patient_studies_id,$cancer_id,$cancer_site_id) {
        $data = array(
        );
        $query = $this->db->select('patient_cancer_id')
                ->where('patient_studies_id', $patient_studies_id)
                ->where('cancer_id',$cancer_id)
                ->where('cancer_site_id',$cancer_site_id)
                ->limit(1)
                ->get($this->tables['patient_cancer']);
        
        $result = null;
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            //echo $result['relatives_id'];
        }

        //print_r($result['relatives_id']);

        return $result['patient_cancer_id'];
    }

     public function get_patient_other_disease_id($patient_studies_id,$diagnosis_id) {
        $data = array(
        );
        $query = $this->db->select('patient_other_disease_id')
                ->where('patient_studies_id', $patient_studies_id)
                ->where('diagnosis_id',$diagnosis_id)
                ->limit(1)
                ->get($this->tables['patient_other_disease']);
        
        $result = null;
        if ($query->num_rows() > 0) {
            $result = $query->row_array();
            //echo $result['relatives_id'];
        }

        //print_r($result['relatives_id']);

        return $result['patient_other_disease_id'];
    }
}

?>
