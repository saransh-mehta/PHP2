<?php
define('TIMEZONE', 'Asia/Calcutta'); //INDIA
date_default_timezone_set(TIMEZONE);

if($_SERVER["SERVER_NAME"]=="localhost" || $_SERVER["SERVER_NAME"]=="trinitysolutions" || $_SERVER["SERVER_NAME"]=="trinityhome")
{
	$host_name = "localhost";
	$db_name="saransh";
	$db_user="root";
	$db_pwd="";
}
else
{
	
	
	 //For Trinity Server
	$host_name="";
	$db_name="";
	$db_user="";
	$db_pwd="";
}

$dblink = mysql_connect("$host_name","$db_user","$db_pwd");
mysql_select_db("$db_name",$dblink);
//$createdate = date('Y-m-d H:m:s');

?>
