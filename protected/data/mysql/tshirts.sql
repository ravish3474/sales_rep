
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- --------------------------------------------------------

DROP TABLE IF EXISTS `tshirts`;
CREATE TABLE `tshirts` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `qty_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
    `category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
    `fabric_options` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
    `style` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
    `qty1` DECIMAL(10,2) NOT NULL,
    `msrp` DECIMAL(10,2) NOT NULL,
    `notes` text COLLATE utf8_unicode_ci NULL,

    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;
