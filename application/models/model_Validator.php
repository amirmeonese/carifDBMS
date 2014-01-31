<?php
class Model_Validator extends CI_Model {
function check_name($name) {
        if (ctype_alpha(str_replace(array(' ', "'", '@', '/','.','-','(',')'), '', $name)))   //if (ctype_alpha(str_replace(' ', '', $name)))
            return TRUE;
        else
            return FALSE;
    }

    public function check_IC_NO($ic_no) {
        if (ctype_digit($ic_no))
            return TRUE;
        else
            return FALSE;
    }

    public function check_phone_no($phone_no) {
        if (ctype_digit($phone_no))
            return TRUE;
        else
            return FALSE;
    }

    public function check_email($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL))
            return TRUE;
        else
            return FALSE;
    }
    
    public function showMessage($field,$worksheetName,$row) {
        echo '<h2>'.$field.' is not in appropriate format at '.$worksheetName . '		row	' . $row . '</h2>';
    }
}
    
?>
