-- =====================================================
-- Ganga Fernhill Phase - Costsheet Database
-- Import this file in phpMyAdmin (XAMPP) to create the
-- database and table required by the application.
-- =====================================================

CREATE DATABASE IF NOT EXISTS `costsheet_db`
  DEFAULT CHARACTER SET utf8mb4
  DEFAULT COLLATE utf8mb4_general_ci;

USE `costsheet_db`;

-- ---------------------------------------------------
-- Table structure for `costsheets`
-- ---------------------------------------------------
CREATE TABLE IF NOT EXISTS `costsheets` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `project_name` VARCHAR(150) NOT NULL DEFAULT 'GANGA FERNHILL PHASE',
  `project_location` VARCHAR(150) NOT NULL DEFAULT 'UNDRI',
  `customer_name` VARCHAR(150) NOT NULL,
  `mobile_number` VARCHAR(20) NOT NULL,
  `flat_no` VARCHAR(30) NOT NULL,
  `flat_type` VARCHAR(30) NOT NULL DEFAULT '1 BHK',
  `area` DECIMAL(10,2) NOT NULL DEFAULT 0,
  `rate` DECIMAL(10,2) NOT NULL DEFAULT 0,
  `carpet_area` DECIMAL(10,2) NOT NULL DEFAULT 0,
  `agr_cost` DECIMAL(12,2) NOT NULL DEFAULT 0,
  `mseb` DECIMAL(12,2) NOT NULL DEFAULT 0,
  `society_formation` DECIMAL(12,2) NOT NULL DEFAULT 0,
  `club_house_charges` DECIMAL(12,2) NOT NULL DEFAULT 0,
  `total_paid_to_developer` DECIMAL(12,2) NOT NULL DEFAULT 0,
  `stamp_duty` DECIMAL(12,2) NOT NULL DEFAULT 0,
  `maintenance` DECIMAL(12,2) NOT NULL DEFAULT 0,
  `registration` DECIMAL(12,2) NOT NULL DEFAULT 0,
  `gst` DECIMAL(12,2) NOT NULL DEFAULT 0,
  `total_cost` DECIMAL(12,2) NOT NULL DEFAULT 0,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- ---------------------------------------------------
-- Sample record matching the reference cost sheet image
-- ---------------------------------------------------
INSERT INTO `costsheets`
(`project_name`, `project_location`, `customer_name`, `mobile_number`, `flat_no`, `flat_type`,
 `area`, `rate`, `carpet_area`, `agr_cost`, `mseb`, `society_formation`, `club_house_charges`,
 `total_paid_to_developer`, `stamp_duty`, `maintenance`, `registration`, `gst`, `total_cost`)
VALUES
('GANGA FERNHILL PHASE', 'UNDRI', 'Xyz', '9856932145', '101', '1 BHK',
 635, 4230, 465.30, 2686050, 60000, 30000, 65000,
 2781050, 162000, 50000, 30000, 349926, 3372976);
