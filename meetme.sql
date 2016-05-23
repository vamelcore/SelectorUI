-- phpMyAdmin SQL Dump
-- version 3.5.8.1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Янв 31 2014 г., 15:49
-- Версия сервера: 5.1.69
-- Версия PHP: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `meetme`
--

-- --------------------------------------------------------

--
-- Структура таблицы `booking`
--

CREATE TABLE IF NOT EXISTS `booking` (
  `bookId` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `clientId` int(10) unsigned DEFAULT '0',
  `roomNo` varchar(30) DEFAULT '0',
  `roomPass` varchar(30) NOT NULL DEFAULT '0',
  `silPass` varchar(30) NOT NULL DEFAULT '0',
  `startTime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `endTime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dateReq` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `dateMod` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `maxUser` varchar(30) NOT NULL DEFAULT '10',
  `status` varchar(30) NOT NULL DEFAULT 'A',
  `confOwner` varchar(30) NOT NULL DEFAULT '',
  `confDesc` varchar(100) NOT NULL DEFAULT '',
  `aFlags` varchar(10) NOT NULL DEFAULT '',
  `uFlags` varchar(10) NOT NULL DEFAULT '',
  `sequenceNo` int(10) unsigned DEFAULT '0',
  `recurInterval` int(10) unsigned DEFAULT '0',
  PRIMARY KEY (`bookId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Дамп данных таблицы `booking`
--

INSERT INTO `booking` (`bookId`, `clientId`, `roomNo`, `roomPass`, `silPass`, `startTime`, `endTime`, `dateReq`, `dateMod`, `maxUser`, `status`, `confOwner`, `confDesc`, `aFlags`, `uFlags`, `sequenceNo`, `recurInterval`) VALUES
(41, 0, '7199', '', '', '2012-12-19 14:15:00', '2112-12-19 15:15:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', '50', 'A', 'admin', 'Ð¡Ð•Ð›Ð•ÐšÐ¢ÐžÐ ', 'cTMxsm', 'D', 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `cdr`
--

CREATE TABLE IF NOT EXISTS `cdr` (
  `bookId` int(11) DEFAULT NULL,
  `duration` varchar(12) DEFAULT NULL,
  `CIDnum` varchar(32) DEFAULT NULL,
  `CIDname` varchar(32) DEFAULT NULL,
  `jointime` datetime DEFAULT NULL,
  `leavetime` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `invite`
--

CREATE TABLE IF NOT EXISTS `invite` (
  `usr_n` int(11) NOT NULL AUTO_INCREMENT,
  `grp_n` int(11) NOT NULL,
  `grp_name` text NOT NULL,
  `usr_name` text NOT NULL,
  `grp_owner` text NOT NULL,
  `phn` text NOT NULL,
  `email` text NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`usr_n`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=81 ;

--
-- Дамп данных таблицы `invite`
--

INSERT INTO `invite` (`usr_n`, `grp_n`, `grp_name`, `usr_name`, `grp_owner`, `phn`, `email`, `comment`) VALUES
(61, 3563407, 'Ð¡Ð•Ð›Ð•ÐšÐ¢ÐžÐ ', 'Ð¥Ð¼ Ð Ð•Ðœ Ð—Ð±ÑƒÑ‚', 'admin', 'SIP/7126', '', ''),
(80, 3563407, 'Ð¡Ð•Ð›Ð•ÐšÐ¢ÐžÐ ', 'Ð¥Ð¼ ÐœÐ Ð•Ðœ Ð—Ð±ÑƒÑ‚', 'admin', 'SIP/7121', '', ''),
(59, 3563407, 'Ð¡Ð•Ð›Ð•ÐšÐ¢ÐžÐ ', 'Ð¥Ð¼ Ð Ð•Ðœ', 'admin', 'SIP/7124', '', ''),
(60, 3563407, 'Ð¡Ð•Ð›Ð•ÐšÐ¢ÐžÐ ', 'Ð¥Ð¼ ÐœÐ Ð•Ðœ', 'admin', 'SIP/7123', '', ''),
(48, 3563407, 'Ð¡Ð•Ð›Ð•ÐšÐ¢ÐžÐ ', 'Ð“ÐžÐ›ÐžÐ’ÐÐ˜Ð™ Ð‘Ð›ÐžÐš', 'admin', 'SIP/7120', '', ''),
(74, 16828435, 'TEST', '7101', 'admin', 'SIP/7101', '', ''),
(75, 3563407, 'Ð¡Ð•Ð›Ð•ÐšÐ¢ÐžÐ ', 'Ð¯Ñ€Ð¼Ð¾Ð»Ð¸Ð½Ñ†Ñ– Ð Ð•Ðœ', 'admin', 'SIP/7127', '', ''),
(73, 16828435, 'TEST', 'Test', 'admin', 'DAHDI/g1/7800', '', ''),
(78, 3563407, 'Ð¡Ð•Ð›Ð•ÐšÐ¢ÐžÐ ', 'Ð¡Ð¦ Ð¡Ð¢Ð£Ð”Ð†Ð¯', 'admin', 'SIP/7122', '', ''),
(79, 3563407, 'Ð¡Ð•Ð›Ð•ÐšÐ¢ÐžÐ ', 'ÐšÑ€Ð°ÑÐ¸Ð»Ñ–Ð² Ð Ð•Ðœ', 'admin', 'SIP/7164', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `book_id` int(11) NOT NULL DEFAULT '0',
  `ntype` char(10) DEFAULT NULL,
  `ndate` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `participants`
--

CREATE TABLE IF NOT EXISTS `participants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `book_id` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(25) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `telephone` varchar(15) DEFAULT NULL,
  `admin` varchar(5) NOT NULL DEFAULT 'User',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
