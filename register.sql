-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 24 Eki 2016, 08:55:12
-- Sunucu sürümü: 5.6.15-log
-- PHP Sürümü: 5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Veritabanı: `register`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `temp_users`
--

CREATE TABLE IF NOT EXISTS `temp_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `key` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Tablo döküm verisi `temp_users`
--

INSERT INTO `temp_users` (`id`, `email`, `key`, `password`) VALUES
(11, 'arif.yldz1@gmail.com', '964941a1417609e024941964be169881', 'e10adc3949ba59abbe56e057f20f883e');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `email`, `password`) VALUES
(5, 'mustafakostek@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(4, 'eliteboymusti@hotmail.com', '202cb962ac59075b964b07152d234b70'),
(6, 'arif.yldz1@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(7, 'must.ksk@hotmail.com', 'd4070de9c571c507ddfaad378c26a8b0');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
