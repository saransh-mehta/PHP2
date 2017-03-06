<?php
include("dbconnection.php");

$contact_no = $_GET['contact_no'];

$sql = "select * from registration where contact_no = '$contact_no'";
$cnt = mysql_num_rows(mysql_query($sql));

if($cnt > 0)
echo "1";
else
echo "0";
?>