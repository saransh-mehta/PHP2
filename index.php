<?php
//session_start();
//include("dbconnection.php");
//include("admin/session_check.php");

if(isset($_POST['sub']))
{
	$uname = $_POST['uname'];
	$password = $_POST['password'];
	if($uname == "admin" && $password =="admin")
	{
	 ?>$sql1 = "select * from login where uname = '$uname' and password = '$password'";
		echo $sqli;
		die;
		$res = mysql_query($sql1);
		$cnt = mysql_num_rows($res);
		if($cnt > 0)
		{
			//success
			$row = mysql_fetch_array($res);
			$_SESSION['userid'] = $row['loginid'];
			echo "<script>location='admin/reg_form.php'</script>";
		}
		else
		{
			//failed
			echo "<script>alert('Incorrect User name and Password');</script>";
			echo "<script>location='index.php'</script>";
		}
	} 
	
	header('location: http://www.google.com/');
	//echo "saransh";
}
}
?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>LOGIN</title>
</head>

<body>
<form action="" method="post">
<table width="200" border="1">
  <tr>
    <td colspan="2">Login Form</td>
  </tr>
  <tr>
    <td>Username</td>
    <td><input type="text" name="uname" id="uname" /></td>
  </tr>
  <tr>
    <td>Password</td>
    <td><input type="password" name="password" id="password" /></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="sub" id="sub" value="Login" /></td>
  </tr>
</table>
</form>
</body>
</html>