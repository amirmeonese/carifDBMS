<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Database Type
| -------------------------------------------------------------------------
| If set to TRUE, Ion Auth will use MongoDB as its database backend.
|
| If you use MongoDB there are two external dependencies that have to be
| integrated with your project:
|   CodeIgniter MongoDB Active Record Library - http://github.com/alexbilbie/codeigniter-mongodb-library/tree/v2
|   CodeIgniter MongoDB Session Library - http://github.com/sepehr/ci-mongodb-session
*/
$config['use_mongodb'] = FALSE;

/*
| -------------------------------------------------------------------------
| MongoDB Collection.
| -------------------------------------------------------------------------
| Setup the mongodb docs using the following command:
| $ mongorestore sql/mongo
|
*/
$config['collections']['users']          = 'users';
$config['collections']['groups']         = 'groups';
$config['collections']['login_attempts'] = 'login_attempts';

/*
| -------------------------------------------------------------------------
| Tables.
| -------------------------------------------------------------------------
| Database table names.
*/
$config['tables']['users']           = 'users';
$config['tables']['groups']          = 'groups';
$config['tables']['users_groups']    = 'users_groups';
$config['tables']['login_attempts']  = 'login_attempts';
$config['tables']['patient'] = 'patient';
$config['tables']['patient_relatives'] = 'patient_relatives';

$config['tables']['cancer'] = 'cancer';
$config['tables']['cancer_site'] = 'cancer_site';
$config['tables']['diagnosis'] = 'diagnosis';
$config['tables']['family'] = 'family';
$config['tables']['patient_breast_abnormality'] = 'patient_breast_abnormality';
$config['tables']['patient_breast_screening'] = 'patient_breast_screening';
$config['tables']['patient_cancer'] = 'patient_cancer';
$config['tables']['patient_cancer_recurrent'] = 'patient_cancer_recurrent';
$config['tables']['patient_cancer_site'] = 'patient_cancer_site';
$config['tables']['patient_cancer_treatment'] = 'patient_cancer_treatment';
$config['tables']['patient_contact_person'] = 'patient_contact_person';
$config['tables']['patient_diagnosis'] = 'patient_diagnosis';
$config['tables']['patient_family'] = 'patient_family';
$config['tables']['patient_gynaecological_surgery_history'] = 'patient_gynaecological_surgery_history';
$config['tables']['patient_investigations'] = 'patient_investigations';
$config['tables']['patient_lifestyle_factors'] = 'patient_lifestyle_factors';
$config['tables']['patient_menstruation'] = 'patient_menstruation';
$config['tables']['patient_mri_abnormality'] = 'patient_mri_abnormality';
$config['tables']['patient_other_screening'] = 'patient_other_screening';
$config['tables']['patient_parity_record'] = 'patient_parity_record';
$config['tables']['patient_parity_table'] = 'patient_parity_table';
$config['tables']['patient_pathology'] = 'patient_pathology';
$config['tables']['patient_relatives'] = 'patient_relatives';
$config['tables']['patient_studies'] = 'patient_studies';
$config['tables']['patient_surveillance'] = 'patient_surveillance';
$config['tables']['patient_ultrasound_abnormality'] = 'patient_ultrasound_abnormality';
$config['tables']['relatives'] = 'relatives';
$config['tables']['studies'] = 'studies';
$config['tables']['treatment'] = 'treatment';
$config['tables']['patient_interview_manager'] = 'patient_interview_manager';
$config['tables']['patient_mammo_raw_images'] = 'patient_mammo_raw_images';
$config['tables']['patient_mammo_processed_images'] = 'patient_mammo_processed_images';
$config['tables']['patient_infertility'] = 'patient_infertility';
$config['tables']['patient_boadicea'] = 'patient_boadicea';
$config['tables']['patient_interview_manager'] = 'patient_interview_manager';
$config['tables']['patient_survival_status'] = 'patient_survival_status';
$config['tables']['patient_relatives_summary'] = 'patient_relatives_summary';
$config['tables']['non_cancerous_site'] = 'non_cancerous_site';
$config['tables']['patient_risk_reducing_surgery'] = 'patient_risk_reducing_surgery';
$config['tables']['patient_risk_reducing_surgery_complete_removal'] = 'patient_risk_reducing_surgery_complete_removal';
$config['tables']['patient_risk_reducing_surgery_lesion'] = 'patient_risk_reducing_surgery_lesion';
$config['tables']['patient_non_cancer_surgery'] = 'patient_non_cancer_surgery';
$config['tables']['ovarian_screening_type'] = 'ovarian_screening_type';
$config['tables']['patient_ovarian_screening'] = 'patient_ovarian_screening';
$config['tables']['patient_other_disease'] = 'patient_other_disease';
$config['tables']['patient_hospital_no'] = 'patient_hospital_no';
$config['tables']['patient_cogs_studies'] = 'patient_cogs_studies';
$config['tables']['patient_private_no'] = 'patient_private_no';
$config['tables']['patient_mutation_analysis'] = 'patient_mutation_analysis';
$config['tables']['patient_risk_assessment'] = 'patient_risk_assessment';
$config['tables']['patient_other_disease_medication'] = 'patient_other_disease_medication';
$config['tables']['patient_pathology_staining_status'] = 'patient_pathology_staining_status';

/*
 | Users table column and Group table column you want to join WITH.
 |
 | Joins from users.id
 | Joins from groups.id
 */
$config['join']['users']  = 'user_id';
$config['join']['groups'] = 'group_id';

/*
 | -------------------------------------------------------------------------
 | Hash Method (sha1 or bcrypt)
 | -------------------------------------------------------------------------
 | Bcrypt is available in PHP 5.3+
 |
 | IMPORTANT: Based on the recommendation by many professionals, it is highly recommended to use
 | bcrypt instead of sha1.
 |
 | NOTE: If you use bcrypt you will need to increase your password column character limit to (80)
 |
 | Below there is "default_rounds" setting.  This defines how strong the encryption will be,
 | but remember the more rounds you set the longer it will take to hash (CPU usage) So adjust
 | this based on your server hardware.
 |
 | If you are using Bcrypt the Admin password field also needs to be changed in order login as admin:
 | $2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36
 |
 | Becareful how high you set max_rounds, I would do your own testing on how long it takes
 | to encrypt with x rounds.
 */
$config['hash_method']    = 'sha1';	// IMPORTANT: Make sure this is set to either sha1 or bcrypt
$config['default_rounds'] = 8;		// This does not apply if random_rounds is set to true
$config['random_rounds']  = FALSE;
$config['min_rounds']     = 5;
$config['max_rounds']     = 9;

/*
 | -------------------------------------------------------------------------
 | Authentication options.
 | -------------------------------------------------------------------------
 | maximum_login_attempts: This maximum is not enforced by the library, but is
 | used by $this->ion_auth->is_max_login_attempts_exceeded().
 | The controller should check this function and act
 | appropriately. If this variable set to 0, there is no maximum.
 */
$config['site_title']                 = "Example.com";       // Site Title, example.com
$config['admin_email']                = "admin@example.com"; // Admin Email, admin@example.com
$config['default_group']              = 'members';           // Default group, use name
$config['admin_group']                = 'admin';             // Default administrators group, use name
$config['identity']                   = 'username';             // A database column which is used to login with
$config['min_password_length']        = 8;                   // Minimum Required Length of Password
$config['max_password_length']        = 20;                  // Maximum Allowed Length of Password
$config['email_activation']           = TRUE;               // Email Activation for registration
$config['manual_activation']          = FALSE;               // Manual Activation for registration
$config['remember_users']             = TRUE;                // Allow users to be remembered and enable auto-login
$config['user_expire']                = 86500;               // How long to remember the user (seconds). Set to zero for no expiration
$config['user_extend_on_login']       = FALSE;               // Extend the users cookies everytime they auto-login
$config['track_login_attempts']       = FALSE;               // Track the number of failed login attempts for each user or ip.
$config['maximum_login_attempts']     = 3;                   // The maximum number of failed login attempts.
$config['lockout_time']               = 600;                 // The number of seconds to lockout an account due to exceeded attempts
$config['forgot_password_expiration'] = 0;                   // The number of miliseconds after which a forgot password request will expire. If set to 0, forgot password requests will not expire.


/*
 | -------------------------------------------------------------------------
 | Email options.
 | -------------------------------------------------------------------------
 | email_config:
 | 	  'file' = Use the default CI config or use from a config file
 | 	  array  = Manually set your email config settings
 */
$config['use_ci_email'] = TRUE; // Send Email using the builtin CI email class, if false it will return the code and the identity
$config['email_config'] = array(
	'mailtype' => 'html',
);

/*
 | -------------------------------------------------------------------------
 | Email templates.
 | -------------------------------------------------------------------------
 | Folder where email templates are stored.
 | Default: auth/
 */
$config['email_templates'] = 'auth/email/';

/*
 | -------------------------------------------------------------------------
 | Activate Account Email Template
 | -------------------------------------------------------------------------
 | Default: activate.tpl.php
 */
$config['email_activate'] = 'activate.tpl.php';

/*
 | -------------------------------------------------------------------------
 | Forgot Password Email Template
 | -------------------------------------------------------------------------
 | Default: forgot_password.tpl.php
 */
$config['email_forgot_password'] = 'forgot_password.tpl.php';

/*
 | -------------------------------------------------------------------------
 | Forgot Password Complete Email Template
 | -------------------------------------------------------------------------
 | Default: new_password.tpl.php
 */
$config['email_forgot_password_complete'] = 'new_password.tpl.php';

/*
 | -------------------------------------------------------------------------
 | Salt options
 | -------------------------------------------------------------------------
 | salt_length Default: 10
 |
 | store_salt: Should the salt be stored in the database?
 | This will change your password encryption algorithm,
 | default password, 'password', changes to
 | fbaa5e216d163a02ae630ab1a43372635dd374c0 with default salt.
 */
$config['salt_length'] = 10;
$config['store_salt']  = FALSE;

/*
 | -------------------------------------------------------------------------
 | Message Delimiters.
 | -------------------------------------------------------------------------
 */
$config['message_start_delimiter'] = '<p>'; 	// Message start delimiter
$config['message_end_delimiter']   = '</p>'; 	// Message end delimiter
$config['error_start_delimiter']   = '<p>';		// Error mesage start delimiter
$config['error_end_delimiter']     = '</p>';	// Error mesage end delimiter

/* End of file ion_auth.php */
/* Location: ./application/config/ion_auth.php */
