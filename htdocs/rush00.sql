SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE DATABASE IF NOT EXISTS `rush00` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `rush00`;

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `commands`;
CREATE TABLE IF NOT EXISTS `commands` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `items` varchar(8000) NOT NULL,
  `amount` int(11) NOT NULL,
  `date` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(8000) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `zipcode` int(5) NOT NULL,
  `city` varchar(255) NOT NULL,
  `admin` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

INSERT INTO `rush00`.`categories` (`id`, `name`) VALUES (NULL, 'condoms'), (NULL, 'cockrings'), (NULL, 'dildos'), (NULL, 'lingeries'), (NULL, 'lubes');

INSERT INTO `rush00`.`users` (`id`, `login`, `password`, `lastname`, `firstname`, `address`, `zipcode`, `city`, `admin`) VALUES (NULL, 'root', '4925da7da7a56260baf1c37925a8fa24e46ad8b107dcd21f44e39e4751bae1304fc70de7acb847ffa96126bb372de005f5320f1ede6f9df07c7d53f9c160f022', 'root', 'root', 'root', 69069, 'root', 1) ;

INSERT INTO `rush00`.`items` (`id`, `category_id`, `name`, `price`) VALUES 
(NULL, 1, 'KISSes', 1),
(NULL, 1, 'Kitties', 1),
(NULL, 1, 'Parisians', 1),
(NULL, 1, 'Papals', 1),
(NULL, 1, 'Achings', 1),
(NULL, 2, 'Leather and chains', 1),
(NULL, 2, 'Full rabbit', 1),
(NULL, 2, 'Leather stretcher', 1),
(NULL, 2, 'Heavy machinery', 1),
(NULL, 2, 'Screw this', 1),
(NULL, 3, 'Greenish', 1),
(NULL, 3, 'Orangeish', 1),
(NULL, 3, 'Yellowish', 1),
(NULL, 3, 'Blackish', 1),
(NULL, 3, 'Discovery kit', 1),
(NULL, 4, 'Parrot', 1),
(NULL, 4, 'Bloody', 1),
(NULL, 4, 'Squid', 1),
(NULL, 4, 'name19', 1),
(NULL, 4, 'name20', 1),
(NULL, 5, 'name21', 1),
(NULL, 5, 'name22', 1),
(NULL, 5, 'name23', 1),
(NULL, 5, 'name24', 1),
(NULL, 5, 'name25', 1);
