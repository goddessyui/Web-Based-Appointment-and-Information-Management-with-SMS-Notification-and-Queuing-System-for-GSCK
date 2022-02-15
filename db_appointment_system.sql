/*
SQLyog Ultimate v10.00 Beta1
MySQL - 8.0.28 : Database - db_appointment_system
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_appointment_system` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `db_appointment_system`;

/*Table structure for table `tbl_appointment` */

DROP TABLE IF EXISTS `tbl_appointment`;

CREATE TABLE `tbl_appointment` (
  `appointment_id` int NOT NULL AUTO_INCREMENT,
  `student_id` varchar(15) NOT NULL,
  `staff_appointment_id` int NOT NULL,
  `note` varchar(250) NOT NULL,
  PRIMARY KEY (`appointment_id`),
  KEY `student_id` (`student_id`),
  KEY `staff_appointment_id` (`staff_appointment_id`),
  CONSTRAINT `staff_appointment_id` FOREIGN KEY (`staff_appointment_id`) REFERENCES `tbl_staff_appointment` (`staff_appointment_id`),
  CONSTRAINT `student_id` FOREIGN KEY (`student_id`) REFERENCES `tbl_student_registry` (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Table structure for table `tbl_appointment_detail` */

DROP TABLE IF EXISTS `tbl_appointment_detail`;

CREATE TABLE `tbl_appointment_detail` (
  `appointment_detail_id` int NOT NULL AUTO_INCREMENT,
  `appointment_id` int NOT NULL,
  `date_created` date NOT NULL,
  `date_accepted` date NOT NULL,
  `appointment_date` date NOT NULL,
  `note` varchar(250) NOT NULL,
  PRIMARY KEY (`appointment_detail_id`),
  KEY `appointment_id` (`appointment_id`),
  CONSTRAINT `appointment_id` FOREIGN KEY (`appointment_id`) REFERENCES `tbl_appointment` (`appointment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Table structure for table `tbl_appointment_type` */

DROP TABLE IF EXISTS `tbl_appointment_type`;

CREATE TABLE `tbl_appointment_type` (
  `appointment_type_id` int NOT NULL AUTO_INCREMENT,
  `appointment_name` varchar(50) NOT NULL,
  `appointment_description` varchar(250) NOT NULL,
  PRIMARY KEY (`appointment_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Table structure for table `tbl_staff_appointment` */

DROP TABLE IF EXISTS `tbl_staff_appointment`;

CREATE TABLE `tbl_staff_appointment` (
  `staff_appointment_id` int NOT NULL AUTO_INCREMENT,
  `appointment_type_id` int NOT NULL,
  `staff_id` varchar(15) NOT NULL,
  PRIMARY KEY (`staff_appointment_id`),
  KEY `staff_id` (`staff_id`),
  KEY `appointment_type_id` (`appointment_type_id`),
  CONSTRAINT `appointment_type_id` FOREIGN KEY (`appointment_type_id`) REFERENCES `tbl_appointment_type` (`appointment_type_id`),
  CONSTRAINT `staff_id` FOREIGN KEY (`staff_id`) REFERENCES `tbl_staff_registry` (`staff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Table structure for table `tbl_staff_record` */

DROP TABLE IF EXISTS `tbl_staff_record`;

CREATE TABLE `tbl_staff_record` (
  `staff_id` varchar(20) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Table structure for table `tbl_staff_registry` */

DROP TABLE IF EXISTS `tbl_staff_registry`;

CREATE TABLE `tbl_staff_registry` (
  `staff_id` varchar(15) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `position` varchar(100) NOT NULL,
  `mobile_number` varchar(11) NOT NULL,
  PRIMARY KEY (`staff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Table structure for table `tbl_student_record` */

DROP TABLE IF EXISTS `tbl_student_record`;

CREATE TABLE `tbl_student_record` (
  `student_id` varchar(20) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*Table structure for table `tbl_student_registry` */

DROP TABLE IF EXISTS `tbl_student_registry`;

CREATE TABLE `tbl_student_registry` (
  `student_id` varchar(15) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `mobile_number` varchar(11) NOT NULL,
  `course` varchar(11) NOT NULL,
  `year` varchar(1) NOT NULL,
  PRIMARY KEY (`student_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
