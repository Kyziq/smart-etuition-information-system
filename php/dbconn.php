<?php
/* php & mysqldb connection file */
$user = "root"; // mysqlusername
$pass = ""; // mysqlpassword
$host = "localhost"; // Server name/IP address
$dbname = "smartetuition"; // Database name
$dbconn = mysqli_connect($host, $user, $pass, $dbname) or die(mysqli_error($dbconn));
