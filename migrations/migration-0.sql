CREATE TABLE team (
  `id` INTEGER PRIMARY KEY AUTO_INCREMENT,
  `team_name` TEXT NOT NULL,
  `members` TEXT NOT NULL,
  `team_description` TEXT NOT NULL,
  `donate_url` TEXT NOT NULL,
  `pin_url` TEXT NOT NULL,
  `team_image_url` TEXT NOT NULL,
  `team_color` TEXT NOT NULL
);

CREATE TABLE location_update (
  `id` INTEGER PRIMARY KEY AUTO_INCREMENT,
  `latitude` REAL NOT NULL,
  `longitude` REAL NOT NULL,
  `update_message` TEXT NOT NULL,
  `update_timestamp` DATETIME NOT NULL,
  `team_id` INTEGER NOT NULL,
  FOREIGN KEY(`team_id`) REFERENCES team(`id`)
);

CREATE TABLE config (
  `id` INTEGER PRIMARY KEY AUTO_INCREMENT,
  `countdown_start` DATETIME NOT NULL,
  `start_location_latitude` REAL NOT NULL,
  `start_location_longitude` REAL NOT NULL,
  `donation_total` REAL,
  `donate_url` TEXT
);

CREATE TABLE version (
  `version` VARCHAR(255) NOT NULL
);

INSERT INTO `config` (`countdown_start`, `start_location_latitude`, `start_location_longitude`, `donation_total`, `donate_url`) VALUES (NOW(), 0.0, 0.0, 0, '');

INSERT INTO `version` (`version`) VALUES ('1.0.0');
