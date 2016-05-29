create schema omega_competition;

use omega_competition;

CREATE TABLE IF NOT EXISTS `member` (
	`member_id` bigint NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`member_name` varchar(250) NOT NULL,
	`member_email` varchar(250) NOT NULL,
	`member_code` varchar(250) NOT NULL,	
	`created_at` timestamp DEFAULT CURRENT_TIMESTAMP,
	`updated_at` timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

