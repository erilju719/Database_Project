<?php
// Start the session
session_start();
?>

<html>
<head>
    <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">

      <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
      <link href="assets/bootstrap/css/homepage.css" rel="stylesheet">

  <title>Stuffshare - ADMINPAGE</title>
  <style>
    table {border-collapse: collapse;}
    table, th, td {border: 1px solid black;}
</style>
</head>
<body>

      <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
          <div class="navbar-header">
          <a class="navbar-brand" href = "adminpage.php">Homepage</a>
          <a class="navbar-brand" href = "addpage.php">Add New Item</a>
          <a class = "navbar-brand" href = "index.php">Logout</a>
          </div>
          <form class="navbar-form" method="post" action = "search.php">
            <div class="form-group" id="search-form">
              <input type="text" name = "searched" placeholder="Eg. Lawnmower" class="form-control" id="searchbar">
            </div>
            <button type="submit" name = "formSubmit" class="btn btn-primary">
              <span class = "glyphicon glyphicon-search" id="search-btn"></span>
            </button>
          </form>
        </div>
      </nav>
<br><br><br>
<table>
<tr> <td colspan="5" style="background-color:#FFA500; text-align:center;">
<h1> All Items</h1> </td>
</tr>

<tr>
  <td style="background-color:#eeeeee;">ID</td>
  <td style="background-color:#eeeeee;">Owner</td>
  <td style="background-color:#eeeeee;">Name</td>
  <td style="background-color:#eeeeee;">Location</td>
  <td style="background-color:#eeeeee;">Condition</td>
</tr>

<?php
  $dbconn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=postgres")
    or die('Could not connect: ' . pg_last_error());
  $usermail = $_SESSION['emailaddress'];
	$query = "SELECT i.id, i.owner, i.name, i.location, i.condition FROM item i";
  $result = pg_query($query) or die('Query failed: ' . pg_last_error());

  //echo "<b>SQL: </b>".$query."<br><br>";

	while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "<tr>\n";
    foreach ($line as $col_value) {
        echo "<td style='background-color:#eeeeee;'>$col_value</td>\n";
    }
    echo "</tr>\n";
  }

	pg_free_result($result);
  pg_close($dbconn);
?>
</table>


<br><br><br><br>


<br><br>

<form method="post">
        ID: <input type="text" name="ID" id="ID">
        Owner: <input type="text" name="Owner" id="owner">
        Name: <input type="text" name="Name" id="name">
        Location: <input type="text" name="Location" id="location">
        Condition: <input type="text" name="Condition" id="condition">
        <!--
        <input type="radio" name="Choice" id="Accept" value="Accepted">Accept
        <input type="radio" name="Choice" id="Decline" value="Declined">Decline

        input name used to be BidSumit
      -->
        <input type="submit" name="modify" value="Modify" >
</form>

<br>
<form method="post">
        ID: <input type="text" name="ID" id="ID">
        <input type="submit" name="delete" value="Delete" >
</form>

<?php
  $dbconn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=postgres")
            or die('Could not connect: ' . pg_last_error());

  if(isset($_POST['modify'])) {
    $id = $_POST['ID'];
    $owner = $_POST['Owner'];
    $name = $_POST['Name'];
    $location = $_POST['Location'];
    $condition = $_POST['Condition'];
    
    $query = "UPDATE item SET owner = '$owner', name = '$name', 
    location = '$location',
    condition = '$condition' 
    FROM item WHERE '$id' = item.id";
    /*
    if(!strcmp('$owner', ""))
      $query .= "i.owner = '$owner', "
    if(!strcmp('$name', ""))
      $query .= "i.name = '$name', "
    if(!strcmp('$location', ""))
      $query .= "i.location = '$location', "
    if(!strcmp('$condition', ""))
      $query .= "i.condition = '$condition' "

    $query .= "FROM item WHERE '$id' = i.id";
    $result = pg_query($query) or die('Query failed: ' . pg_last_error());
    header("Refresh:0"); //Update page
    */
  }


  if(isset($_POST['delete'])) {
    $id = $_POST['ID'];
    $query = "DELETE FROM item WHERE '$id' = item.id";
  }
  $result = pg_query($query) or die('Query failed: ' . pg_last_error());
  pg_free_result($result);
  pg_close($dbconn);
?>

<br><br>

<table>
<tr> <td colspan="5" style="background-color:#FFA500; text-align:center;">
<h1> All Bids </h1> </td>
</tr>

<tr>
  <td style="background-color:#eeeeee;">ID</td>
  <td style="background-color:#eeeeee;">Bidder</td>
  <td style="background-color:#eeeeee;">Name</td>
  <td style="background-color:#eeeeee;">Owner</td>
  <td style="background-color:#eeeeee;">Status</td>
</tr>

<?php
  $dbconn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=postgres")
    or die('Could not connect: ' . pg_last_error());

  header("Refresh:0"); //Update page

  $usermail = $_SESSION['emailaddress'];
	$query = "SELECT i.id, b.bidder_email, i.name, i.owner, b.status FROM item i, bid b WHERE i.id=b.item_id ORDER BY i.id;";
  $result = pg_query($query) or die('Query failed: ' . pg_last_error());


  while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "<tr>\n";
    foreach ($line as $col_value) {
        echo "<td style='background-color:#eeeeee;'>$col_value</td>\n";
    }
    echo "</tr>\n";
  }

  pg_free_result($result);
  pg_close($dbconn);
?>

<form method="post">
        ID: <input type="text" name="ID" id="ID">
        Bidder: <input type="text" name="Bidder" id="bidder">
        Name: <input type="text" name="Name" id="name">
        Owner: <input type="text" name="Owner" id="owner">
        Status: <input type="text" name="Status" id="status">
        <!--
        <input type="radio" name="Choice" id="Accept" value="Accepted">Accept
        <input type="radio" name="Choice" id="Decline" value="Declined">Decline

        input name used to be BidSumit
      -->
        <input type="submit" name="modify" value="Modify" >
</form>

<br>
<form method="post">
        ID: <input type="text" name="ID" id="ID">
        Bidder Email: <input type="text" name="Bidder_Email" id="bidder_email">
        <input type="submit" name="delete" value="Delete" >
</form>

<?php
  $dbconn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=postgres")
            or die('Could not connect: ' . pg_last_error());

  if(isset($_POST['modify'])) {
    $id = $_POST['ID'];
    $bidder = $_POST['Bidder'];
    $name = $_POST['Name'];
    $owner = $_POST['Owner'];
    $status = $_POST['Status'];
    
    $query = "UPDATE bid SET bidder = '$bidder', name = '$name', 
    owner = '$owner',
    status = '$status' 
    FROM bid WHERE '$id' = bid.item_id";
    /*
    if(!strcmp('$owner', ""))
      $query .= "i.owner = '$owner', "
    if(!strcmp('$name', ""))
      $query .= "i.name = '$name', "
    if(!strcmp('$location', ""))
      $query .= "i.location = '$location', "
    if(!strcmp('$condition', ""))
      $query .= "i.condition = '$condition' "

    $query .= "FROM item WHERE '$id' = i.id";
    $result = pg_query($query) or die('Query failed: ' . pg_last_error());
    header("Refresh:0"); //Update page
    */
  }


  if(isset($_POST['delete'])) {
    $id = $_POST['ID'];
    $bidder_email = $_POST['Bidder_Email'];
    $query = "DELETE FROM bid WHERE '$id' = bid.item_id AND '$bidder_email' = bid.bidder_email";
  }
  $result = pg_query($query) or die('Query failed: ' . pg_last_error());
  header("Refresh:0"); //Update page
  pg_free_result($result);
  pg_close($dbconn);
?>
</td> </tr>
</table>
</body>
</html>
