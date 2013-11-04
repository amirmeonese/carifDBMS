-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 01, 2013 at 04:03 AM
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
(2, 'Ovaries', ''),
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
-- Table structure for table `non_cancerous_site`
--

CREATE TABLE IF NOT EXISTS `non_cancerous_site` (
  `non_cancerous_site_id` int(10) NOT NULL AUTO_INCREMENT,
  `non_cancerous_site_name` text NOT NULL,
  PRIMARY KEY (`non_cancerous_site_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `non_cancerous_site`
--

INSERT INTO `non_cancerous_site` (`non_cancerous_site_id`, `non_cancerous_site_name`) VALUES
(1, 'Left breast'),
(2, 'Right breast'),
(3, 'Left ovary'),
(4, 'Right ovary'),
(5, 'Uterus');

-- --------------------------------------------------------

--
-- Table structure for table `ovarian_screening_type`
--

CREATE TABLE IF NOT EXISTS `ovarian_screening_type` (
  `ovarian_screening_type_id` int(10) NOT NULL AUTO_INCREMENT,
  `ovarian_screening_type_name` text NOT NULL,
  PRIMARY KEY (`ovarian_screening_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `ovarian_screening_type`
--

INSERT INTO `ovarian_screening_type` (`ovarian_screening_type_id`, `ovarian_screening_type_name`) VALUES
(1, 'Physical Examinations'),
(2, 'Abdominal ultrasound'),
(3, 'Trans-vaginal Ultrasound'),
(4, 'CA125 blood test'),
(5, 'Biopsy');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE IF NOT EXISTS `patient` (
  `given_name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `maiden_name` varchar(50) NOT NULL,
  `nationality` varchar(30) NOT NULL,
  `ic_no` bigint(18) NOT NULL AUTO_INCREMENT,
  `family_no` varchar(50) NOT NULL,
  `gender` char(50) NOT NULL,
  `ethnicity` char(50) NOT NULL,
  `blood_group` char(50) NOT NULL,
  `comment` char(200) NOT NULL,
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
  `is_record_locked` tinyint(1) NOT NULL DEFAULT '0',
  `created_on` datetime NOT NULL,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(50) NOT NULL,
  `locked_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`ic_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8902208900 ;


--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`given_name`, `surname`, `maiden_name`, `nationality`, `ic_no`, `family_no`, `gender`, `ethnicity`, `blood_group`, `comment`, `d_o_b`, `d_o_d`, `place_of_birth`, `marital_status`, `is_dead`, `reason_of_death`, `record_status`, `blood_card`, `blood_card_location`, `address`, `home_phone`, `cell_phone`, `work_phone`, `other_phone`, `fax`, `email`, `height`, `weight`, `bmi`, `highest_education_level`, `income_level`, `is_record_locked`, `created_on`, `modified_on`, `modified_by`, `locked_date`, `is_deleted`, `deleted_date`) VALUES
('asyraf', 'amirul', 'abd rani', '', 8902208810, '1', '', '', '', '', '2013-03-10', '2013-01-10', '', '', 1, '', '', 1, 'bangi', '', '0321788655', '0123344522', '', '', '', '', 0, 0, 0, '0', '', 0, '0000-00-00 00:00:00', '2013-10-18 03:15:01', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
('asyraf', 'amirul', 'abd rani', '', 8902208811, '1', '', '', '', '', '2013-03-10', '2013-01-10', '', '', 1, '', '', 1, 'bangi', '', '0321788655', '0123344522', '', '', '', '', 0, 0, 0, '0', '', 0, '0000-00-00 00:00:00', '2013-10-18 03:16:19', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
('asyraf', 'amirul', 'abd rani', '', 8902208812, '1', '', '', '', '', '2013-03-10', '2013-01-10', '', '', 1, '', '', 1, 'bangi', '', '0321788655', '0123344522', '', '', '', '', 0, 0, 0, '0', '', 0, '0000-00-00 00:00:00', '2013-10-18 03:23:38', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
('asyraf', 'amirul', 'abd rani', '', 8902208813, '1', '', '', '', '', '2013-03-10', '2013-01-10', '', '', 1, '', '', 1, 'bangi', '', '0321788655', '0123344522', '', '', '', '', 0, 0, 0, '0', '', 0, '0000-00-00 00:00:00', '2013-10-18 03:33:59', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
('asyraf', 'amirul', 'abd rani', '', 8902208814, '1', '', '', '', '', '2013-03-10', '2013-01-10', '', '', 1, '', '', 1, 'bangi', '', '0321788655', '0123344522', '', '', '', '', 0, 0, 0, '0', '', 0, '0000-00-00 00:00:00', '2013-10-18 03:34:58', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
('asyraf', 'amirul', 'abd rani', '', 8902208815, '1', '', '', '', '', '2013-03-10', '2013-01-10', '', '', 1, '', '', 1, 'bangi', '', '0321788655', '0123344522', '', '', '', '', 0, 0, 0, '0', '', 0, '0000-00-00 00:00:00', '2013-10-18 03:35:43', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
('asyraf', 'amirul', 'abd rani', '', 8902208816, '1', '', '', '', '', '2013-03-10', '2013-01-10', '', '', 1, '', '', 1, 'bangi', '', '0321788655', '0123344522', '', '', '', '', 0, 0, 0, '0', '', 0, '0000-00-00 00:00:00', '2013-10-18 03:36:51', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
('asyraf', 'amirul', 'abd rani', '', 8902208817, '', '', '', '', '', '1970-01-01', '1970-01-01', '', '', 1, '', '', 1, '', '', '', '', '', '', '', '', 0, 0, 0, '0', '', 0, '0000-00-00 00:00:00', '2013-10-18 03:38:49', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
('asyraf', 'amirul', 'abd rani', '', 8902208819, '', '', '', '', '', '1970-01-01', '1970-01-01', '', '', 1, '', '', 1, '', '', '', '', '', '', '', '', 0, 0, 0, '0', '', 0, '0000-00-00 00:00:00', '2013-10-18 03:42:37', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
('asyraf', 'amirul', 'abd rani', '', 8902208831, '', '', '', '', '', '1970-01-01', '1970-01-01', '', '', 1, '', '', 1, '', '', '', '', '', '', '', '', 0, 0, 0, '0', '', 0, '0000-00-00 00:00:00', '2013-10-18 04:00:54', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
('asyraf', 'amirul', 'abd rani', 'Malaysian', 8902208890, '1', 'Male', 'malay', 'o', '', '0000-00-00', '0000-00-00', 'baling', 'Single', 1, '', '', 1, 'bangi', 'kajang', '0321788655', '0123344522', '', '', '', 'applepie1502@yahoo.com', 170, 65, 0, '0', '<5,000', 0, '0000-00-00 00:00:00', '2013-10-18 01:58:20', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
('asyraf', 'amirul', 'abd rani', 'Malaysian', 8902208891, '1', 'Male', 'malay', 'o', '', '0000-00-00', '0000-00-00', 'baling', 'Single', 1, '', '', 1, 'bangi', 'kajang', '0321788655', '0123344522', '', '', '', 'applepie1502@yahoo.com', 170, 65, 0, '0', '<5,000', 0, '0000-00-00 00:00:00', '2013-10-18 02:14:48', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
('asyraf', 'amirul', 'abd rani', 'Malaysian', 8902208892, '1', 'Male', 'malay', 'o', '', '0000-00-00', '0000-00-00', 'baling', 'Single', 1, '', '', 1, 'bangi', 'kajang', '0321788655', '0123344522', '', '', '', 'applepie1502@yahoo.com', 170, 65, 0, '0', '<5,000', 0, '0000-00-00 00:00:00', '2013-10-18 02:20:29', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
('asyraf', 'amirul', 'abd rani', 'Malaysian', 8902208893, '1', 'Male', 'malay', 'o', '', '2013-10-18', '2013-10-18', 'baling', 'Single', 1, '', '', 1, 'bangi', 'kajang', '0321788655', '0123344522', '', '', '', 'applepie1502@yahoo.com', 170, 65, 0, '0', '<5,000', 0, '0000-00-00 00:00:00', '2013-10-18 02:26:31', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
('asyraf', 'amirul', 'abd rani', 'Malaysian', 8902208894, '1', 'Male', 'malay', 'o', '', '1970-01-01', '2013-10-18', 'baling', 'Single', 1, '', '', 1, 'bangi', 'kajang', '0321788655', '0123344522', '', '', '', 'applepie1502@yahoo.com', 170, 65, 0, '0', '<5,000', 0, '0000-00-00 00:00:00', '2013-10-18 02:32:56', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
('asyraf', 'amirul', 'abd rani', '', 8902208896, '1', '', '', '', '', '2013-03-10', '2013-01-10', '', '', 1, '', '', 1, 'bangi', '', '0321788655', '0123344522', '', '', '', '', 0, 0, 0, '0', '', 0, '0000-00-00 00:00:00', '2013-10-18 03:05:36', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
('asyraf', 'amirul', 'abd rani', '', 8902208897, '1', '', '', '', '', '2013-03-10', '2013-01-10', '', '', 1, '', '', 1, 'bangi', '', '0321788655', '0123344522', '', '', '', '', 0, 0, 0, '0', '', 0, '0000-00-00 00:00:00', '2013-10-18 03:08:00', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
('asyraf', 'amirul', 'abd rani', '', 8902208898, '1', '', '', '', '', '2013-03-10', '2013-01-10', '', '', 1, '', '', 1, 'bangi', '', '0321788655', '0123344522', '', '', '', '', 0, 0, 0, '0', '', 0, '0000-00-00 00:00:00', '2013-10-18 03:12:46', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00'),
('asyraf', 'amirul', 'abd rani', '', 8902208899, '1', '', '', '', '', '2013-03-10', '2013-01-10', '', '', 1, '', '', 1, 'bangi', '', '0321788655', '0123344522', '', '', '', '', 0, 0, 0, '0', '', 0, '0000-00-00 00:00:00', '2013-10-18 03:14:01', '', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00');


-- --------------------------------------------------------

--
-- Table structure for table `patient_breast_abnormality`
--

CREATE TABLE IF NOT EXISTS `patient_breast_abnormality` (
  `patient_breast_abnormality_side_id` int(10) NOT NULL AUTO_INCREMENT,
  `patient_breast_screening_id` int(10) NOT NULL,
  `left_breast` tinyint(1) NOT NULL,
  `right_breast` tinyint(1) NOT NULL,
  `upper` tinyint(1) NOT NULL,
  `below` tinyint(1) NOT NULL,
  `is_abnormality_detected` tinyint(1) NOT NULL,
  `created_on` date NOT NULL,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(50) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`patient_breast_abnormality_side_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `patient_breast_abnormality`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient_breast_screening`
--

CREATE TABLE IF NOT EXISTS `patient_breast_screening` (
  `patient_breast_screening_id` int(10) NOT NULL AUTO_INCREMENT,
  `patient_ic_no` bigint(18) NOT NULL,
  `patient_studies_id` int(10) NOT NULL,
  `date_of_first_mammogram` date NOT NULL,
  `age_of_first_mammogram` int(3) NOT NULL,
  `date_of_recent_mammogram` date NOT NULL,
  `screening_centre` varchar(200) NOT NULL,
  `total_no_of_mammogram` int(5) NOT NULL,
  `screening_interval` varchar(100) NOT NULL,
  `abnormalities_mammo_flag` tinyint(1) NOT NULL,
  `mammo_comments` varchar(200) NOT NULL,
  `name_of_radiologist` varchar(100) NOT NULL,
  `had_ultrasound_flag` tinyint(1) NOT NULL,
  `total_no_of_ultrasound` int(10) NOT NULL,
  `abnormalities_ultrasound_flag` tinyint(1) NOT NULL,
  `had_mri_flag` tinyint(1) NOT NULL,
  `total_no_of_mri` int(10) NOT NULL,
  `abnormalities_MRI_flag` tinyint(1) NOT NULL,
  `BIRADS_clinical_classification` longtext NOT NULL,
  `BIRADS_density_classification` longtext NOT NULL,
  `percentage_of_mammo_density` varchar(20) NOT NULL,
  `created_on` date NOT NULL,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(50) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `screening_center_of_first_mammogram` varchar(60) DEFAULT NULL,
  `screening_center_of_recent_mammogram` varchar(100) DEFAULT NULL,
  `details_of_first_mammogram` varchar(100) DEFAULT NULL,
  `details_of_recent_mammogram` varchar(100) DEFAULT NULL,
  `motivaters_of_first_mammogram` varchar(100) DEFAULT NULL,
  `motivaters_of_recent_mammogram` varchar(100) DEFAULT NULL,
  `reason_of_mammogram` varchar(100) DEFAULT NULL,
  `reason_of_mammogram_details` varchar(100) DEFAULT NULL,
  `mammogram_in_sdmc` tinyint(1) DEFAULT NULL,
  `action_suggested_on_mammogram_report` varchar(100) NOT NULL,
  `reason_of_action_suggested` varchar(100) NOT NULL,
  `site_effected_of_mammogram` varchar(50) NOT NULL,
  `is_cancer_mammogram_flag` int(3) NOT NULL,
  PRIMARY KEY (`patient_breast_screening_id`),
  KEY `fk_patient_breast_screening_patient_studies_id` (`patient_studies_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `patient_breast_screening`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient_cancer`
--

CREATE TABLE IF NOT EXISTS `patient_cancer` (
  `patient_cancer_id` int(10) NOT NULL AUTO_INCREMENT,
  `patient_studies_id` int(10) NOT NULL,
  `cancer_id` int(10) NOT NULL,
  `cancer_site_id` int(10) NOT NULL,
  `cancer_invasive_type` text NOT NULL,
  `is_primary` tinyint(1) NOT NULL,
  `date_of_diagnosis` date NOT NULL,
  `age_of_diagnosis` int(10) NOT NULL,
  `diagnosis_center` varchar(250) NOT NULL,
  `doctor_name` varchar(100) NOT NULL,
  `detected_by` varchar(250) NOT NULL,
  `bilateral_flag` tinyint(1) NOT NULL,
  `recurrence_flag` tinyint(1) NOT NULL,
  `created_on` date NOT NULL,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(50) NOT NULL,
  `is_deleted` tinyint(1) DEFAULT '0',
  `deleted_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`patient_cancer_id`),
  KEY `fk_patient_cancer_patient_studies_id` (`patient_studies_id`),
  KEY `cancer_site_id` (`cancer_site_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `patient_cancer`
--


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
  `treatment_durations` varchar(50) NOT NULL,
  `comments` varchar(200) NOT NULL,
  `treatment_drug_dose` longtext NOT NULL,
  `created_on` date NOT NULL,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(50) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `treatment_details` varchar(150) DEFAULT NULL,
  `treatment_dose` varchar(60) DEFAULT NULL,
  `treatment_cycle` varchar(100) DEFAULT NULL,
  `treatment_frequency` varchar(100) DEFAULT NULL,
  `treatment_visidual_desease` varchar(100) DEFAULT NULL,
  `treatment_privacy_outcome` varchar(100) DEFAULT NULL,
  `treatment_cal125_pretreatment` varchar(100) DEFAULT NULL,
  `treatment_cal125_posttreatment` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`patient_cancer_treatment_id`),
  KEY `fk_patient_cancer_treatment_patient_cancer_id` (`patient_cancer_id`),
  KEY `fk_patient_cancer_treatment_treatment_id` (`treatment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `patient_cancer_treatment`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient_cogs_studies`
--

CREATE TABLE IF NOT EXISTS `patient_cogs_studies` (
  `COGS_studies_id` bigint(10) NOT NULL AUTO_INCREMENT,
  `patient_ic_no` bigint(18) NOT NULL,
  `COGS_studies_name` varchar(50) NOT NULL,
  `COGS_studies_no` varchar(50) NOT NULL,
  `created_on` date NOT NULL,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(50) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `deleted_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`COGS_studies_id`),
  KEY `fk_patient_ic_no` (`patient_ic_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;


--
-- Dumping data for table `patient_cogs_studies`
--

INSERT INTO `patient_cogs_studies` (`COGS_studies_id`, `patient_ic_no`, `COGS_studies_name`, `COGS_studies_no`, `created_on`, `modified_on`, `modified_by`, `is_deleted`, `deleted_on`) VALUES
(1, 8902208819, 'CIMBA', '12456', '0000-00-00', '2013-10-18 03:42:37', '', 0, '0000-00-00 00:00:00');


-- --------------------------------------------------------

--
-- Table structure for table `patient_contact_person`
--

CREATE TABLE IF NOT EXISTS `patient_contact_person` (
  `patient_contact_person_id` int(10) NOT NULL AUTO_INCREMENT,
  `patient_ic_no` bigint(18) NOT NULL,
  `contact_name` varchar(50) NOT NULL,
  `contact_relationship` varchar(50) NOT NULL,
  `contact_telephone` varchar(30) NOT NULL,
  `created_on` date NOT NULL,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(50) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`patient_contact_person_id`),
  KEY `fk_patient_contact_person_patient_ic_no` (`patient_ic_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;



--
-- Dumping data for table `patient_contact_person`
--

INSERT INTO `patient_contact_person` (`patient_contact_person_id`, `patient_ic_no`, `contact_name`, `contact_relationship`, `contact_telephone`, `created_on`, `modified_on`, `modified_by`, `is_deleted`, `deleted_on`) VALUES
(1, 8902208890, 'ali', 'boss', '01254617189', '0000-00-00', '2013-10-18 01:58:21', '', 0, '0000-00-00 00:00:00'),
(2, 8902208891, 'ali', 'boss', '01254617189', '0000-00-00', '2013-10-18 02:14:48', '', 0, '0000-00-00 00:00:00'),
(3, 8902208892, 'ali', 'boss', '01254617189', '0000-00-00', '2013-10-18 02:20:29', '', 0, '0000-00-00 00:00:00'),
(4, 8902208893, 'ali', 'boss', '01254617189', '0000-00-00', '2013-10-18 02:26:31', '', 0, '0000-00-00 00:00:00'),
(5, 8902208894, 'ali', 'boss', '01254617189', '0000-00-00', '2013-10-18 02:32:56', '', 0, '0000-00-00 00:00:00'),
(6, 8902208896, '', '', '', '0000-00-00', '2013-10-18 03:05:37', '', 0, '0000-00-00 00:00:00'),
(7, 8902208897, '', '', '', '0000-00-00', '2013-10-18 03:08:00', '', 0, '0000-00-00 00:00:00'),
(8, 8902208898, '', '', '', '0000-00-00', '2013-10-18 03:12:46', '', 0, '0000-00-00 00:00:00'),
(9, 8902208899, '', '', '', '0000-00-00', '2013-10-18 03:14:01', '', 0, '0000-00-00 00:00:00'),
(10, 8902208810, '', '', '', '0000-00-00', '2013-10-18 03:15:01', '', 0, '0000-00-00 00:00:00'),
(11, 8902208811, '', '', '', '0000-00-00', '2013-10-18 03:16:19', '', 0, '0000-00-00 00:00:00'),
(12, 8902208812, '', '', '', '0000-00-00', '2013-10-18 03:23:38', '', 0, '0000-00-00 00:00:00'),
(13, 8902208813, '', '', '', '0000-00-00', '2013-10-18 03:33:59', '', 0, '0000-00-00 00:00:00'),
(14, 8902208814, '', '', '', '0000-00-00', '2013-10-18 03:34:58', '', 0, '0000-00-00 00:00:00'),
(15, 8902208815, '', '', '', '0000-00-00', '2013-10-18 03:35:44', '', 0, '0000-00-00 00:00:00'),
(16, 8902208816, '', '', '', '0000-00-00', '2013-10-18 03:36:51', '', 0, '0000-00-00 00:00:00'),
(17, 8902208817, '', '', '', '0000-00-00', '2013-10-18 03:38:49', '', 0, '0000-00-00 00:00:00'),
(18, 8902208819, '', '', '', '0000-00-00', '2013-10-18 03:42:37', '', 0, '0000-00-00 00:00:00'),
(19, 8902208831, '', '', '', '0000-00-00', '2013-10-18 04:00:54', '', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `patient_family`
--

CREATE TABLE IF NOT EXISTS `patient_family` (
  `patient_family_id` int(10) NOT NULL AUTO_INCREMENT,
  `family_no` int(10) NOT NULL,
  `patient_ic_no` bigint(18) NOT NULL,
  `created_on` date NOT NULL,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(50) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
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
  `patient_studies_id` int(10) NOT NULL,
  `had_gnc_surgery_flag` tinyint(1) NOT NULL,
  `surgery_year` date NOT NULL,
  `treatment_id` int(10) NOT NULL,
  `gnc_treatment_name_other_details` longtext NOT NULL,
  `created_on` date NOT NULL,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(50) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`patient_gne_surgery_history_id`),
  KEY `fk_patient_gynaecological_surgery_history_treatment_id` (`treatment_id`),
  KEY `fk_patient_gynaecological_surgery_history_studies_id` (`patient_studies_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `patient_gynaecological_surgery_history`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient_hospital_no`
--

CREATE TABLE IF NOT EXISTS `patient_hospital_no` (
  `patient_hospital_no_ID` int(11) NOT NULL AUTO_INCREMENT,
  `patient_ic_no` bigint(18) NOT NULL,
  `hospital_no` char(50) NOT NULL,
  `created_on` date NOT NULL,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(50) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `deleted_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`patient_hospital_no_ID`),
  KEY `patient_ic_no` (`patient_ic_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `patient_hospital_no`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient_infertility`
--

CREATE TABLE IF NOT EXISTS `patient_infertility` (
  `patient_infertility_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_studies_id` int(10) NOT NULL,
  `infertility_testing_flag` tinyint(1) NOT NULL,
  `infertility_treatment_type` longtext NOT NULL,
  `infertility_treatment_duration` varchar(50) NOT NULL,
  `infertility_comments` varchar(200) NOT NULL,
  `contraceptive_pills_flag` tinyint(1) NOT NULL,
  `currently_taking_contraceptive_pills_flag` tinyint(1) NOT NULL,
  `contraceptive_start_date` date NOT NULL,
  `contraceptive_end_date` date NOT NULL,
  `contraceptive_duration` varchar(50) NOT NULL,
  `hrt_flag` tinyint(1) NOT NULL,
  `currently_using_hrt_flag` tinyint(1) NOT NULL,
  `hrt_start_date` date NOT NULL,
  `hrt_end_date` date NOT NULL,
  `hrt_duration` varchar(50) NOT NULL,
  `created_on` date NOT NULL,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(50) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `contraceptive_end_age` varchar(60) DEFAULT NULL,
  `contraceptive_start_age` varchar(60) DEFAULT NULL,
  `hrt_start_age` varchar(60) DEFAULT NULL,
  `hrt_end_age` varchar(60) DEFAULT NULL,
  PRIMARY KEY (`patient_infertility_id`),
  KEY `fk_patient_infertility_patient_studies_id` (`patient_studies_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `patient_infertility`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient_interview_manager`
--

CREATE TABLE IF NOT EXISTS `patient_interview_manager` (
  `patient_interview_manager_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_ic_no` bigint(18) NOT NULL,
  `created_on` date NOT NULL,
  `comments` longtext NOT NULL,
  `interview_date` date NOT NULL,
  `next_interview_date` date NOT NULL,
  `is_send_email_reminder_to_officers` tinyint(1) NOT NULL DEFAULT '0',
  `officer_email_addresses` varchar(250) NOT NULL,
  `interview_interval` varchar(250) NOT NULL,
  `is_reminded` tinyint(1) NOT NULL DEFAULT '0',
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(50) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`patient_interview_manager_id`),
  KEY `fk_patient_interview_manager_patient_ic_no` (`patient_ic_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `patient_interview_manager`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient_lifestyle_adulthood_exercise`
--

CREATE TABLE IF NOT EXISTS `patient_lifestyle_adulthood_exercise` (
  `patient_lifestyle_adulthood_exercise_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_lifestyle_factors_id` int(11) NOT NULL,
  `exercise_id` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(50) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
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
  `created_on` date NOT NULL,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(50) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
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
  `created_on` date NOT NULL,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(50) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
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
  `patient_studies_id` int(10) NOT NULL,
  `questionnaire_date` date NOT NULL,
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
  `alcohol_frequency` double NOT NULL,
  `alcohol_comments` longtext NOT NULL,
  `coffee_drunk_flag` tinyint(1) NOT NULL,
  `coffee_age` int(5) NOT NULL,
  `coffee_frequency` double NOT NULL,
  `tea_drunk_flag` tinyint(1) NOT NULL,
  `tea_age` int(5) NOT NULL,
  `tea_type` text NOT NULL,
  `tea_frequency` double NOT NULL,
  `soya_bean_drunk_flag` tinyint(1) NOT NULL,
  `soya_bean_frequency` double NOT NULL,
  `soya_products_flag` tinyint(1) NOT NULL,
  `soya_products_average` double NOT NULL,
  `diabetes_flag` tinyint(1) NOT NULL,
  `medicine_for_diabetes_flag` tinyint(1) NOT NULL,
  `diabetes_medicine_name` text NOT NULL,
  `created_on` date NOT NULL,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(50) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`patient_lifestyle_factors_id`),
  KEY `fk_patient_lifestyle_factors_patient_studies_id` (`patient_studies_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

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
  `processed_image_file_name` longtext NOT NULL,
  `created_on` date NOT NULL,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(50) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`patient_mammo_processed_images_id`),
  KEY `fk_patient_mammo_processed_images_patient_ic_no` (`patient_ic_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `patient_mammo_processed_images`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient_mammo_raw_images`
--

CREATE TABLE IF NOT EXISTS `patient_mammo_raw_images` (
  `patient_mammo_raw_images_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_ic_no` bigint(18) NOT NULL,
  `patient_breast_screening_id` int(10) NOT NULL,
  `raw_image_file_name` longtext NOT NULL,
  `created_on` date NOT NULL,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(50) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`patient_mammo_raw_images_id`),
  KEY `fk_patient_mammo_raw_images_patient_ic_no` (`patient_ic_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `patient_mammo_raw_images`
--


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
  `age_at_menopause` date NOT NULL,
  `reason_period_stops` longtext NOT NULL,
  `date_period_stops` date NOT NULL,
  `reason_period_stops_other_details` longtext NOT NULL,
  `created_on` date NOT NULL,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(50) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`patient_menstruation_id`),
  KEY `fk_patient_menstruation_patient_studies_id` (`patient_studies_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `patient_menstruation`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient_mri_abnormality`
--

CREATE TABLE IF NOT EXISTS `patient_mri_abnormality` (
  `patient_mri_abnormlity_id` int(10) NOT NULL AUTO_INCREMENT,
  `mri_date` date NOT NULL,
  `is_abnormality_detected` tinyint(1) NOT NULL,
  `comments` varchar(250) NOT NULL,
  `patient_breast_screening_id` int(10) NOT NULL,
  `created_on` date NOT NULL,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(50) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`patient_mri_abnormlity_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `patient_mri_abnormality`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient_mutation_analysis`
--

CREATE TABLE IF NOT EXISTS `patient_mutation_analysis` (
  `patient_investigations_id` int(10) NOT NULL AUTO_INCREMENT,
  `date_test_ordered` date NOT NULL,
  `ordered_by` text NOT NULL,
  `testing_result_notification_flag` tinyint(1) NOT NULL,
  `service_provider` longtext NOT NULL,
  `testing_batch` text NOT NULL,
  `testing_date` date NOT NULL,
  `gene_tested` text NOT NULL,
  `types_of_testing` text NOT NULL,
  `type_of_sample` text NOT NULL,
  `reasons` longtext NOT NULL,
  `new_mutation_flag` tinyint(1) NOT NULL,
  `test_result` longtext NOT NULL,
  `investigation_test_results_other_details` longtext NOT NULL,
  `carrier_status` text NOT NULL,
  `mutation_nomenclature` text NOT NULL,
  `mutation_type` text NOT NULL,
  `exon` text NOT NULL,
  `mutation_pathogenicity` text NOT NULL,
  `report_date` date NOT NULL,
  `date_client_notified` date NOT NULL,
  `is_counselling_flag` tinyint(1) NOT NULL,
  `comments` longtext NOT NULL,
  `patient_studies_id` int(10) NOT NULL,
  `conformation_attachment` tinyint(1) NOT NULL,
  `conformation_file_url` longtext NOT NULL,
  `created_on` date NOT NULL,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(50) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `mutation_name` varchar(150) NOT NULL,
  PRIMARY KEY (`patient_investigations_id`),
  KEY `fk_patient_investigations_patient_studies_id` (`patient_studies_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `patient_mutation_analysis`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient_non_cancer_surgery`
--

CREATE TABLE IF NOT EXISTS `patient_non_cancer_surgery` (
  `patient_non_cancer_surgery_id` int(10) NOT NULL AUTO_INCREMENT,
  `patient_studies_id` int(10) NOT NULL,
  `surgery_type` text NOT NULL,
  `reason_for_surgery` varchar(200) NOT NULL,
  `date_of_surgery` date NOT NULL,
  `age_at_surgery` int(11) NOT NULL,
  `comments` varchar(200) NOT NULL,
  `created_on` date NOT NULL,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(50) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `deleted_on` date NOT NULL,
  `breast_surgery_type` varchar(60) DEFAULT NULL,
  `breast_reason_of_surgery` varchar(60) DEFAULT NULL,
  `breast_comments` varchar(150) DEFAULT NULL,
  `breast_age_of_surgery` varchar(60) DEFAULT NULL,
  `breast_date_of_surgery` date NOT NULL,
  PRIMARY KEY (`patient_non_cancer_surgery_id`),
  KEY `patient_studies_id` (`patient_studies_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `patient_non_cancer_surgery`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient_other_disease`
--

CREATE TABLE IF NOT EXISTS `patient_other_disease` (
  `patient_other_disease_id` int(10) NOT NULL AUTO_INCREMENT,
  `patient_studies_id` int(10) NOT NULL,
  `diagnosis_id` int(10) NOT NULL,
  `date_of_diagnosis` date NOT NULL,
  `diagnosis_age` int(5) NOT NULL,
  `diagnosis_center` text NOT NULL,
  `doctor_name` varchar(100) NOT NULL,
  `on_medication_flag` tinyint(1) NOT NULL,
  `created_on` date NOT NULL,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(50) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`patient_other_disease_id`),
  KEY `fk_patient_diagnosis_diagnosis_id` (`diagnosis_id`),
  KEY `fk_patient_diagnosis_patient_studies_id` (`patient_studies_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `patient_other_disease`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient_other_disease_medication`
--

CREATE TABLE IF NOT EXISTS `patient_other_disease_medication` (
  `patient_other_disease_medication_id` int(10) NOT NULL AUTO_INCREMENT,
  `patient_other_disease_id` int(10) NOT NULL,
  `medication_type` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `duration` varchar(50) NOT NULL,
  `comments` varchar(200) NOT NULL,
  `created_on` date NOT NULL,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(50) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `deleted_on` date NOT NULL,
  PRIMARY KEY (`patient_other_disease_medication_id`),
  KEY `patient_other_disease_id` (`patient_other_disease_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `patient_other_disease_medication`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient_other_screening`
--

CREATE TABLE IF NOT EXISTS `patient_other_screening` (
  `patient_other_screening_id` int(10) NOT NULL AUTO_INCREMENT,
  `patient_studies_id` int(10) NOT NULL,
  `screening_type` varchar(250) NOT NULL,
  `age_at_screening` int(10) NOT NULL,
  `screening_center` varchar(250) NOT NULL,
  `screening_result` varchar(250) NOT NULL,
  `created_on` date NOT NULL,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(50) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`patient_other_screening_id`),
  KEY `patient_studies_id` (`patient_studies_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `patient_other_screening`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient_ovarian_screening`
--

CREATE TABLE IF NOT EXISTS `patient_ovarian_screening` (
  `patient_ovarian_screening_id` int(10) NOT NULL AUTO_INCREMENT,
  `patient_studies_id` int(10) NOT NULL,
  `ovarian_screening_type_id` int(10) NOT NULL,
  `screening_date` date NOT NULL,
  `is_abnormality_detected` tinyint(1) NOT NULL,
  `additional_info` varchar(200) NOT NULL,
  `created_on` date NOT NULL,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(50) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `deleted_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`patient_ovarian_screening_id`),
  KEY `patient_studies_id` (`patient_studies_id`),
  KEY `ovarian_screening_type_id` (`ovarian_screening_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `patient_ovarian_screening`
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
  `date_of_birth` date NOT NULL,
  `year_of_birth` int(11) NOT NULL,
  `age_child_at_consent` int(11) NOT NULL,
  `birthweight` double NOT NULL,
  `breastfeeding_duration` text NOT NULL,
  `created_on` date NOT NULL,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(50) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
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
  `patient_studies_id` int(10) NOT NULL,
  `pregnant_flag` tinyint(1) NOT NULL,
  `created_on` date NOT NULL,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(50) NOT NULL,
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  `deleted_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`patient_parity_id`),
  KEY `fk_patient_parity_table_patient_studies_id` (`patient_studies_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `patient_parity_table`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient_pathology`
--

CREATE TABLE IF NOT EXISTS `patient_pathology` (
  `patient_pathology_id` int(10) NOT NULL AUTO_INCREMENT,
  `cancer_id` int(10) NOT NULL,
  `tissue_site` text NOT NULL,
  `type_of_report` text NOT NULL,
  `date_of_report` date NOT NULL,
  `pathology_lab` text NOT NULL,
  `name_of_doctor` text NOT NULL,
  `morphology` text NOT NULL,
  `t_staging` text NOT NULL,
  `n_staging` text NOT NULL,
  `m_staging` longtext NOT NULL,
  `stage_classifications` text NOT NULL,
  `tumour_stage` longtext NOT NULL,
  `tumour_grade` text NOT NULL,
  `total_lymph_nodes` int(10) NOT NULL,
  `tumour_size` text NOT NULL,
  `comments` longtext NOT NULL,
  `created_on` date NOT NULL,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(50) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `patient_cancer_id` int(5) DEFAULT NULL,
  `no_of_report` varchar(50) NOT NULL,
  `tumor_subtype` varchar(50) NOT NULL,
  `tumor_behaviour` varchar(100) NOT NULL,
  `tumor_differentiation` varchar(150) NOT NULL,
  PRIMARY KEY (`patient_pathology_id`),
  KEY `cancer_id` (`cancer_id`),
  KEY `fk_patient_cancer_id` (`patient_cancer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `patient_pathology`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient_pathology_staining_status`
--

CREATE TABLE IF NOT EXISTS `patient_pathology_staining_status` (
  `patient_pathology_staining_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_pathology_id` int(10) NOT NULL,
  `ER_status` text NOT NULL,
  `PR_status` text NOT NULL,
  `HER2_status` text NOT NULL,
  `created_on` date NOT NULL,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(50) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `deleted_on` date NOT NULL,
  PRIMARY KEY (`patient_pathology_staining_status_id`),
  KEY `patient_pathology_id` (`patient_pathology_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `patient_pathology_staining_status`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient_private_no`
--

CREATE TABLE IF NOT EXISTS `patient_private_no` (
  `patient_private_no_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_ic_no` bigint(18) NOT NULL,
  `private_no` char(50) NOT NULL,
  `created_on` date NOT NULL,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(50) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`patient_private_no_id`),
  KEY `fk_patient_private_no_patient_ic_no` (`patient_ic_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

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
  `degree_of_relativeness` int(10) NOT NULL,
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
  `total_half_brothers` int(5) NOT NULL,
  `total_half_sisters` int(5) NOT NULL,
  `sex` text NOT NULL,
  `is_paternal` tinyint(1) NOT NULL,
  `is_maternal` tinyint(1) NOT NULL,
  `vital_status` text NOT NULL,
  `comments` char(200) NOT NULL,
  `created_on` date NOT NULL,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(50) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `is_adopted` tinyint(1) NOT NULL,
  `is_in_other_country` tinyint(1) NOT NULL,
  PRIMARY KEY (`patient_relatives_id`),
  KEY `fk_patient_relatives_cancer_type_id` (`cancer_type_id`),
  KEY `fk_patient_relatives_family_family_no` (`family_no`),
  KEY `fk_patient_relatives_patient_ic_no` (`patient_ic_no`),
  KEY `fk_patient_relatives_relatives_id` (`relatives_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;


--
-- Dumping data for table `patient_relatives`
--

INSERT INTO `patient_relatives` (`patient_relatives_id`, `patient_ic_no`, `relatives_id`, `degree_of_relativeness`, `family_no`, `full_name`, `sur_name`, `maiden_name`, `ethnicity`, `nationality`, `town_of_residence`, `d_o_b`, `is_alive_flag`, `d_o_d`, `is_cancer_diagnosed`, `date_of_diagnosis`, `cancer_type_id`, `age_of_diagnosis`, `other_detail`, `no_of_brothers`, `no_of_sisters`, `total_half_brothers`, `total_half_sisters`, `sex`, `is_paternal`, `is_maternal`, `vital_status`, `comments`, `created_on`, `modified_on`, `modified_by`, `is_deleted`, `deleted_on`, `is_adopted`, `is_in_other_country`) VALUES
(2, 8902208810, 1, 0, 1, 'ali', '0', 'ahmad', 'malay', '', 'baling', '0000-00-00', 1, '0000-00-00', 1, '0000-00-00', 2, 4, 'father Diagnosis details', 1, 2, 3, 4, '', 0, 0, 'Vital status', '', '0000-00-00', '2013-10-24 02:07:36', '', 0, '0000-00-00 00:00:00', 0, 0),
(3, 8902208811, 1, 0, 1, 'ali', '0', 'ahmad', 'malay', '', 'baling', '0000-00-00', 1, '0000-00-00', 1, '0000-00-00', 2, 4, 'father Diagnosis details', 1, 2, 3, 4, '', 0, 0, 'Vital status', '', '0000-00-00', '2013-10-24 02:14:28', '', 0, '0000-00-00 00:00:00', 0, 0),
(4, 8902208811, 2, 0, 1, 'aminah', '0', 'zainab', '0', '', 'baling', '0000-00-00', 1, '0000-00-00', 1, '0000-00-00', 1, 3, 'diagnosis details', 1, 2, 3, 4, '', 0, 0, '1', '', '0000-00-00', '2013-10-24 02:14:28', '', 0, '0000-00-00 00:00:00', 0, 0);

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
  `created_on` date NOT NULL,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(50) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `total_no_of_siblings` int(3) DEFAULT NULL,
  PRIMARY KEY (`patient_relatives_summary_ID`),
  KEY `fk_patient_relatives_summary_patient_ic_no` (`patient_ic_no`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `patient_relatives_summary`
--

INSERT INTO `patient_relatives_summary` (`patient_relatives_summary_ID`, `patient_ic_no`, `total_no_of_male_siblings`, `total_no_of_female_siblings`, `total_no_of_affected_siblings`, `total_no_of_male_children`, `total_no_of_female_children`, `total_no_of_affected_children`, `total_no_of_1st_degree`, `total_no_of_2nd_degree`, `total_no_of_3rd_degree`, `created_on`, `modified_on`, `modified_by`, `is_deleted`, `deleted_on`, `total_no_of_siblings`) VALUES
(3, 8902208890, 3, 4, 7, 3, 3, 6, 2, 3, 4, '0000-00-00', '2013-10-18 01:58:21', '', 0, '0000-00-00 00:00:00', NULL),
(4, 8902208891, 3, 4, 7, 3, 3, 6, 2, 3, 4, '0000-00-00', '2013-10-18 02:14:49', '', 0, '0000-00-00 00:00:00', NULL),
(5, 8902208892, 3, 4, 7, 3, 3, 6, 2, 3, 4, '0000-00-00', '2013-10-18 02:20:29', '', 0, '0000-00-00 00:00:00', NULL),
(6, 8902208893, 3, 4, 7, 3, 3, 6, 2, 3, 4, '0000-00-00', '2013-10-18 02:26:32', '', 0, '0000-00-00 00:00:00', NULL),
(7, 8902208894, 3, 4, 7, 3, 3, 6, 2, 3, 4, '0000-00-00', '2013-10-18 02:32:56', '', 0, '0000-00-00 00:00:00', NULL),
(8, 8902208819, 0, 0, 0, 0, 0, 0, 0, 0, 0, '0000-00-00', '2013-10-18 03:42:37', '', 0, '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `patient_risk_assessment`
--

CREATE TABLE IF NOT EXISTS `patient_risk_assessment` (
  `patient_boadicea_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_ic_no` bigint(18) NOT NULL,
  `at_consent_mach_brca1` int(11) NOT NULL,
  `at_consent_mach_brca2` int(11) NOT NULL,
  `at_consent_mach_total` int(11) NOT NULL,
  `adjusted_mach_brca1` int(11) NOT NULL,
  `adjusted_mach_brca2` int(11) NOT NULL,
  `adjusted_mach_total` int(11) NOT NULL,
  `after_gc_brca1` int(11) NOT NULL,
  `after_gc_brca2` int(11) NOT NULL,
  `after_gc_total` int(11) NOT NULL,
  `at_consent_boadicea_brca1` int(11) NOT NULL,
  `at_consent_boadicea_brca2` int(11) NOT NULL,
  `at_consent_boadicea_no_mutation` tinyint(1) NOT NULL,
  `adjusted_boadicea_brca1` int(11) NOT NULL,
  `adjusted_boadicea_brca2` int(11) NOT NULL,
  `adjusted_boadicea_no_mutation` tinyint(1) NOT NULL,
  `after_gc_boadicea_brca1` int(11) NOT NULL,
  `after_gc_boadicea_brca2` int(11) NOT NULL,
  `after_gc_boadicea_no_mutation` tinyint(1) NOT NULL,
  `at_consent_gail_model_5years` int(11) NOT NULL,
  `at_consent_gail_model_10years` int(11) NOT NULL,
  `first_mammo_gail_model_5years` int(11) NOT NULL,
  `first_mammo_gail_model_10years` int(11) NOT NULL,
  `created_on` date NOT NULL,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(50) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`patient_boadicea_id`),
  KEY `fk_patient_boadicea_patient_ic_no` (`patient_ic_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `patient_risk_assessment`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient_risk_reducing_surgery`
--

CREATE TABLE IF NOT EXISTS `patient_risk_reducing_surgery` (
  `patient_risk_reducing_surgery_id` int(10) NOT NULL AUTO_INCREMENT,
  `patient_studies_id` int(10) NOT NULL,
  `had_new_lesion_surgery_flag` tinyint(1) NOT NULL,
  `had_complete_removal_surgery_flag` tinyint(1) NOT NULL,
  `created_on` date NOT NULL,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(50) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `deleted_on` date NOT NULL,
  PRIMARY KEY (`patient_risk_reducing_surgery_id`),
  KEY `patient_studies_id` (`patient_studies_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `patient_risk_reducing_surgery`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient_risk_reducing_surgery_complete_removal`
--

CREATE TABLE IF NOT EXISTS `patient_risk_reducing_surgery_complete_removal` (
  `patient_risk_reducing_surgery_complete_removal_id` int(10) NOT NULL AUTO_INCREMENT,
  `patient_risk_reducing_surgery_id` int(10) NOT NULL,
  `non_cancerous_site_id` int(10) NOT NULL,
  `surgery_date` date NOT NULL,
  `surgery_reason` varchar(200) NOT NULL,
  `created_on` date NOT NULL,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(50) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `deleted_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`patient_risk_reducing_surgery_complete_removal_id`),
  KEY `patient_risk_reducing_surgery_id` (`patient_risk_reducing_surgery_id`),
  KEY `non_cancerous_site_id` (`non_cancerous_site_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `patient_risk_reducing_surgery_complete_removal`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient_risk_reducing_surgery_lesion`
--

CREATE TABLE IF NOT EXISTS `patient_risk_reducing_surgery_lesion` (
  `patient_risk_reducing_surgery_lesion_id` int(10) NOT NULL AUTO_INCREMENT,
  `patient_risk_reducing_surgery_id` int(10) NOT NULL,
  `non_cancerous_site_id` int(10) NOT NULL,
  `surgery_date` date NOT NULL,
  `created_on` date NOT NULL,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(50) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL,
  `deleted_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`patient_risk_reducing_surgery_lesion_id`),
  KEY `patient_risk_reducing_surgery_id` (`patient_risk_reducing_surgery_id`),
  KEY `non_cancerous_site_id` (`non_cancerous_site_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `patient_risk_reducing_surgery_lesion`
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
  `consent_given_by` varchar(250) NOT NULL,
  `consent_response` varchar(250) NOT NULL,
  `consent_version` varchar(250) NOT NULL,
  `relation_to_study` varchar(50) NOT NULL,
  `referral_to` varchar(250) NOT NULL DEFAULT '',
  `referral_to_genetic_counselling` varchar(250) NOT NULL DEFAULT '',
  `referral_source` text NOT NULL,
  `created_on` date NOT NULL,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(50) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`patient_studies_id`),
  KEY `fk_patient_studies_patient_ic_no` (`patient_ic_no`),
  KEY `fk_patient_studies_studies_id` (`studies_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `patient_studies`
--


-- --------------------------------------------------------

--
-- Table structure for table `patient_surveillance`
--

CREATE TABLE IF NOT EXISTS `patient_surveillance` (
  `patient_surveillance_id` int(10) NOT NULL AUTO_INCREMENT,
  `patient_studies_id` int(10) NOT NULL,
  `recruitment_center` text NOT NULL,
  `type` text NOT NULL,
  `first_consultation_date` date NOT NULL,
  `first_consultation_place` text NOT NULL,
  `surveillance_interval` text NOT NULL,
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
  `created_on` date NOT NULL,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(50) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`patient_surveillance_id`),
  KEY `fk_patient_surveillance_patient_studies_id` (`patient_studies_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

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
  `status_gathering_date` date NOT NULL,
  `created_on` date NOT NULL,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(50) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`patient_survival_status_id`),
  KEY `fk_patient_survival_status_patient_ic_no` (`patient_ic_no`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `patient_survival_status`
--

INSERT INTO `patient_survival_status` (`patient_survival_status_id`, `patient_ic_no`, `source`, `alive_status`, `status_gathering_date`, `created_on`, `modified_on`, `modified_by`, `is_deleted`, `deleted_on`) VALUES
(1, 8902208890, 'JPN', 1, '0000-00-00', '0000-00-00', '2013-10-18 01:58:21', '', 0, '0000-00-00 00:00:00'),
(2, 8902208891, 'JPN', 1, '0000-00-00', '0000-00-00', '2013-10-18 02:14:48', '', 0, '0000-00-00 00:00:00'),
(3, 8902208892, 'JPN', 1, '0000-00-00', '0000-00-00', '2013-10-18 02:20:29', '', 0, '0000-00-00 00:00:00'),
(4, 8902208893, 'JPN', 1, '0000-00-00', '0000-00-00', '2013-10-18 02:26:32', '', 0, '0000-00-00 00:00:00'),
(5, 8902208894, 'JPN', 1, '0000-00-00', '0000-00-00', '2013-10-18 02:32:56', '', 0, '0000-00-00 00:00:00'),
(6, 8902208896, '', 0, '0000-00-00', '0000-00-00', '2013-10-18 03:05:37', '', 0, '0000-00-00 00:00:00'),
(7, 8902208897, '', 0, '0000-00-00', '0000-00-00', '2013-10-18 03:08:00', '', 0, '0000-00-00 00:00:00'),
(8, 8902208898, '', 0, '0000-00-00', '0000-00-00', '2013-10-18 03:12:46', '', 0, '0000-00-00 00:00:00'),
(9, 8902208899, '', 0, '0000-00-00', '0000-00-00', '2013-10-18 03:14:01', '', 0, '0000-00-00 00:00:00'),
(10, 8902208810, '', 0, '0000-00-00', '0000-00-00', '2013-10-18 03:15:01', '', 0, '0000-00-00 00:00:00'),
(11, 8902208811, '', 0, '0000-00-00', '0000-00-00', '2013-10-18 03:16:19', '', 0, '0000-00-00 00:00:00'),
(12, 8902208812, '', 0, '0000-00-00', '0000-00-00', '2013-10-18 03:23:38', '', 0, '0000-00-00 00:00:00'),
(13, 8902208813, '', 0, '0000-00-00', '0000-00-00', '2013-10-18 03:33:59', '', 0, '0000-00-00 00:00:00'),
(14, 8902208814, '', 0, '0000-00-00', '0000-00-00', '2013-10-18 03:34:58', '', 0, '0000-00-00 00:00:00'),
(15, 8902208815, '', 0, '0000-00-00', '0000-00-00', '2013-10-18 03:35:44', '', 0, '0000-00-00 00:00:00'),
(16, 8902208816, '', 0, '0000-00-00', '0000-00-00', '2013-10-18 03:36:51', '', 0, '0000-00-00 00:00:00'),
(17, 8902208817, '', 0, '0000-00-00', '0000-00-00', '2013-10-18 03:38:49', '', 0, '0000-00-00 00:00:00'),
(18, 8902208819, '', 0, '0000-00-00', '0000-00-00', '2013-10-18 03:42:37', '', 0, '0000-00-00 00:00:00'),
(19, 8902208831, '', 0, '0000-00-00', '0000-00-00', '2013-10-18 04:00:54', '', 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `patient_ultrasound_abnormality`
--

CREATE TABLE IF NOT EXISTS `patient_ultrasound_abnormality` (
  `patient_ultra_abn` int(10) NOT NULL AUTO_INCREMENT,
  `ultrasound_date` date NOT NULL,
  `is_abnormality_detected` tinyint(1) NOT NULL,
  `comments` longtext NOT NULL,
  `patient_breast_screening_id` int(10) NOT NULL,
  `created_on` date NOT NULL,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(50) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`patient_ultra_abn`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `relatives`
--

INSERT INTO `relatives` (`relatives_id`, `relatives_type`) VALUES
(1, 'Father'),
(2, 'Mother'),
(3, 'Brother'),
(4, 'Sister'),
(9, 'Stepbrother'),
(10, 'Stepsister'),
(11, 'Son'),
(12, 'Daughter'),
(13, 'Uncle'),
(14, 'Aunt'),
(15, 'Grandmother'),
(16, 'Grandfather'),
(17, 'Cousin');

-- --------------------------------------------------------

--
-- Table structure for table `relative_degrees`
--

CREATE TABLE IF NOT EXISTS `relative_degrees` (
  `relative_degree_ID` int(10) NOT NULL AUTO_INCREMENT,
  `relative_degree_name` char(100) NOT NULL,
  PRIMARY KEY (`relative_degree_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `relative_degrees`
--

INSERT INTO `relative_degrees` (`relative_degree_ID`, `relative_degree_name`) VALUES
(1, '1st degree'),
(2, '2nd degree'),
(3, '3rd degree');

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
(1, 'UM MyBrCa'),
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `suspend`, `reset_password_invalid_attempts`, `reset_password_counter`, `first_name`, `last_name`, `phone`, `current_city`, `country`, `profile_picture_path`, `user_language`, `add_privilege`, `view_privilege`, `edit_privilege`, `delete_privilege`) VALUES
(1, '\0\0', 'administrator', '59beecdf7fc966e2f17fd8f65a4a9aeb09d4a3d4', '9462e8eee0', 'asyraf.abdrani@gmail.com', '', NULL, NULL, '9d029802e28cd9c768e8e62277c0df49ec65c48c', 1268889823, 1383015052, 1, 0, 0, 0, 'Admin', 'istrator', '0', NULL, NULL, NULL, NULL, 1, 1, 1, 0),
(2, '\0\0', 'nazmul', '59beecdf7fc966e2f17fd8f65a4a9aeb09d4a3d4', '9462e8eee0', 'nazmul@apurbatech.com', '', NULL, NULL, NULL, 1268889823, 1373438882, 1, 0, 0, 0, 'Nazmul', 'Hasan', '0', NULL, NULL, NULL, NULL, 1, 1, 1, 0),
(3, '\0\0', 'alamgir', '59beecdf7fc966e2f17fd8f65a4a9aeb09d4a3d4', '9462e8eee0', 'alamgir@apurbatech.com', '', NULL, NULL, NULL, 1268889823, 1380003462, 1, 0, 0, 0, 'Alamgir', 'Kabir', '0', NULL, NULL, NULL, NULL, 1, 1, 1, 0),
(4, '\0\0', 'fariza', '59beecdf7fc966e2f17fd8f65a4a9aeb09d4a3d4', '9462e8eee0', 'fariza@apurbatech.com', '', NULL, NULL, NULL, 1268889823, 1375689996, 1, 0, 0, 0, 'Fariza', 'Amir', '0', NULL, NULL, NULL, NULL, 1, 1, 1, 0),
(5, '\0\0', 'nor', '59beecdf7fc966e2f17fd8f65a4a9aeb09d4a3d4', '9462e8eee0', 'azriah.aziz@apurbatech.com', '', NULL, NULL, NULL, 1268889823, 1373438882, 1, 0, 0, 0, 'Nor', 'Azriah', '0', NULL, NULL, NULL, NULL, 1, 1, 1, 0),
(6, '::1', '1', '5aa1cf374db58cfc254d0238f5f510b2', 'ecf965a6f606c708d9794321c602415f41b8869b', 'abc@yahoo.com', NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, 0, 0, 'Pulak', 'Roy', NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 1),
(7, '127.0.0.1', 'hayati', '24e601e426c48ca2b35a37218d129426', '756f02d5a3f3f77aa4cb3e29cddb82ce97bdd11a', 'farizaamir@gmail.com', NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, 0, 0, 'hayati', 'zanal', NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0),
(8, '127.0.0.1', 'firdaus', '05f60571e710fbe08c046156b4512306', '0cda0b86a43c5ef14b2dd2d3a61d8a869b3300dc', 'farizaamir@apurbatech.com', NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, 0, 0, 'Firdaus', 'Shaha', NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 1),
(9, '127.0.0.1', 'apurba', '5eb9db4a1de1213b16ba7f528bec7a3e', 'b4ed1869715559e7eb7bd7b03187eef5e90aec23', 'farizaamir@apurbatech.com', NULL, NULL, NULL, NULL, 0, NULL, NULL, 0, 0, 0, 'test', 'last', NULL, NULL, NULL, NULL, NULL, 1, 1, 0, 0),
(10, '\0\0', 'testuser', '679cfd73df416fc2c915d5f22815e9c8f0b1d1ec', NULL, 'farizaamir@apurbatech.com', NULL, NULL, NULL, NULL, 1381384886, 1381384923, 1, 0, 0, 0, 'test user', 'two', NULL, NULL, NULL, NULL, NULL, 1, 1, 1, 0);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(4, 3, 2),
(5, 4, 2),
(6, 5, 2),
(7, 8, 1),
(8, 10, 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `patient_breast_screening`
--
ALTER TABLE `patient_breast_screening`
  ADD CONSTRAINT `fk_patient_breast_screening_patient_studies_id` FOREIGN KEY (`patient_studies_id`) REFERENCES `patient_studies` (`patient_studies_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `patient_cancer`
--
ALTER TABLE `patient_cancer`
  ADD CONSTRAINT `fk_patient_cancer_patient_studies_id` FOREIGN KEY (`patient_studies_id`) REFERENCES `patient_studies` (`patient_studies_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `patient_cancer_ibfk_1` FOREIGN KEY (`cancer_site_id`) REFERENCES `cancer_site` (`cancer_site_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_cancer_treatment`
--
ALTER TABLE `patient_cancer_treatment`
  ADD CONSTRAINT `fk_patient_cancer_treatment_patient_cancer_id` FOREIGN KEY (`patient_cancer_id`) REFERENCES `patient_cancer` (`patient_cancer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_patient_cancer_treatment_treatment_id` FOREIGN KEY (`treatment_id`) REFERENCES `treatment` (`treatment_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_cogs_studies`
--
ALTER TABLE `patient_cogs_studies`
  ADD CONSTRAINT `patient_cogs_studies_ibfk_1` FOREIGN KEY (`patient_ic_no`) REFERENCES `patient` (`ic_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_contact_person`
--
ALTER TABLE `patient_contact_person`
  ADD CONSTRAINT `fk_patient_contact_person_patient_ic_no` FOREIGN KEY (`patient_ic_no`) REFERENCES `patient` (`ic_no`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `fk_patient_gynaecological_surgery_history_studies_id` FOREIGN KEY (`patient_studies_id`) REFERENCES `patient_studies` (`patient_studies_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_patient_gynaecological_surgery_history_treatment_id` FOREIGN KEY (`treatment_id`) REFERENCES `treatment` (`treatment_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_hospital_no`
--
ALTER TABLE `patient_hospital_no`
  ADD CONSTRAINT `patient_hospital_no_ibfk_1` FOREIGN KEY (`patient_ic_no`) REFERENCES `patient` (`ic_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `patient_hospital_no_ibfk_2` FOREIGN KEY (`patient_ic_no`) REFERENCES `patient` (`ic_no`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_interview_manager`
--
ALTER TABLE `patient_interview_manager`
  ADD CONSTRAINT `fk_patient_interview_manager_patient_ic_no` FOREIGN KEY (`patient_ic_no`) REFERENCES `patient` (`ic_no`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `patient_lifestyle_factors`
--
ALTER TABLE `patient_lifestyle_factors`
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
-- Constraints for table `patient_mutation_analysis`
--
ALTER TABLE `patient_mutation_analysis`
  ADD CONSTRAINT `fk_patient_investigations_patient_studies_id` FOREIGN KEY (`patient_studies_id`) REFERENCES `patient_studies` (`patient_studies_id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_patient_investigations_studies_id` FOREIGN KEY (`patient_studies_id`) REFERENCES `patient_studies` (`patient_studies_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `patient_non_cancer_surgery`
--
ALTER TABLE `patient_non_cancer_surgery`
  ADD CONSTRAINT `patient_non_cancer_surgery_ibfk_1` FOREIGN KEY (`patient_studies_id`) REFERENCES `patient_studies` (`patient_studies_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_other_disease`
--
ALTER TABLE `patient_other_disease`
  ADD CONSTRAINT `fk_patient_diagnosis_diagnosis_id` FOREIGN KEY (`diagnosis_id`) REFERENCES `diagnosis` (`diagnosis_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_patient_diagnosis_patient_studies_id` FOREIGN KEY (`patient_studies_id`) REFERENCES `patient_studies` (`patient_studies_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `patient_other_disease_medication`
--
ALTER TABLE `patient_other_disease_medication`
  ADD CONSTRAINT `patient_other_disease_medication_ibfk_1` FOREIGN KEY (`patient_other_disease_id`) REFERENCES `patient_other_disease` (`patient_other_disease_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_other_screening`
--
ALTER TABLE `patient_other_screening`
  ADD CONSTRAINT `patient_other_screening_ibfk_1` FOREIGN KEY (`patient_studies_id`) REFERENCES `patient_studies` (`patient_studies_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_ovarian_screening`
--
ALTER TABLE `patient_ovarian_screening`
  ADD CONSTRAINT `patient_ovarian_screening_ibfk_1` FOREIGN KEY (`patient_studies_id`) REFERENCES `patient_studies` (`patient_studies_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `patient_ovarian_screening_ibfk_2` FOREIGN KEY (`ovarian_screening_type_id`) REFERENCES `ovarian_screening_type` (`ovarian_screening_type_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_parity_record`
--
ALTER TABLE `patient_parity_record`
  ADD CONSTRAINT `fk_patient_parity_record_patient_parity_table_id` FOREIGN KEY (`patient_parity_table_id`) REFERENCES `patient_parity_table` (`patient_parity_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_parity_table`
--
ALTER TABLE `patient_parity_table`
  ADD CONSTRAINT `fk_patient_parity_table_patient_studies_id` FOREIGN KEY (`patient_studies_id`) REFERENCES `patient_studies` (`patient_studies_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `patient_pathology`
--
ALTER TABLE `patient_pathology`
  ADD CONSTRAINT `patient_pathology_ibfk_1` FOREIGN KEY (`cancer_id`) REFERENCES `cancer` (`cancer_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `patient_pathology_ibfk_2` FOREIGN KEY (`patient_cancer_id`) REFERENCES `patient_cancer` (`patient_cancer_id`),
  ADD CONSTRAINT `patient_pathology_ibfk_3` FOREIGN KEY (`patient_cancer_id`) REFERENCES `patient_cancer` (`patient_cancer_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_pathology_staining_status`
--
ALTER TABLE `patient_pathology_staining_status`
  ADD CONSTRAINT `patient_pathology_staining_status_ibfk_1` FOREIGN KEY (`patient_pathology_id`) REFERENCES `patient_pathology` (`patient_pathology_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `fk_patient_relatives_patient_ic_no` FOREIGN KEY (`patient_ic_no`) REFERENCES `patient` (`ic_no`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_patient_relatives_relatives_id` FOREIGN KEY (`relatives_id`) REFERENCES `relatives` (`relatives_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_risk_assessment`
--
ALTER TABLE `patient_risk_assessment`
  ADD CONSTRAINT `fk_patient_boadicea_patient_ic_no` FOREIGN KEY (`patient_ic_no`) REFERENCES `patient` (`ic_no`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `patient_risk_reducing_surgery`
--
ALTER TABLE `patient_risk_reducing_surgery`
  ADD CONSTRAINT `patient_risk_reducing_surgery_ibfk_1` FOREIGN KEY (`patient_studies_id`) REFERENCES `patient_studies` (`patient_studies_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_risk_reducing_surgery_complete_removal`
--
ALTER TABLE `patient_risk_reducing_surgery_complete_removal`
  ADD CONSTRAINT `patient_risk_reducing_surgery_complete_removal_ibfk_1` FOREIGN KEY (`patient_risk_reducing_surgery_id`) REFERENCES `patient_risk_reducing_surgery` (`patient_risk_reducing_surgery_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `patient_risk_reducing_surgery_complete_removal_ibfk_2` FOREIGN KEY (`non_cancerous_site_id`) REFERENCES `non_cancerous_site` (`non_cancerous_site_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient_risk_reducing_surgery_lesion`
--
ALTER TABLE `patient_risk_reducing_surgery_lesion`
  ADD CONSTRAINT `patient_risk_reducing_surgery_lesion_ibfk_1` FOREIGN KEY (`patient_risk_reducing_surgery_id`) REFERENCES `patient_risk_reducing_surgery` (`patient_risk_reducing_surgery_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `patient_risk_reducing_surgery_lesion_ibfk_2` FOREIGN KEY (`non_cancerous_site_id`) REFERENCES `non_cancerous_site` (`non_cancerous_site_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
