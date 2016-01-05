-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 18 Mai 2015 à 00:39
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `camping`
--
CREATE DATABASE IF NOT EXISTS `camping` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `camping`;

-- --------------------------------------------------------

--
-- Structure de la table `caravan`
--

CREATE TABLE IF NOT EXISTS `caravan` (
  `car_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'caravans id name',
  `car_society_name` varchar(20) NOT NULL COMMENT 'society name who rent caravans',
  `car_price` double NOT NULL COMMENT 'caravans_price',
  `car_nb_person` int(11) NOT NULL COMMENT 'the number of person who can live into the caravan',
  `car_id_location` int(11) NOT NULL COMMENT 'location number where the caravans was rented',
  PRIMARY KEY (`car_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

-- --------------------------------------------------------

--
-- Structure de la table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `cust_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'customer''s ID ',
  `cust_lastName` varchar(15) NOT NULL COMMENT 'customer''s last name',
  `cust_address` varchar(255) NOT NULL COMMENT 'customer''s address',
  `cust_postal_code` varchar(10) NOT NULL COMMENT 'customer''s postal code',
  `cust_city` varchar(20) NOT NULL COMMENT 'customer''s city',
  `cust_phone_number` varchar(13) NOT NULL COMMENT 'customer''s phone number',
  `cust_record_number` varchar(15) NOT NULL COMMENT 'customer''s record number',
  `cust_firstName` varchar(15) NOT NULL,
  PRIMARY KEY (`cust_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Contenu de la table `customer`
--

INSERT INTO `customer` (`cust_id`, `cust_lastName`, `cust_address`, `cust_postal_code`, `cust_city`, `cust_phone_number`, `cust_record_number`, `cust_firstName`) VALUES
(17, 'dfg', 'sdfg', 'sdfg', 'sdgsd', 'sdfg', 'sdfg', 'sdfg');

-- --------------------------------------------------------

--
-- Structure de la table `link_car_location`
--

CREATE TABLE IF NOT EXISTS `link_car_location` (
  `lcl_car_id` int(11) NOT NULL,
  `lcl_rent_id` int(11) NOT NULL,
  PRIMARY KEY (`lcl_car_id`,`lcl_rent_id`),
  KEY `lcl_rend_constraint` (`lcl_rent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `link_rent_rental`
--

CREATE TABLE IF NOT EXISTS `link_rent_rental` (
  `lle_rent_id` int(11) NOT NULL,
  `lle_loc_id` int(11) NOT NULL,
  PRIMARY KEY (`lle_rent_id`,`lle_loc_id`),
  KEY `rent_index` (`lle_rent_id`),
  KEY `lle_location_constraint` (`lle_loc_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `link_rent_rental`
--

INSERT INTO `link_rent_rental` (`lle_rent_id`, `lle_loc_id`) VALUES
(14, 27),
(15, 27),
(16, 27);

-- --------------------------------------------------------

--
-- Structure de la table `link_season_location`
--

CREATE TABLE IF NOT EXISTS `link_season_location` (
  `link_seas_id` int(11) NOT NULL,
  `link_location_id` int(11) NOT NULL,
  PRIMARY KEY (`link_seas_id`,`link_location_id`),
  KEY `link_location_constraint` (`link_location_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `link_visitor_rental`
--

CREATE TABLE IF NOT EXISTS `link_visitor_rental` (
  `lvr_visitor_id` int(11) NOT NULL,
  `lvr_rental_id` int(11) NOT NULL,
  KEY `index_rental_id` (`lvr_rental_id`),
  KEY `index_visitor_id` (`lvr_visitor_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `loc_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'location''s id',
  `loc_sec_id` int(11) NOT NULL,
  `loc_type_id` int(11) NOT NULL,
  PRIMARY KEY (`loc_id`),
  KEY `loc_type_index` (`loc_type_id`),
  KEY `loc_sec_index` (`loc_sec_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Contenu de la table `location`
--

INSERT INTO `location` (`loc_id`, `loc_sec_id`, `loc_type_id`) VALUES
(27, 12, 4);

-- --------------------------------------------------------

--
-- Structure de la table `rental`
--

CREATE TABLE IF NOT EXISTS `rental` (
  `rent_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id from rentals date',
  `rent_name` varchar(20) NOT NULL COMMENT 'renteur''s name',
  `rent_begin` date NOT NULL COMMENT 'begin date of the rent',
  `rent_end` date NOT NULL COMMENT 'end date of the rent',
  `rent_nb_person` int(11) NOT NULL COMMENT 'nb person of the rent',
  `rent_location_state` text NOT NULL COMMENT 'rent''s state after the rent',
  `rent_caution_state` double NOT NULL COMMENT 'rent''s state payment',
  `rent_days_number` int(11) NOT NULL COMMENT 'rent''s days number',
  `rent_price` double NOT NULL COMMENT 'rent''s price',
  `rent_cust_id` int(11) NOT NULL COMMENT 'foreign key from customer''s table',
  `rent_validity` tinyint(1) NOT NULL DEFAULT '1' COMMENT 'rent''s state of the validity',
  PRIMARY KEY (`rent_id`),
  KEY `cust_foreign_key` (`rent_cust_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Contenu de la table `rental`
--

INSERT INTO `rental` (`rent_id`, `rent_name`, `rent_begin`, `rent_end`, `rent_nb_person`, `rent_location_state`, `rent_caution_state`, `rent_days_number`, `rent_price`, `rent_cust_id`, `rent_validity`) VALUES
(14, 'test', '2015-05-19', '2015-05-30', 3, '', 25, 11, 25, 17, 1),
(15, 'test6', '2015-05-25', '2015-05-30', 2, '', 25, 5, 25, 17, 1),
(16, 'test10', '2015-05-28', '2015-06-10', 5, '', 35, 13, 347, 17, 1);

-- --------------------------------------------------------

--
-- Structure de la table `season`
--

CREATE TABLE IF NOT EXISTS `season` (
  `seas_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'season''s id',
  `seas_name` varchar(20) NOT NULL COMMENT 'season''s name',
  `seas_start_date` date NOT NULL COMMENT 'season''s start date',
  `seas_end_date` date NOT NULL COMMENT 'season''s  end date',
  `seas_coeff` double NOT NULL COMMENT 'season''s coeff',
  PRIMARY KEY (`seas_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Contenu de la table `season`
--

INSERT INTO `season` (`seas_id`, `seas_name`, `seas_start_date`, `seas_end_date`, `seas_coeff`) VALUES
(17, 'test52', '2012-07-22', '2012-09-10', 1),
(19, 'test95', '2015-05-23', '2015-06-30', 0.8);

-- --------------------------------------------------------

--
-- Structure de la table `sector`
--

CREATE TABLE IF NOT EXISTS `sector` (
  `sec_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'sector''s id',
  `sec_name` varchar(30) NOT NULL COMMENT 'sector''s name',
  PRIMARY KEY (`sec_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `sector`
--

INSERT INTO `sector` (`sec_id`, `sec_name`) VALUES
(11, 'testdfgsdfgd'),
(12, 'test');

-- --------------------------------------------------------

--
-- Structure de la table `type_location`
--

CREATE TABLE IF NOT EXISTS `type_location` (
  `type_location_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'type location''s id',
  `type_location_name` varchar(20) NOT NULL COMMENT 'location''s name',
  `type_location_price` double NOT NULL COMMENT 'location''s price',
  PRIMARY KEY (`type_location_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `type_location`
--

INSERT INTO `type_location` (`type_location_id`, `type_location_name`, `type_location_price`) VALUES
(1, 'terrain nu', 15),
(2, 'mobil home standard', 50),
(3, 'mobil home deluxe', 80),
(4, 'caravans 3 places', 30),
(5, 'caravans 5 places', 45);

-- --------------------------------------------------------

--
-- Structure de la table `visitor`
--

CREATE TABLE IF NOT EXISTS `visitor` (
  `vis_id` int(11) NOT NULL AUTO_INCREMENT,
  `vis_firstName` varchar(20) NOT NULL,
  `vis_lastName` varchar(20) NOT NULL,
  `vis_personNumber` int(11) NOT NULL,
  `vis_date` date NOT NULL,
  PRIMARY KEY (`vis_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `visitor`
--

INSERT INTO `visitor` (`vis_id`, `vis_firstName`, `vis_lastName`, `vis_personNumber`, `vis_date`) VALUES
(2, 'theName', 'theLastName', 444, '2015-05-12');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `link_car_location`
--
ALTER TABLE `link_car_location`
  ADD CONSTRAINT `lcl_car_constraint` FOREIGN KEY (`lcl_car_id`) REFERENCES `caravan` (`car_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lcl_rend_constraint` FOREIGN KEY (`lcl_rent_id`) REFERENCES `rental` (`rent_id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `link_rent_rental`
--
ALTER TABLE `link_rent_rental`
  ADD CONSTRAINT `lle_location_constraint` FOREIGN KEY (`lle_loc_id`) REFERENCES `location` (`loc_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `lle_rent_constraint` FOREIGN KEY (`lle_rent_id`) REFERENCES `rental` (`rent_id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `link_season_location`
--
ALTER TABLE `link_season_location`
  ADD CONSTRAINT `link_location_constraint` FOREIGN KEY (`link_location_id`) REFERENCES `location` (`loc_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `link_season_constraint` FOREIGN KEY (`link_seas_id`) REFERENCES `season` (`seas_id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `link_visitor_rental`
--
ALTER TABLE `link_visitor_rental`
  ADD CONSTRAINT `link_visitor_rental_ibfk_1` FOREIGN KEY (`lvr_rental_id`) REFERENCES `rental` (`rent_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `visitor_id_constraint` FOREIGN KEY (`lvr_visitor_id`) REFERENCES `visitor` (`vis_id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `location_sector_constraint` FOREIGN KEY (`loc_sec_id`) REFERENCES `sector` (`sec_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `location_type_location_constraint` FOREIGN KEY (`loc_type_id`) REFERENCES `type_location` (`type_location_id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `rental`
--
ALTER TABLE `rental`
  ADD CONSTRAINT `rental_customers_constraint` FOREIGN KEY (`rent_cust_id`) REFERENCES `customer` (`cust_id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
