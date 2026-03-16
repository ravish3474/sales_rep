
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- --------------------------------------------------------

DROP TABLE IF EXISTS `hockey_line`;
CREATE TABLE `hockey_line` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `style` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
    `discription` text COLLATE utf8_unicode_ci NOT NULL,
    `qty1` DECIMAL(10,2) NOT NULL,
    `qty2` DECIMAL(10,2) NOT NULL,
    `qty3` DECIMAL(10,2) NOT NULL,
    `qty4` DECIMAL(10,2) NOT NULL,
    `qty5` DECIMAL(10,2) NOT NULL,
    `qty6` DECIMAL(10,2) NOT NULL,
    `msrp` DECIMAL(10,2) NOT NULL,
    `price_th` DECIMAL(10,2) NOT NULL,
    `price` DECIMAL(10,2) NOT NULL,

    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;
