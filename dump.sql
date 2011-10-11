CREATE TABLE IF NOT EXISTS `sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sessionid` varchar(31) CHARACTER SET utf8 NOT NULL,
  `userid` int(11) NOT NULL,
  `expiredate` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sessionid` (`sessionid`,`userid`)
);

CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `profile` int(11) DEFAULT NULL,
  `passhash` varchar(32) CHARACTER SET utf8 NOT NULL,
  `mode` varchar(3) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `passhash` (`passhash`)
);
