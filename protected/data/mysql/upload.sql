
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- --------------------------------------------------------

DROP TABLE IF EXISTS `upload`;
CREATE TABLE `upload` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
    `file_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
    `file_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
    `file_datetime` dateTime NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;
