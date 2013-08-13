-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 13, 2013 at 12:37 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `carif_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cancer`
--

CREATE TABLE IF NOT EXISTS `cancer` (
  `cancer_id` int(10) NOT NULL AUTO_INCREMENT,
  `cancer_name` text NOT NULL,
  `cancer_detail` longtext NOT NULL,
  PRIMARY KEY (`cancer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cancer`
--

INSERT INTO `cancer` (`cancer_id`, `cancer_name`, `cancer_detail`) VALUES
(1, 'breast', 'ashdshfhafh jhafkhfha sdjkfhdksjh');

-- --------------------------------------------------------

--
-- Table structure for table `cancer_site`
--

CREATE TABLE IF NOT EXISTS `cancer_site` (
  `cancer_site_id` int(10) NOT NULL AUTO_INCREMENT,
  `cancer_site_name` text NOT NULL,
  PRIMARY KEY (`cancer_site_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `cancer_site`
--


-- --------------------------------------------------------

--
-- Table structure for table `diagnosis`
--

CREATE TABLE IF NOT EXISTS `diagnosis` (
  `diagnosis_id` int(10) NOT NULL AUTO_INCREMENT,
  `diagnosis_name` text NOT NULL,
  `diagnosis_details` longtext NOT NULL,
  PRIMARY KEY (`diagnosis_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `diagnosis`
--


-- --------------------------------------------------------

--
-- Table structure for table `family`
--

CREATE TABLE IF NOT EXISTS `family` (
  `family_no` int(10) NOT NULL AUTO_INCREMENT,
  `family_name` char(50) NOT NULL,
  PRIMARY KEY (`family_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `family`
--

INSERT INTO `family` (`family_no`, `family_name`) VALUES
(1, 'zsfmdsfbdsmb');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'members', 'General User');

-- --------------------------------------------------------

--
-- Table structure for table `login_attempts`
--

CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varbinary(16) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `login_attempts`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE IF NOT EXISTS `patient` (
  `fullname` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `maiden_name` varchar(50) NOT NULL,
  `nationality` varchar(30) NOT NULL,
  `ic_no` int(10) NOT NULL AUTO_INCREMENT,
  `family_no` varchar(50) NOT NULL,
  `padigree_labelling` char(50) NOT NULL,
  `gender` char(50) NOT NULL,
  `ethnicity` char(50) NOT NULL,
  `blood_group` char(50) NOT NULL,
  `comment` char(200) NOT NULL,
  `hospital_no` char(50) NOT NULL,
  `private_patient_no` char(50) NOT NULL,
  `cogs_study_id` char(50) NOT NULL,
  `2nd_mammo_test_flag` tinyint(1) NOT NULL,
  `d_o_b` date NOT NULL,
  `d_o_d` date NOT NULL,
  `place_of_birth` char(250) NOT NULL,
  `metal_status` char(250) NOT NULL,
  `is_dead` tinyint(1) NOT NULL,
  `reason_of_death` char(250) NOT NULL,
  `record_status` char(250) NOT NULL,
  `blood_card` tinyint(1) NOT NULL,
  `blood_card_location` text NOT NULL,
  `address` char(250) NOT NULL,
  `home_phone` varchar(30) NOT NULL,
  `cell_phone` varchar(30) NOT NULL,
  `work_phone` varchar(30) NOT NULL,
  `other_phone` varchar(30) NOT NULL,
  `fax` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `height` double NOT NULL,
  `weight` double NOT NULL,
  `rmi` int(11) NOT NULL,
  `highest_education_level` char(250) NOT NULL,
  `income_level` char(250) NOT NULL,
  PRIMARY KEY (`ic_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`fullname`, `surname`, `maiden_name`, `nationality`, `ic_no`, `family_no`, `padigree_labelling`, `gender`, `ethnicity`, `blood_group`, `comment`, `hospital_no`, `private_patient_no`, `cogs_study_id`, `2nd_mammo_test_flag`, `d_o_b`, `d_o_d`, `place_of_birth`, `metal_status`, `is_dead`, `reason_of_death`, `record_status`, `blood_card`, `blood_card_location`, `address`, `home_phone`, `cell_phone`, `work_phone`, `other_phone`, `fax`, `email`, `height`, `weight`, `rmi`, `highest_education_level`, `income_level`) VALUES
('asfds', '', '', '', 1, '', '', '', '', '', '', '', '', '', 0, '0000-00-00', '0000-00-00', '', '', 0, '', '', 0, '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
('alamgir', '', '', '', 2, '', '', '', '', '', '', '', '', '', 0, '2013-08-13', '0000-00-00', '', '', 0, '', '', 0, '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
('pulak', '', '', '', 3, '', '', '', '', '', '', '', '', '', 0, '0000-00-00', '0000-00-00', '', '', 0, '', '', 0, '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
('onimesh', 'Roy', 'aaa', 'American', 4, '', 'aaaa', 'male', 'aaaa', 'O+', 'HHHHHIIIIIIIIIIIIIIIIIIIIII', 'HHHHHIIIIIIIIIIIIIIIIIIIIII', '', '', 0, '1988-10-06', '0000-00-00', '', '', 0, '', '', 0, '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
('zaher', 'fdgdfg', 'dfgfdgdf', 'Bangladeshi', 5, '', 'fdgdfg', 'fdgdfg', 'dfgfdg', 'o+', 'kkkkkkkkkkkkkkkk', 'kkkkkkkkkkkkkkkk', '', '', 0, '1988-10-06', '0000-00-00', '', '', 0, '', '', 0, '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
('Pulak..', 'Roy...', 'ROY', 'American', 6, '', 'agsgdjgsg', 'male', 'adsakhakhd', 'o+', 'dsjgfjds dhagfjdgsj', 'dsjgfjds dhagfjdgsj', '', '', 0, '1988-10-06', '0000-00-00', '', '', 0, '', '', 0, '', '', '', '', '', '', '', '', 0, 0, 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `patient_breast_abnormality_side`
--

CREATE TABLE IF NOT EXISTS `patient_breast_abnormality_side` (
  `patient_breast_abnormality_side_id` int(10) NOT NULL AUTO_INCREMENT,
  `patient_ic_no` int(10) NOT NULL,
  `breast_side` varchar(10) NOT NULL,
  `description` longtext NOT NULL,
  `upper` text NOT NULL,
  `below` text NOT NULL,
  PRIMARY KEY (`patient_breast_abnormality_side_id`),
  KEY `fk_patient_breast_abnormality_side_patient_ic_no` (`patient_ic_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `patient_breast_abnormality_side`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient_breast_screening`
--

CREATE TABLE IF NOT EXISTS `patient_breast_screening` (
  `patient_breast_screening_id` int(10) NOT NULL AUTO_INCREMENT,
  `patient_ic_no` int(10) NOT NULL,
  `age_of_first_mammogram` int(3) NOT NULL,
  `date_of_frecent_mammogram` date NOT NULL,
  `screening_centre` varchar(200) NOT NULL,
  `total_no_of_mammogram` int(5) NOT NULL,
  `screening_interval` varchar(100) NOT NULL,
  `abnormality_mammo` tinyint(1) NOT NULL,
  `patient_breast_abnormality_side_id` int(10) NOT NULL,
  `name_of_radiologist` varchar(100) NOT NULL,
  `action_suggested_on_memo_report` varchar(250) NOT NULL,
  `had_ultrasound_flag` tinyint(1) NOT NULL,
  `total_no_of_ultrasound` int(10) NOT NULL,
  `abnormality_ultrasound_flag` tinyint(1) NOT NULL,
  `p_ultra_abn_id` int(10) NOT NULL,
  `had_mri_flag` tinyint(1) NOT NULL,
  `total_no_of_mri` int(10) NOT NULL,
  `patient_mri_abn_id` int(10) NOT NULL,
  `had_surgery_for_benign_lump_or_cyst_flag` tinyint(1) NOT NULL,
  `other_screening_flag` tinyint(1) NOT NULL,
  `other_screening_id` int(10) NOT NULL,
  `studies_id` int(10) NOT NULL,
  PRIMARY KEY (`patient_breast_screening_id`),
  KEY `fk_patient_breast_screening_studies_id` (`studies_id`),
  KEY `fk_patient_breast_screening_patient_breast_abnormality_side_id` (`patient_breast_abnormality_side_id`),
  KEY `fk_patient_breast_screening_patient_mri_abn_id` (`patient_mri_abn_id`),
  KEY `fk_patient_breast_screening_patient_other_screening_id` (`other_screening_id`),
  KEY `fk_patient_breast_screening_p_ultra_abn_id` (`p_ultra_abn_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `patient_breast_screening`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient_cancer`
--

CREATE TABLE IF NOT EXISTS `patient_cancer` (
  `patient_cancer_id` int(10) NOT NULL AUTO_INCREMENT,
  `patient_ic_no` int(10) NOT NULL,
  `studies_id` int(10) NOT NULL,
  `breast_cancer_diagnosed_flag` tinyint(1) NOT NULL,
  `cancer_id` int(10) NOT NULL,
  `patient_cancer_site_id` int(10) NOT NULL,
  `primary_diagnosis` varchar(250) NOT NULL,
  `age_of_diagnosis` int(10) NOT NULL,
  `date_of_diagnosis` date NOT NULL,
  `patient_cancer_treatment_id` int(10) NOT NULL,
  `diagnosis_center` varchar(250) NOT NULL,
  `doctor_name` varchar(100) NOT NULL,
  `detected_by` varchar(250) NOT NULL,
  `recurrence_flag` tinyint(1) NOT NULL,
  `recurrence_site` varchar(250) NOT NULL,
  `recurrence_date` date NOT NULL,
  `patient_recurrence_id` int(10) NOT NULL,
  PRIMARY KEY (`patient_cancer_id`),
  KEY `fk_patient_cancer_patient_ic_no` (`patient_ic_no`),
  KEY `fk_patient_cancer_studies_id` (`studies_id`),
  KEY `fk_patient_cancer_patient_cancer_site_id` (`patient_cancer_site_id`),
  KEY `fk_patient_cancer_patient_cancer_treatment_id` (`patient_cancer_treatment_id`),
  KEY `fk_patient_cancer_patient_recurrence_id` (`patient_recurrence_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `patient_cancer`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient_cancer_recurrent`
--

CREATE TABLE IF NOT EXISTS `patient_cancer_recurrent` (
  `patient_cancer_recurrent_id` int(10) NOT NULL AUTO_INCREMENT,
  `treatment_id` int(10) NOT NULL,
  `patient_cancer_id` int(10) NOT NULL,
  PRIMARY KEY (`patient_cancer_recurrent_id`),
  KEY `fk_patient_cancer_recurrent_patient_cancer_id` (`patient_cancer_id`),
  KEY `fk_patient_cancer_recurrent_patient_treatment_id` (`treatment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `patient_cancer_recurrent`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient_cancer_site`
--

CREATE TABLE IF NOT EXISTS `patient_cancer_site` (
  `patient_cancer_site_id` int(10) NOT NULL AUTO_INCREMENT,
  `patient_cancer_id` int(10) NOT NULL,
  `cancer_site_id` int(10) NOT NULL,
  `site_details` longtext NOT NULL,
  PRIMARY KEY (`patient_cancer_site_id`),
  KEY `fk_patient_cancer_site_patient_cancer_id` (`patient_cancer_id`),
  KEY `fk_patient_cancer_site_patient_cancer_site_id` (`cancer_site_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `patient_cancer_site`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient_cancer_treatment`
--

CREATE TABLE IF NOT EXISTS `patient_cancer_treatment` (
  `patient_cancer_treatment_id` int(10) NOT NULL AUTO_INCREMENT,
  `treatment_id` int(10) NOT NULL,
  `patient_cancer_id` int(10) NOT NULL,
  PRIMARY KEY (`patient_cancer_treatment_id`),
  KEY `fk_patient_cancer_treatment_treatment_id` (`treatment_id`),
  KEY `fk_patient_cancer_treatment_patient_cancer_id` (`patient_cancer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `patient_cancer_treatment`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient_contact_person`
--

CREATE TABLE IF NOT EXISTS `patient_contact_person` (
  `patient_contact_person_id` int(10) NOT NULL AUTO_INCREMENT,
  `patient_ic_no` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `relationship` varchar(50) NOT NULL,
  `telephone` varchar(30) NOT NULL,
  PRIMARY KEY (`patient_contact_person_id`),
  KEY `fk_patient_contact_person_patient_ic_no` (`patient_ic_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `patient_contact_person`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient_diagnosis`
--

CREATE TABLE IF NOT EXISTS `patient_diagnosis` (
  `patient_diagnosis_id` int(10) NOT NULL AUTO_INCREMENT,
  `patient_ic_no` int(10) NOT NULL,
  `diagnosis_id` int(10) NOT NULL,
  `diagnosis_age` int(5) NOT NULL,
  `year_of_diagnosis` date NOT NULL,
  `on_medication_flag` tinyint(1) NOT NULL,
  `medication_details` longtext NOT NULL,
  `diagnosis_center` text NOT NULL,
  `doctor_name` varchar(100) NOT NULL,
  `studies_id` int(10) NOT NULL,
  PRIMARY KEY (`patient_diagnosis_id`),
  KEY `fk_patient_diagnosis_patient_ic_no` (`patient_ic_no`),
  KEY `fk_patient_diagnosis_diagnosis_id` (`diagnosis_id`),
  KEY `fk_patient_diagnosis_studies_id` (`studies_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `patient_diagnosis`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient_family`
--

CREATE TABLE IF NOT EXISTS `patient_family` (
  `patient_family_id` int(10) NOT NULL AUTO_INCREMENT,
  `family_no` int(10) NOT NULL,
  `patient_ic_no` int(10) NOT NULL,
  PRIMARY KEY (`patient_family_id`),
  KEY `fk_patient_family_family_no` (`family_no`),
  KEY `fk_patient_family_patient_ic_no` (`patient_ic_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `patient_family`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient_gynaecological_surgery_history`
--

CREATE TABLE IF NOT EXISTS `patient_gynaecological_surgery_history` (
  `patient_gne_surgery_history_id` int(10) NOT NULL AUTO_INCREMENT,
  `patient_ic_no` int(10) NOT NULL,
  `studies_id` int(10) NOT NULL,
  `had_gne_surgery_flag` tinyint(1) NOT NULL,
  `surgery_year` date NOT NULL,
  `treatment_id` int(10) NOT NULL,
  PRIMARY KEY (`patient_gne_surgery_history_id`),
  KEY `fk_patient_gynaecological_surgery_history_patient_ic_no` (`patient_ic_no`),
  KEY `fk_patient_gynaecological_surgery_history_studies_id` (`studies_id`),
  KEY `fk_patient_gynaecological_surgery_history_treatment_id` (`treatment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `patient_gynaecological_surgery_history`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient_investigations`
--

CREATE TABLE IF NOT EXISTS `patient_investigations` (
  `patient_investigations_id` int(10) NOT NULL AUTO_INCREMENT,
  `patient_ic_no` int(10) NOT NULL,
  `date_test_ordered` date NOT NULL,
  `ordered_by` text NOT NULL,
  `testing_result_notification_flag` tinyint(1) NOT NULL,
  `project_id` int(10) NOT NULL,
  `project_batch` text NOT NULL,
  `test_type` text NOT NULL,
  `type_of_sample` text NOT NULL,
  `reasons` longtext NOT NULL,
  `new_mutation` text NOT NULL,
  `test_result` longtext NOT NULL,
  `cancer_status` text NOT NULL,
  `mutation_nomenclature` text NOT NULL,
  `reported_by` text NOT NULL,
  `mutation_type` text NOT NULL,
  `mutation_pathogenicity` text NOT NULL,
  `sample_id` int(10) NOT NULL,
  `report_due` text NOT NULL,
  `report_date` date NOT NULL,
  `date_modified` date NOT NULL,
  `test_comment` longtext NOT NULL,
  `study_id` int(10) NOT NULL,
  PRIMARY KEY (`patient_investigations_id`),
  KEY `fk_patient_investigations_patient_ic_no` (`patient_ic_no`),
  KEY `fk_patient_investigations_study_id` (`study_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `patient_investigations`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient_lifestyle_factors`
--

CREATE TABLE IF NOT EXISTS `patient_lifestyle_factors` (
  `patient_lifestyle_factors` int(10) NOT NULL AUTO_INCREMENT,
  `patient_ic_no` int(10) NOT NULL,
  `studies_id` int(10) NOT NULL,
  `self_image_at_1years` longblob NOT NULL,
  `self_image_at_18years` longblob NOT NULL,
  `self_image_now` longblob NOT NULL,
  `pa_sports_activitiy_childhood` text NOT NULL,
  `pa_sports_activitiy_adult` text NOT NULL,
  `pa_sports_activitiy_now` text NOT NULL,
  `cigarrets_smoked_flag` tinyint(1) NOT NULL,
  `cigarrets_still_smoked_flag` tinyint(1) NOT NULL,
  `total_smoked_years` int(5) NOT NULL,
  `cigarrets_count_at_teen` int(10) NOT NULL,
  `cigarrets_count_at_twenties` int(10) NOT NULL,
  `cigarrets_count_at_thirties` int(10) NOT NULL,
  `cigarrets_count_at_fourrties` int(10) NOT NULL,
  `cigarrets_count_at_fifties` int(10) NOT NULL,
  `cigarrets_count_at_sixties_and_above` int(10) NOT NULL,
  `cigarrets_count_one_year_before_diagnosed` int(10) NOT NULL,
  `alcohol_drunk_flag` tinyint(1) NOT NULL,
  `alcohol_average` double NOT NULL,
  `coffee_drunk_flag` tinyint(1) NOT NULL,
  `coffee_age` int(5) NOT NULL,
  `coffee_average` double NOT NULL,
  `tea_drunk_flag` tinyint(1) NOT NULL,
  `tea_age` int(5) NOT NULL,
  `tea_type` text NOT NULL,
  `tea_average` double NOT NULL,
  `soya_bean_drunk_flag` tinyint(1) NOT NULL,
  `soya_bean_average` double NOT NULL,
  `soya_products_average` double NOT NULL,
  `diabetes_flag` tinyint(1) NOT NULL,
  `medicine_for_diabetes_flag` tinyint(1) NOT NULL,
  `diabetes_medicine_name` text NOT NULL,
  PRIMARY KEY (`patient_lifestyle_factors`),
  KEY `fk_patient_lifestyle_factors_patient_ic_no` (`patient_ic_no`),
  KEY `fk_patient_lifestyle_factors_studies_id` (`studies_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `patient_lifestyle_factors`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient_menstwation`
--

CREATE TABLE IF NOT EXISTS `patient_menstwation` (
  `patient_menstwation_id` int(10) NOT NULL AUTO_INCREMENT,
  `patient_ic_no` int(10) NOT NULL,
  `studies_id` int(10) NOT NULL,
  `age_period_starts` date NOT NULL,
  `still_period_flag` tinyint(1) NOT NULL,
  `period_type` text NOT NULL,
  `period_cycle_days` text NOT NULL,
  `age_period_stops` date NOT NULL,
  `reason_period_stops` longtext NOT NULL,
  `date_period_stops` date NOT NULL,
  `infertility_testing_flag` tinyint(1) NOT NULL,
  `infertility_treatment_details` longtext NOT NULL,
  `contraceptive_pills_flag` tinyint(1) NOT NULL,
  `currently_taking_contraceptive_pills_flag` tinyint(1) NOT NULL,
  `contraceptive_pills_details` longtext NOT NULL,
  `contraceptive_start_date` date NOT NULL,
  `contraceptive_end_date` date NOT NULL,
  `hrt_flag` tinyint(1) NOT NULL,
  `currently_using_hrt_flag` tinyint(1) NOT NULL,
  `hrt_details` longtext NOT NULL,
  `hrt__start_date` date NOT NULL,
  `hrt__end_date` date NOT NULL,
  PRIMARY KEY (`patient_menstwation_id`),
  KEY `fk_patient_menstwation_patient_ic_no` (`patient_ic_no`),
  KEY `fk_patient_menstwation_studies_id` (`studies_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `patient_menstwation`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient_mri_abnormality`
--

CREATE TABLE IF NOT EXISTS `patient_mri_abnormality` (
  `patient_mri_abnormlity_id` int(10) NOT NULL AUTO_INCREMENT,
  `patient_ic_no` int(10) NOT NULL,
  `detail` varchar(250) NOT NULL,
  PRIMARY KEY (`patient_mri_abnormlity_id`),
  KEY `fk_patient_mri_abnormality_patient_ic_no` (`patient_ic_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `patient_mri_abnormality`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient_other_screening`
--

CREATE TABLE IF NOT EXISTS `patient_other_screening` (
  `patient_other_screening_id` int(10) NOT NULL AUTO_INCREMENT,
  `screening_name` varchar(250) NOT NULL,
  `total_of_screening` int(10) NOT NULL,
  `age_at_screening` int(10) NOT NULL,
  `place_of_screening` varchar(250) NOT NULL,
  `screening_result` varchar(250) NOT NULL,
  PRIMARY KEY (`patient_other_screening_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `patient_other_screening`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient_parity_record`
--

CREATE TABLE IF NOT EXISTS `patient_parity_record` (
  `patient_parity_record_id` int(10) NOT NULL AUTO_INCREMENT,
  `patient_parity_table_id` int(10) NOT NULL,
  `pregnancy_type` text NOT NULL,
  `gender` text NOT NULL,
  `birthyear` int(5) NOT NULL,
  `birthweight` double NOT NULL,
  `breastfeeding_duration` text NOT NULL,
  PRIMARY KEY (`patient_parity_record_id`),
  KEY `fk_patient_parity_record_patient_parity_table_id` (`patient_parity_table_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `patient_parity_record`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient_parity_table`
--

CREATE TABLE IF NOT EXISTS `patient_parity_table` (
  `patient_parity_id` int(10) NOT NULL AUTO_INCREMENT,
  `patient_ic_no` int(10) NOT NULL,
  `studies_id` int(10) NOT NULL,
  `pregnent_flag` tinyint(1) NOT NULL,
  PRIMARY KEY (`patient_parity_id`),
  KEY `fk_patient_parity_table_patient_ic_no` (`patient_ic_no`),
  KEY `fk_patient_parity_table_studies_id` (`studies_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `patient_parity_table`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient_pathology`
--

CREATE TABLE IF NOT EXISTS `patient_pathology` (
  `patient_pathology_id` int(10) NOT NULL AUTO_INCREMENT,
  `patient_ic_no` int(10) NOT NULL,
  `studies_id` int(10) NOT NULL,
  `tissue_site` text NOT NULL,
  `tumour_stages` text NOT NULL,
  `morphology` text NOT NULL,
  `node_stage` text NOT NULL,
  `total_lymph_nodes` int(10) NOT NULL,
  `er_status` longtext NOT NULL,
  `pr_status` longtext NOT NULL,
  `herz_status` longtext NOT NULL,
  `number_of_tumers` int(10) NOT NULL,
  `metastasis_stage` longtext NOT NULL,
  `side_affected` longtext NOT NULL,
  `tumour_stage` longtext NOT NULL,
  `tumour_grade` text NOT NULL,
  `size` text NOT NULL,
  `path_doc` text NOT NULL,
  `path_lab` text NOT NULL,
  `lab_reference` text NOT NULL,
  `path_report_date` date NOT NULL,
  `type_of_report` text NOT NULL,
  `path_report_requested_date` date NOT NULL,
  `path_report_received_date` date NOT NULL,
  `path_block_requested_date` date NOT NULL,
  `path_block_received_date` date NOT NULL,
  `tissue_path_comment` longtext NOT NULL,
  PRIMARY KEY (`patient_pathology_id`),
  KEY `fk_patient_pathology_patient_ic_no` (`patient_ic_no`),
  KEY `fk_patient_pathology_studies_id` (`studies_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `patient_pathology`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient_relatives`
--

CREATE TABLE IF NOT EXISTS `patient_relatives` (
  `patient_relatives_id` int(10) NOT NULL AUTO_INCREMENT,
  `patient_ic_no` int(10) NOT NULL,
  `relatives_id` int(10) NOT NULL,
  `family_no` int(10) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `sur_name` varchar(100) NOT NULL,
  `maiden_name` varchar(100) NOT NULL,
  `ethnicity` varchar(250) NOT NULL,
  `nationality` varchar(250) NOT NULL,
  `town_of_residence` varchar(250) NOT NULL,
  `d_o_b` date NOT NULL,
  `is_alive_flag` tinyint(1) NOT NULL,
  `d_o_d` date NOT NULL,
  `is_cancer_diagnosed` tinyint(1) NOT NULL,
  `date_of_diagnosis` date NOT NULL,
  `cancer_type_id` int(10) NOT NULL,
  `age_of_diagnosis` int(10) NOT NULL,
  `other_detail` longtext NOT NULL,
  `no_of_brothers` int(5) NOT NULL,
  `no_of_sisters` int(5) NOT NULL,
  `sex` text NOT NULL,
  `no_of_female_children` int(5) NOT NULL,
  `no_of_male_children` int(5) NOT NULL,
  `no_of_first_degree` int(5) NOT NULL,
  `is_paternal` tinyint(1) NOT NULL,
  `is_maternal` tinyint(1) NOT NULL,
  `vital_status` text NOT NULL,
  `total_no_of_second_degree` int(10) NOT NULL,
  `total_no_of_third_degree` int(10) NOT NULL,
  `match_score_at_consent` double NOT NULL,
  `match_score_post_consent` double NOT NULL,
  `fh_category` varchar(100) NOT NULL,
  PRIMARY KEY (`patient_relatives_id`),
  KEY `fk_patient_relatives_patient_ic_no` (`patient_ic_no`),
  KEY `fk_patient_relatives_relatives_id` (`relatives_id`),
  KEY `fk_patient_relatives_family_family_no` (`family_no`),
  KEY `fk_patient_relatives_cancer_type_id` (`cancer_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `patient_relatives`
--

INSERT INTO `patient_relatives` (`patient_relatives_id`, `patient_ic_no`, `relatives_id`, `family_no`, `full_name`, `sur_name`, `maiden_name`, `ethnicity`, `nationality`, `town_of_residence`, `d_o_b`, `is_alive_flag`, `d_o_d`, `is_cancer_diagnosed`, `date_of_diagnosis`, `cancer_type_id`, `age_of_diagnosis`, `other_detail`, `no_of_brothers`, `no_of_sisters`, `sex`, `no_of_female_children`, `no_of_male_children`, `no_of_first_degree`, `is_paternal`, `is_maternal`, `vital_status`, `total_no_of_second_degree`, `total_no_of_third_degree`, `match_score_at_consent`, `match_score_post_consent`, `fh_category`) VALUES
(27, 1, 1, 1, 'aa', 'aa', 'a', '', 'American', '', '1980-01-01', 0, '0000-00-00', 0, '0000-00-00', 1, 0, '', 0, 0, '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, ''),
(28, 1, 1, 1, 'AA', 'ROy', 'asfdhafdh', '', 'American', '', '1988-10-06', 0, '0000-00-00', 0, '0000-00-00', 1, 0, '', 0, 0, '', 0, 0, 0, 0, 0, '', 0, 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `patient_studies`
--

CREATE TABLE IF NOT EXISTS `patient_studies` (
  `patient_studies_id` int(10) NOT NULL AUTO_INCREMENT,
  `patient_ic_no` int(10) NOT NULL,
  `studies_id` int(10) NOT NULL,
  `date_at_consent` date NOT NULL,
  `age_at_consent` int(10) NOT NULL,
  `double_consent_flag` tinyint(1) NOT NULL,
  `double_consent_detail` varchar(250) NOT NULL,
  `consent_given_by` varchar(250) NOT NULL,
  `consent_response` varchar(250) NOT NULL,
  `consent_version` varchar(250) NOT NULL,
  `relation_to_study_flag` tinyint(1) NOT NULL,
  `referral_to` varchar(250) NOT NULL DEFAULT '',
  `referral_to_sewice` varchar(250) NOT NULL DEFAULT '',
  `referral_date` date NOT NULL,
  `referral_source` text NOT NULL,
  PRIMARY KEY (`patient_studies_id`),
  KEY `fk_patient_studies_patient_ic_no` (`patient_ic_no`),
  KEY `fk_patient_studies_studies_id` (`studies_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `patient_studies`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient_surveillance`
--

CREATE TABLE IF NOT EXISTS `patient_surveillance` (
  `patient_surveillance_id` int(10) NOT NULL AUTO_INCREMENT,
  `patient_ic_no` int(10) NOT NULL,
  `recruitment_center` text NOT NULL,
  `type` text NOT NULL,
  `first_consultation_date` date NOT NULL,
  `first_consultation_place` text NOT NULL,
  `interval` text NOT NULL,
  `diagnosis` text NOT NULL,
  `due_date` date NOT NULL,
  `reminder_sent_date` date NOT NULL,
  `surveillance_done_date` date NOT NULL,
  `reminded_by` text NOT NULL,
  `timing` text NOT NULL,
  `symptoms` text NOT NULL,
  `doctor_name` text NOT NULL,
  `surveillance_done_place` text NOT NULL,
  `outcome` text NOT NULL,
  `comments` longtext NOT NULL,
  `studies_id` int(10) NOT NULL,
  PRIMARY KEY (`patient_surveillance_id`),
  KEY `fk_patient_surveillance_studies_id` (`studies_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `patient_surveillance`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient_ultrasound_abnormality`
--

CREATE TABLE IF NOT EXISTS `patient_ultrasound_abnormality` (
  `patient_ultra_abn` int(10) NOT NULL AUTO_INCREMENT,
  `patient_ic_no` int(10) NOT NULL,
  `details` longtext NOT NULL,
  PRIMARY KEY (`patient_ultra_abn`),
  KEY `fk_patient_ultrasound_abnormality_patient_ic_no` (`patient_ic_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `patient_ultrasound_abnormality`
--


-- --------------------------------------------------------

--
-- Table structure for table `relatives`
--

CREATE TABLE IF NOT EXISTS `relatives` (
  `relatives_id` int(10) NOT NULL AUTO_INCREMENT,
  `relatives_type` char(100) NOT NULL,
  PRIMARY KEY (`relatives_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `relatives`
--

INSERT INTO `relatives` (`relatives_id`, `relatives_type`) VALUES
(1, 'Parents');

-- --------------------------------------------------------

--
-- Table structure for table `studies`
--

CREATE TABLE IF NOT EXISTS `studies` (
  `studies_id` int(10) NOT NULL AUTO_INCREMENT,
  `studies_name` char(200) NOT NULL,
  PRIMARY KEY (`studies_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `studies`
--


-- --------------------------------------------------------

--
-- Table structure for table `treatment`
--

CREATE TABLE IF NOT EXISTS `treatment` (
  `treatment_id` int(10) NOT NULL AUTO_INCREMENT,
  `treatment_name` varchar(250) NOT NULL,
  `treatment_detail` varchar(250) NOT NULL,
  PRIMARY KEY (`treatment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `treatment`
--


-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varbinary(16) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(80) NOT NULL,
  `salt` varchar(40) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `activation_code` varchar(40) DEFAULT NULL,
  `forgotten_password_code` varchar(40) DEFAULT NULL,
  `forgotten_password_time` int(11) unsigned DEFAULT NULL,
  `remember_code` varchar(40) DEFAULT NULL,
  `created_on` int(11) unsigned NOT NULL,
  `last_login` int(11) unsigned DEFAULT NULL,
  `active` tinyint(1) unsigned DEFAULT NULL,
  `suspend` tinyint(1) unsigned DEFAULT '0',
  `reset_password_invalid_attempts` mediumint(8) unsigned DEFAULT '0',
  `reset_password_counter` mediumint(8) unsigned DEFAULT '0',
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `current_city` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `profile_picture_path` varchar(500) DEFAULT NULL,
  `user_language` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `suspend`, `reset_password_invalid_attempts`, `reset_password_counter`, `first_name`, `last_name`, `phone`, `current_city`, `country`, `profile_picture_path`, `user_language`) VALUES
(1, '\0\0', 'administrator', '59beecdf7fc966e2f17fd8f65a4a9aeb09d4a3d4', '9462e8eee0', 'admin@admin.com', '', NULL, NULL, '9d029802e28cd9c768e8e62277c0df49ec65c48c', 1268889823, 1376371615, 1, 0, 0, 0, 'Admin', 'istrator', '0', NULL, NULL, NULL, NULL),
(2, '\0\0', 'nazmul', '59beecdf7fc966e2f17fd8f65a4a9aeb09d4a3d4', '9462e8eee0', 'nazmul@apurbatech.com', '', NULL, NULL, NULL, 1268889823, 1373438882, 1, 0, 0, 0, 'Nazmul', 'Hasan', '0', NULL, NULL, NULL, NULL),
(3, '\0\0', 'alamgir', '59beecdf7fc966e2f17fd8f65a4a9aeb09d4a3d4', '9462e8eee0', 'alamgir@apurbatech.com', '', NULL, NULL, NULL, 1268889823, 1373438882, 1, 0, 0, 0, 'Alamgir', 'Kabir', '0', NULL, NULL, NULL, NULL),
(4, '\0\0', 'fariza', '59beecdf7fc966e2f17fd8f65a4a9aeb09d4a3d4', '9462e8eee0', 'fariza@apurbatech.com', '', NULL, NULL, NULL, 1268889823, 1375689996, 1, 0, 0, 0, 'Fariza', 'Amir', '0', NULL, NULL, NULL, NULL),
(5, '\0\0', 'nor', '59beecdf7fc966e2f17fd8f65a4a9aeb09d4a3d4', '9462e8eee0', 'azriah.aziz@apurbatech.com', '', NULL, NULL, NULL, 1268889823, 1373438882, 1, 0, 0, 0, 'Nor', 'Azriah', '0', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(4, 3, 2),
(5, 4, 2),
(6, 5, 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `patient_breast_abnormality_side`
--
ALTER TABLE `patient_breast_abnormality_side`
  ADD CONSTRAINT `fk_patient_breast_abnormality_side_patient_ic_no` FOREIGN KEY (`patient_ic_no`) REFERENCES `patient` (`ic_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_breast_screening`
--
ALTER TABLE `patient_breast_screening`
  ADD CONSTRAINT `fk_patient_breast_screening_patient_breast_abnormality_side_id` FOREIGN KEY (`patient_breast_abnormality_side_id`) REFERENCES `patient_breast_abnormality_side` (`patient_breast_abnormality_side_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_patient_breast_screening_patient_mri_abn_id` FOREIGN KEY (`patient_mri_abn_id`) REFERENCES `patient_mri_abnormality` (`patient_mri_abnormlity_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_patient_breast_screening_patient_other_screening_id` FOREIGN KEY (`other_screening_id`) REFERENCES `patient_other_screening` (`patient_other_screening_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_patient_breast_screening_p_ultra_abn_id` FOREIGN KEY (`p_ultra_abn_id`) REFERENCES `patient_ultrasound_abnormality` (`patient_ultra_abn`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_patient_breast_screening_studies_id` FOREIGN KEY (`studies_id`) REFERENCES `studies` (`studies_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_cancer`
--
ALTER TABLE `patient_cancer`
  ADD CONSTRAINT `fk_patient_cancer_patient_cancer_site_id` FOREIGN KEY (`patient_cancer_site_id`) REFERENCES `patient_cancer_site` (`patient_cancer_site_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_patient_cancer_patient_cancer_treatment_id` FOREIGN KEY (`patient_cancer_treatment_id`) REFERENCES `patient_cancer_treatment` (`patient_cancer_treatment_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_patient_cancer_patient_ic_no` FOREIGN KEY (`patient_ic_no`) REFERENCES `patient` (`ic_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_patient_cancer_patient_recurrence_id` FOREIGN KEY (`patient_recurrence_id`) REFERENCES `patient_cancer_recurrent` (`patient_cancer_recurrent_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_patient_cancer_studies_id` FOREIGN KEY (`studies_id`) REFERENCES `studies` (`studies_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_cancer_recurrent`
--
ALTER TABLE `patient_cancer_recurrent`
  ADD CONSTRAINT `fk_patient_cancer_recurrent_patient_cancer_id` FOREIGN KEY (`patient_cancer_id`) REFERENCES `patient_cancer` (`patient_cancer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_patient_cancer_recurrent_patient_treatment_id` FOREIGN KEY (`treatment_id`) REFERENCES `treatment` (`treatment_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_cancer_site`
--
ALTER TABLE `patient_cancer_site`
  ADD CONSTRAINT `fk_patient_cancer_site_patient_cancer_id` FOREIGN KEY (`patient_cancer_id`) REFERENCES `patient_cancer` (`patient_cancer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_patient_cancer_site_patient_cancer_site_id` FOREIGN KEY (`cancer_site_id`) REFERENCES `cancer_site` (`cancer_site_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_cancer_treatment`
--
ALTER TABLE `patient_cancer_treatment`
  ADD CONSTRAINT `fk_patient_cancer_treatment_patient_cancer_id` FOREIGN KEY (`patient_cancer_id`) REFERENCES `patient_cancer` (`patient_cancer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_patient_cancer_treatment_treatment_id` FOREIGN KEY (`treatment_id`) REFERENCES `treatment` (`treatment_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_contact_person`
--
ALTER TABLE `patient_contact_person`
  ADD CONSTRAINT `fk_patient_contact_person_patient_ic_no` FOREIGN KEY (`patient_ic_no`) REFERENCES `patient` (`ic_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `patient_contact_person_ibfk_1` FOREIGN KEY (`patient_contact_person_id`) REFERENCES `patient` (`ic_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_diagnosis`
--
ALTER TABLE `patient_diagnosis`
  ADD CONSTRAINT `fk_patient_diagnosis_diagnosis_id` FOREIGN KEY (`diagnosis_id`) REFERENCES `diagnosis` (`diagnosis_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_patient_diagnosis_patient_ic_no` FOREIGN KEY (`patient_ic_no`) REFERENCES `patient` (`ic_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_patient_diagnosis_studies_id` FOREIGN KEY (`studies_id`) REFERENCES `studies` (`studies_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_family`
--
ALTER TABLE `patient_family`
  ADD CONSTRAINT `fk_patient_family_family_no` FOREIGN KEY (`family_no`) REFERENCES `family` (`family_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_patient_family_patient_ic_no` FOREIGN KEY (`patient_ic_no`) REFERENCES `patient` (`ic_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`patient_ic_no`) REFERENCES `patient` (`ic_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`family_no`) REFERENCES `family` (`family_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_gynaecological_surgery_history`
--
ALTER TABLE `patient_gynaecological_surgery_history`
  ADD CONSTRAINT `fk_patient_gynaecological_surgery_history_patient_ic_no` FOREIGN KEY (`patient_ic_no`) REFERENCES `patient` (`ic_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_patient_gynaecological_surgery_history_studies_id` FOREIGN KEY (`studies_id`) REFERENCES `studies` (`studies_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_patient_gynaecological_surgery_history_treatment_id` FOREIGN KEY (`treatment_id`) REFERENCES `treatment` (`treatment_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_investigations`
--
ALTER TABLE `patient_investigations`
  ADD CONSTRAINT `fk_patient_investigations_patient_ic_no` FOREIGN KEY (`patient_ic_no`) REFERENCES `patient` (`ic_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_patient_investigations_study_id` FOREIGN KEY (`study_id`) REFERENCES `studies` (`studies_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_lifestyle_factors`
--
ALTER TABLE `patient_lifestyle_factors`
  ADD CONSTRAINT `fk_patient_lifestyle_factors_patient_ic_no` FOREIGN KEY (`patient_ic_no`) REFERENCES `patient` (`ic_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_patient_lifestyle_factors_studies_id` FOREIGN KEY (`studies_id`) REFERENCES `studies` (`studies_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_menstwation`
--
ALTER TABLE `patient_menstwation`
  ADD CONSTRAINT `fk_patient_menstwation_patient_ic_no` FOREIGN KEY (`patient_ic_no`) REFERENCES `patient` (`ic_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_patient_menstwation_studies_id` FOREIGN KEY (`studies_id`) REFERENCES `studies` (`studies_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_mri_abnormality`
--
ALTER TABLE `patient_mri_abnormality`
  ADD CONSTRAINT `fk_patient_mri_abnormality_patient_ic_no` FOREIGN KEY (`patient_ic_no`) REFERENCES `patient` (`ic_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_parity_record`
--
ALTER TABLE `patient_parity_record`
  ADD CONSTRAINT `fk_patient_parity_record_patient_parity_table_id` FOREIGN KEY (`patient_parity_table_id`) REFERENCES `patient_parity_table` (`patient_parity_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_parity_table`
--
ALTER TABLE `patient_parity_table`
  ADD CONSTRAINT `fk_patient_parity_table_patient_ic_no` FOREIGN KEY (`patient_ic_no`) REFERENCES `patient` (`ic_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_patient_parity_table_studies_id` FOREIGN KEY (`studies_id`) REFERENCES `studies` (`studies_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_pathology`
--
ALTER TABLE `patient_pathology`
  ADD CONSTRAINT `fk_patient_pathology_patient_ic_no` FOREIGN KEY (`patient_ic_no`) REFERENCES `patient` (`ic_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_patient_pathology_studies_id` FOREIGN KEY (`studies_id`) REFERENCES `studies` (`studies_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_relatives`
--
ALTER TABLE `patient_relatives`
  ADD CONSTRAINT `fk_patient_relatives_cancer_type_id` FOREIGN KEY (`cancer_type_id`) REFERENCES `cancer` (`cancer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_patient_relatives_family_family_no` FOREIGN KEY (`family_no`) REFERENCES `family` (`family_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_patient_relatives_patient_ic_no` FOREIGN KEY (`patient_ic_no`) REFERENCES `patient` (`ic_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_patient_relatives_relatives_id` FOREIGN KEY (`relatives_id`) REFERENCES `relatives` (`relatives_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_studies`
--
ALTER TABLE `patient_studies`
  ADD CONSTRAINT `fk_patient_studies_patient_ic_no` FOREIGN KEY (`patient_ic_no`) REFERENCES `patient` (`ic_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_patient_studies_studies_id` FOREIGN KEY (`studies_id`) REFERENCES `studies` (`studies_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_surveillance`
--
ALTER TABLE `patient_surveillance`
  ADD CONSTRAINT `fk_patient_surveillance_studies_id` FOREIGN KEY (`studies_id`) REFERENCES `studies` (`studies_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_ultrasound_abnormality`
--
ALTER TABLE `patient_ultrasound_abnormality`
  ADD CONSTRAINT `fk_patient_ultrasound_abnormality_patient_ic_no` FOREIGN KEY (`patient_ic_no`) REFERENCES `patient` (`ic_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
