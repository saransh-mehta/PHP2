<?php
//db connection code // session
//include("session_check.php");
include("dbconnection.php");
$tablename = "registration";
$tablekey = "reg_id";
$module_name = "User Registration";
$pagename = "reg_form.php";

if(isset($_GET[$tablekey]))
{
	$keyvalue = $_GET[$tablekey];
	$sql_edit = "select * from $tablename where $tablekey = '$keyvalue'";
	$res_edit = mysql_query($sql_edit);
	$row_edit = mysql_fetch_array($res_edit);
	
	$sname = $row_edit['sname'];
	$contact_no = $row_edit['contact_no'];
	$class = $row_edit['class'];
}
else
{
	$keyvalue = 0;
	$sname = "";
	$contact_no = "";
	$class= "";
}

$condition = " where 1 = 1 ";
if(isset($_GET['search']))
{
	$search_sname = $_GET['search_sname'];
	$search_contact_no = $_GET['search_contact_no'];
	
	if($search_sname!="")
	$condition .=  " and sname like '%$search_sname%'  or contact_no = '$search_sname'";
	
}

//get all forms value after submit
if(isset($_POST['submit']))
{
	
	//print_r($_POST);
	//die;
	$keyvalue = $_POST[$tablekey];
	$sname = $_POST['sname'];
	$contact_no = $_POST['contact_no'];
	$class = $_POST['class'];
	$imgname = $_FILES['imgname'];
	
	//print_r($_FILES['imgname']);
	//echo date('d-m-Y h:i:s');
	//die;
	$ext =  pathinfo($_FILES['imgname']['name'],PATHINFO_EXTENSION);
	$new_file_name = uniqid().strtotime(date('d-m-Y h:i:s')).'.'.$ext;
	
	if($keyvalue == 0)
	{
		//insert
		$sql = "insert into $tablename set sname = '$sname', contact_no = '$contact_no', class = '$class'"; 
		$res = mysql_query($sql);
		$action = "inserted";
		$lastid = mysql_insert_id();
		
		if(isset($_FILES['imgname']['tmp_name']) && $_FILES['imgname']['tmp_name']!="")
		{
			 $location = "uploads/".$new_file_name;
			 pathinfo($$_FILES['imgname']['tmp_name'],PATHINFO_EXTENSION);
			 move_uploaded_file($_FILES['imgname']['tmp_name'], "$location");
			 mysql_query("update registration set imagename = '$new_file_name' where reg_id = '$lastid'");
			 
		}
		
	}
	else
	{
		//update
		$sql = "update  $tablename set sname = '$sname', contact_no = '$contact_no', class = '$class' where $tablekey = '$keyvalue'"; 
		$res = mysql_query($sql);
		$action = "Updated";
		
	}
	
	echo "<script>alert('Record Saved');</script>";
	echo "<script>location = 'reg_form.php';</script>";
}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $module_name; ?></title>

</head>

<body>
<fieldset style="width:70%">
<legend><?php echo $module_name; ?></legend>
<form action="" method="post" enctype="multipart/form-data" />
<table width="100%" border="1"  >
 <tr >
 	 <td width="25%">Name </td>
     <td width="25%">Contact_no &nbsp;&nbsp;<span id="dupid" style="color:#F00;"></span></td>
     <td width="20%">class</td>
     <td width="30%">Image</td>
  </tr>
  <tr >
     <td><input type="text" name="sname" id="sname" value="<?php echo $sname; ?>" /></td>
     <td><input type="text" name="contact_no" id="contact_no" value="<?php echo $contact_no; ?>" onchange="checkduplicate(this.value);"/></td> 
     <td>
        <select name="class" id="class">
            <option value="BCA" > BCA</option>
            <option value="MBA"> MBA</option>
            <option value="BBA" >BBA</option>
        </select>
        <script>document.getElementById('class').value='<?php echo $class; ?>';</script>
     </td>
     <td><input type="file" name="imgname" id="imgname"  /></td>
   </tr>
</table>
 <input type="submit" name="submit" value="submit" onclick="return check_validation();" /> 
 <input type="hidden" name="<?php echo $tablekey; ?>" id="<?php echo $tablekey; ?>" value="<?php echo $keyvalue; ?>" />
</form>
</fieldset>         
<br /><br />

<form action="" method="get">
<table width="60%" border="1">
  <tr>
    <td width="13%">Search By Name / Mobile:</td>
    <td width="25%"><input type="text" name="search_sname" id="search_sname" value="<?php echo $search_sname; ?>"/></td>
    <td width="20%"><input type="submit" name="search" id="search" value="Search"  />&nbsp;
    <a href="<?php echo $pagename; ?>" name="reset" id="reset"   />Reset</a>
    </td>
  </tr>
</table>
</form>

         
<table width="60%" border="1">
	<tr>
    	<td colspan="6" style="color:#F00;font-size:18px;"><?php echo $module_name; ?> List</td>
    </tr>
	<tr>
        <td width="6%"></td> 
        <td width="23%">Name</td>
    	<td width="14%">Contact_no</td>
        <td width="46%">class</td>
        <td width="46%">Image</td>
 		<td width="5%">Edit</td>
        <td width="6%">Delete</td>
    </tr>
    <?php
	$sn = 1;
	$sdsss = "select * from registration $condition";
    $sql_get = mysql_query($sdsss);
	while($row_get = mysql_fetch_array($sql_get))
	{
		//$regid = $row_get['regid'];
	?>
       <tr>
       	<td><?php echo $sn; ?></td>
        <td><?php echo $row_get['sname']; ?></td>
    	<td><?php echo $row_get['contact_no']; ?></td>
        <td><?php echo $row_get['class'];?></td>
        <td><?php if($row_get['imagename']!=""){ ?><img  src="uploads/<?php echo $row_get['imagename'];?>" style="width:25px; height:25px;"  /><?php } ?></td>
        <td><a href="<?php echo $pagename."?".$tablekey."=".$row_get[$tablekey]; ?>">Edit</a></td>
        <td><a style="cursor:pointer;" onclick="funDelete('<?php echo $row_get[$tablekey]; ?>');">Delete</a></td>
         </tr>
		 <?php
		 $sn++;
     }
	 ?>
</table>

<script>
function funDelete(id)
{
	if(confirm('Are you sure want to delete this!'))
	{
		var tablename = "<?php echo $tablename; ?>";
		var tablekey = "<?php echo $tablekey; ?>";
		var pagename = "<?php echo $pagename; ?>";
		location = 'delete_selected.php?tablename=' + tablename + '&tablekey=' + tablekey + '&pagename=' + pagename + '&id=' + id;
	}
}


function checkduplicate(contact_no)
{
	//alert(contact_no);
	var xhttp = new XMLHttpRequest();
	var ajaxurl = "ajax_check_number.php?contact_no=" + contact_no;
	xhttp.onreadystatechange = function() {
	if (xhttp.readyState == 4 && xhttp.status == 200) {
		if(xhttp.responseText == 0)
		document.getElementById("dupid").innerHTML = "";
		else
		{
			document.getElementById("dupid").innerHTML = "Contact Number Already Exist...";
			document.getElementById("contact_no").value = "";
		}
	}
	};
	xhttp.open("GET", ajaxurl , true);
	xhttp.send();
}


function check_validation()
{
	var sname = document.getElementById('sname').value;
	var contact_no = document.getElementById('contact_no').value;
	if(sname == '')
	{
		alert('Name can not be blank!');
		document.getElementById('sname').focus();
		return false;
	}
	
	if(contact_no == '')
	{
		alert('contact_no can not be blank!');
		document.getElementById('contact_no').focus();
		return false;
	}
}
</script>
</body>
</html>