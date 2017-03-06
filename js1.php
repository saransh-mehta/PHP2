<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<input type="submit" onclick="displaysum();" />
<input type="text" id="mydate" />


<div id="mydiv" style="color:#F00;"> </div>
<br />
<select onchange="displaysum();" id="mybox">
	<option value="" selected="selected">--select--</option>
    <option value="0" >Checque</option>
    <option value="1" >Cash</option>
</select>

<input type="text" placeholder="Enter Cash Amount" id="cashamt" style="display:none" />
<input type="text" placeholder="Enter Checque Amount" id="chequamt" style="display:none" />


<hr />


<input type="text" id="x"  />+
<input type="text" id="y"  />=
<input type="text" id="z" />
<script>

function displaydate()
{
	var curdate = Date();
	document.getElementById('mydate').value = curdate;
	document.getElementById('mydiv').innerHTML = curdate;
}

function displaysum()
{
	var x = parseFloat(document.getElementById('x').value);
	var y = parseFloat(document.getElementById('y').value);
	//alert(x);
	
	//if(x!=Nan && y!=Nan)
	document.getElementById('z').value = x + y;
}


function shownhide()
{
	var myboxval = document.getElementById('mybox').value;
	
	if(myboxval == 0)
	{
		document.getElementById('cashamt').style.display = 'block';
		document.getElementById('chequamt').style.display = 'none';
	}
	else
	{
		document.getElementById('cashamt').style.display = 'none';
		document.getElementById('chequamt').style.display = 'block';
	}
	//document.getElementById('mydiv').innerHTML = curdate;
	
	for(i = 0; i <=10; i++ )
	{
		cars[i] = i; 
		
	}
}



</script>


</body>
</html>