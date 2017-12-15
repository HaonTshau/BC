
-- create database
CREATE DATABASE IF NOT EXISTS bc DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;

use bc;

-- create table course
DROP TABLE IF EXISTS `course`;
CREATE TABLE  IF NOT EXISTS `course` (
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`name` CHAR(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
	`time` CHAR(30) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
	`places` TINYINT NOT NULL,
	`left` TINYINT NOT NULL
) ENGINE=MYISAM CHARACTER SET utf8 COLLATE utf8_bin;


insert into course (`id`,`name`,`time`, `places`, `left`) values (1,'Boot Camp','Monday, 9:00', 2, 2);
insert into course (`id`,`name`,`time`, `places`, `left`) values (2,'Boot Camp','Tuesday, 9:00', 2, 2);
insert into course (`id`,`name`,`time`, `places`, `left`) values (3,'Boot Camp','Wednesday, 9:00', 2, 2);
insert into course (`id`,`name`,`time`, `places`, `left`) values (4,'Boxercise','Thursday, 10:00', 4, 4);
insert into course (`id`,`name`,`time`, `places`, `left`) values (5,'Boxercise','Friday, 10:00', 4, 4);
insert into course (`id`,`name`,`time`, `places`, `left`) values (6,'Pilates','Monday, 11:00', 3, 3);
insert into course (`id`,`name`,`time`, `places`, `left`) values (7,'Pilates','Wednesday, 11:00', 3, 3);
insert into course (`id`,`name`,`time`, `places`, `left`) values (8,'Pilates','Friday, 11:00', 3, 3);
insert into course (`id`,`name`,`time`, `places`, `left`) values (9,'Yoga','Tuesday, 13:00', 2, 2);
insert into course (`id`,`name`,`time`, `places`, `left`) values (10,'Yoga','Wednesday, 13:00', 2, 2);
insert into course (`id`,`name`,`time`, `places`, `left`) values (11,'Zumba','Friday, 14:00', 2, 2);

-- create table booklog
DROP TABLE IF EXISTS `booklog`;
CREATE TABLE IF NOT EXISTS `booklog` (
	`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	`courseid` INT NOT NULL,
	`username` CHAR(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
	`mobile` CHAR(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL
) ENGINE=MYISAM CHARACTER SET utf8 COLLATE utf8_bin;
