-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 11, 2013 at 05:36 AM
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `cancer`
--

INSERT INTO `cancer` (`cancer_id`, `cancer_name`, `cancer_detail`) VALUES
(1, 'Breast', ''),
(2, 'Overian', ''),
(3, 'Prostate', ''),
(4, 'Cervical', ''),
(5, 'Cervical', ''),
(6, 'Lung', ''),
(7, 'Colorectal', ''),
(8, 'Uterine', ''),
(9, 'Peritoneum', ''),
(10, 'Pencreatic', ''),
(11, 'Nasopharyngeal', ''),
(12, 'Liver', ''),
(13, 'Gastric', ''),
(14, 'Others', ''),
(15, 'None', '');

-- --------------------------------------------------------

--
-- Table structure for table `cancer_site`
--

CREATE TABLE IF NOT EXISTS `cancer_site` (
  `cancer_site_id` int(10) NOT NULL AUTO_INCREMENT,
  `cancer_site_name` text NOT NULL,
  PRIMARY KEY (`cancer_site_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `cancer_site`
--

INSERT INTO `cancer_site` (`cancer_site_id`, `cancer_site_name`) VALUES
(1, 'Left Breast'),
(2, 'Right Breast'),
(3, 'Left Ovary'),
(4, 'Right Ovary');

-- --------------------------------------------------------

--
-- Table structure for table `diagnosis`
--

CREATE TABLE IF NOT EXISTS `diagnosis` (
  `diagnosis_id` int(10) NOT NULL AUTO_INCREMENT,
  `diagnosis_name` text NOT NULL,
  `diagnosis_details` longtext NOT NULL,
  PRIMARY KEY (`diagnosis_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `diagnosis`
--

INSERT INTO `diagnosis` (`diagnosis_id`, `diagnosis_name`, `diagnosis_details`) VALUES
(1, 'Diabetes', ''),
(2, 'Hypertension', ''),
(3, 'Thyroid', ''),
(4, 'Cardiovaskular Disease', ''),
(5, 'Endochrine', ''),
(6, 'Congenital', ''),
(7, 'Mental Disorder', '');

-- --------------------------------------------------------

--
-- Table structure for table `exercise`
--

CREATE TABLE IF NOT EXISTS `exercise` (
  `exercise_id` int(11) NOT NULL AUTO_INCREMENT,
  `exercise_name` varchar(250) NOT NULL,
  `exercise_details` longtext NOT NULL,
  PRIMARY KEY (`exercise_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `exercise`
--


-- --------------------------------------------------------

--
-- Table structure for table `family`
--

CREATE TABLE IF NOT EXISTS `family` (
  `family_no` int(10) NOT NULL AUTO_INCREMENT,
  `family_name` char(50) NOT NULL,
  PRIMARY KEY (`family_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `family`
--

INSERT INTO `family` (`family_no`, `family_name`) VALUES
(1, 'AAAA'),
(2, 'BBBB'),
(3, 'CCCC');

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
  `ic_no` bigint(18) NOT NULL AUTO_INCREMENT,
  `family_no` varchar(50) NOT NULL,
  `padigree_labelling` char(50) NOT NULL,
  `gender` char(50) NOT NULL,
  `ethnicity` char(50) NOT NULL,
  `blood_group` char(50) NOT NULL,
  `comment` char(200) NOT NULL,
  `hospital_no` char(50) NOT NULL,
  `private_patient_no` int(11) NOT NULL,
  `cogs_study_id` char(50) NOT NULL,
  `2nd_mammo_test_flag` tinyint(1) NOT NULL,
  `d_o_b` date NOT NULL,
  `d_o_d` date NOT NULL,
  `place_of_birth` char(250) NOT NULL,
  `marital_status` char(250) NOT NULL,
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
  `bmi` int(11) NOT NULL,
  `highest_education_level` char(250) NOT NULL,
  `income_level` char(250) NOT NULL,
  PRIMARY KEY (`ic_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=123460 ;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`fullname`, `surname`, `maiden_name`, `nationality`, `ic_no`, `family_no`, `padigree_labelling`, `gender`, `ethnicity`, `blood_group`, `comment`, `hospital_no`, `private_patient_no`, `cogs_study_id`, `2nd_mammo_test_flag`, `d_o_b`, `d_o_d`, `place_of_birth`, `marital_status`, `is_dead`, `reason_of_death`, `record_status`, `blood_card`, `blood_card_location`, `address`, `home_phone`, `cell_phone`, `work_phone`, `other_phone`, `fax`, `email`, `height`, `weight`, `bmi`, `highest_education_level`, `income_level`) VALUES
('aaaaaaaaaaa', 'bbbbb', 'cccccccccc', 'American', 123456, '1', 'ffffff', 'Male', 'ddddddd', 'o+', '', '4565', 45646, '', 0, '0000-00-00', '0000-00-00', 'California', 'Single', 0, 'EEEEEE EEEE\r\nEEEEEE EEEE', '', 0, '45646', 'hhhhh\r\n\r\n\r\nhhhhhh', '0177', '0178', '0179', '', '', '', 10, 10, 11, 'PHD', 'high'),
('aaaaaaaaaa', 'bbbbbbbbbb', 'cccccccccc', 'American', 123457, '2', '', 'Male', '', '', '', '', 0, '', 0, '0000-00-00', '0000-00-00', '', 'Single', 0, '', '', 0, '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
('John smith', 'smith', '', '', 123458, '', '', '', '', '', '', '', 0, '', 0, '0000-00-00', '0000-00-00', '', '', 0, '', '', 0, '', '', '', '', '', '', '', '', 0, 0, 0, '', ''),
('Adam John', 'John', '', '', 123459, '', '', '', '', '', '', '', 0, '', 0, '0000-00-00', '0000-00-00', '', '', 0, '', '', 0, '', '', '', '', '', '', '', '', 0, 0, 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `patient_boadicea`
--

CREATE TABLE IF NOT EXISTS `patient_boadicea` (
  `patient_boadicea_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_ic_no` bigint(18) NOT NULL,
  `boadicea_brca1` int(11) NOT NULL,
  `boadicea_brca2` int(11) NOT NULL,
  `boadicea_total` int(11) NOT NULL,
  `boadicea_mach1` int(11) NOT NULL,
  `boadicea_mach2` int(11) NOT NULL,
  `boadicea_mach_total` int(11) NOT NULL,
  PRIMARY KEY (`patient_boadicea_id`),
  KEY `fk_patient_boadicea_patient_ic_no` (`patient_ic_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `patient_boadicea`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient_breast_abnormality`
--

CREATE TABLE IF NOT EXISTS `patient_breast_abnormality` (
  `patient_breast_abnormality_side_id` int(10) NOT NULL AUTO_INCREMENT,
  `patient_breast_screening_id` int(10) NOT NULL,
  `description` longtext NOT NULL,
  `left_breast` tinyint(1) NOT NULL,
  `right_breast` tinyint(1) NOT NULL,
  `upper` tinyint(1) NOT NULL,
  `below` tinyint(1) NOT NULL,
  `percentage_of_mammo_density` longtext NOT NULL,
  PRIMARY KEY (`patient_breast_abnormality_side_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `patient_breast_abnormality`
--

INSERT INTO `patient_breast_abnormality` (`patient_breast_abnormality_side_id`, `patient_breast_screening_id`, `description`, `left_breast`, `right_breast`, `upper`, `below`, `percentage_of_mammo_density`) VALUES
(14, 8, '0', 0, 0, 0, 0, ''),
(15, 10, '0', 0, 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `patient_breast_screening`
--

CREATE TABLE IF NOT EXISTS `patient_breast_screening` (
  `patient_breast_screening_id` int(10) NOT NULL AUTO_INCREMENT,
  `patient_ic_no` bigint(18) NOT NULL,
  `patient_studies_id` int(10) NOT NULL,
  `year_of_first_mammogram` varchar(250) NOT NULL,
  `age_of_first_mammogram` int(3) NOT NULL,
  `date_of_recent_mammogram` date NOT NULL,
  `screening_centre` varchar(200) NOT NULL,
  `total_no_of_mammogram` int(5) NOT NULL,
  `screening_interval` varchar(100) NOT NULL,
  `abnormality_mammo_flag` tinyint(1) NOT NULL,
  `mammo_abnormality_details` longtext NOT NULL,
  `name_of_radiologist` varchar(100) NOT NULL,
  `action_suggested_on_memo_report` varchar(250) NOT NULL,
  `had_ultrasound_flag` tinyint(1) NOT NULL,
  `total_no_of_ultrasound` int(10) NOT NULL,
  `abnormality_ultrasound_flag` tinyint(1) NOT NULL,
  `had_mri_flag` tinyint(1) NOT NULL,
  `total_no_of_mri` int(10) NOT NULL,
  `had_surgery_for_benign_lump_or_cyst_flag` tinyint(1) NOT NULL,
  `other_screening_flag` tinyint(1) NOT NULL,
  `BIRADS_clinical_classification` longtext NOT NULL,
  `BIRADS_density_classification` longtext NOT NULL,
  `abnormality_MRI_flag` tinyint(1) NOT NULL,
  PRIMARY KEY (`patient_breast_screening_id`),
  KEY `fk_patient_breast_screening_patient_studies_id` (`patient_studies_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `patient_breast_screening`
--

INSERT INTO `patient_breast_screening` (`patient_breast_screening_id`, `patient_ic_no`, `patient_studies_id`, `year_of_first_mammogram`, `age_of_first_mammogram`, `date_of_recent_mammogram`, `screening_centre`, `total_no_of_mammogram`, `screening_interval`, `abnormality_mammo_flag`, `mammo_abnormality_details`, `name_of_radiologist`, `action_suggested_on_memo_report`, `had_ultrasound_flag`, `total_no_of_ultrasound`, `abnormality_ultrasound_flag`, `had_mri_flag`, `total_no_of_mri`, `had_surgery_for_benign_lump_or_cyst_flag`, `other_screening_flag`, `BIRADS_clinical_classification`, `BIRADS_density_classification`, `abnormality_MRI_flag`) VALUES
(8, 123456, 11, '1950', 1950, '2013-09-07', 'aaaaaaaaaaa', 5, 'ddddddddddddd', 0, '', '', '0', 0, 5, 0, 0, 5, 0, 0, '', '', 0),
(10, 123457, 13, '1950', 5, '2013-09-07', 'ttttttttttttttttttt', 5, 'qqqqqqqqqqqqq', 0, '', '', '0', 0, 5, 0, 0, 5, 0, 0, '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `patient_cancer`
--

CREATE TABLE IF NOT EXISTS `patient_cancer` (
  `patient_cancer_id` int(10) NOT NULL AUTO_INCREMENT,
  `patient_ic_no` bigint(18) NOT NULL,
  `patient_studies_id` int(10) NOT NULL,
  `breast_cancer_diagnosed_flag` tinyint(1) NOT NULL,
  `cancer_id` int(10) NOT NULL,
  `age_of_diagnosis` int(10) NOT NULL,
  `date_of_diagnosis` date NOT NULL,
  `diagnosis_center` varchar(250) NOT NULL,
  `doctor_name` varchar(100) NOT NULL,
  `detected_by` varchar(250) NOT NULL,
  `recurrence_flag` tinyint(1) NOT NULL,
  `recurrence_site` varchar(250) NOT NULL,
  `recurrence_date` date NOT NULL,
  `is_primary` tinyint(1) NOT NULL,
  PRIMARY KEY (`patient_cancer_id`),
  KEY `fk_patient_cancer_patient_ic_no` (`patient_ic_no`),
  KEY `fk_patient_cancer_patient_studies_id` (`patient_studies_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `patient_cancer`
--

INSERT INTO `patient_cancer` (`patient_cancer_id`, `patient_ic_no`, `patient_studies_id`, `breast_cancer_diagnosed_flag`, `cancer_id`, `age_of_diagnosis`, `date_of_diagnosis`, `diagnosis_center`, `doctor_name`, `detected_by`, `recurrence_flag`, `recurrence_site`, `recurrence_date`, `is_primary`) VALUES
(6, 123456, 11, 0, 1, 45, '2013-09-07', 'xxxxxxxxxx', '', 'vvvvvvvvvvvvv', 0, 'kkkkkkkkkkkk', '2013-09-07', 0),
(7, 123457, 13, 0, 1, 5, '2013-09-07', 'iiiiiiiiiiiiiiiiiii', 'hhhhhhhhh', 'gggggggggggg', 0, 'eeeeeeeeeeeeeeee', '2013-09-07', 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `patient_cancer_recurrent`
--

INSERT INTO `patient_cancer_recurrent` (`patient_cancer_recurrent_id`, `treatment_id`, `patient_cancer_id`) VALUES
(5, 1, 6),
(6, 1, 7);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `patient_cancer_site`
--

INSERT INTO `patient_cancer_site` (`patient_cancer_site_id`, `patient_cancer_id`, `cancer_site_id`, `site_details`) VALUES
(5, 6, 1, 'iiiiiiiiiiiiiiiiiiiiiiiiiiiiiii'),
(6, 7, 1, 'jjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj');

-- --------------------------------------------------------

--
-- Table structure for table `patient_cancer_treatment`
--

CREATE TABLE IF NOT EXISTS `patient_cancer_treatment` (
  `patient_cancer_treatment_id` int(10) NOT NULL AUTO_INCREMENT,
  `treatment_id` int(10) NOT NULL,
  `patient_cancer_id` int(10) NOT NULL,
  `treatment_start_date` date NOT NULL,
  `treatment_end_date` date NOT NULL,
  `treatment_drug_dose` longtext NOT NULL,
  PRIMARY KEY (`patient_cancer_treatment_id`),
  KEY `fk_patient_cancer_treatment_patient_cancer_id` (`patient_cancer_id`),
  KEY `fk_patient_cancer_treatment_treatment_id` (`treatment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `patient_cancer_treatment`
--

INSERT INTO `patient_cancer_treatment` (`patient_cancer_treatment_id`, `treatment_id`, `patient_cancer_id`, `treatment_start_date`, `treatment_end_date`, `treatment_drug_dose`) VALUES
(5, 1, 6, '2013-09-07', '2013-09-07', 'jjjjjjjjj'),
(6, 1, 7, '2013-09-07', '2013-09-07', 'ffffffffffffffff');

-- --------------------------------------------------------

--
-- Table structure for table `patient_contact_person`
--

CREATE TABLE IF NOT EXISTS `patient_contact_person` (
  `patient_contact_person_id` int(10) NOT NULL AUTO_INCREMENT,
  `patient_ic_no` bigint(18) NOT NULL,
  `name` varchar(50) NOT NULL,
  `relationship` varchar(50) NOT NULL,
  `telephone` varchar(30) NOT NULL,
  PRIMARY KEY (`patient_contact_person_id`),
  KEY `fk_patient_contact_person_patient_ic_no` (`patient_ic_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `patient_contact_person`
--

INSERT INTO `patient_contact_person` (`patient_contact_person_id`, `patient_ic_no`, `name`, `relationship`, `telephone`) VALUES
(1, 123456, 'iiiiii iiiii', 'Father', '01799'),
(3, 123457, 'aaaaaaaaa', 'Mother', '0178');

-- --------------------------------------------------------

--
-- Table structure for table `patient_diagnosis`
--

CREATE TABLE IF NOT EXISTS `patient_diagnosis` (
  `patient_diagnosis_id` int(10) NOT NULL AUTO_INCREMENT,
  `patient_ic_no` bigint(18) NOT NULL,
  `patient_studies_id` int(10) NOT NULL,
  `diagnosis_id` int(10) NOT NULL,
  `diagnosis_age` int(5) NOT NULL,
  `year_of_diagnosis` date NOT NULL,
  `on_medication_flag` tinyint(1) NOT NULL,
  `medication_details` longtext NOT NULL,
  `diagnosis_center` text NOT NULL,
  `doctor_name` varchar(100) NOT NULL,
  `diagnosis_details` longtext NOT NULL,
  PRIMARY KEY (`patient_diagnosis_id`),
  KEY `fk_patient_diagnosis_diagnosis_id` (`diagnosis_id`),
  KEY `fk_patient_diagnosis_patient_ic_no` (`patient_ic_no`),
  KEY `fk_patient_diagnosis_patient_studies_id` (`patient_studies_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `patient_diagnosis`
--

INSERT INTO `patient_diagnosis` (`patient_diagnosis_id`, `patient_ic_no`, `patient_studies_id`, `diagnosis_id`, `diagnosis_age`, `year_of_diagnosis`, `on_medication_flag`, `medication_details`, `diagnosis_center`, `doctor_name`, `diagnosis_details`) VALUES
(4, 123456, 11, 1, 5, '0000-00-00', 0, 'mmmmmmmmmmmmmmmmm', 'fffffffffff', 'nnnnnnnnnnnnnnn', ''),
(5, 123457, 13, 1, 5, '0000-00-00', 0, 'cccccccccccccccccccc', 'bbbbbbbbbbbbbb', 'aaaaaaaaaaaaaa', '');

-- --------------------------------------------------------

--
-- Table structure for table `patient_family`
--

CREATE TABLE IF NOT EXISTS `patient_family` (
  `patient_family_id` int(10) NOT NULL AUTO_INCREMENT,
  `family_no` int(10) NOT NULL,
  `patient_ic_no` bigint(18) NOT NULL,
  PRIMARY KEY (`patient_family_id`),
  KEY `fk_users_groups_groups1` (`patient_ic_no`),
  KEY `fk_users_groups_users1` (`family_no`)
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
  `patient_ic_no` bigint(18) NOT NULL,
  `patient_studies_id` int(10) NOT NULL,
  `had_gnc_surgery_flag` tinyint(1) NOT NULL,
  `surgery_year` date NOT NULL,
  `treatment_id` int(10) NOT NULL,
  `gnc_treatment_name_other_details` longtext NOT NULL,
  PRIMARY KEY (`patient_gne_surgery_history_id`),
  KEY `fk_patient_gynaecological_surgery_history_patient_ic_no` (`patient_ic_no`),
  KEY `fk_patient_gynaecological_surgery_history_treatment_id` (`treatment_id`),
  KEY `fk_patient_gynaecological_surgery_history_studies_id` (`patient_studies_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `patient_gynaecological_surgery_history`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient_infertility`
--

CREATE TABLE IF NOT EXISTS `patient_infertility` (
  `patient_infertility_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_studies_id` int(10) NOT NULL,
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
  `hrt_start_date` date NOT NULL,
  `hrt_end_date` date NOT NULL,
  PRIMARY KEY (`patient_infertility_id`),
  KEY `fk_patient_infertility_patient_studies_id` (`patient_studies_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `patient_infertility`
--

INSERT INTO `patient_infertility` (`patient_infertility_id`, `patient_studies_id`, `infertility_testing_flag`, `infertility_treatment_details`, `contraceptive_pills_flag`, `currently_taking_contraceptive_pills_flag`, `contraceptive_pills_details`, `contraceptive_start_date`, `contraceptive_end_date`, `hrt_flag`, `currently_using_hrt_flag`, `hrt_details`, `hrt_start_date`, `hrt_end_date`) VALUES
(2, 8, 0, '0', 0, 0, 'ccccccccccccccc', '0000-00-00', '0000-00-00', 0, 0, 'bbbbbbbbbbbb', '0000-00-00', '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `patient_interview_manager`
--

CREATE TABLE IF NOT EXISTS `patient_interview_manager` (
  `patient_interview_manager_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_ic_no` bigint(18) NOT NULL,
  `creation_date` date NOT NULL,
  `comments` longtext NOT NULL,
  `interview_date` date NOT NULL,
  `next_interview_date` date NOT NULL,
  `is_send_email_reminder_to_officers` tinyint(1) NOT NULL,
  `officer_email_addresses` varchar(250) NOT NULL,
  `interval` varchar(250) NOT NULL,
  PRIMARY KEY (`patient_interview_manager_id`),
  KEY `fk_patient_interview_manager_patient_ic_no` (`patient_ic_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `patient_interview_manager`
--

INSERT INTO `patient_interview_manager` (`patient_interview_manager_id`, `patient_ic_no`, `creation_date`, `comments`, `interview_date`, `next_interview_date`, `is_send_email_reminder_to_officers`, `officer_email_addresses`, `interval`) VALUES
(1, 123456, '0000-00-00', 'aaaaaa', '0000-00-00', '0000-00-00', 0, 'aaa@aaa.com', '');

-- --------------------------------------------------------

--
-- Table structure for table `patient_investigations`
--

CREATE TABLE IF NOT EXISTS `patient_investigations` (
  `patient_investigations_id` int(10) NOT NULL AUTO_INCREMENT,
  `patient_ic_no` bigint(18) NOT NULL,
  `date_test_ordered` date NOT NULL,
  `ordered_by` text NOT NULL,
  `testing_result_notification_flag` tinyint(1) NOT NULL,
  `project_name` longtext NOT NULL,
  `project_batch` text NOT NULL,
  `test_type` text NOT NULL,
  `type_of_sample` text NOT NULL,
  `reasons` longtext NOT NULL,
  `new_mutation_flag` tinyint(1) NOT NULL,
  `test_result` longtext NOT NULL,
  `investigation_test_results_other_details` longtext NOT NULL,
  `carrier_status` text NOT NULL,
  `mutation_nomenclature` text NOT NULL,
  `reported_by` text NOT NULL,
  `mutation_type` text NOT NULL,
  `mutation_pathogenicity` text NOT NULL,
  `sample_id` int(10) NOT NULL,
  `report_due` text NOT NULL,
  `report_date` date NOT NULL,
  `date_modified` date NOT NULL,
  `test_comment` longtext NOT NULL,
  `patient_studies_id` int(10) NOT NULL,
  `conformation_attachment` tinyint(1) NOT NULL,
  `conformation_file_url` longtext NOT NULL,
  PRIMARY KEY (`patient_investigations_id`),
  KEY `fk_patient_investigations_patient_ic_no` (`patient_ic_no`),
  KEY `fk_patient_investigations_patient_studies_id` (`patient_studies_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `patient_investigations`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient_lifestyle_adulthood_exercise`
--

CREATE TABLE IF NOT EXISTS `patient_lifestyle_adulthood_exercise` (
  `patient_lifestyle_adulthood_exercise_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_lifestyle_factors_id` int(11) NOT NULL,
  `exercise_id` int(11) NOT NULL,
  PRIMARY KEY (`patient_lifestyle_adulthood_exercise_id`),
  KEY `fk_patient_lifestyle_adulthood_exercise_exercise_id` (`exercise_id`),
  KEY `fk_patient_lifestyle_adulthood_patient_lifestyle_factors_id` (`patient_lifestyle_factors_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `patient_lifestyle_adulthood_exercise`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient_lifestyle_childhood_exercise`
--

CREATE TABLE IF NOT EXISTS `patient_lifestyle_childhood_exercise` (
  `patient_lifestyle_childhood_exercise_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_lifestyle_factors_id` int(11) NOT NULL,
  `exercise_id` int(11) NOT NULL,
  PRIMARY KEY (`patient_lifestyle_childhood_exercise_id`),
  KEY `fk_patient_lifestyle_childhood_exercise_exercise_id` (`exercise_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `patient_lifestyle_childhood_exercise`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient_lifestyle_current_exercise`
--

CREATE TABLE IF NOT EXISTS `patient_lifestyle_current_exercise` (
  `patient_lifestyle_current_exercise_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_lifestyle_factors_id` int(11) NOT NULL,
  `exercise_id` int(11) NOT NULL,
  PRIMARY KEY (`patient_lifestyle_current_exercise_id`),
  KEY `fk_patient_lifestyle_current_exercise_exercise_id` (`exercise_id`),
  KEY `fk_patient_lifestyle_current_exercise_lifestyle_factors_id` (`patient_lifestyle_factors_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `patient_lifestyle_current_exercise`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient_lifestyle_factors`
--

CREATE TABLE IF NOT EXISTS `patient_lifestyle_factors` (
  `patient_lifestyle_factors_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_ic_no` bigint(18) NOT NULL,
  `patient_studies_id` int(10) NOT NULL,
  `self_image_at_7years` longblob NOT NULL,
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
  `alcohol_average_details` longtext NOT NULL,
  `coffee_drunk_flag` tinyint(1) NOT NULL,
  `coffee_age` int(5) NOT NULL,
  `coffee_average` double NOT NULL,
  `tea_drunk_flag` tinyint(1) NOT NULL,
  `tea_age` int(5) NOT NULL,
  `tea_type` text NOT NULL,
  `tea_average` double NOT NULL,
  `soya_bean_drunk_flag` tinyint(1) NOT NULL,
  `soya_bean_average` double NOT NULL,
  `soya_products_flag` tinyint(1) NOT NULL,
  `soya_products_average` double NOT NULL,
  `diabetes_flag` tinyint(1) NOT NULL,
  `medicine_for_diabetes_flag` tinyint(1) NOT NULL,
  `diabetes_medicine_name` text NOT NULL,
  PRIMARY KEY (`patient_lifestyle_factors_id`),
  KEY `fk_patient_lifestyle_factors_patient_ic_no` (`patient_ic_no`),
  KEY `fk_patient_lifestyle_factors_patient_studies_id` (`patient_studies_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `patient_lifestyle_factors`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient_mammo_processed_images`
--

CREATE TABLE IF NOT EXISTS `patient_mammo_processed_images` (
  `patient_mammo_processed_images_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_ic_no` bigint(18) NOT NULL,
  `patient_breast_screening_id` int(11) NOT NULL,
  `processed_image_file_name` int(10) NOT NULL,
  PRIMARY KEY (`patient_mammo_processed_images_id`),
  KEY `fk_patient_mammo_processed_images_patient_ic_no` (`patient_ic_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `patient_mammo_processed_images`
--

INSERT INTO `patient_mammo_processed_images` (`patient_mammo_processed_images_id`, `patient_ic_no`, `patient_breast_screening_id`, `processed_image_file_name`) VALUES
(1, 123457, 10, 0),
(2, 123457, 10, 0),
(3, 123457, 10, 0),
(4, 123457, 10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `patient_mammo_raw_images`
--

CREATE TABLE IF NOT EXISTS `patient_mammo_raw_images` (
  `patient_mammo_raw_images_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_ic_no` bigint(18) NOT NULL,
  `patient_breast_screening_id` int(10) NOT NULL,
  `raw_image_file_name` longtext NOT NULL,
  PRIMARY KEY (`patient_mammo_raw_images_id`),
  KEY `fk_patient_mammo_raw_images_patient_ic_no` (`patient_ic_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `patient_mammo_raw_images`
--

INSERT INTO `patient_mammo_raw_images` (`patient_mammo_raw_images_id`, `patient_ic_no`, `patient_breast_screening_id`, `raw_image_file_name`) VALUES
(2, 123457, 9, 'C:/xampp/htdocs/CarifDBMS/images/11.jpg'),
(3, 123457, 9, 'C:/xampp/htdocs/CarifDBMS/images/2.jpg'),
(4, 123457, 9, 'C:/xampp/htdocs/CarifDBMS/images/3.png'),
(5, 123457, 9, 'C:/xampp/htdocs/CarifDBMS/images/4.jpg'),
(6, 123457, 10, 'C:/xampp/htdocs/CarifDBMS/images/1.jpg'),
(7, 123457, 10, 'C:/xampp/htdocs/CarifDBMS/images/2.jpg'),
(8, 123457, 10, 'C:/xampp/htdocs/CarifDBMS/images/3.png'),
(9, 123457, 10, 'C:/xampp/htdocs/CarifDBMS/images/4.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `patient_menstruation`
--

CREATE TABLE IF NOT EXISTS `patient_menstruation` (
  `patient_menstruation_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_studies_id` int(10) NOT NULL,
  `age_period_starts` date NOT NULL,
  `still_period_flag` tinyint(1) NOT NULL,
  `period_type` text NOT NULL,
  `period_cycle_days` text NOT NULL,
  `period_cycle_days_other_details` longtext NOT NULL,
  `age_period_stops` date NOT NULL,
  `reason_period_stops` longtext NOT NULL,
  `date_period_stops` date NOT NULL,
  `reason_period_stops_other_details` longtext NOT NULL,
  PRIMARY KEY (`patient_menstruation_id`),
  KEY `fk_patient_menstruation_patient_studies_id` (`patient_studies_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `patient_menstruation`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient_mri_abnormality`
--

CREATE TABLE IF NOT EXISTS `patient_mri_abnormality` (
  `patient_mri_abnormlity_id` int(10) NOT NULL AUTO_INCREMENT,
  `detail` varchar(250) NOT NULL,
  `patient_breast_screening_id` int(10) NOT NULL,
  PRIMARY KEY (`patient_mri_abnormlity_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `patient_mri_abnormality`
--

INSERT INTO `patient_mri_abnormality` (`patient_mri_abnormlity_id`, `detail`, `patient_breast_screening_id`) VALUES
(7, 'ggggggggggggggggggg', 8),
(8, 'ooooooooooooooooooo', 10);

-- --------------------------------------------------------

--
-- Table structure for table `patient_other_screening`
--

CREATE TABLE IF NOT EXISTS `patient_other_screening` (
  `patient_other_screening_id` int(10) NOT NULL AUTO_INCREMENT,
  `screening_name` varchar(250) NOT NULL,
  `total_no_of_screening` int(10) NOT NULL,
  `age_at_screening` int(10) NOT NULL,
  `place_of_screening` varchar(250) NOT NULL,
  `screening_result` varchar(250) NOT NULL,
  `patient_breast_screening_id` int(10) NOT NULL,
  PRIMARY KEY (`patient_other_screening_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `patient_other_screening`
--

INSERT INTO `patient_other_screening` (`patient_other_screening_id`, `screening_name`, `total_no_of_screening`, `age_at_screening`, `place_of_screening`, `screening_result`, `patient_breast_screening_id`) VALUES
(7, 'aaaaaaaaaaa', 5, 45, 'ggggggggg', 'hhhhhhhhhhhhhhhhh', 8),
(8, 'mmmmmmmmmm', 5, 5, 'llllllllllllllllllllll', 'kkkkkkkkkkkkkkkk', 10);

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
  `patient_ic_no` bigint(18) NOT NULL,
  `patient_studies_id` int(10) NOT NULL,
  `pregnent_flag` tinyint(1) NOT NULL,
  PRIMARY KEY (`patient_parity_id`),
  KEY `fk_patient_parity_table_patient_ic_no` (`patient_ic_no`),
  KEY `fk_patient_parity_table_patient_studies_id` (`patient_studies_id`)
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
  `patient_ic_no` bigint(18) NOT NULL,
  `patient_studies_id` int(10) NOT NULL,
  `tissue_site` text NOT NULL,
  `tissue_tumour_stages` text NOT NULL,
  `morphology` text NOT NULL,
  `node_stage` text NOT NULL,
  `lymph_node` varchar(250) NOT NULL,
  `total_lymph_nodes` int(10) NOT NULL,
  `er_status` longtext NOT NULL,
  `pr_status` longtext NOT NULL,
  `her2_status` longtext NOT NULL,
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
  KEY `fk_patient_pathology_patient_studies_id` (`patient_studies_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `patient_pathology`
--

INSERT INTO `patient_pathology` (`patient_pathology_id`, `patient_ic_no`, `patient_studies_id`, `tissue_site`, `tissue_tumour_stages`, `morphology`, `node_stage`, `lymph_node`, `total_lymph_nodes`, `er_status`, `pr_status`, `her2_status`, `number_of_tumers`, `metastasis_stage`, `side_affected`, `tumour_stage`, `tumour_grade`, `size`, `path_doc`, `path_lab`, `lab_reference`, `path_report_date`, `type_of_report`, `path_report_requested_date`, `path_report_received_date`, `path_block_requested_date`, `path_block_received_date`, `tissue_path_comment`) VALUES
(1, 123456, 11, 'aaaaaaaaaaa', 'T0', 'DCIS', 'N0', 'Yes', 0, 'aaaaaaaaaaaa', 'bbbbbbbbbbbbb', 'ccccccccccccccccc', 5, 'M0', 'Both', '0', '1: Well differentiated', '5', 'lllllllllllllll', 'dddddddddd', 'eeeeeeeeeeeee', '0000-00-00', 'Pathology', '0000-00-00', '2013-09-07', '2013-09-07', '2013-09-07', 'aaaaaaaaaaaaa'),
(2, 123457, 13, 'aaaaaaaaaaaaa', 'T0', 'DCIS', 'N0', 'Yes', 5, 'bbbbbbbbb', 'cccccccccc', 'ddddddddddddd', 5, 'M0', 'Both', '0', '1: Well differentiated', '5', 'eeeeeeeeee', 'fffffffffff', 'gggggggggggg', '2013-09-07', 'Pathology', '0000-00-00', '2013-09-07', '2013-09-07', '2013-09-07', 'hhhhhhhhhhhhhhhhhh');

-- --------------------------------------------------------

--
-- Table structure for table `patient_private_no`
--

CREATE TABLE IF NOT EXISTS `patient_private_no` (
  `patient_private_no_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_ic_no` bigint(18) NOT NULL,
  `private_no` char(50) NOT NULL,
  PRIMARY KEY (`patient_private_no_id`),
  KEY `fk_patient_private_no_patient_ic_no` (`patient_ic_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `patient_private_no`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient_relatives`
--

CREATE TABLE IF NOT EXISTS `patient_relatives` (
  `patient_relatives_id` int(10) NOT NULL AUTO_INCREMENT,
  `patient_ic_no` bigint(18) NOT NULL,
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
  `match_score_past_consent` double NOT NULL,
  `fh_category` varchar(100) NOT NULL,
  PRIMARY KEY (`patient_relatives_id`),
  KEY `fk_patient_relatives_cancer_type_id` (`cancer_type_id`),
  KEY `fk_patient_relatives_family_family_no` (`family_no`),
  KEY `fk_patient_relatives_patient_ic_no` (`patient_ic_no`),
  KEY `fk_patient_relatives_relatives_id` (`relatives_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `patient_relatives`
--

INSERT INTO `patient_relatives` (`patient_relatives_id`, `patient_ic_no`, `relatives_id`, `family_no`, `full_name`, `sur_name`, `maiden_name`, `ethnicity`, `nationality`, `town_of_residence`, `d_o_b`, `is_alive_flag`, `d_o_d`, `is_cancer_diagnosed`, `date_of_diagnosis`, `cancer_type_id`, `age_of_diagnosis`, `other_detail`, `no_of_brothers`, `no_of_sisters`, `sex`, `no_of_female_children`, `no_of_male_children`, `no_of_first_degree`, `is_paternal`, `is_maternal`, `vital_status`, `total_no_of_second_degree`, `total_no_of_third_degree`, `match_score_at_consent`, `match_score_past_consent`, `fh_category`) VALUES
(3, 123456, 1, 1, 'aaaaa', 'bbbb', 'ccccc', 'ddddd', '', 'eeeee', '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 4, 18, 'fffffffffffffffffffffffffff\r\nfffffffffffffffffffffffffff', 5, 5, '', 1, 5, 5, 0, 0, 'gggggggggggggg', 5, 5, 45, 4545, 'hhhhhhhhhhhh'),
(4, 123456, 2, 1, 'iiiiiiii', 'jjjjjjj', 'kkkkkk', '0', '', 'mmmmmm', '0000-00-00', 0, '0000-00-00', 0, '0000-00-00', 2, 45, 'nnnnnn', 5, 5, '', 5, 5, 5, 0, 0, '5', 5, 5, 5, 5, '5');

-- --------------------------------------------------------

--
-- Table structure for table `patient_relatives_summary`
--

CREATE TABLE IF NOT EXISTS `patient_relatives_summary` (
  `patient_relatives_summary_ID` int(11) NOT NULL AUTO_INCREMENT,
  `patient_ic_no` bigint(18) NOT NULL,
  `total_no_of_male_siblings` int(11) NOT NULL,
  `total_no_of_female_siblings` int(11) NOT NULL,
  `total_no_of_affected_siblings` int(11) NOT NULL,
  `total_no_of_male_children` int(11) NOT NULL,
  `total_no_of_female_children` int(11) NOT NULL,
  `total_no_of_affected_children` int(11) NOT NULL,
  `total_no_of_1st_degree` int(11) NOT NULL,
  `total_no_of_2nd_degree` int(11) NOT NULL,
  `total_no_of_3rd_degree` int(11) NOT NULL,
  `unknown_reason_is_adopted` tinyint(1) NOT NULL,
  `unknown_reason_in_other_countries` tinyint(1) NOT NULL,
  PRIMARY KEY (`patient_relatives_summary_ID`),
  KEY `fk_patient_relatives_summary_patient_ic_no` (`patient_ic_no`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `patient_relatives_summary`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient_studies`
--

CREATE TABLE IF NOT EXISTS `patient_studies` (
  `patient_studies_id` int(10) NOT NULL AUTO_INCREMENT,
  `patient_ic_no` bigint(18) NOT NULL,
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
  `referral_to_service` varchar(250) NOT NULL DEFAULT '',
  `referral_date` date NOT NULL,
  `referral_source` text NOT NULL,
  PRIMARY KEY (`patient_studies_id`),
  KEY `fk_patient_studies_patient_ic_no` (`patient_ic_no`),
  KEY `fk_patient_studies_studies_id` (`studies_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `patient_studies`
--

INSERT INTO `patient_studies` (`patient_studies_id`, `patient_ic_no`, `studies_id`, `date_at_consent`, `age_at_consent`, `double_consent_flag`, `double_consent_detail`, `consent_given_by`, `consent_response`, `consent_version`, `relation_to_study_flag`, `referral_to`, `referral_to_service`, `referral_date`, `referral_source`) VALUES
(11, 123456, 1, '0000-00-00', 0, 0, '', '', '', '', 1, '', '', '0000-00-00', ''),
(13, 123457, 1, '2013-09-07', 5, 0, 'zzzzzzzzzzzzzzzz', 'yyyyyyyyyyyyyy', 'xxxxxxxxxx', '12', 1, 'wwwwwwwwwwww', 'vvvvvvvv', '0000-00-00', 'uuuuuuuuuuuuuu');

-- --------------------------------------------------------

--
-- Table structure for table `patient_surveillance`
--

CREATE TABLE IF NOT EXISTS `patient_surveillance` (
  `patient_surveillance_id` int(10) NOT NULL AUTO_INCREMENT,
  `patient_ic_no` bigint(18) NOT NULL,
  `patient_studies_id` int(10) NOT NULL,
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
  PRIMARY KEY (`patient_surveillance_id`),
  KEY `fk_patient_surveillance_patient_studies_id` (`patient_studies_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `patient_surveillance`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient_survival_status`
--

CREATE TABLE IF NOT EXISTS `patient_survival_status` (
  `patient_survival_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_ic_no` bigint(18) NOT NULL,
  `source` longtext NOT NULL,
  `alive_status` tinyint(1) NOT NULL,
  `creation_date` date NOT NULL,
  PRIMARY KEY (`patient_survival_status_id`),
  KEY `fk_patient_survival_status_patient_ic_no` (`patient_ic_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `patient_survival_status`
--

INSERT INTO `patient_survival_status` (`patient_survival_status_id`, `patient_ic_no`, `source`, `alive_status`, `creation_date`) VALUES
(1, 123457, '0', 0, '2013-09-07');

-- --------------------------------------------------------

--
-- Table structure for table `patient_ultrasound_abnormality`
--

CREATE TABLE IF NOT EXISTS `patient_ultrasound_abnormality` (
  `patient_ultra_abn` int(10) NOT NULL AUTO_INCREMENT,
  `details` longtext NOT NULL,
  `patient_breast_screening_id` int(10) NOT NULL,
  PRIMARY KEY (`patient_ultra_abn`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `patient_ultrasound_abnormality`
--

INSERT INTO `patient_ultrasound_abnormality` (`patient_ultra_abn`, `details`, `patient_breast_screening_id`) VALUES
(8, 'ffffffffffffffff', 8),
(9, 'pppppppppppppppp', 10);

-- --------------------------------------------------------

--
-- Table structure for table `relatives`
--

CREATE TABLE IF NOT EXISTS `relatives` (
  `relatives_id` int(10) NOT NULL AUTO_INCREMENT,
  `relatives_type` char(100) NOT NULL,
  PRIMARY KEY (`relatives_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `relatives`
--

INSERT INTO `relatives` (`relatives_id`, `relatives_type`) VALUES
(1, 'Father'),
(2, 'Mother'),
(3, 'Brother'),
(4, 'Sister'),
(5, 'Children'),
(6, '1st degree'),
(7, '2nd degree'),
(8, '3rd');

-- --------------------------------------------------------

--
-- Table structure for table `studies`
--

CREATE TABLE IF NOT EXISTS `studies` (
  `studies_id` int(10) NOT NULL AUTO_INCREMENT,
  `studies_name` char(200) NOT NULL,
  PRIMARY KEY (`studies_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `studies`
--

INSERT INTO `studies` (`studies_id`, `studies_name`) VALUES
(1, 'MyBrCa'),
(2, 'EpBrCa'),
(3, 'OvaCa'),
(4, 'Mammo');

-- --------------------------------------------------------

--
-- Table structure for table `treatment`
--

CREATE TABLE IF NOT EXISTS `treatment` (
  `treatment_id` int(10) NOT NULL AUTO_INCREMENT,
  `treatment_name` varchar(250) NOT NULL,
  `treatment_detail` varchar(250) NOT NULL,
  PRIMARY KEY (`treatment_id`),
  KEY `treatment_id` (`treatment_id`),
  KEY `treatment_id_2` (`treatment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `treatment`
--

INSERT INTO `treatment` (`treatment_id`, `treatment_name`, `treatment_detail`) VALUES
(1, 'Lumpectomy', ''),
(2, 'Mastectomy', ''),
(3, 'Healthy Braest Removed', ''),
(4, 'Hysterectomy', ''),
(5, 'Oophorectomy', ''),
(6, 'Radiotherapy', ''),
(7, 'Chemotherapy', ''),
(8, 'Tamoxifen', ''),
(9, 'Other Hormonal Treatment', ''),
(10, 'Transplantation', ''),
(11, 'Neo Adjurant', ''),
(12, 'Sterilisation', ''),
(13, 'Tubal Ligation', ''),
(14, 'Unilateral Salpingo Oophorectomy', ''),
(15, 'Bilateral Salpingo Oophorectomy', ''),
(16, 'TAHBSO', ''),
(17, 'None', '');

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
  `add_privilege` tinyint(1) NOT NULL,
  `view_privilege` tinyint(1) NOT NULL,
  `edit_privilege` tinyint(1) NOT NULL,
  `delete_privilege` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `suspend`, `reset_password_invalid_attempts`, `reset_password_counter`, `first_name`, `last_name`, `phone`, `current_city`, `country`, `profile_picture_path`, `user_language`, `add_privilege`, `view_privilege`, `edit_privilege`, `delete_privilege`) VALUES
(1, '\0\0', 'administrator', '59beecdf7fc966e2f17fd8f65a4a9aeb09d4a3d4', '9462e8eee0', 'admin@admin.com', '', NULL, NULL, '9d029802e28cd9c768e8e62277c0df49ec65c48c', 1268889823, 1378873899, 1, 0, 0, 0, 'Admin', 'istrator', '0', NULL, NULL, NULL, NULL, 1, 1, 1, 0),
(2, '\0\0', 'nazmul', '59beecdf7fc966e2f17fd8f65a4a9aeb09d4a3d4', '9462e8eee0', 'nazmul@apurbatech.com', '', NULL, NULL, NULL, 1268889823, 1373438882, 1, 0, 0, 0, 'Nazmul', 'Hasan', '0', NULL, NULL, NULL, NULL, 1, 1, 1, 0),
(3, '\0\0', 'alamgir', '59beecdf7fc966e2f17fd8f65a4a9aeb09d4a3d4', '9462e8eee0', 'alamgir@apurbatech.com', '', NULL, NULL, NULL, 1268889823, 1373438882, 1, 0, 0, 0, 'Alamgir', 'Kabir', '0', NULL, NULL, NULL, NULL, 1, 1, 1, 0),
(4, '\0\0', 'fariza', '59beecdf7fc966e2f17fd8f65a4a9aeb09d4a3d4', '9462e8eee0', 'fariza@apurbatech.com', '', NULL, NULL, NULL, 1268889823, 1375689996, 1, 0, 0, 0, 'Fariza', 'Amir', '0', NULL, NULL, NULL, NULL, 1, 1, 1, 0),
(5, '\0\0', 'nor', '59beecdf7fc966e2f17fd8f65a4a9aeb09d4a3d4', '9462e8eee0', 'azriah.aziz@apurbatech.com', '', NULL, NULL, NULL, 1268889823, 1373438882, 1, 0, 0, 0, 'Nor', 'Azriah', '0', NULL, NULL, NULL, NULL, 1, 1, 1, 0);

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
-- Constraints for table `patient_boadicea`
--
ALTER TABLE `patient_boadicea`
  ADD CONSTRAINT `fk_patient_boadicea_patient_ic_no` FOREIGN KEY (`patient_ic_no`) REFERENCES `patient` (`ic_no`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `patient_breast_screening`
--
ALTER TABLE `patient_breast_screening`
  ADD CONSTRAINT `fk_patient_breast_screening_patient_studies_id` FOREIGN KEY (`patient_studies_id`) REFERENCES `patient_studies` (`patient_studies_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `patient_cancer`
--
ALTER TABLE `patient_cancer`
  ADD CONSTRAINT `fk_patient_cancer_patient_ic_no` FOREIGN KEY (`patient_ic_no`) REFERENCES `patient` (`ic_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_patient_cancer_patient_studies_id` FOREIGN KEY (`patient_studies_id`) REFERENCES `patient_studies` (`patient_studies_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_patient_contact_person_patient_ic_no` FOREIGN KEY (`patient_ic_no`) REFERENCES `patient` (`ic_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_diagnosis`
--
ALTER TABLE `patient_diagnosis`
  ADD CONSTRAINT `fk_patient_diagnosis_diagnosis_id` FOREIGN KEY (`diagnosis_id`) REFERENCES `diagnosis` (`diagnosis_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_patient_diagnosis_patient_ic_no` FOREIGN KEY (`patient_ic_no`) REFERENCES `patient` (`ic_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_patient_diagnosis_patient_studies_id` FOREIGN KEY (`patient_studies_id`) REFERENCES `patient_studies` (`patient_studies_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_patient_gynaecological_surgery_history_studies_id` FOREIGN KEY (`patient_studies_id`) REFERENCES `patient_studies` (`patient_studies_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_patient_gynaecological_surgery_history_treatment_id` FOREIGN KEY (`treatment_id`) REFERENCES `treatment` (`treatment_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_interview_manager`
--
ALTER TABLE `patient_interview_manager`
  ADD CONSTRAINT `fk_patient_interview_manager_patient_ic_no` FOREIGN KEY (`patient_ic_no`) REFERENCES `patient` (`ic_no`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `patient_investigations`
--
ALTER TABLE `patient_investigations`
  ADD CONSTRAINT `fk_patient_investigations_patient_ic_no` FOREIGN KEY (`patient_ic_no`) REFERENCES `patient` (`ic_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_patient_investigations_patient_studies_id` FOREIGN KEY (`patient_studies_id`) REFERENCES `patient_studies` (`patient_studies_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_patient_investigations_studies_id` FOREIGN KEY (`patient_studies_id`) REFERENCES `patient_studies` (`patient_studies_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `patient_lifestyle_factors`
--
ALTER TABLE `patient_lifestyle_factors`
  ADD CONSTRAINT `fk_patient_lifestyle_factors_patient_ic_no` FOREIGN KEY (`patient_ic_no`) REFERENCES `patient` (`ic_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_patient_lifestyle_factors_patient_studies_id` FOREIGN KEY (`patient_studies_id`) REFERENCES `patient_studies` (`patient_studies_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_patient_lifestyle_factors_studies_id` FOREIGN KEY (`patient_studies_id`) REFERENCES `patient_studies` (`patient_studies_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `patient_mammo_processed_images`
--
ALTER TABLE `patient_mammo_processed_images`
  ADD CONSTRAINT `fk_patient_mammo_processed_images_patient_ic_no` FOREIGN KEY (`patient_ic_no`) REFERENCES `patient` (`ic_no`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `patient_mammo_raw_images`
--
ALTER TABLE `patient_mammo_raw_images`
  ADD CONSTRAINT `fk_patient_mammo_raw_images_patient_ic_no` FOREIGN KEY (`patient_ic_no`) REFERENCES `patient` (`ic_no`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `patient_menstruation`
--
ALTER TABLE `patient_menstruation`
  ADD CONSTRAINT `fk_patient_menstruation_patient_studies_id` FOREIGN KEY (`patient_studies_id`) REFERENCES `patient_studies` (`patient_studies_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_patient_parity_table_patient_studies_id` FOREIGN KEY (`patient_studies_id`) REFERENCES `patient_studies` (`patient_studies_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `patient_pathology`
--
ALTER TABLE `patient_pathology`
  ADD CONSTRAINT `fk_patient_pathology_patient_ic_no` FOREIGN KEY (`patient_ic_no`) REFERENCES `patient` (`ic_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_patient_pathology_patient_studies_id` FOREIGN KEY (`patient_studies_id`) REFERENCES `patient_studies` (`patient_studies_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `patient_private_no`
--
ALTER TABLE `patient_private_no`
  ADD CONSTRAINT `fk_patient_private_no_patient_ic_no` FOREIGN KEY (`patient_ic_no`) REFERENCES `patient` (`ic_no`) ON DELETE CASCADE ON UPDATE NO ACTION;

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
  ADD CONSTRAINT `fk_patient_surveillance_patient_studies_id` FOREIGN KEY (`patient_studies_id`) REFERENCES `patient_studies` (`patient_studies_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `patient_survival_status`
--
ALTER TABLE `patient_survival_status`
  ADD CONSTRAINT `fk_patient_survival_status_patient_ic_no` FOREIGN KEY (`patient_ic_no`) REFERENCES `patient` (`ic_no`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
