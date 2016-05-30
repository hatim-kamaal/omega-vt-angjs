create schema omega_competition;

use omega_competition;

-------------------------------------------
-- Member
-------------------------------------------

CREATE TABLE IF NOT EXISTS `member` (
	`member_id` bigint NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`member_name` varchar(250) NOT NULL,
	`member_email` varchar(250) NOT NULL,
	`member_code` varchar(250) NOT NULL,	
	`created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
	`updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-------------------------------------------
-- Category
-------------------------------------------

CREATE TABLE IF NOT EXISTS `c_category` (
	`c_category_id` bigint NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`c_category_title` varchar(250) NOT NULL,
	`c_category_code` varchar(250) NOT NULL,
	`c_category_created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
	`c_category_updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-------------------------------------------
-- Competition
-------------------------------------------
CREATE TABLE IF NOT EXISTS `c_competition` (
	`c_competition_id` bigint NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`c_competition_title` varchar(250) NOT NULL,
	`c_competition_code` varchar(250) NOT NULL,
	`c_competition_registration_start` timestamp,
	`c_competition_registration_end` timestamp,
	`c_competition_max_participant` int(5),
	`c_competition_category_id` bigint,	
	`c_category_created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
	`c_category_updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-------------------------------------------
-- Competition
-------------------------------------------
CREATE TABLE IF NOT EXISTS `c_competition` (
	`c_competition_id` bigint NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`c_competition_title` varchar(250) NOT NULL,
	`c_competition_code` varchar(250) NOT NULL,
	`c_competition_registration_start` timestamp,
	`c_competition_registration_end` timestamp,
	`c_competition_max_participant` int(5),
	`c_competition_category_id` bigint,	
	`c_category_created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
	`c_category_updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

