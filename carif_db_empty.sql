-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2014 at 04:58 AM
-- Server version: 5.6.11
-- PHP Version: 5.5.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `carif_db_new`
--
CREATE DATABASE IF NOT EXISTS `carif_db_new` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `carif_db_new`;

-- --------------------------------------------------------

--
-- Table structure for table `cancer`
--

CREATE TABLE IF NOT EXISTS `cancer` (
  `cancer_id` int(10) NOT NULL AUTO_INCREMENT,
  `cancer_name` text NOT NULL,
  `cancer_detail` longtext NOT NULL,
  PRIMARY KEY (`cancer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=514 ;

--
-- Dumping data for table `cancer`
--

INSERT INTO `cancer` (`cancer_id`, `cancer_name`, `cancer_detail`) VALUES
(1, 'BREAST', ''),
(2, 'OVARY', ''),
(171, 'STOMACH? REPRODUCTIVE?', ''),
(172, 'DK', ''),
(173, 'LYMPH NODE (NECK)', ''),
(174, 'BONE MARROW', ''),
(175, 'CERVICAL METS TO BONE', ''),
(176, 'NECK (UNCERTAIN)', ''),
(177, 'TESTICULAR', ''),
(178, 'LUNG/LIVER', ''),
(179, 'STOMACH, LIVER', ''),
(180, 'ENDOMETRI', ''),
(181, 'BREAST CANCER STG 2', ''),
(182, 'CERVIX?', ''),
(183, 'NK (ABDOMEN REGION?)', ''),
(184, 'BACK?', ''),
(185, 'GYECOLOGIC', ''),
(186, 'SAL', ''),
(187, 'PERINEUM REGION', ''),
(188, 'LUNG (SMOKER)', ''),
(189, 'MYELOMA', ''),
(190, 'LUNG? (HEAVY SMOKER+DRINKER)', ''),
(191, 'GASTRIC', ''),
(192, 'BEHIND THE EARS', ''),
(193, 'LUNG CANCER', ''),
(194, 'NECK REGION', ''),
(195, 'KIDNEY', ''),
(196, 'FIBROID', ''),
(197, 'LIVER/LUNG', ''),
(198, 'UTERUS, COLON? (DID COLOSTOMY)', ''),
(199, 'SPIL', ''),
(200, 'REL', ''),
(201, 'CERVICAL (NOT CONFIRMED)', ''),
(202, 'UTERUS', ''),
(203, 'EUMONIA?', ''),
(204, 'RECTUM', ''),
(205, 'NK', ''),
(206, 'OVARIAN', ''),
(207, 'PANCREATIC/LUNG', ''),
(208, 'N', ''),
(209, 'SARCOMA OF UTERUS', ''),
(210, 'WOMB (UTERINE?)', ''),
(211, 'LYMPH NODE', ''),
(212, 'SOPHARYNX', ''),
(213, 'BREAST & COLON', ''),
(214, 'LUNG/LEVER(EITHER ONE,NOT SURE)', ''),
(215, 'NOT SURE', ''),
(216, 'LUNGS', ''),
(217, 'BRAIN', ''),
(218, 'EAR', ''),
(219, 'UTERUS/CERVICAL', ''),
(220, 'NOSE (NPC)', ''),
(221, 'CIRRHOSIS OF THE LIVER', ''),
(222, 'LEUKEMIA', ''),
(223, 'THROAT', ''),
(224, 'LIVER (HEAVY DRINKER)', ''),
(225, 'STOMACH/WOMB', ''),
(226, 'COLON: STAGE 2 (APRIL 2013 OPERATION TO REMOVE TUMOUR IN COLON)', ''),
(227, 'OVARY AND UTERUS', ''),
(228, 'STOMACH AND OVARIAN', ''),
(229, 'SOPHARNYX/LARYNGEAL', ''),
(230, 'LYMPHATIC', ''),
(231, 'NPC? ORAL?', ''),
(232, 'CHIC', ''),
(233, 'LUNG? WATER IN LUNGS', ''),
(234, 'NPC', ''),
(235, 'OVARIAN?', ''),
(236, 'GASTRIC (STOMACH?)', ''),
(237, 'RECTAL', ''),
(238, 'HODGKIN LYMPHOMA; BREAST', ''),
(239, 'UNSURE', ''),
(240, 'NON-HODGEKINS LYMPHOMA', ''),
(241, 'SOMEWHERE AROUND KIDNEY?', ''),
(242, 'NPC, LIVER', ''),
(243, 'GLANDULAR', ''),
(244, 'THYROID; BREAST CANCER', ''),
(245, 'LUNG CARCINOMA', ''),
(246, 'MUSCLES', ''),
(247, 'UTERUS?', ''),
(248, 'LUNG (HEAVY SMOKER)', ''),
(249, 'BREAST CANCER', ''),
(250, 'CERVICAL CANCER', ''),
(251, 'BASAL CELL CARCINOMA', ''),
(252, 'COLON, LATER LIVER', ''),
(253, 'REPRODUCTIVE? BREAST? - METASTASIS', ''),
(254, 'WOMB (ENDOMETRIAL AND UTERINE?)', ''),
(255, 'BLADDER', ''),
(256, 'LIVER (HEP-B CARRIER)', ''),
(257, 'BREAST AND LUNG', ''),
(258, 'SOPHARYNGEAL', ''),
(259, 'ABDOMEN', ''),
(260, 'NHL', ''),
(261, 'PPC', ''),
(262, 'NOSE/LUNG', ''),
(263, 'PHARYNX', ''),
(264, 'DUCTAL CARCINOMA IN SITU (DCIS)', ''),
(265, 'CHEEKBONE', ''),
(266, 'COLORECTAL', ''),
(267, 'ENDOMESIS?', ''),
(268, 'GROWTH ON NECK', ''),
(269, 'SKIN CARCINOMA', ''),
(270, 'NOSE (TIMBER MEREHANT)', ''),
(271, 'BRAIN TUMOUR - BENIGN', ''),
(272, 'GROIN', ''),
(273, 'VAGIL', ''),
(274, 'PROSTATE', ''),
(275, 'LIVER (ALCOHOLIC)', ''),
(276, 'BREAST AND COLON', ''),
(277, 'BILE DUCT', ''),
(278, 'BREAST STAGE 0 (DCIS)', ''),
(279, 'LIVER CARCINOMA', ''),
(280, 'STOMACH CANCER', ''),
(281, 'COLON, LIVER', ''),
(282, 'BONE', ''),
(283, 'LIVER CHIRRHOSIS', ''),
(284, 'THYROID', ''),
(285, 'SKIN', ''),
(286, 'SEPTICEMIA', ''),
(287, 'NECK REGION?', ''),
(288, 'NOSE', ''),
(289, 'MULTIPLE MYELOMA', ''),
(290, 'STROKE', ''),
(291, 'BREAST; LEUKEMIA', ''),
(292, 'GALLBLADDER?', ''),
(293, 'BREAST, OVARIAN AND RECTUM', ''),
(294, 'LIVER?', ''),
(295, 'NECK', ''),
(296, 'INTESTINE?', ''),
(297, 'COLON?', ''),
(298, 'ORAL (GUM REGION)', ''),
(299, 'LYMPHOMA', ''),
(300, 'ORAL?', ''),
(301, 'COLON', ''),
(302, 'HEPATITIS B', ''),
(303, 'CERVICAL/OVARIAN?', ''),
(304, 'NON-HODKINS LYMPHOMA', ''),
(305, 'STOMACH/COLON', ''),
(306, 'COLORESTAL', ''),
(307, 'NPC?', ''),
(308, 'COLON CANCER 2ND DEGREE TO LIVER', ''),
(309, 'UTERAS', ''),
(310, 'REPRODUCTIVE?', ''),
(311, 'COLON? INTESTIL? (CHECK)', ''),
(312, 'BRAIN TUMOUR', ''),
(313, 'CR', ''),
(314, 'ESOPHAGUS', ''),
(315, 'OVARY?, UTERUS?, CERVIX?', ''),
(316, 'NON-HODGKIN LYMPHOMA', ''),
(317, 'LYMPH NODES NEAR EARS', ''),
(318, 'WOMB', ''),
(319, 'LIVER CANCER', ''),
(320, 'MASS ON THIGH', ''),
(321, 'GALLBLADDER', ''),
(322, 'BLOOD CANCER', ''),
(323, 'DUODENUM', ''),
(324, 'BONE?', ''),
(325, 'PANCREASE', ''),
(326, 'LIVER', ''),
(327, 'UTERUS FIBRO', ''),
(328, 'NON-HODGKIN LUMPHOMA STAGE 1', ''),
(329, 'UTERIAN METS BREAST', ''),
(330, 'INTESTINE', ''),
(331, 'GROIN SARCOMA', ''),
(332, 'AT FIRST COLON THEN HEALED COMPLETELY AFTER OP LATER LIVER CANCER', ''),
(333, 'BREAST; LUNG', ''),
(334, 'TYROID', ''),
(335, 'LYMPHATIC NODES', ''),
(336, 'UTERINE', ''),
(337, 'STOMACH', ''),
(339, 'ASCENDING COLON', ''),
(340, 'HODGKIN''S DISEASE, SKIN CANCER', ''),
(341, 'ORAL (TOUGUE)', ''),
(342, 'INTESTIL OR STOMACH? NOT SURE', ''),
(343, 'REPRODUCTIVE', ''),
(344, 'NK (MOLE ON NOSE BECAME CANCER)', ''),
(345, 'COLON CANCER', ''),
(346, 'CERVICAL', ''),
(348, 'PANCREATIC', ''),
(349, 'TONGUE CANCER', ''),
(350, 'LYMPH NODES', ''),
(351, 'THYROID?', ''),
(352, 'UTERINE/OVARIAN?', ''),
(353, 'SUSPECTED LUNG CANCER ON THE DAY SHE WENT INTO COMA ON 14/12/2010', ''),
(354, 'NOT SURE (CHECK)', ''),
(355, 'GASTRO', ''),
(356, 'CHEEK', ''),
(357, 'COLON CA. METS TO LIVER', ''),
(358, 'GYECOLOGICAL CANCER (OVARIAN?)', ''),
(359, 'LUNG?', ''),
(360, 'CANCER UPPER PALATE', ''),
(361, 'MOUTH', ''),
(362, 'LEUKEMIA? (BLOOD RELATED)', ''),
(363, 'CERVIX', ''),
(364, 'STOMACHE', ''),
(365, 'GALL BLADDER', ''),
(366, 'BREAST?', ''),
(367, 'COLON CANCER (COMPLETED TREATMENT)', ''),
(368, 'URIRY BLADDER', ''),
(369, 'ORAL', ''),
(370, 'LUNG', ''),
(371, 'BONE (THIGH)', ''),
(372, 'LOWER PART OF GALLBLADDER', ''),
(373, 'SPIL?', ''),
(374, 'STOMACH/REPRODUCTIVE?', ''),
(375, 'BA', ''),
(376, 'NOT SURE (ADVANCE STAGE)', ''),
(377, 'ENT (NPC)', ''),
(378, 'INTESTIL', ''),
(379, 'STOMACH (PRIMARY?), METS TO COLON, LIVER, ESOPHAGUS', ''),
(380, 'AC. BONE MARROW', ''),
(381, 'HEPATOMA', ''),
(382, 'LARYNGEAL', ''),
(383, 'AML', ''),
(384, 'LUNG (WAS A SMOKER)', ''),
(385, 'NECK AND SHOULDER', ''),
(386, 'BREAST (UNCERTAIN)', ''),
(387, 'PANCREAS', ''),
(388, 'LUMPHOMA', ''),
(389, 'VIRGI', ''),
(390, 'PROSTATE (CANOMA IN SITU)', ''),
(391, 'SARCOMA OF THE BREAST', ''),
(392, 'SAL (NPC)', ''),
(393, 'NA', ''),
(394, 'COLON & NON HODGKINS LYMPHOMA OF THE BLOOD', ''),
(395, 'LIVER/STOMACH? (HEP-B CARRIER)', ''),
(396, 'BRAIN,NOSE,THROAT', ''),
(397, 'DCIS (REMOVED)', ''),
(398, 'BREAST, BREAST', ''),
(399, 'LUMP ON BACK', ''),
(400, 'BLOOD/BRAIN', ''),
(401, 'ESOPHAGUS, STOMACH AND COLON', ''),
(402, 'LUNG, LIVER', ''),
(403, 'STOMACH?', ''),
(404, 'BREAST AND LIVER', ''),
(405, 'TONSILS', ''),
(406, 'ESOPHAGEAL', ''),
(407, 'BLOOD', ''),
(408, 'UNKNOWN', ''),
(409, 'JAW (BEETLE LEAF EATER)', ''),
(410, 'TRACHEA', ''),
(411, 'ENDOMETRIAL LINING CANCER', ''),
(412, 'BONE (HIP REGION)', ''),
(413, 'CERVICAL (HPV) *NOT SURE', ''),
(414, 'MOUTH/THROAT?', ''),
(415, 'NECK AREA', ''),
(416, 'None', ''),
(417, '999', ''),
(418, 'PANCREATIC CANCER', ''),
(419, 'LIVER/PANCREATIC CANCER', ''),
(420, 'GASTRIC CANCER', ''),
(421, 'ORAL CANCER', ''),
(422, 'PROSTATE CANCER', ''),
(423, 'BREAST AND OVARIAN CANCER', ''),
(424, 'LIVER CANCER?', ''),
(425, 'UTERINE CANCER', ''),
(426, 'NOS', ''),
(427, 'OVARY, UTERINE CANCER?', ''),
(428, 'LEG CANCER?', ''),
(429, 'MOUTH CANCER', ''),
(430, 'CIRRHOSIS LIVER', ''),
(431, 'SPINE CANCER', ''),
(432, 'RECTUM CANCER', ''),
(433, 'ESOPHAGUS CANCER', ''),
(434, 'BRAIN CANCER', ''),
(435, 'BONE CANCER', ''),
(436, 'PAROTID CANCER', ''),
(437, 'CRC', ''),
(438, 'NECK CANCER', ''),
(439, 'THROAT CANCER', ''),
(440, 'OVARIAN CANCER', ''),
(441, 'THYROID CANCER', ''),
(442, 'OVARY, UTERINE AND CERVICAL CANCER', ''),
(443, 'ADENOMA CA?', ''),
(444, 'NON-OVARIAN', ''),
(445, 'ENDOMETRIOSIS', ''),
(446, 'FALLOPIAN TUBE', ''),
(447, 'CLL', ''),
(448, 'GANGRENE', ''),
(449, 'BENIGN NODULES AT THYROID GLAND', ''),
(450, 'OVARIAN CYST AT RIGHT OVARY', ''),
(451, 'LYMPH (LUNG)', ''),
(452, 'BREAST (LEFT)', ''),
(453, 'BLOOD CANCER (UNSURE OF TYPE)', ''),
(454, 'URINARY', ''),
(455, 'BREAST (UNDERGONE MASTECTOMY), LUNG (PRIMARY)', ''),
(456, 'UNSURE (CANCER OF ARMPIT)', ''),
(457, 'HODGKIN''S LYMPHOMA', ''),
(458, 'OVARIAN AND BREAST', ''),
(459, 'COLON BLEEDING', ''),
(460, 'BREAST AND CERVICAL', ''),
(461, 'BREAST, UTERUS & LIVER CANCERS', ''),
(462, 'CA?', ''),
(463, 'BREAST (DCIS)', ''),
(464, 'CA LUNG', ''),
(465, 'NASOPHARYNGEAL?', ''),
(466, 'NOSE PHARYNX', ''),
(467, 'VOCAL CHORD', ''),
(468, 'BENIGN OVARY CYST', ''),
(469, 'STOMACH, BREAST', ''),
(470, 'NASOPHARNYX', ''),
(471, 'NASOPHARYNGEAL', ''),
(472, 'BRAIN?', ''),
(473, 'UNKNOWN PRIMARY', ''),
(474, 'UNSURE (OVARY OR COLON)', ''),
(475, 'BREAST/UTERUS?', ''),
(476, 'BREAST - LEFT', ''),
(477, 'DIED OF INFECTION', ''),
(478, 'CANNOT REMEMBER', ''),
(479, 'LUMP IN BREAST', ''),
(480, 'CA BREAST', ''),
(481, 'CA UTERUS', ''),
(482, 'LIVER, LUNG', ''),
(483, 'MYLOMA', ''),
(484, 'NASOPHARYNX', ''),
(485, 'BILATERAL BREAST CANCER', ''),
(486, 'SPLEEN', ''),
(487, 'GANGRENE', ''),
(488, 'BREAST (UNDERGONE MASTECTOMY), LUNG (PRIMARY)', ''),
(489, 'DIED OF INFECTION', ''),
(490, 'LUMP IN BREAST', ''),
(491, 'UNSURE (OVARY OR COLON)', ''),
(492, 'BREAST, UTERUS & LIVER CANCERS', ''),
(493, 'CA UTERUS', ''),
(494, 'BREAST (DCIS)', ''),
(495, 'BLOOD CANCER (UNSURE OF TYPE)', ''),
(496, 'BILATERAL BREAST CANCER', ''),
(497, 'NASAL', ''),
(498, 'URINARY BLADDER', ''),
(499, 'VAGINAL', ''),
(500, 'SPINAL', ''),
(501, 'COLON? INTESTINAL? (CHECK)', ''),
(502, 'NASOPHARYNGEAL', ''),
(503, 'VIRGINA', ''),
(504, 'INTESTINAL OR STOMACH? NOT SURE', ''),
(505, 'GYNAECOLOGICAL CANCER (OVARIAN?)', ''),
(506, 'GYNAECOLOGIC', ''),
(507, 'RENAL', ''),
(508, 'NASAL (NPC)', ''),
(509, 'INTESTINAL', ''),
(510, 'NASOPHARNYX/LARYNGEAL', ''),
(511, 'SPINAL?', ''),
(512, 'NASOPHARYNX', ''),
(513, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `cancer_site`
--

CREATE TABLE IF NOT EXISTS `cancer_site` (
  `cancer_site_id` int(10) NOT NULL AUTO_INCREMENT,
  `cancer_site_name` text NOT NULL,
  PRIMARY KEY (`cancer_site_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `cancer_site`
--

INSERT INTO `cancer_site` (`cancer_site_id`, `cancer_site_name`) VALUES
(0, ''),
(1, 'Left Breast'),
(2, 'Right Breast'),
(3, 'Left Ovary'),
(4, 'Right Ovary'),
(5, 'Bilateral'),
(6, 'None'),
(7, 'Left (fallopian tube)'),
(8, 'Bilateral (fallopian tube)'),
(9, 'Right (fallopian tube)');

-- --------------------------------------------------------

--
-- Table structure for table `diagnosis`
--

CREATE TABLE IF NOT EXISTS `diagnosis` (
  `diagnosis_id` int(10) NOT NULL AUTO_INCREMENT,
  `diagnosis_name` text NOT NULL,
  `diagnosis_details` longtext NOT NULL,
  PRIMARY KEY (`diagnosis_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `diagnosis`
--

INSERT INTO `diagnosis` (`diagnosis_id`, `diagnosis_name`, `diagnosis_details`) VALUES
(0, '', ''),
(1, 'Diabetes', ''),
(2, 'Hypertension', ''),
(3, 'Thyroid', ''),
(4, 'Cardiovaskular Disease', ''),
(5, 'Endochrine', ''),
(6, 'Congenital', ''),
(7, 'Mental Disorder', ''),
(8, 'None', '');

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

-- --------------------------------------------------------

--
-- Table structure for table `non_cancerous_site`
--

CREATE TABLE IF NOT EXISTS `non_cancerous_site` (
  `non_cancerous_site_id` int(10) NOT NULL AUTO_INCREMENT,
  `non_cancerous_site_name` text NOT NULL,
  PRIMARY KEY (`non_cancerous_site_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `non_cancerous_site`
--

INSERT INTO `non_cancerous_site` (`non_cancerous_site_id`, `non_cancerous_site_name`) VALUES
(0, ''),
(1, 'Left breast'),
(2, 'Right breast'),
(3, 'Left Ovary'),
(4, 'Right Ovary'),
(5, 'Uterus'),
(6, 'None');

-- --------------------------------------------------------

--
-- Table structure for table `ovarian_screening_type`
--

CREATE TABLE IF NOT EXISTS `ovarian_screening_type` (
  `ovarian_screening_type_id` int(10) NOT NULL AUTO_INCREMENT,
  `ovarian_screening_type_name` text NOT NULL,
  PRIMARY KEY (`ovarian_screening_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `ovarian_screening_type`
--

INSERT INTO `ovarian_screening_type` (`ovarian_screening_type_id`, `ovarian_screening_type_name`) VALUES
(0, ''),
(1, 'Physical Examinations'),
(2, 'Abdominal ultrasound'),
(3, 'Trans-vaginal Ultrasound'),
(4, 'CA125 blood test'),
(5, 'Biopsy'),
(6, 'None'),
(7, 'Peritoneal fluid cytology');

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
  `old_ic_no` varchar(15) NOT NULL,
  `family_no` varchar(50) NOT NULL,
  `gender` char(50) NOT NULL,
  `ethnicity` char(50) NOT NULL,
  `blood_group` char(50) NOT NULL,
  `comment` char(200) NOT NULL,
  `d_o_b` varchar(30) NOT NULL,
  `d_o_d` varchar(30) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `patient_breast_screening`
--

CREATE TABLE IF NOT EXISTS `patient_breast_screening` (
  `patient_breast_screening_id` int(10) NOT NULL AUTO_INCREMENT,
  `patient_ic_no` bigint(18) NOT NULL,
  `patient_studies_id` int(10) NOT NULL,
  `date_of_first_mammogram` date NOT NULL,
  `age_of_first_mammogram` varchar(50) NOT NULL,
  `age_of_recent_mammogram` int(3) NOT NULL,
  `date_of_recent_mammogram` date NOT NULL,
  `screening_centre` varchar(200) NOT NULL,
  `total_no_of_mammogram` varchar(50) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `date_of_diagnosis` varchar(30) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `patient_cancer_treatment`
--

CREATE TABLE IF NOT EXISTS `patient_cancer_treatment` (
  `patient_cancer_treatment_id` int(10) NOT NULL AUTO_INCREMENT,
  `treatment_id` int(10) NOT NULL,
  `patient_cancer_id` int(10) NOT NULL,
  `treatment_start_date` varchar(30) NOT NULL,
  `treatment_end_date` varchar(30) NOT NULL,
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
  `treatment_primary_outcome` varchar(100) DEFAULT NULL,
  `treatment_cal125_pretreatment` varchar(100) DEFAULT NULL,
  `treatment_cal125_posttreatment` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`patient_cancer_treatment_id`),
  KEY `fk_patient_cancer_treatment_patient_cancer_id` (`patient_cancer_id`),
  KEY `fk_patient_cancer_treatment_treatment_id` (`treatment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `contraceptive_start_date` varchar(50) NOT NULL,
  `contraceptive_end_date` varchar(50) NOT NULL,
  `contraceptive_duration` varchar(50) NOT NULL,
  `hrt_flag` tinyint(1) NOT NULL,
  `currently_using_hrt_flag` tinyint(1) NOT NULL,
  `hrt_start_date` date NOT NULL,
  `hrt_end_date` date NOT NULL,
  `hrt_duration` varchar(50) NOT NULL,
  `hrt_details` text NOT NULL,
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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

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

-- --------------------------------------------------------

--
-- Table structure for table `patient_lifestyle_factors`
--

CREATE TABLE IF NOT EXISTS `patient_lifestyle_factors` (
  `patient_lifestyle_factors_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_studies_id` int(10) NOT NULL,
  `questionnaire_date` varchar(30) NOT NULL,
  `self_image_at_7years` int(5) NOT NULL,
  `self_image_at_18years` int(5) NOT NULL,
  `self_image_now` int(5) NOT NULL,
  `pa_strenuous_activity_childhood` text,
  `pa_moderate_exercise_childhood` text,
  `pa_gentle_exercise_childhood` text,
  `pa_strenuous_activity_now` text,
  `pa_moderate_exercise_now` text,
  `pa_gentle_exercise_now` text,
  `pa_strenuous_activity_adult` text,
  `pa_moderate_exercise_adult` text,
  `pa_gentle_exercise_adult` text,
  `cigarrets_smoked_flag` tinyint(1) NOT NULL,
  `cigarrets_still_smoked_flag` tinyint(1) NOT NULL,
  `total_smoked_years` int(5) NOT NULL,
  `cigarrets_count_at_teen` int(10) NOT NULL,
  `cigarrets_count_at_twenties` varchar(50) NOT NULL,
  `cigarrets_count_at_thirties` varchar(50) NOT NULL,
  `cigarrets_count_at_fourrties` varchar(50) NOT NULL,
  `cigarrets_count_at_fifties` varchar(50) NOT NULL,
  `cigarrets_count_at_sixties_and_above` varchar(50) NOT NULL,
  `cigarrets_count_one_year_before_diagnosed` varchar(50) NOT NULL,
  `alcohol_drunk_flag` tinyint(1) NOT NULL,
  `alcohol_frequency` varchar(50) NOT NULL,
  `alcohol_comments` longtext NOT NULL,
  `coffee_drunk_flag` tinyint(1) NOT NULL,
  `coffee_age` int(5) NOT NULL,
  `coffee_frequency` varchar(50) NOT NULL,
  `tea_drunk_flag` tinyint(1) NOT NULL,
  `tea_age` int(5) NOT NULL,
  `tea_type` text NOT NULL,
  `tea_frequency` varchar(50) NOT NULL,
  `soya_bean_drunk_flag` tinyint(1) NOT NULL,
  `soya_bean_frequency` varchar(50) NOT NULL,
  `soya_products_flag` tinyint(1) NOT NULL,
  `soya_products_average` varchar(50) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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

-- --------------------------------------------------------

--
-- Table structure for table `patient_menstruation`
--

CREATE TABLE IF NOT EXISTS `patient_menstruation` (
  `patient_menstruation_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_studies_id` int(10) NOT NULL,
  `age_period_starts` int(11) NOT NULL,
  `still_period_flag` tinyint(1) NOT NULL,
  `period_type` text NOT NULL,
  `period_cycle_days` text NOT NULL,
  `period_cycle_days_other_details` longtext NOT NULL,
  `age_at_menopause` int(11) NOT NULL,
  `reason_period_stops` longtext NOT NULL,
  `date_period_stops` varchar(50) NOT NULL,
  `reason_period_stops_other_details` longtext NOT NULL,
  `created_on` date NOT NULL,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(50) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`patient_menstruation_id`),
  KEY `fk_patient_menstruation_patient_studies_id` (`patient_studies_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `patient_pathology`
--

CREATE TABLE IF NOT EXISTS `patient_pathology` (
  `patient_pathology_id` int(10) NOT NULL AUTO_INCREMENT,
  `cancer_id` int(10) NOT NULL,
  `tissue_site` text NOT NULL,
  `type_of_report` text NOT NULL,
  `date_of_report` varchar(30) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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

-- --------------------------------------------------------

--
-- Table structure for table `patient_private_no`
--

CREATE TABLE IF NOT EXISTS `patient_private_no` (
  `patient_private_no_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_ic_no` bigint(18) NOT NULL,
  `patient_studies_id` varchar(30) NOT NULL,
  `private_no` char(50) NOT NULL,
  `created_on` date NOT NULL,
  `modified_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` varchar(50) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `deleted_on` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`patient_private_no_id`),
  KEY `fk_patient_private_no_patient_ic_no` (`patient_ic_no`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `d_o_b` varchar(50) NOT NULL,
  `is_alive_flag` tinyint(1) NOT NULL,
  `d_o_d` varchar(50) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `patient_surveillance`
--

CREATE TABLE IF NOT EXISTS `patient_surveillance` (
  `patient_surveillance_id` int(10) NOT NULL AUTO_INCREMENT,
  `patient_studies_id` int(10) NOT NULL,
  `recruitment_center` text NOT NULL,
  `type` text NOT NULL,
  `first_consultation_date` varchar(30) NOT NULL,
  `first_consultation_place` text NOT NULL,
  `surveillance_interval` text NOT NULL,
  `diagnosis` text NOT NULL,
  `due_date` varchar(30) NOT NULL,
  `reminder_sent_date` varchar(30) NOT NULL,
  `surveillance_done_date` varchar(50) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `relatives`
--

CREATE TABLE IF NOT EXISTS `relatives` (
  `relatives_id` int(10) NOT NULL AUTO_INCREMENT,
  `relatives_type` char(100) NOT NULL,
  PRIMARY KEY (`relatives_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=110 ;

--
-- Dumping data for table `relatives`
--

INSERT INTO `relatives` (`relatives_id`, `relatives_type`) VALUES
(0, ''),
(1, 'FATHER'),
(2, 'MOTHER'),
(3, 'BROTHER'),
(4, 'SISTER'),
(9, 'STEPBROTHER'),
(10, 'STEPSISTER'),
(11, 'SON'),
(12, 'DAUGHTER'),
(13, 'UNCLE'),
(14, 'AUNT'),
(15, 'GRANDMOTHER'),
(16, 'GRANDFATHER'),
(17, 'COUSIN'),
(18, 'None'),
(19, 'GREAT GRANDMOTHER'),
(20, 'GRANDAUNT'),
(21, 'GRAND UNCLE'),
(22, 'HALF BROTHER'),
(23, 'GRANDDAUGHTER'),
(24, 'abc'),
(25, 'FIRST COUSIN (F)'),
(26, 'FIRST COUSIN'),
(27, 'NEPHEW'),
(28, 'COUSIN BROTHER'),
(29, 'GRANDFATHER (PROBAND)'),
(30, 'STEP NIECE'),
(31, 'HALF-SISTER (PROBAND)'),
(32, 'SECOND COUSIN'),
(33, 'HALF SISTER'),
(34, '3 UNCLES'),
(35, '2 COUSINS'),
(36, 'NIECE'),
(37, 'UNCLE (MOTHER''S COUSIN)'),
(38, 'HALF-UNCLE'),
(39, 'HALF SISTER (SAME FATHER)'),
(40, 'COUSIN (ADOPTED)'),
(41, 'STEPCOUSIN'),
(42, 'GRANDUNCLE'),
(43, 'FIRST STEP SISTER (X2)'),
(44, 'FIRST STEP SISTER'),
(45, 'GREAT GRANDMOTHER?'),
(46, 'STEP AUNT'),
(47, '2 UNCLES'),
(48, 'GRANDUNCLE'),
(49, 'AUNT?'),
(50, 'NK'),
(51, '3 UNCLES'),
(52, 'NIECE'),
(53, 'COUSIN SISTER'),
(54, 'ELDEST UNCLE'),
(55, 'FIRST COUSIN (F)'),
(56, 'SECOND COUSIN'),
(57, 'HALF SISTER'),
(58, 'STEPUNCLE'),
(59, 'COUSIN SISTER'),
(60, 'SECOND COUSIN'),
(61, 'COUSIN (M)'),
(62, 'FIRST COUSIN SISTER'),
(63, '2 COUSINS'),
(64, 'STEP-AUNT'),
(65, 'EMAK SAUDARA'),
(66, 'HALF AUNT'),
(67, 'GREAT GRANDMOTHER?'),
(68, 'STEP-UNCLE'),
(69, 'HALF SISTER'),
(70, 'GRANDUNCLE'),
(71, 'AUNTY'),
(72, 'AUNT, AUNT'),
(73, 'NEPHEW'),
(74, 'GRAND AUNT'),
(75, 'NIECE (HER FATHER COLON CA)'),
(76, '1ST COUSIN'),
(77, 'FIRST COUSIN''S DAUGHTER'),
(78, 'UNCLE (MOTHER''S COUSIN)'),
(79, 'STEPMOTHER (MOTHER''S COUSIN)'),
(80, 'GRANDUNCLE''S GRANDSON'),
(81, 'GRANDFATHER (GRANDMOTHER''S COUSIN)'),
(82, 'MOTHER''S COUSIN'),
(83, 'MOTHER''S HALF SISTER (DIFF MOTHER, SAME FATHER)'),
(84, 'GRANDMOTHER''S BROTHER'),
(85, 'NEPHEW (BROTHER''S SON)'),
(86, 'MOM''S FIRST COUSIN'),
(87, 'FATHER''S COUSIN'),
(88, 'COUSIN''S DAUGHTER'),
(89, 'None'),
(90, '*HUSBAND'),
(91, 'SECOND ELDEST AUNT'),
(92, '2ND UNCLE'),
(93, 'ELDEST AUNT'),
(94, 'COUSIN (UNCLE''S DAUGHTER)'),
(95, 'SECOND COUSIN SISTER'),
(96, 'SIBLING2'),
(97, '5TH UNCLE'),
(98, 'DAD''S BROTHER IN LAW'),
(99, 'FIRST AUNT'),
(100, 'SIBLING 2'),
(101, 'SIBLING 1'),
(102, 'HALF-BROTHER'),
(103, '1ST AUNT'),
(104, 'SIBLING1'),
(105, 'AUNTIE'),
(106, 'FATHER OF CHILD'),
(107, 'COUSIN''S AUNT'),
(108, 'GRANDAUNT, GRANDAUNT');

-- --------------------------------------------------------

--
-- Table structure for table `relative_degrees`
--

CREATE TABLE IF NOT EXISTS `relative_degrees` (
  `relative_degree_ID` int(10) NOT NULL AUTO_INCREMENT,
  `relative_degree_name` char(100) NOT NULL,
  PRIMARY KEY (`relative_degree_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `relative_degrees`
--

INSERT INTO `relative_degrees` (`relative_degree_ID`, `relative_degree_name`) VALUES
(0, ''),
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `studies`
--

INSERT INTO `studies` (`studies_id`, `studies_name`) VALUES
(1, 'UM MyBrCa'),
(2, 'EpBrCa'),
(3, 'MyOvCa'),
(4, 'Mammo'),
(5, 'MyMammo'),
(6, 'SD MyBrca'),
(7, 'My1000Mammo'),
(8, 'MyEpiBrCa Baseline'),
(9, 'MyEpiBrCa Follow up');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `treatment`
--

INSERT INTO `treatment` (`treatment_id`, `treatment_name`, `treatment_detail`) VALUES
(0, '', ''),
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
(13, 'Tubal ligation', ''),
(14, 'Unilateral Salpingo Oophorectomy', ''),
(15, 'Bilateral Salpingo Oophorectomy', ''),
(16, 'TAHBSO', ''),
(17, 'None', ''),
(18, 'surgery/chemotherapy/neo-adjuvant', ''),
(19, 'chemotherapy', ''),
(20, 'Surgery', ''),
(21, 'surgery/neo-adjuvant', ''),
(22, 'Neo-adjuvant', ''),
(23, 'surgery/chemotherapy', ''),
(24, 'surgery', ''),
(25, 'surgery/chemotherapy/radiotherapy', ''),
(26, 'chemotherapy/neo-adjuvant', '');

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
(1, '\0\0', 'administrator', '59beecdf7fc966e2f17fd8f65a4a9aeb09d4a3d4', '9462e8eee0', 'asyraf.abdrani@gmail.com', '', NULL, NULL, '9d029802e28cd9c768e8e62277c0df49ec65c48c', 1268889823, 1390371055, 1, 0, 0, 0, 'Admin', 'istrator', '0', NULL, NULL, NULL, NULL, 1, 1, 1, 0),
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
