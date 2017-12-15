
-- create database
CREATE DATABASE IF NOT EXISTS bookclass DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;

use bookclass;


DROP TABLE IF EXISTS `course`;
CREATE TABLE  IF NOT EXISTS `course` (
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`coursename` CHAR(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
	`coursetime` CHAR(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
	`capacity` TINYINT NOT NULL,
	`remain` TINYINT NOT NULL
) ENGINE=MYISAM CHARACTER SET utf8 COLLATE utf8_bin;


insert into course (`id`,`coursename`,`coursetime`, `capacity`, `remain`) values (1,'Boot Camp','Monday, 9:00', 2, 2);
insert into course (`id`,`coursename`,`coursetime`, `capacity`, `remain`) values (2,'Boot Camp','Tuesday, 9:00', 2, 2);
insert into course (`id`,`coursename`,`coursetime`, `capacity`, `remain`) values (3,'Boot Camp','Wednesday, 9:00', 2, 2);
insert into course (`id`,`coursename`,`coursetime`, `capacity`, `remain`) values (4,'Boxercise','Thursday, 10:00', 4, 4);
insert into course (`id`,`coursename`,`coursetime`, `capacity`, `remain`) values (5,'Boxercise','Friday, 10:00', 4, 4);
insert into course (`id`,`coursename`,`coursetime`, `capacity`, `remain`) values (6,'Pilates','Monday, 11:00', 3, 3);
insert into course (`id`,`coursename`,`coursetime`, `capacity`, `remain`) values (7,'Pilates','Wednesday, 11:00', 3, 3);
insert into course (`id`,`coursename`,`coursetime`, `capacity`, `remain`) values (8,'Pilates','Friday, 11:00', 3, 3);
insert into course (`id`,`coursename`,`coursetime`, `capacity`, `remain`) values (9,'Yoga','Tuesday, 13:00', 2, 2);
insert into course (`id`,`coursename`,`coursetime`, `capacity`, `remain`) values (10,'Yoga','Wednesday, 13:00', 2, 2);
insert into course (`id`,`coursename`,`coursetime`, `capacity`, `remain`) values (11,'Zumba','Friday, 14:00', 2, 2);

DROP TABLE IF EXISTS `log`;
CREATE TABLE IF NOT EXISTS `log` (
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`courseid` INT NOT NULL,
	`name` CHAR(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
	`phone` CHAR(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=MYISAM CHARACTER SET utf8 COLLATE utf8_bin;
