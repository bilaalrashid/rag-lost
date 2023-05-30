ALTER TABLE `config` ADD COLUMN `charity_name` TEXT NOT NULL;

UPDATE `version` SET `version`='1.2.0';
