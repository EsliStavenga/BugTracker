CREATE TABLE `user` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`email` varchar(255) NOT NULL,
	`firstname` varchar(255) NOT NULL,
	`lastname` varchar(255) NOT NULL,
	`password` varchar(255) NOT NULL,
	`role` INT(2) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `api_key` (
	`user_id` INT(10) NOT NULL,
	`api_key` varchar(50) NOT NULL UNIQUE,
	`active` tinyint(1) NOT NULL,
	`deleted` tinyint(1) NOT NULL,
	PRIMARY KEY (`user_id`,`api_key`)
);

CREATE TABLE `project` (
	`id` INT(10) NOT NULL AUTO_INCREMENT UNIQUE,
	`name` varchar(50) NOT NULL,
	`description` varchar(1000) NOT NULL,
	`image` varchar(100) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `user_project` (
	`user_id` INT(10) NOT NULL,
	`project_id` INT(10) NOT NULL,
	PRIMARY KEY (`user_id`,`project_id`)
);

CREATE TABLE `report` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`title` varchar(50) NOT NULL,
	`description` varchar(2000) NOT NULL,
	`status` INT(2) NOT NULL,
	`assigned_to` INT(10) NOT NULL,
	`created_at` DATETIME NOT NULL,
	`updated_at` DATETIME,
	`version` INT(10) NOT NULL,
	`project_id` INT(10) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `tag` (
	`id` INT(2) NOT NULL AUTO_INCREMENT,
	`tag` varchar(20) NOT NULL UNIQUE,
	PRIMARY KEY (`id`)
);

CREATE TABLE `report_tag` (
	`project_id` INT(10) NOT NULL,
	`tag_id` INT(2) NOT NULL,
	PRIMARY KEY (`project_id`,`tag_id`)
);

CREATE TABLE `status` (
	`id` INT(2) NOT NULL AUTO_INCREMENT,
	`status` varchar(20) NOT NULL UNIQUE,
	PRIMARY KEY (`id`)
);

CREATE TABLE `user_setting` (
	`user_id` INT(10) NOT NULL AUTO_INCREMENT,
	`setting` varchar(50) NOT NULL,
	`value` FLOAT(4) NOT NULL,
	PRIMARY KEY (`user_id`,`setting`)
);

CREATE TABLE `priority` (
	`id` INT(1) NOT NULL AUTO_INCREMENT,
	`priority` varchar(20) NOT NULL UNIQUE,
	PRIMARY KEY (`id`)
);

CREATE TABLE `project_priority` (
	`project_id` INT(10) NOT NULL,
	`priority_id` INT(1) NOT NULL,
	PRIMARY KEY (`project_id`,`priority_id`)
);

CREATE TABLE `comment` (
	`project_id` INT(10) NOT NULL,
	`user_id` INT(10) NOT NULL,
	`comment` varchar(500) NOT NULL,
	`created_at` DATETIME NOT NULL,
	`updated_at` DATETIME
);

CREATE TABLE `project_version` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`project_id` INT(10) NOT NULL,
	`version` varchar(30) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `role` (
	`id` INT(2) NOT NULL AUTO_INCREMENT,
	`role` varchar(20) NOT NULL UNIQUE,
	PRIMARY KEY (`id`)
);

ALTER TABLE `user` ADD CONSTRAINT `user_fk0` FOREIGN KEY (`role`) REFERENCES `role`(`id`);

ALTER TABLE `api_key` ADD CONSTRAINT `api_key_fk0` FOREIGN KEY (`user_id`) REFERENCES `user`(`id`);

ALTER TABLE `user_project` ADD CONSTRAINT `user_project_fk0` FOREIGN KEY (`user_id`) REFERENCES `user`(`id`);

ALTER TABLE `user_project` ADD CONSTRAINT `user_project_fk1` FOREIGN KEY (`project_id`) REFERENCES `project`(`id`);

ALTER TABLE `report` ADD CONSTRAINT `report_fk0` FOREIGN KEY (`status`) REFERENCES `status`(`id`);

ALTER TABLE `report` ADD CONSTRAINT `report_fk1` FOREIGN KEY (`assigned_to`) REFERENCES `user`(`id`);

ALTER TABLE `report` ADD CONSTRAINT `report_fk2` FOREIGN KEY (`version`) REFERENCES `project_version`(`id`);

ALTER TABLE `report` ADD CONSTRAINT `report_fk3` FOREIGN KEY (`project_id`) REFERENCES `project`(`id`);

ALTER TABLE `report_tag` ADD CONSTRAINT `report_tag_fk0` FOREIGN KEY (`project_id`) REFERENCES `report`(`id`);

ALTER TABLE `report_tag` ADD CONSTRAINT `report_tag_fk1` FOREIGN KEY (`tag_id`) REFERENCES `tag`(`id`);

ALTER TABLE `user_setting` ADD CONSTRAINT `user_setting_fk0` FOREIGN KEY (`user_id`) REFERENCES `user`(`id`);

ALTER TABLE `project_priority` ADD CONSTRAINT `project_priority_fk0` FOREIGN KEY (`project_id`) REFERENCES `project`(`id`);

ALTER TABLE `project_priority` ADD CONSTRAINT `project_priority_fk1` FOREIGN KEY (`priority_id`) REFERENCES `priority`(`id`);

ALTER TABLE `comment` ADD CONSTRAINT `comment_fk0` FOREIGN KEY (`project_id`) REFERENCES `report`(`id`);

ALTER TABLE `comment` ADD CONSTRAINT `comment_fk1` FOREIGN KEY (`user_id`) REFERENCES `user`(`id`);

ALTER TABLE `project_version` ADD CONSTRAINT `project_version_fk0` FOREIGN KEY (`project_id`) REFERENCES `project`(`id`);

