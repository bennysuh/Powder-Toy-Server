<?php
require_once(Global.api);

StartDatabase();
mysql_query("CREATE TABLE saves (id INT, name VARCHAR(256), votes INT, upvotes INT, downvotes INT, author VARCHAR(256), data VARCHAR(65535), views INT) TYPE=innodb;");
mysql_query("CREATE TABLE users (id INT, name VARCHAR(256), saves INT, date_joined VARCHAR(1024), biography VARCHAR(65535), birthday VARCHAR(65535), website VARCHAR(65535), location VARCHAR(65535)) TYPE=innodb;");
CloseDatabase();
?>
