<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_DATABASE', 'dbjejaring');
$connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
$database = mysql_select_db(DB_DATABASE);
?>
