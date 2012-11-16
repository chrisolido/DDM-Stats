<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_mysql_ddm = "localhost";
$database_mysql_ddm = "ufsp";
$username_mysql_ddm = "ddmrocks";
$password_mysql_ddm = "qwertyu";
$mysql_ddm = mysql_pconnect($hostname_mysql_ddm, $username_mysql_ddm, $password_mysql_ddm) or trigger_error(mysql_error(),E_USER_ERROR); 
?>