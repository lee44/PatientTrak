-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 17, 2019 at 07:30 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `acupuncture`
--

-- --------------------------------------------------------

--
-- Table structure for table `charges`
--

CREATE TABLE IF NOT EXISTS `charges` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `charge_description` varchar(11) DEFAULT NULL,
  `total_charge` decimal(10,2) DEFAULT NULL,
  `charge` decimal(10,2) DEFAULT NULL,
  `subtotal` decimal(10,2) DEFAULT NULL,
  `co_pay` decimal(10,2) DEFAULT NULL,
  `tax` decimal(10,2) DEFAULT NULL,
  `charge_note` varchar(50) DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `charge_created_at` date DEFAULT NULL,
  `charge_id` varchar(13) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `charges`
--

INSERT INTO `charges` (`id`, `charge_description`, `total_charge`, `charge`, `subtotal`, `co_pay`, `tax`, `charge_note`, `customer_id`, `charge_created_at`, `charge_id`) VALUES
(1, 'Herb', '159.76', '27.42', '27.42', '15.64', '116.70', 'Testing Charge', 64, '2019-02-13', '5c651536ece24');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=52 ;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `title`, `start`, `end`, `description`) VALUES
(8, 'T', '2019-01-28 06:00:00', '2019-01-28 07:00:00', NULL),
(9, 'T2', '2019-01-27 13:00:00', '2019-01-27 14:30:00', NULL),
(12, 'T3', '2019-01-29 10:00:00', '2019-01-29 11:00:00', 'Testing third'),
(23, 'Doctor', '2019-01-28 10:00:00', '2019-01-28 11:00:00', 'fgdgdfg'),
(24, 'fchcfh', '2019-01-28 11:00:00', '2019-01-28 11:30:00', 'hnc fhfh'),
(38, 'Test 7', '2019-01-29 12:00:00', '2019-01-29 12:30:00', ''),
(42, 'T8', '2019-01-29 14:00:00', '2019-01-29 14:30:00', 'empty'),
(45, 'T11', '2019-01-29 17:00:00', '2019-01-29 17:30:00', 'empty'),
(46, 'T5', '2019-01-28 13:00:00', '2019-01-28 13:30:00', ''),
(49, 'Doctor', '2019-01-28 16:30:00', '2019-01-28 17:00:00', 'sadefefews'),
(50, 'Reminder', '2019-01-28 23:00:00', '2019-01-28 23:30:00', 'Take Shower'),
(51, 'T16', '2019-01-30 12:00:00', '2019-01-30 12:30:00', 'gfggr');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_name` varchar(50) DEFAULT NULL,
  `type` varchar(11) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `file_name`, `type`, `size`, `created_at`, `customer_id`) VALUES
(6, 'IMG_0861.JPG', 'image/jpeg', 75760, '2019-02-06 21:10:02', 64),
(7, 'Intern Web Design Resume.docx', 'application', 25554, '2019-02-06 22:29:34', 65),
(8, 'Costco.xlsx', 'application', 507357, '2019-02-06 22:29:34', 65),
(9, 'Interview Questions.docx', 'application', 15424, '2019-02-08 01:18:42', 32),
(10, 'character list.txt', 'text/plain', 87, '2019-02-16 12:11:41', 64),
(12, 'TombRaider.log', 'application', 9092, '2019-02-16 12:38:48', 69);

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE IF NOT EXISTS `patients` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(30) DEFAULT NULL,
  `last_name` varchar(15) DEFAULT NULL,
  `address` varchar(30) DEFAULT NULL,
  `city` varchar(30) DEFAULT NULL,
  `state` varchar(20) DEFAULT NULL,
  `zip` int(11) DEFAULT NULL,
  `phone_number` varchar(14) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `ssn` varchar(11) DEFAULT NULL,
  `license` varchar(30) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `employer` varchar(30) DEFAULT NULL,
  `occupation` varchar(30) DEFAULT NULL,
  `notes` varchar(200) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=70 ;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`customer_id`, `first_name`, `last_name`, `address`, `city`, `state`, `zip`, `phone_number`, `email`, `ssn`, `license`, `birthday`, `sex`, `employer`, `occupation`, `notes`, `created_at`) VALUES
(32, 'Malachi', 'Albrooke', '3453 Centinela Ave', 'New York', 'CA', 0, '(214) 748-3647', 'malbrookev@oakley.co', '649-24-0296', 'D826787', '1987-05-18', 'female ', 'efdewfew', 'Pharmacist', NULL, NULL),
(33, 'Meaghan', 'Cayley', '00960 Bartillon Junction', 'Raleigh', 'NC', 27605, '(214) 748-3647', 'mcayleyw@yahoo.com', '576-04-2382', 'A998515', '1985-08-14', 'female ', 'efefewewf', 'VP Product Management', NULL, NULL),
(34, 'Jamey', 'Emberson', '87273 Ruskin Trail', 'Lansing', 'MI', 48930, '(214) 748-3647', 'jembersonx@arizona.e', '227-18-2175', 'D579170', '1971-12-05', 'male ', '', 'Office Assistant III', NULL, NULL),
(35, 'Mechelle', 'Duxbarry', '1234 Some Street', 'Miami', 'MI', 0, '(214) 748-3647', 'mduxbarryy@rakuten.c', '584-62-1651', 'G354667', '1988-03-08', 'female ', 'Best Buy', 'Administrative Officer', NULL, NULL),
(36, 'Tiff', 'Roden', '4840 Dottie Place', 'Los Angeles', 'CA', 90071, '(214) 748-3647', 'trodenz@a8.net', '308-84-9732', 'X974101', '1958-02-07', 'female ', '', 'Nuclear Power Engineer', NULL, NULL),
(37, 'Reamonn', 'Andersch', '19 Superior Drive', 'Portland', 'OR', 97229, '(214) 748-3647', 'randersch10@gmail.co', '417-52-0719', 'S054877', '1964-04-22', 'male ', '', 'Paralegal', NULL, NULL),
(38, 'Lyndell', 'O', '34814 Pierstorff Road', 'Sacramento', 'CA', 95852, '(214) 748-3647', 'lodunneen11@gmail.co', '167-28-5987', 'X367170', '1984-05-17', 'female ', '', 'Account Coordinator', NULL, NULL),
(39, 'Silvanus', 'Lewtey', '0770 Waywood Avenue', 'Washington', 'DC', 20599, '(202) 487-2828', 'slewtey12@archive.or', '308-06-9171', 'F970235', '1952-07-08', 'male ', '', 'Account Coordinator', NULL, NULL),
(40, 'Lani', 'Wyre', '59399 Linden Avenue', 'Fort Worth', 'TX', 76129, '2147483647', 'lwyre13@clickbank.ne', '882-25-6041', 'H053706', '1975-11-09', 'F', '', 'Programmer IV', NULL, NULL),
(41, 'Quill', 'Tolotti', '48 Chinook Court', 'Monticello', 'MN', 55590, '2147483647', 'qtolotti14@seattleti', '802-24-9689', 'W683681', '2000-07-10', 'M', '', 'Social Worker', NULL, NULL),
(42, 'Noel', 'Gledhall', '739 Hayes Avenue', 'Fullerton', 'CA', 92640, '2147483647', 'ngledhall15@indiegog', '336-61-4905', 'R280549', '1990-09-19', 'F', '', 'Professor', NULL, NULL),
(43, 'Eden', 'Nielson', '53794 High Crossing Court', 'Charleston', 'WV', 25321, '(214) 748-3647', 'enielson16@va.gov', '299-38-4440', 'S237984', '1944-01-23', 'female ', 'Apple', 'Systems Administrator II', NULL, NULL),
(44, 'Yoshiko', 'Drei', '78 Orin Junction', 'Amarillo', 'TX', 79118, '2147483647', 'ydrei17@economist.co', '362-85-0928', 'H610167', '1956-11-11', 'F', '', 'Analyst Programmer', NULL, NULL),
(45, 'Lacey', 'Filan', '35829 Oakridge Parkway', 'San Bernardino', 'CA', 92405, '2147483647', 'lacey@gmail.com', '385-54-2748', 'C986852', '1966-04-20', 'M', '', 'Registered Nurse', NULL, NULL),
(46, 'Rockie', 'Huggett', '28 Sommers Lane', 'Fullerton', 'CA', 92835, '2147483647', 'rhuggett19@wikispace', '518-55-2306', 'K691133', '1985-03-07', 'M', '', 'Junior Executive', NULL, NULL),
(47, 'Starlin', 'Conen', '828 Summerview Place', 'San Antonio', 'TX', 78250, '2108609136', 'sconen1a@wiley.com', '834-24-9694', 'A475307', '1984-05-27', 'F', '', 'Nurse Practicioner', NULL, NULL),
(48, 'Petronilla', 'Jaram', '789 Gale Park', 'Huntsville', 'AL', 35805, '2147483647', 'pjaram1b@ed.gov', '818-62-7194', 'H450647', '1982-03-04', 'F', '', 'Director of Sales', NULL, NULL),
(49, 'Jedediah', 'Allport', '159 Victoria Street', 'Bradenton', 'FL', 34205, '2147483647', 'jallport1c@loc.gov', '850-19-8443', 'B579284', '1988-08-16', 'M', '', 'Assistant Manager', NULL, NULL),
(50, 'Lacey', 'Willis', '246 Clemons Junction', 'El Paso', 'TX', 88569, '2147483647', 'lwillis1d@salon.com', '764-66-8299', 'R148494', '1959-10-20', 'F', '', 'Computer Systems Analyst IV', NULL, NULL),
(64, 'Jenny', 'Pham', '6969 Santa Monica Blvd', 'Santa Monica', 'CA', 90542, '(310) 864-9951', 'jenny@gmail.com', '812-78-0456', 'F1953255', '1997-08-21', 'female ', 'Victoria Secret', 'Model', '', '2019-02-06 21:10:02'),
(65, 'Emily', 'Ratajowski', '6006 Venice Blvd', 'Santa Monica', 'CA', 0, '(310) 715-6984', 'emily@gmail.com', '812-78-0456', 'F1953255', '1990-07-19', 'female ', 'Victoria Secret', 'Model', '', '2019-02-06 22:29:34'),
(69, 'Ariana', 'Grande', '5734 Hollywood Ave', 'Los Angeles', 'CA', 94857, '(310) 539-5837', 'grande@gmail.com', '584-95-7493', 'A39FE3', '1995-03-12', 'Female', 'Independent', 'Singer', '', '2019-02-16 12:38:48');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE IF NOT EXISTS `payments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `total_payment` decimal(10,2) DEFAULT NULL,
  `payment` decimal(10,2) DEFAULT NULL,
  `balance` decimal(10,2) DEFAULT NULL,
  `payment_type` varchar(11) DEFAULT NULL,
  `payment_note` varchar(50) DEFAULT NULL,
  `customer_id` int(11) NOT NULL,
  `payment_created_at` date DEFAULT NULL,
  `charge_id` varchar(13) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  KEY `charge_id` (`charge_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `total_payment`, `payment`, `balance`, `payment_type`, `payment_note`, `customer_id`, `payment_created_at`, `charge_id`) VALUES
(1, '359.76', '359.76', '-200.00', 'Credit Card', 'Testing Payment NOtes', 64, '2019-02-13', '5c651536ece24');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `Customers` FOREIGN KEY (`customer_id`) REFERENCES `patients` (`customer_id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `customer` FOREIGN KEY (`customer_id`) REFERENCES `patients` (`customer_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
