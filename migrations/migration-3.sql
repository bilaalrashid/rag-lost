ALTER TABLE `team` ADD COLUMN `charity_name` TEXT NOT NULL;

UPDATE `version` SET `version`='1.3.0';
