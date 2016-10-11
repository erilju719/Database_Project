<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrapValidator.css"/>
        <link href="assets/bootstrap/css/index.css" rel="stylesheet">
     <title>Stuffshare - Log in</title>
</head>


<?php
	if(isset($_SESSION)){
		session_destroy();
	}
	session_start();
	$dbconn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=postgres")
	or die('Could not connect: ' . pg_last_error());
?>
<body>
	<div class="container">
		<div class="jumbotron">
			<h2>Log In Page</h2>
			<form method="post">
				<input type="email" placeholder="Email" name = "user_name" id="emailplease"> <br>
				<input type="password" placeholder="Password" id="un" name = "pass"><br><br>
				<div>
					<input class="btn btn-info" type="submit" value = "Sign In" name = "formSubmit">
					<button type="button" class = "btn btn-info" role="button" href= "regpage.php">Register</a>
				</div>
			</form>
		</div>
	</div>
<?php
if (isset($_POST['formSubmit'])){
		$name = $_REQUEST['user_name'];
		$password=$_REQUEST['pass'];
		$query = "SELECT a.admin::int FROM account a WHERE email = '$name' AND password = '$password'";
		$result = pg_query($dbconn, $query) or die('Query failed: ' . pg_last_error());
		$unique = pg_num_rows($result);
		if($unique == 1){
			$_SESSION['emailaddress'] = $name;
			$adminaccess = pg_fetch_array($result,null,PGSQL_NUM)[0];
			if($adminaccess){
				header('Location: /adminpage.php');
			}
			else{
				header('Location: /homepage.php');
			}
	    exit;
		}
		else{
			echo "\nEmail or Password is incorrect.";
		}
	}
?>
</body>

</html>
