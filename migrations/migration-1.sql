ALTER TABLE `location_update` ADD COLUMN `location_name` TEXT NOT NULL;

UPDATE `Version` SET `version`='1.1.0';
