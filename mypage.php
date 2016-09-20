<!DOCTYPE html>
<html>

<head>
<title>MyPage</title>
</head>

<body>

<!--Connection-->
<?php
$dbconn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=postgres")
    or die('Could not connect: ' . pg_last_error());
?>
<!--end-->

<div><img align="middle" src="lendstuffplz.png"></div>

<form method='post'>
        Username <input type="text" name="myusername" id="myusername">
		Password <input type="password" name="mypassword" id="mypassword">
		
		<input type="submit" name="formSubmit" value="Login">
</form>

<!--PHP-->
<?php if(isset($_POST['formSubmit'])) 
{
	$myuser = $_POST['myusername'];
	 $mypass = $_POST['mypassword'];
	 
	$query = "SELECT name FROM account WHERE email ='$myuser' AND password = '$mypass'"; 
  $result = pg_query($query) or die('Query failed: ' . pg_last_error());	
	
	
	while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "\t<tr>\n";
    foreach ($line as $col_value) {
        echo "\t\t<td>$col_value</td>\n";
    }
    echo "\t</tr>\n";
  } 
	
	pg_free_result($result);
}
?>
</td> </tr>
<?php
pg_close($dbconn);
?>
<!--end-->

</body>
</html>

