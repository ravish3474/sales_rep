
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- --------------------------------------------------------

DROP TABLE IF EXISTS `notes`;
CREATE TABLE `notes` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `notes` text COLLATE utf8_unicode_ci NULL,
    `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,

    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;
