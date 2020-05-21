-- Adminer 4.7.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `info`;
CREATE TABLE `info` (
  `key` char(255) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `info` (`key`, `value`) VALUES
('password',	'<CHANGE THIS PLEASE>');

DROP TABLE IF EXISTS `teachers`;
CREATE TABLE `teachers` (
  `name` varchar(100) NOT NULL,
  `course` varchar(100) NOT NULL,
  `voters_10_sci` int(11) NOT NULL DEFAULT 0,
  `voters_10_soc` int(11) NOT NULL DEFAULT 0,
  `voters_11_sci` int(11) NOT NULL DEFAULT 0,
  `voters_11_soc` int(11) NOT NULL DEFAULT 0,
  `voters_12_sci` int(11) NOT NULL DEFAULT 0,
  `voters_12_soc` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- 2019-11-17 23:29:26
