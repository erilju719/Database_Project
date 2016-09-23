<!DOCTYPE html>
<html>
<head>
  <title>Stuffshare - Log in</title>
</head>

<body>

<h3>Log In Page</h3>
<?php
	$dbconn = pg_connect("host=localhost port=5432 dbname=2102Project user=postgres password=postgres")
	or die('Could not connect: ' . pg_last_error());
?>
	<form>
		<input type="text" placeholder="Email" name = "user_name"> <br>
		<input type="password" placeholder="Password" name = "pass"><br>
		<input type="submit" value = "Sign In" name = "formSubmit"></button>
	</form>
<?php if (isset($_GET['formSubmit']))
	session_start();
	{
		$name = $_REQUEST['user_name'];
		$password=$_REQUEST['pass'];
		$query = "SELECT * FROM account a WHERE email = '$name' AND password = '$password'";
		$result = pg_query($dbconn, $query) or die('Query failed: ' . pg_last_error());
		$unique = pg_num_rows($result);
		if($unique == 1){
			$_SESSION['emailaddress'] = $name;
			header('Location: /homepage.php');
	    	exit;
		}
		else{
			echo "\nEmail or Password is incorrect.";
		}
	}
?>
</body>

</html>