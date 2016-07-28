-- Adminer 4.2.4 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `adams_questionaires`;
CREATE TABLE `adams_questionaires` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `libido_rate` varchar(31) COLLATE utf8_unicode_ci NOT NULL,
  `energy_rate` varchar(31) COLLATE utf8_unicode_ci NOT NULL,
  `strength_rate` varchar(31) COLLATE utf8_unicode_ci NOT NULL,
  `enjoy_rate` varchar(31) COLLATE utf8_unicode_ci NOT NULL,
  `happiness_rate` varchar(31) COLLATE utf8_unicode_ci NOT NULL,
  `erection_rate` varchar(31) COLLATE utf8_unicode_ci NOT NULL,
  `performance_rate` varchar(31) COLLATE utf8_unicode_ci NOT NULL,
  `sleep_rate` varchar(31) COLLATE utf8_unicode_ci NOT NULL,
  `sport_rate` varchar(31) COLLATE utf8_unicode_ci NOT NULL,
  `lost_height_rate` varchar(31) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `allergies_list`;
CREATE TABLE `allergies_list` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `allergic_medicine` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `appointments`;
CREATE TABLE `appointments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `relative_id` int(11) NOT NULL COMMENT 'Appointment Request Id',
  `apptTime` datetime NOT NULL,
  `appt_source` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1=>Active, 2=>Reschedule, 3=>Cancel, 4=>Confirm, 5=> Never Treat, 6=>Followup Later',
  `email_invitation` tinyint(4) NOT NULL,
  `createdBy` int(11) NOT NULL,
  `lastUpdatedBy` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `patient_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1=>Show, 2=>Send to Lab, 3=>Waiting for Report, 4=>Ready Lab Report',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `appointments` (`id`, `relative_id`, `apptTime`, `appt_source`, `request_id`, `status`, `email_invitation`, `createdBy`, `lastUpdatedBy`, `patient_id`, `doctor_id`, `comment`, `patient_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	0,	'2016-07-28 10:00:00',	2,	1,	4,	0,	1,	0,	3,	0,	'Appointment Schedule',	5,	'2016-07-28 14:50:49',	'2016-07-28 15:02:08',	'2016-07-28 15:02:08'),
(2,	0,	'2016-07-29 10:00:00',	3,	2,	2,	1,	1,	0,	4,	0,	'Appointment Schedule',	0,	'2016-07-28 14:52:31',	'2016-07-28 14:54:21',	NULL),
(3,	0,	'2016-07-31 10:00:00',	3,	2,	1,	1,	1,	0,	4,	0,	'Appointment Schedule',	0,	'2016-07-28 14:52:31',	'2016-07-28 14:54:21',	NULL)
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `relative_id` = VALUES(`relative_id`), `apptTime` = VALUES(`apptTime`), `appt_source` = VALUES(`appt_source`), `request_id` = VALUES(`request_id`), `status` = VALUES(`status`), `email_invitation` = VALUES(`email_invitation`), `createdBy` = VALUES(`createdBy`), `lastUpdatedBy` = VALUES(`lastUpdatedBy`), `patient_id` = VALUES(`patient_id`), `doctor_id` = VALUES(`doctor_id`), `comment` = VALUES(`comment`), `patient_status` = VALUES(`patient_status`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`), `deleted_at` = VALUES(`deleted_at`);

DROP TABLE IF EXISTS `appointment_followups`;
CREATE TABLE `appointment_followups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `appt_id` int(11) NOT NULL COMMENT 'If appt_type=1, appt_id = webleads id & if appt_type=2, appt_id = telemarketing call id',
  `reason_id` int(11) NOT NULL,
  `appt_type` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1=>Web_leads, 2=> Marketing calls',
  `comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `followup_date` datetime NOT NULL,
  `followup_status` tinyint(4) NOT NULL COMMENT '0=> Not Show , 1=>Show in Listing',
  `status` tinyint(4) NOT NULL COMMENT '1=>Set, 2=>No Set',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `appointment_reasons`;
CREATE TABLE `appointment_reasons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL COMMENT 'Appointment Request Id',
  `reason_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `appointment_reasons` (`id`, `patient_id`, `request_id`, `reason_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	3,	1,	11,	'2016-07-28 14:50:49',	'2016-07-28 15:02:08',	'2016-07-28 15:02:08'),
(2,	4,	2,	11,	'2016-07-28 14:52:25',	'2016-07-28 14:52:25',	NULL),
(3,	6,	3,	5,	'2016-07-28 16:10:27',	'2016-07-28 16:10:27',	NULL)
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `patient_id` = VALUES(`patient_id`), `request_id` = VALUES(`request_id`), `reason_id` = VALUES(`reason_id`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`), `deleted_at` = VALUES(`deleted_at`);

DROP TABLE IF EXISTS `appointment_requests`;
CREATE TABLE `appointment_requests` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `marketing_phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `call_time` varchar(31) COLLATE utf8_unicode_ci NOT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `appt_source` tinyint(4) NOT NULL DEFAULT '0' COMMENT '1=>Web_leads, 2=> Marketing calls, 3=> Walikins',
  `followup_date` date NOT NULL,
  `followup_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=> Not Show , 1=>Show in Listing',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL COMMENT '0=>Set, 1=>No Set',
  `noSetStatus` tinyint(4) NOT NULL COMMENT '0 => Next Appointment, 1 => End Appointment',
  PRIMARY KEY (`id`),
  KEY `appointment_requests_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `appointment_requests` (`id`, `user_id`, `marketing_phone`, `call_time`, `comment`, `created_by`, `appt_source`, `followup_date`, `followup_status`, `created_at`, `updated_at`, `deleted_at`, `status`, `noSetStatus`) VALUES
(1,	3,	'(945)-949-4594',	'',	'Appointment Schedule',	1,	2,	'0000-00-00',	0,	'2016-07-28 14:49:00',	'2016-07-28 15:02:08',	'2016-07-28 15:02:08',	0,	0),
(2,	4,	'',	'',	'Appointment Schedule',	1,	3,	'0000-00-00',	0,	'2016-07-28 14:51:00',	'2016-07-28 14:52:25',	NULL,	0,	0),
(3,	6,	'(848)-837-8438',	'',	'testing',	5,	2,	'0000-00-00',	0,	'2016-07-28 16:07:00',	'2016-07-28 16:10:27',	NULL,	1,	0)
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `user_id` = VALUES(`user_id`), `marketing_phone` = VALUES(`marketing_phone`), `call_time` = VALUES(`call_time`), `comment` = VALUES(`comment`), `created_by` = VALUES(`created_by`), `appt_source` = VALUES(`appt_source`), `followup_date` = VALUES(`followup_date`), `followup_status` = VALUES(`followup_status`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`), `deleted_at` = VALUES(`deleted_at`), `status` = VALUES(`status`), `noSetStatus` = VALUES(`noSetStatus`);

DROP TABLE IF EXISTS `appointment_sources`;
CREATE TABLE `appointment_sources` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(31) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `appointment_sources` (`id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	'Web Leads',	'Create Appointment by the Website contact us form',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(2,	'Tele-marketing Calls',	'Create the appointment from the phone calls for a clinic',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(3,	'Walkin Patient',	'Create the appointment for the patient whose come directly in the clinic',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL)
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `name` = VALUES(`name`), `description` = VALUES(`description`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`), `deleted_at` = VALUES(`deleted_at`);

DROP TABLE IF EXISTS `call_details`;
CREATE TABLE `call_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `source` varchar(31) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `carts`;
CREATE TABLE `carts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `category_type_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `patient_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `cart_items`;
CREATE TABLE `cart_items` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cart_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_sku` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `product_price` decimal(2,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `discount_price` decimal(2,2) NOT NULL,
  `total_price` decimal(2,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `duration_months` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `categories` (`id`, `cat_name`, `duration_months`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	'Himeros Male Enhancement Packages',	6,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(2,	'Trimix Therapy Package',	3,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(3,	'Vitamin Therapy Packeage',	5,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(4,	'Weight Loss Individual Pricing',	8,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(5,	'Testosterone Therapy Indivisual Pricing',	3,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(6,	'21 Days Challenge Diet',	1,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(7,	'HCG Diet',	3,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(8,	'Appetite Supperssant Diet',	8,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(9,	'Low Carb Protien Diet',	3,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(10,	'Testosterone Total Health Therapy',	12,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(11,	'HGH Low Level anti Aging Therapy',	3,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(12,	'Sublingual Troche Therapy Packages',	3,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL)
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `cat_name` = VALUES(`cat_name`), `duration_months` = VALUES(`duration_months`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`), `deleted_at` = VALUES(`deleted_at`);

DROP TABLE IF EXISTS `category_add_ons`;
CREATE TABLE `category_add_ons` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `add_on_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cost` varchar(31) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `category_add_ons` (`id`, `category_id`, `add_on_name`, `cost`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	1,	'add_on1',	'5000',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(2,	2,	'add_on2',	'8000',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(3,	3,	'add_on3',	'6000',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(4,	4,	'add_on4',	'9000',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(5,	5,	'add_on5',	'10000',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL)
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `category_id` = VALUES(`category_id`), `add_on_name` = VALUES(`add_on_name`), `cost` = VALUES(`cost`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`), `deleted_at` = VALUES(`deleted_at`);

DROP TABLE IF EXISTS `category_types`;
CREATE TABLE `category_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `category_types` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	'Bronze',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(2,	'Silver',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(3,	'Gold',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL)
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `name` = VALUES(`name`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`), `deleted_at` = VALUES(`deleted_at`);

DROP TABLE IF EXISTS `cosmetics`;
CREATE TABLE `cosmetics` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `facial_surgeries` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `facial_kind` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `face_wash` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `exposure` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `skin_look` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `look_score` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `happy_score` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `crowsfeet` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `facial_expression` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `sunken` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `bullfrog_looking` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `loose_skin` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `thin_lip` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `face_spot` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `acne` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `skin_tag` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `doctor_details`;
CREATE TABLE `doctor_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `dob` date DEFAULT NULL,
  `gender` enum('Male','Female') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Male',
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `address1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(31) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` int(11) NOT NULL,
  `zipCode` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(63) COLLATE utf8_unicode_ci DEFAULT NULL,
  `employer` varchar(63) COLLATE utf8_unicode_ci DEFAULT NULL,
  `specialization` varchar(63) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `doctor_details_user_id_unique` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `erectile_dysfunctions`;
CREATE TABLE `erectile_dysfunctions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `sex_status` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `sex_often` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `sex_with` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `pronography` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `prostate_removal` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `nerve_damage` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `erectile` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `implant` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `penis_pump` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `recreational` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `ejaculate` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `medicine_used` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `sickle` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `dwarfing` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `hiv` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `sex_medicine` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `medicine_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `medicine_work` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `last_used` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `still_work` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `side_effect` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `erection_time` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `erection_kind` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `erection_strength` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `activity_score` tinyint(4) DEFAULT NULL,
  `stimulation_score` tinyint(4) DEFAULT NULL,
  `intercourse_score` tinyint(4) DEFAULT NULL,
  `maintain_score` tinyint(4) DEFAULT NULL,
  `difficult_score` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `followups`;
CREATE TABLE `followups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `appt_id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `action` tinyint(4) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `followup_later_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `followups` (`id`, `appt_id`, `created_by`, `action`, `status`, `comment`, `followup_later_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	1,	1,	4,	0,	'',	'0000-00-00',	'2016-07-28 14:51:14',	'2016-07-28 15:02:08',	'2016-07-28 15:02:08'),
(2,	2,	1,	2,	0,	'Reschedule',	'0000-00-00',	'2016-07-28 14:54:21',	'2016-07-28 14:54:21',	NULL)
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `appt_id` = VALUES(`appt_id`), `created_by` = VALUES(`created_by`), `action` = VALUES(`action`), `status` = VALUES(`status`), `comment` = VALUES(`comment`), `followup_later_date` = VALUES(`followup_later_date`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`), `deleted_at` = VALUES(`deleted_at`);

DROP TABLE IF EXISTS `followup_reschedule`;
CREATE TABLE `followup_reschedule` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `old_appointment_id` int(11) NOT NULL COMMENT 'Appointment before the followup reshedule/later',
  `new_appointment_id` int(11) NOT NULL COMMENT 'Appointment After the followup reshedule/later',
  `followup_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `followup_reschedule` (`id`, `old_appointment_id`, `new_appointment_id`, `followup_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	2,	3,	2,	'2016-07-28 14:54:21',	'2016-07-28 14:54:21',	NULL)
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `old_appointment_id` = VALUES(`old_appointment_id`), `new_appointment_id` = VALUES(`new_appointment_id`), `followup_id` = VALUES(`followup_id`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`), `deleted_at` = VALUES(`deleted_at`);

DROP TABLE IF EXISTS `followup_status`;
CREATE TABLE `followup_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `followup_status` (`id`, `title`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2,	'Reschedule Appointment',	1,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(3,	'Cancel Appointment',	1,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(4,	'Confirmed Appointment',	1,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(5,	'Never Treat',	1,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(6,	'Follow-up Later',	1,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL)
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `title` = VALUES(`title`), `status` = VALUES(`status`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`), `deleted_at` = VALUES(`deleted_at`);

DROP TABLE IF EXISTS `high_testosterone`;
CREATE TABLE `high_testosterone` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `harmone_therapy` tinyint(4) DEFAULT NULL COMMENT '1=> Yes',
  `harmone_therapy_type` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `usa_military` tinyint(4) DEFAULT NULL COMMENT '1=> Yes',
  `lack_increment` tinyint(4) DEFAULT NULL COMMENT '1=> Yes',
  `increase_fat` tinyint(4) DEFAULT NULL COMMENT '1=> Yes',
  `depression` tinyint(4) DEFAULT NULL COMMENT '1=> Yes',
  `mood_increment` tinyint(4) DEFAULT NULL COMMENT '1=> Yes',
  `sleep_difficulty` tinyint(4) DEFAULT NULL COMMENT '1=> Yes',
  `wrinkle_increment` tinyint(4) DEFAULT NULL COMMENT '1=> Yes',
  `sagging_increment` tinyint(4) DEFAULT NULL COMMENT '1=> Yes',
  `hot_flash` tinyint(4) DEFAULT NULL COMMENT '1=> Yes',
  `loss_activity` tinyint(4) DEFAULT NULL COMMENT '1=> Yes',
  `stess_increment` tinyint(4) DEFAULT NULL COMMENT '1=> Yes',
  `loss_interest` tinyint(4) DEFAULT NULL COMMENT '1=> Yes',
  `loose_skin` tinyint(4) DEFAULT NULL COMMENT '1=> Yes',
  `exercise_ability` tinyint(4) DEFAULT NULL COMMENT '1=> Yes',
  `memory_decrement` tinyint(4) DEFAULT NULL COMMENT '1=> Yes',
  `loss_muscle` tinyint(4) DEFAULT NULL COMMENT '1=> Yes',
  `endurance` tinyint(4) DEFAULT NULL COMMENT '1=> Yes',
  `muscle_decrement` tinyint(4) DEFAULT NULL COMMENT '1=> Yes',
  `loss_hair` tinyint(4) DEFAULT NULL COMMENT '1=> Yes',
  `sense_decrement` tinyint(4) DEFAULT NULL COMMENT '1=> Yes',
  `testicle_decrement` tinyint(4) DEFAULT NULL COMMENT '1=> Yes',
  `shrinkage` tinyint(4) DEFAULT NULL COMMENT '1=> Yes',
  `osteoporosis` tinyint(4) DEFAULT NULL COMMENT '1=> Yes',
  `intolerance` tinyint(4) DEFAULT NULL COMMENT '1=> Yes',
  `unexplained_weight` tinyint(4) DEFAULT NULL COMMENT '1=> Yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `illness_list`;
CREATE TABLE `illness_list` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `illness` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `invoice`;
CREATE TABLE `invoice` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `invoice_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `invoice` (`id`, `order_id`, `invoice_number`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	1,	'Inv0001',	4,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(2,	2,	'Inv0002',	5,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(3,	3,	'Inv0003',	6,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(4,	4,	'Inv0004',	4,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(5,	5,	'Inv0005',	5,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL)
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `order_id` = VALUES(`order_id`), `invoice_number` = VALUES(`invoice_number`), `user_id` = VALUES(`user_id`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`), `deleted_at` = VALUES(`deleted_at`);

DROP TABLE IF EXISTS `lab_reports`;
CREATE TABLE `lab_reports` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `appointments_id` int(11) NOT NULL,
  `file` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Original name of file uploaded',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `marketing_details`;
CREATE TABLE `marketing_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `medical_histories`;
CREATE TABLE `medical_histories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `cardiovascular` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `hypertension` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `enocrine_disorder` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `prostate` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `lipid` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `cancer_form` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `smoke_status` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `smoke_often` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `smoke_quantity` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `drink_status` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `drink_often` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `drink_quantity` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `activity_level` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `exercise_status` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `exercise_often` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `deficiency_status` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `chemical_dependency` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `blood_disorder` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `orthopedic_disorder` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `known_deficiency` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `carpal_syndrome` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `immune_disorder` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `heart_disease` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `lung_disorder` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `cancer_status` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `surgeries` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `renal` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `upper` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `allergies` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `genital` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `retention` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `endocrine` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `hyperlipidema` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `healing` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `neurological` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `emotional` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `hypertention_hbp` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `other_illness` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `arthritis` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `recreational_drug` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `blood_test` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `health_insurance` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `kind_of_hi` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `medication` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `migrations` (`migration`, `batch`, `deleted_at`) VALUES
('2014_10_12_000000_create_users_table',	1,	NULL),
('2014_10_12_100000_create_password_resets_table',	1,	NULL),
('2016_03_29_213737_create_appointments_table',	1,	NULL),
('2016_03_29_213820_create_followups_table',	1,	NULL),
('2016_03_29_213928_create_sales_table',	1,	NULL),
('2016_04_25_173433_create_roles_table',	1,	NULL),
('2016_04_25_173957_create_permissions_table',	1,	NULL),
('2016_04_25_174125_create_permission_role_table',	1,	NULL),
('2016_04_25_174322_create_role_user_table',	1,	NULL),
('2016_05_09_105254_create_doctor_details',	1,	NULL),
('2016_05_09_105330_create_patient_details',	1,	NULL),
('2016_05_09_105411_create_user_details',	1,	NULL),
('2016_05_12_172110_create_states_table',	1,	NULL),
('2016_05_21_134326_create_products_table',	1,	NULL),
('2016_05_21_134344_create_categories_table',	1,	NULL),
('2016_05_21_134402_create_product_categories_table',	1,	NULL),
('2016_05_21_134428_create_category_types_table',	1,	NULL),
('2016_05_21_134446_create_category_add_ons_table',	1,	NULL),
('2016_05_25_123040_create_packages_table',	1,	NULL),
('2016_06_01_141837_create_call_details_table',	1,	NULL),
('2016_06_01_141905_create_marketing_details_table',	1,	NULL),
('2016_06_02_144652_create_appointment_followups_table',	1,	NULL),
('2016_06_02_171605_create_web_leads_table',	1,	NULL),
('2016_06_07_103313_create_telemarketing_calls_table',	1,	NULL),
('2016_06_09_135935_create_appointment_sources_table',	1,	NULL),
('2016_06_10_094726_create_appointment_requests_table',	1,	NULL),
('2016_06_20_162035_create_adams_questionaires_table',	1,	NULL),
('2016_06_20_170401_create_medical_histories_table',	1,	NULL),
('2016_06_20_214325_create_priapus_table',	1,	NULL),
('2016_06_20_215209_create_vitamins_table',	1,	NULL),
('2016_06_20_223256_create_weight_loss_table',	1,	NULL),
('2016_06_20_224730_create_cosmetics_table',	1,	NULL),
('2016_06_20_225447_create_erectile_dysfunctions_table',	1,	NULL),
('2016_06_20_231338_create_high_testosterone_table',	1,	NULL),
('2016_06_23_175151_create_followup_status_table',	1,	NULL),
('2016_06_28_164802_create_cart_items_table',	1,	NULL),
('2016_07_01_155002_create_appointment_reasons_table',	1,	NULL),
('2016_07_01_173223_create_reason_codes_table',	1,	NULL),
('2016_07_01_195149_create_invoice_table',	1,	NULL),
('2016_07_05_214210_create_allergies_list_table',	1,	NULL),
('2016_07_05_214233_create_illness_list_table',	1,	NULL),
('2016_07_05_214316_create_patient_vitamin_list_table',	1,	NULL),
('2016_07_05_214348_create_surgery_list_table',	1,	NULL),
('2016_07_05_231230_create_carts_table',	1,	NULL),
('2016_07_12_174624_create_patient_medication_list_table',	1,	NULL),
('2016_07_12_232736_add_units_of_measurement_column_to_products_table',	1,	NULL),
('2016_07_14_183100_remove_extra_coloums_from_appointment_request_table',	1,	NULL),
('2016_07_14_192139_remove_extra_coloums_from_appointment_table',	1,	NULL),
('2016_07_14_193725_change_coloum_status_in_appointment_request_table',	1,	NULL),
('2016_07_14_194545_adding_status_coloum_in_appointment_request_table',	1,	NULL),
('2016_07_15_172230_remove_disease_id_from_appointment_table',	1,	NULL),
('2016_07_15_172255_remove_reason_id_from_appointment_requesst_table',	1,	NULL),
('2016_07_18_212009_add_relative_id_coloumn_to_appointment_table',	1,	NULL),
('2016_07_19_160946_add_request_id_coloum_in_appointment_reason_table',	1,	NULL),
('2016_07_20_190911_create_lab_reports_table',	1,	NULL),
('2016_07_21_153315_add_patient_status_coloum_in_patient_detail_table',	1,	NULL),
('2016_07_21_165030_add_noSetStatus_column_to_appoitmentRequestTable',	1,	NULL),
('2016_07_21_191415_add_deleted_at_column_to_all_tables',	1,	NULL),
('2016_07_21_220705_add_order_id_column_invoice_table',	1,	NULL),
('2016_07_21_221613_create_orders_table',	1,	NULL),
('2016_07_21_221643_create_order_details_table',	1,	NULL),
('2016_07_21_221710_create_payments_table',	1,	NULL),
('2016_07_22_203226_add_patient_id_column_to_sales_and_carts_table',	1,	NULL),
('2016_07_26_184237_add_deleted_at_column_to_lab_reports_table',	1,	NULL),
('2016_07_28_161630_create_followup_reschedules_table',	1,	NULL)
ON DUPLICATE KEY UPDATE `migration` = VALUES(`migration`), `batch` = VALUES(`batch`), `deleted_at` = VALUES(`deleted_at`);

DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `agent_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `package_type` int(11) NOT NULL,
  `subtotal_amount` decimal(10,2) NOT NULL,
  `discount_amount` decimal(10,2) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `orders` (`id`, `user_id`, `agent_id`, `package_id`, `package_type`, `subtotal_amount`, `discount_amount`, `total_amount`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	4,	1,	1,	1,	500.00,	100.00,	400.00,	0,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(2,	5,	1,	1,	2,	1000.00,	85.00,	915.00,	0,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(3,	6,	1,	1,	1,	300.00,	30.00,	270.00,	0,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(4,	4,	1,	1,	1,	700.00,	20.00,	680.00,	0,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(5,	5,	1,	1,	2,	1500.00,	300.00,	1200.00,	0,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL)
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `user_id` = VALUES(`user_id`), `agent_id` = VALUES(`agent_id`), `package_id` = VALUES(`package_id`), `package_type` = VALUES(`package_type`), `subtotal_amount` = VALUES(`subtotal_amount`), `discount_amount` = VALUES(`discount_amount`), `total_amount` = VALUES(`total_amount`), `status` = VALUES(`status`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`), `deleted_at` = VALUES(`deleted_at`);

DROP TABLE IF EXISTS `order_details`;
CREATE TABLE `order_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_sku` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `save_amount` decimal(10,2) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `product_sku`, `quantity`, `unit_price`, `save_amount`, `total_amount`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	1,	1,	'pro1',	1,	300.00,	0.00,	300.00,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(2,	1,	2,	'pro2',	2,	60.00,	20.00,	100.00,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(3,	1,	3,	'pro3',	2,	50.00,	0.00,	100.00,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(4,	2,	1,	'pro1',	3,	300.00,	200.00,	700.00,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(5,	2,	2,	'pro2',	6,	60.00,	60.00,	300.00,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(6,	3,	1,	'pro1',	1,	300.00,	0.00,	300.00,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(7,	4,	4,	'pro4',	1,	700.00,	0.00,	700.00,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(8,	5,	1,	'pro1',	6,	300.00,	300.00,	1500.00,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL)
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `order_id` = VALUES(`order_id`), `product_id` = VALUES(`product_id`), `product_sku` = VALUES(`product_sku`), `quantity` = VALUES(`quantity`), `unit_price` = VALUES(`unit_price`), `save_amount` = VALUES(`save_amount`), `total_amount` = VALUES(`total_amount`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`), `deleted_at` = VALUES(`deleted_at`);

DROP TABLE IF EXISTS `packages`;
CREATE TABLE `packages` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_count` int(11) NOT NULL,
  `product_price` double NOT NULL,
  `category_type` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `patient_details`;
CREATE TABLE `patient_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `disease_id` int(11) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` enum('Male','Female') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Male',
  `marital_status` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `call_time` varchar(31) COLLATE utf8_unicode_ci NOT NULL,
  `driving_license` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(31) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` int(11) NOT NULL,
  `zipCode` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `height` varchar(31) COLLATE utf8_unicode_ci NOT NULL,
  `weight` varchar(31) COLLATE utf8_unicode_ci NOT NULL,
  `employment_place` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `primary_physician` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `physician_phone` varchar(31) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `employer` varchar(63) COLLATE utf8_unicode_ci DEFAULT NULL,
  `occupation` varchar(63) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_bill` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `never_treat_status` tinyint(1) NOT NULL DEFAULT '0',
  `form_status` tinyint(1) NOT NULL DEFAULT '0',
  `patient_status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=> New Patient, 1=> Current Patient',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `patient_details_user_id_unique` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `patient_details` (`id`, `user_id`, `disease_id`, `dob`, `gender`, `marital_status`, `phone`, `mobile`, `call_time`, `driving_license`, `address1`, `address2`, `city`, `state`, `zipCode`, `height`, `weight`, `employment_place`, `primary_physician`, `physician_phone`, `image`, `employer`, `occupation`, `payment_bill`, `hash`, `never_treat_status`, `form_status`, `patient_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(2,	3,	NULL,	'2016-07-28',	'Male',	'',	'',	'',	'',	'',	NULL,	NULL,	NULL,	0,	'',	'',	'',	'',	'',	'',	NULL,	NULL,	NULL,	NULL,	'edba3e0048a805950416c569957c17b7',	0,	0,	0,	'2016-07-28 14:50:49',	'2016-07-28 14:50:49',	NULL),
(3,	4,	NULL,	'2016-07-28',	'Male',	'',	'',	'',	'',	'',	NULL,	NULL,	NULL,	0,	'',	'',	'',	'',	'',	'',	NULL,	NULL,	NULL,	NULL,	'475a127d96c7074ea2eca4a139e0613b',	0,	0,	0,	'2016-07-28 14:52:25',	'2016-07-28 14:52:25',	NULL),
(4,	6,	NULL,	'1990-07-23',	'Male',	'',	'(858)-685-6856',	'',	'',	'',	NULL,	NULL,	NULL,	0,	'',	'',	'',	'',	'',	'',	NULL,	NULL,	NULL,	NULL,	'695b86bfa968321ddfb815cec6fa2d9a',	0,	0,	0,	'2016-07-28 16:10:27',	'2016-07-28 16:10:27',	NULL)
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `user_id` = VALUES(`user_id`), `disease_id` = VALUES(`disease_id`), `dob` = VALUES(`dob`), `gender` = VALUES(`gender`), `marital_status` = VALUES(`marital_status`), `phone` = VALUES(`phone`), `mobile` = VALUES(`mobile`), `call_time` = VALUES(`call_time`), `driving_license` = VALUES(`driving_license`), `address1` = VALUES(`address1`), `address2` = VALUES(`address2`), `city` = VALUES(`city`), `state` = VALUES(`state`), `zipCode` = VALUES(`zipCode`), `height` = VALUES(`height`), `weight` = VALUES(`weight`), `employment_place` = VALUES(`employment_place`), `primary_physician` = VALUES(`primary_physician`), `physician_phone` = VALUES(`physician_phone`), `image` = VALUES(`image`), `employer` = VALUES(`employer`), `occupation` = VALUES(`occupation`), `payment_bill` = VALUES(`payment_bill`), `hash` = VALUES(`hash`), `never_treat_status` = VALUES(`never_treat_status`), `form_status` = VALUES(`form_status`), `patient_status` = VALUES(`patient_status`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`), `deleted_at` = VALUES(`deleted_at`);

DROP TABLE IF EXISTS `patient_medication_list`;
CREATE TABLE `patient_medication_list` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dosage` tinyint(1) NOT NULL,
  `how_often` varchar(31) COLLATE utf8_unicode_ci NOT NULL,
  `taken_for` varchar(31) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `patient_vitamin_list`;
CREATE TABLE `patient_vitamin_list` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `dosage` tinyint(4) DEFAULT NULL,
  `how_often` varchar(31) COLLATE utf8_unicode_ci NOT NULL,
  `taken_for` varchar(31) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `payments`;
CREATE TABLE `payments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `payment_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `paid_amount` decimal(10,2) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission_title` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `permission_slug` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `permission_description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `permissions` (`id`, `permission_title`, `permission_slug`, `permission_description`, `parent_id`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	'Appointment Setting',	'appointment_setting',	'Permission for Appointment Setting module.',	0,	1,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(2,	'Read',	'appointment_setting_read',	'Read permission for Appointment Setting module.',	1,	1,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(3,	'Write',	'appointment_setting_write',	'Write permission for Appointment Setting module.',	1,	1,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(4,	'Front Office',	'pos',	'Permission for POS module.',	0,	1,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(5,	'Read',	'pos_read',	'Read permission for POS module.',	4,	1,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(6,	'Write',	'pos_write',	'Write permission for POS module.',	4,	1,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(7,	'ACL Management',	'acl_management',	'Permission for ACL Management module.',	0,	1,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(8,	'Read',	'acl_management_read',	'Read permission for ACL Management module.',	7,	1,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(9,	'Write',	'acl_management_write',	'Write permission for ACL Management module.',	7,	1,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(10,	'User Management',	'user_management',	'Permission for User Management module.',	0,	1,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(11,	'Read',	'user_management_read',	'Read permission for User Management module.',	10,	1,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(12,	'Write',	'user_management_write',	'Write permission for User Management module.',	10,	1,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(13,	'Product Categories',	'product_categories',	'Permission for Product Categories module.',	0,	1,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(14,	'Read',	'product_categories_read',	'Read permission for Product Categories module.',	13,	1,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(15,	'Write',	'product_categories_write',	'Write permission for Product Categories module.',	13,	1,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(16,	'Product Imports',	'product_imports',	'Permission for Product Imports module.',	0,	1,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(17,	'Read',	'product_imports_read',	'Read permission for Product Imports module.',	16,	1,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(18,	'Write',	'product_imports_write',	'Write permission for Product Imports module.',	16,	1,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(19,	'Accounting',	'accounting',	'Permission for Accounting module.',	0,	1,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(20,	'Read',	'accounting_read',	'Read permission for Accounting module.',	19,	1,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(21,	'Write',	'accounting_write',	'Write permission for Accounting module.',	19,	1,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(22,	'Finance',	'finance',	'Permission for Finance module.',	0,	1,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(23,	'Read',	'finance_read',	'Read permission for Finance module.',	22,	1,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(24,	'Write',	'finance_write',	'Write permission for Finance module.',	22,	1,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(25,	'Inventory Management',	'inventory_management',	'Permission for Inventory Management module.',	0,	1,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(26,	'Read',	'inventory_management_read',	'Read permission for Inventory Management module.',	22,	1,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(27,	'Write',	'inventory_management_write',	'Write permission for Inventory Management module.',	22,	1,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL)
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `permission_title` = VALUES(`permission_title`), `permission_slug` = VALUES(`permission_slug`), `permission_description` = VALUES(`permission_description`), `parent_id` = VALUES(`parent_id`), `status` = VALUES(`status`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`), `deleted_at` = VALUES(`deleted_at`);

DROP TABLE IF EXISTS `permission_role`;
CREATE TABLE `permission_role` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `priapus`;
CREATE TABLE `priapus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `abnormal` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `abnormal_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `priapus_goal` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prp_before` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `pump_past` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `implant_surgery` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `pre_activity_score` tinyint(4) DEFAULT NULL,
  `prp_stimulation_score` tinyint(4) DEFAULT NULL,
  `prp_intercourse_score` tinyint(4) DEFAULT NULL,
  `prp_maintain_score` tinyint(4) DEFAULT NULL,
  `prp_difficult_score` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `price` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `sku` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `unit_of_measurement` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `products_sku_unique` (`sku`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `product_categories`;
CREATE TABLE `product_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `product_count` int(11) NOT NULL,
  `product_price` double NOT NULL,
  `category_type_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `reason_codes`;
CREATE TABLE `reason_codes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `reason` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL COMMENT '1=>Set, 1=> No Set',
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `reason_codes` (`id`, `reason`, `type`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	'No Insurance',	2,	0,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(2,	'Talk to wife',	2,	0,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(3,	'Information Only',	2,	0,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(4,	'Cant Afford',	2,	0,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(5,	'Think about It',	2,	0,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(6,	'Wrong Number',	2,	0,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(7,	'Scheduling Issue',	2,	0,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(8,	'Advertising Call',	2,	0,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(9,	'Erectile Dysfunction / Premature Ejaculation',	1,	0,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(10,	'HGH Testosterone Therapy',	1,	0,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(11,	'Medical Weight Loss',	1,	0,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(12,	'IV Vitamin Therapy',	1,	0,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(13,	'PRP Priapus Male Enhancment',	1,	0,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(14,	'Mens Facial Cosmetics and Skincare',	1,	0,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL)
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `reason` = VALUES(`reason`), `type` = VALUES(`type`), `status` = VALUES(`status`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`), `deleted_at` = VALUES(`deleted_at`);

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_title` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `role_slug` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `roles` (`id`, `role_title`, `role_slug`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	'Administrators',	'administrator',	1,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(2,	'Admin',	'admin',	1,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(3,	'User',	'user',	1,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(4,	'Authors',	'authors',	1,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(5,	'Doctor',	'doctor',	1,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(6,	'Patient',	'patient',	1,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL)
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `role_title` = VALUES(`role_title`), `role_slug` = VALUES(`role_slug`), `status` = VALUES(`status`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`), `deleted_at` = VALUES(`deleted_at`);

DROP TABLE IF EXISTS `role_user`;
CREATE TABLE `role_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `sales`;
CREATE TABLE `sales` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `appt` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `description` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `cash` int(11) NOT NULL,
  `credit_cd` int(11) NOT NULL,
  `credit_cd2` int(11) NOT NULL,
  `credit_cd3` int(11) NOT NULL,
  `check` int(11) NOT NULL,
  `lab_follow_up` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `patient_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `states`;
CREATE TABLE `states` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(31) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(31) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `states` (`id`, `code`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	'AL',	'Alabama',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(2,	'AK',	'Alaska',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(3,	'AS',	'American Samoa',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(4,	'AZ',	'Arizona',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(5,	'AR',	'Arkansas',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(6,	'CA',	'California',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(7,	'CO',	'Colorado',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(8,	'CT',	'Connecticut',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(9,	'DE',	'Delaware',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(10,	'DC',	'District of Columbia',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(11,	'FM',	'Federated statess of Micronesia',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(12,	'FL',	'Florida',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(13,	'GA',	'Georgia',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(14,	'GU',	'Guam',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(15,	'HI',	'Hawaii',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(16,	'ID',	'Idaho',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(17,	'IL',	'Illinois',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(18,	'IN',	'Indiana',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(19,	'IA',	'Iowa',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(20,	'KS',	'Kansas',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(21,	'KY',	'Kentucky',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(22,	'LA',	'Louisiana',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(23,	'ME',	'Maine',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(24,	'MH',	'Marshall Islands',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(25,	'MD',	'Maryland',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(26,	'MA',	'Massachusetts',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(27,	'MI',	'Michigan',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(28,	'MN',	'Minnesota',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(29,	'MS',	'Mississippi',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(30,	'MO',	'Missouri',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(31,	'MT',	'Montana',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(32,	'NE',	'Nebraska',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(33,	'NV',	'Nevada',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(34,	'NH',	'New Hampshire',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(35,	'NJ',	'New Jersey',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(36,	'NM',	'New Mexico',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(37,	'NY',	'New York',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(38,	'NC',	'North Carolina',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(39,	'ND',	'North Dakota',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(40,	'MP',	'Northern Mariana Islands',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(41,	'OH',	'Ohio',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(42,	'OK',	'Oklahoma',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(43,	'OR',	'Oregon',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(44,	'PW',	'Palau',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(45,	'PA',	'Pennsylvania',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(46,	'PR',	'Puerto Rico',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(47,	'RI',	'Rhode Island',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(48,	'SC',	'South Carolina',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(49,	'SD',	'South Dakota',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(50,	'TN',	'Tennessee',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(51,	'TX',	'Texas',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(52,	'UT',	'Utah',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(53,	'VT',	'Vermont',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(54,	'VI',	'Virgin Islands',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(55,	'VA',	'Virginia',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(56,	'WA',	'Washington',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(57,	'WV',	'West Virginia',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(58,	'WI',	'Wisconsin',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(59,	'WY',	'Wyoming',	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL)
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `code` = VALUES(`code`), `name` = VALUES(`name`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`), `deleted_at` = VALUES(`deleted_at`);

DROP TABLE IF EXISTS `surgery_list`;
CREATE TABLE `surgery_list` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `type_of_surgery` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `reason` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `telemarketing_calls`;
CREATE TABLE `telemarketing_calls` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(31) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(31) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `requested_date` datetime NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0=>Pending, 1=>Set, 2=>No Set',
  `comment` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(31) COLLATE utf8_unicode_ci NOT NULL,
  `middle_name` varchar(31) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(31) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(63) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `role` int(11) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `users` (`id`, `first_name`, `middle_name`, `last_name`, `email`, `password`, `role`, `remember_token`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	'Vipul',	NULL,	'kumar',	'vipulk@chetu.com',	'$2y$10$28G8c8hsGfdibidZs6QPmegL52cv8p3.DeAOTQrOP7z6IkfHwqEya',	1,	NULL,	1,	'2016-07-28 14:38:16',	'2016-07-28 14:38:16',	NULL),
(3,	'Nivi',	NULL,	'',	'',	'',	6,	NULL,	1,	'2016-07-28 14:50:49',	'2016-07-28 14:50:49',	NULL),
(4,	'Raj',	NULL,	'',	'raj912@yopmail.com',	'',	6,	NULL,	1,	'2016-07-28 14:52:25',	'2016-07-28 14:52:25',	NULL),
(5,	'Niwedita',	NULL,	'jaysawal',	'niwedita@chetu.com',	'$2y$10$YEh6ISkEOMdN65FvDFG2XOkFQZ8V/USL90pZRmkETtGxUQVc.Adwa',	1,	NULL,	1,	'2016-07-28 16:06:32',	'2016-07-28 16:06:32',	NULL),
(6,	'amir',	NULL,	'',	'amirh@chetu.com',	'',	6,	NULL,	1,	'2016-07-28 16:10:27',	'2016-07-28 16:10:27',	NULL)
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `first_name` = VALUES(`first_name`), `middle_name` = VALUES(`middle_name`), `last_name` = VALUES(`last_name`), `email` = VALUES(`email`), `password` = VALUES(`password`), `role` = VALUES(`role`), `remember_token` = VALUES(`remember_token`), `status` = VALUES(`status`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`), `deleted_at` = VALUES(`deleted_at`);

DROP TABLE IF EXISTS `user_details`;
CREATE TABLE `user_details` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `dob` date DEFAULT NULL,
  `gender` enum('Male','Female') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Male',
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `address1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(31) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` int(11) NOT NULL,
  `zipCode` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_details_user_id_unique` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `user_details` (`id`, `user_id`, `dob`, `gender`, `phone`, `address1`, `address2`, `city`, `state`, `zipCode`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	1,	NULL,	'Male',	'',	NULL,	NULL,	NULL,	0,	'',	NULL,	'2016-07-28 14:38:16',	'2016-07-28 14:38:16',	NULL),
(2,	5,	NULL,	'Male',	'',	NULL,	NULL,	NULL,	0,	'',	NULL,	'2016-07-28 16:06:32',	'2016-07-28 16:06:32',	NULL)
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `user_id` = VALUES(`user_id`), `dob` = VALUES(`dob`), `gender` = VALUES(`gender`), `phone` = VALUES(`phone`), `address1` = VALUES(`address1`), `address2` = VALUES(`address2`), `city` = VALUES(`city`), `state` = VALUES(`state`), `zipCode` = VALUES(`zipCode`), `image` = VALUES(`image`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`), `deleted_at` = VALUES(`deleted_at`);

DROP TABLE IF EXISTS `vitamins`;
CREATE TABLE `vitamins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `needle_afraid` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `afraid_limit` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `injectable_type` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `total_wellness` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `weight_supplement` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `vitamin_knowledge` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `vitamin_taken` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `wellness_tested` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `vitamin_drip` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `web_leads`;
CREATE TABLE `web_leads` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(31) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(31) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `requested_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `call_time` varchar(31) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0=> Pending, 1=>Completed',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `web_leads` (`id`, `first_name`, `last_name`, `email`, `phone`, `location`, `requested_date`, `call_time`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1,	'suresh',	'kumar',	'sureshc@gmail.com',	'123445',	'2016-06-02 16:00:24',	'2016-06-02 10:30:24',	'11 am - 2 pm',	0,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(2,	'binaya',	'lenka',	'binayal@gmail.com',	'123445',	'2016-06-02 16:00:24',	'2016-06-02 10:30:24',	'9 am - 11 am',	0,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(3,	'Niwedita',	'Jaysawal',	'niweditaj@gmail.com',	'123445',	'2016-06-02 16:00:24',	'2016-06-02 10:30:24',	'11 am - 1pm',	0,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(4,	'Amir',	'Hnaga',	'amirh@gmail.com',	'123445',	'2016-06-02 16:00:24',	'2016-06-02 10:30:24',	'1 pm - 3 pm',	0,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL),
(5,	'Vipul',	'kumar',	'vipulk@gmail.com',	'123445',	'2016-06-02 16:00:24',	'2016-06-02 10:30:24',	'3 pm - 5 pm',	0,	'2016-07-28 14:37:21',	'2016-07-28 14:37:21',	NULL)
ON DUPLICATE KEY UPDATE `id` = VALUES(`id`), `first_name` = VALUES(`first_name`), `last_name` = VALUES(`last_name`), `email` = VALUES(`email`), `phone` = VALUES(`phone`), `location` = VALUES(`location`), `requested_date` = VALUES(`requested_date`), `call_time` = VALUES(`call_time`), `status` = VALUES(`status`), `created_at` = VALUES(`created_at`), `updated_at` = VALUES(`updated_at`), `deleted_at` = VALUES(`deleted_at`);

DROP TABLE IF EXISTS `weight_loss`;
CREATE TABLE `weight_loss` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `weight_surgeries` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `surgeries_kind` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `weight_supplement` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `supplement_type` varchar(63) COLLATE utf8_unicode_ci NOT NULL,
  `liver_disease` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `diabetes` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `thyroid_treated` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `hormone_treated` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `seizures` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `kidney_disorder` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `eating_disorder` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `frequently_eat` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `eat_more` tinyint(4) DEFAULT NULL COMMENT '0=>No, 1=> Yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- 2016-07-28 16:12:08
