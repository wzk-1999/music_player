DROP DATABASE IF EXISTS test;

CREATE DATABASE IF NOT EXISTS test;

use test;

BEGIN;


-- test.mus_users definition

CREATE TABLE `mus_users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'primary key',
  `userName` varchar(100) DEFAULT NULL COMMENT 'email',
  `password` text DEFAULT NULL,
  `register_time` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT NULL COMMENT 'is admin',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- test.mus_playlists definition

CREATE TABLE `mus_playlists` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) DEFAULT NULL COMMENT 'user name',
  `add_time` timestamp NULL DEFAULT NULL COMMENT 'add this music time',
  `playlist` varchar(100) DEFAULT NULL COMMENT 'play list name',
  `music_name` varchar(100) DEFAULT NULL COMMENT 'music name',
  `user_comment` text DEFAULT NULL COMMENT 'user description about this music',
  `update_time` timestamp NULL DEFAULT NULL COMMENT 'update time',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


-- test.mus_songlist definition

CREATE TABLE `mus_songlist` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT COMMENT 'primary key',
  `user_name` varchar(100) DEFAULT NULL COMMENT 'user name',
  `playlist` varchar(100) DEFAULT NULL COMMENT 'playlist in this user',
  `add_time` timestamp NULL DEFAULT NULL COMMENT 'add this playlist time',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO test.mus_users
(userName, password, register_time, is_admin)
VALUES('Admin@conestogac.on.ca', '$2y$10$FAphpC5K2A5ooarJnX9H6u8elBtGPBtJOPEI.10qGlrS/iJpGSuH2', '2024-04-07 15:56:50', 1);


COMMIT;