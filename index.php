<?php

/*
 * ---------------------------------------------------------------
 * APPLICATION ENVIRONMENT
 * ---------------------------------------------------------------
 *
 * You can load different configurations depending on your
 * current environment. Setting the environment also influences
 * things like logging and error reporting.
 *
 * This can be set to anything, but default usage is:
 *
 *     development
 *     testing
 *     production
 *
 * NOTE: If you change these, also change the error_reporting() code below
 *
 */
define('ENVIRONMENT', 'development');
/* define('hrt_start_date', 3);
  define('hrt_start_date', 3);
  define('contraceptive_end_age', 4);
  define('hrt_start_age', 5); */
//For Personal worksheet $data_patient
/* define('given_name', 0);
  define('surname', 1);
  define('maiden_name', 2);
  define('nationality', 4);
  define('ic_no', 5);
  define('family_no', 3);
  define('gender', 6);
  define('ethnicity', 7);
  define('d_o_b', 8);
  define('place_of_birth', 9);
  define('marital_status', 10);
  define('blood_group', 11);
  define('comment', 36);
  define('is_dead', 12);
  define('d_o_d', 13);
  define('reason_of_death', 14);
  define('blood_card', 19);
  define('blood_card_location', 20);
  define('address', 21);
  define('home_phone', 22);
  define('cell_phone', 23);
  define('work_phone', 24);
  define('other_phone', 25);
  define('fax', 26);
  define('email', 27);
  define('height', 29);
  define('weight', 30);
  define('bmi', 31);
  define('highest_education_level', 28);
  define('income_level', 32);

  //for $data_patient_hospital_no
  define('hospital_no', 15);

  //for $data_patient_private_no
  define('private_no', 16);

  //for $data_patient_cogs_studies
  define('COGS_studies_name', 17);
  define('COGS_studies_no', 18);

  //for $data_patient_contact_person
  define('contact_name', 33);
  define('contact_relationship', 35);
  define('contact_telephone', 34);

  //for $data_patient_relatives_summary
  define('total_no_of_male_siblings', 37);
  define('total_no_of_female_siblings', 38);
  define('total_no_of_affected_siblings', 39);
  define('total_no_of_male_children', 40);
  define('total_no_of_female_children', 41);
  define('total_no_of_affected_children', 42);
  define('total_no_of_1st_degree', 43);
  define('total_no_of_2nd_degree', 44);
  define('total_no_of_3rd_degree', 45);
  define('total_no_of_siblings', 46);

  //for $data_patient_survival_status
  define('source', 47);
  define('alive_status', 48);
  define('status_gathering_date', 49); */

/////////Sreening and Surveilance1\\\\\\\\\\\\

define('patient_IC_no', 0);
define('studies_name', 1);
define('date_of_first_mammogram', 2);
define('age_at_first_mammogram', 3);
define('date_of_recent_mammogram', 4);
define('age_of_recent_mammogram', 5);
define('screening_center', 6);
define('radiologist_name', 7);
define('abnormalities_detected', 8);
define('mammo_comments', 9);
define('total_no_of_mammogram', 10);
define('screening_intervals', 11);
define('BIRADS_clinical_classification', 12);
define('BIRADS_density_classification', 13);
define('percentage_of_mammo_density', 14);
define('mammo_left_right_breast_site', 15);
define('mammo_upper_below_breast_site', 16);
define('mammo_abnormality_flag', 17);
define('had_ultrasound_flag', 18);
define('total_no_ultrasound', 19);
define('ultrasound_abnormalities_flag', 20);
define('ultrasound_date', 21);
define('ultrasound_abnormality_detected_flag', 22);
define('Ultrasound_abnormality_comments', 23);
define('had_mri_flag', 24);
define('total_no_mri', 25);
define('abnormalities_MRI_flag', 26);
define('MRI_date', 27);
define('MRI_abnormality_detected_flag', 28);
define('MRI_abnormality_comments', 29);
define('screening_center_of_first_mammogram', 30);
define('screening_center_of_recent_mammogram', 31);
define('details_of_first_mammogram', 32);
define('details_of_recent_mammogram', 33);
define('motivaters_of_first_mammogram', 34);
define('motivaters_of_recent_mammogram', 35);
define('mammogram_in_sdmc', 36);
define('reason_of_mammogram', 37);
define('reason_of_mammogram_details', 38);
define('action_suggested_on_mammogram_report', 39);
define('reason_of_action_suggested', 40);
define('site_effected_of_mammogram', 41);
define('is_cancer_mammogram_flag', 42);

/////////Lifestyles1\\\\\\\\\\\\          
define('questionnaire_date', 2);
define('self_image_at_7', 3);
define('self_image_at_18', 4);
define('self_image_now', 5);
define('pa_strenuous_activity_childhood', 6);
define('pa_moderate_exercise_childhood', 7);
define('pa_gentle_exercise_childhood', 8);
define('pa_strenuous_activity_now', 9);
define('pa_moderate_exercise_now', 10);
define('pa_gentle_exercise_now', 11);
define('pa_strenuous_activity_adult', 12);
define('pa_moderate_exercise_adult', 13);
define('pa_gentle_exercise_adult', 14);
define('cigarettes_smoked_now', 15);
define('cigarettes_still_smoked', 16);
define('total_smoked_years', 17);
define('cigarettes_count_at_teen', 18);
define('cigarettes_count_at_twenties', 19);
define('cigarettes_count_at_thirties', 20);
define('cigarettes_count_at_fourties', 21);
define('cigarettes_count_at_fifties', 22);
define('cigarettes_count_at_sixties', 23);
define('cigarettes_count_one_year_prior', 24);
define('alcohol_drunk_flag', 25);
define('alcohol_frequency', 26);
define('alcohol_comments', 27);
define('coffee_drunk_flag', 28);
define('coffee_age', 29);
define('coffee_frequency', 30);
define('tea_drunk_flag', 31);
define('tea_age', 32);
define('tea_type', 33);
define('tea_frequency', 34);
define('soya_bean_drunk_flag', 35);
define('soya_bean_frequency', 36);
define('soya_products_flag', 37);
define('soya_products_average', 38);
define('diabetes_flag', 39);
define('medicine_for_diabetes_flag', 40);
define('diabetes_medicine_name', 41);

////////////Sreening and Surveilance5\\\\\\\\\\\\\\
define('recruitment_center', 2);	
define('surveillance_type', 3);	
define('first_consultation_date', 4);	
define('first_consultation_place', 5);	
define('interval', 6);	
define('diagnosis', 7);	
define('due_date', 8);	
define('reminder_sent_date', 9);	
define('surveillance_done_date', 10);	
define('reminded_by', 11);	
define('timing', 12);	
define('symptoms', 13);	
define('doctor_name', 14);	
define('survillance_done_place', 15);
define('outcome', 16);	
define('comments', 17);


/*
 * ---------------------------------------------------------------
 * ERROR REPORTING
 * ---------------------------------------------------------------
 *
 * Different environments will require different levels of error reporting.
 * By default development will show errors but testing and live will hide them.
 */

if (defined('ENVIRONMENT')) {
    switch (ENVIRONMENT) {
        case 'development':
            error_reporting(E_ALL);
            break;

        case 'testing':
        case 'production':
            error_reporting(0);
            break;

        default:
            exit('The application environment is not set correctly.');
    }
}

/*
 * ---------------------------------------------------------------
 * SYSTEM FOLDER NAME
 * ---------------------------------------------------------------
 *
 * This variable must contain the name of your "system" folder.
 * Include the path if the folder is not in the same  directory
 * as this file.
 *
 */
$system_path = 'system';

/*
 * ---------------------------------------------------------------
 * APPLICATION FOLDER NAME
 * ---------------------------------------------------------------
 *
 * If you want this front controller to use a different "application"
 * folder then the default one you can set its name here. The folder
 * can also be renamed or relocated anywhere on your server.  If
 * you do, use a full server path. For more info please see the user guide:
 * http://codeigniter.com/user_guide/general/managing_apps.html
 *
 * NO TRAILING SLASH!
 *
 */
$application_folder = 'application';

/*
 * --------------------------------------------------------------------
 * DEFAULT CONTROLLER
 * --------------------------------------------------------------------
 *
 * Normally you will set your default controller in the routes.php file.
 * You can, however, force a custom routing by hard-coding a
 * specific controller class/function here.  For most applications, you
 * WILL NOT set your routing here, but it's an option for those
 * special instances where you might want to override the standard
 * routing in a specific front controller that shares a common CI installation.
 *
 * IMPORTANT:  If you set the routing here, NO OTHER controller will be
 * callable. In essence, this preference limits your application to ONE
 * specific controller.  Leave the function name blank if you need
 * to call functions dynamically via the URI.
 *
 * Un-comment the $routing array below to use this feature
 *
 */
// The directory name, relative to the "controllers" folder.  Leave blank
// if your controller is not in a sub-folder within the "controllers" folder
// $routing['directory'] = '';
// The controller class file name.  Example:  Mycontroller
// $routing['controller'] = '';
// The controller function you wish to be called.
// $routing['function']	= '';


/*
 * -------------------------------------------------------------------
 *  CUSTOM CONFIG VALUES
 * -------------------------------------------------------------------
 *
 * The $assign_to_config array below will be passed dynamically to the
 * config class when initialized. This allows you to set custom config
 * items or override any default config values found in the config.php file.
 * This can be handy as it permits you to share one application between
 * multiple front controller files, with each file containing different
 * config values.
 *
 * Un-comment the $assign_to_config array below to use this feature
 *
 */
// $assign_to_config['name_of_config_item'] = 'value of config item';
// --------------------------------------------------------------------
// END OF USER CONFIGURABLE SETTINGS.  DO NOT EDIT BELOW THIS LINE
// --------------------------------------------------------------------

/*
 * ---------------------------------------------------------------
 *  Resolve the system path for increased reliability
 * ---------------------------------------------------------------
 */

// Set the current directory correctly for CLI requests
if (defined('STDIN')) {
    chdir(dirname(__FILE__));
}

if (realpath($system_path) !== FALSE) {
    $system_path = realpath($system_path) . '/';
}

// ensure there's a trailing slash
$system_path = rtrim($system_path, '/') . '/';

// Is the system path correct?
if (!is_dir($system_path)) {
    exit("Your system folder path does not appear to be set correctly. Please open the following file and correct this: " . pathinfo(__FILE__, PATHINFO_BASENAME));
}

/*
 * -------------------------------------------------------------------
 *  Now that we know the path, set the main path constants
 * -------------------------------------------------------------------
 */
// The name of THIS file
define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));

// The PHP file extension
// this global constant is deprecated.
define('EXT', '.php');

// Path to the system folder
define('BASEPATH', str_replace("\\", "/", $system_path));

// Path to the front controller (this file)
define('FCPATH', str_replace(SELF, '', __FILE__));

// Name of the "system folder"
define('SYSDIR', trim(strrchr(trim(BASEPATH, '/'), '/'), '/'));


// The path to the "application" folder
if (is_dir($application_folder)) {
    define('APPPATH', $application_folder . '/');
} else {
    if (!is_dir(BASEPATH . $application_folder . '/')) {
        exit("Your application folder path does not appear to be set correctly. Please open the following file and correct this: " . SELF);
    }

    define('APPPATH', BASEPATH . $application_folder . '/');
}

/*
 * --------------------------------------------------------------------
 * LOAD THE BOOTSTRAP FILE
 * --------------------------------------------------------------------
 *
 * And away we go...
 *
 */
require_once BASEPATH . 'core/CodeIgniter.php';

/* End of file index.php */
/* Location: ./index.php */