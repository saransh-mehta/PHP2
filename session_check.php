<?php
session_start();
include("admin/dbconnection.php");
//print_r($_SESSION);
if(isset($_SESSION['userid']) && $_SESSION['userid']!='')
{
}
else
{
	echo "<script>alert('Unauthorised Access');</script>";
	echo "<script>location='../index.php'</script>";
}
?>