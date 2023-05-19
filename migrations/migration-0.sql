CREATE TABLE team (
  `id` INTEGER PRIMARY KEY,
  `team_name` TEXT NOT NULL,
  `members` TEXT NOT NULL,
  `team_description` TEXT NOT NULL,
  `donate_url` TEXT NOT NULL,
  `pin_url` TEXT NOT NULL
);

CREATE TABLE location_update (
  `id` INTEGER PRIMARY KEY,
  `latitude` REAL NOT NULL,
  `longitude` REAL NOT NULL,
  `update_message` TEXT NOT NULL,
  `update_timestamp` DATETIME NOT NULL,
  `team_id` INTEGER NOT NULL,
  FOREIGN KEY(`team_id`) REFERENCES team(`id`)
);

CREATE TABLE config (
  `id` INTEGER PRIMARY KEY,
  `countdown_start` DATETIME NOT NULL
);

CREATE TABLE version (
  `version` VARCHAR(255) NOT NULL
);

INSERT INTO `Version` (`version`) VALUES ('1.0.0');
