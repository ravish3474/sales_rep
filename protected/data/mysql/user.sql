
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- --------------------------------------------------------

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_salt` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `fullname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_group_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;

INSERT INTO `user` (`username`, `password`, `password_salt`, `fullname`, `email`, `user_group_id`) VALUES ('jogAdmin', '224b1d2a7ae64108d09d9f6bfaffbf1aa6cd0625', 'dJ0fNm', 'Administrator', 'administration@jogsportswear.com', '99');
INSERT INTO `user` (`username`, `password`, `password_salt`, `fullname`, `email`, `user_group_id`) VALUES ('admin', '0c38f440c0fad83c9887feae31e59fe20de7f340', 'uatIBV', 'Administrator', 'administration@jogsportswear.com', '1');
