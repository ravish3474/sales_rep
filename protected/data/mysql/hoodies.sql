
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- --------------------------------------------------------

DROP TABLE IF EXISTS `hoodies`;
CREATE TABLE `hoodies` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `year` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
    `category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
    `discription` text COLLATE utf8_unicode_ci NOT NULL,
    `style` text COLLATE utf8_unicode_ci NOT NULL,
    `qty1` DECIMAL(10,2) NOT NULL,
    `qty2` DECIMAL(10,2) NOT NULL,
    `qty3` DECIMAL(10,2) NOT NULL,
    `msrp` DECIMAL(10,2) NOT NULL,
    `cad` DECIMAL(10,2) NOT NULL,
    `notes` text COLLATE utf8_unicode_ci NULL,

    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;
