<?php
include("dbconnection.php");

if(isset($_GET['tablename']))
$tablename = $_GET['tablename'];

if(isset($_GET['tablekey']))
$tablekey = $_GET['tablekey'];

if(isset($_GET['pagename']))
$pagename = $_GET['pagename'];


if(isset($_GET['id']))
$id = $_GET['id'];


$sql = "delete from $tablename where $tablekey = '$id'";
mysql_query($sql);
echo "<script>location='reg_form.php';</script>";

?>