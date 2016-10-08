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
<h1> Your items </h1> </td>
</tr>

<tr>
  <td style="background-color:#eeeeee;">ID</td>
  <td style="background-color:#eeeeee;">Name</td>
  <td style="background-color:#eeeeee;">Location</td>
  <td style="background-color:#eeeeee;">Condition</td>
  <td style="background-color:#eeeeee;">Availability</td>
</tr>

<?php
  $dbconn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=postgres")
    or die('Could not connect: ' . pg_last_error());
  $usermail = $_SESSION['emailaddress'];
	$query = "SELECT i.id, i.name, i.location, i.condition, i.availability FROM item i WHERE i.owner = '$usermail'";
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



<table>
<tr> <td colspan="4" style="background-color:#FFA500; text-align:center;">
<h1> Bids on your items</h1> </td>
</tr>

<tr>
  <td style="background-color:#eeeeee;">ID</td>
  <td style="background-color:#eeeeee;">Name</td>
  <td style="background-color:#eeeeee;">Bidder email</td>
  <td style="background-color:#eeeeee;">Status</td>
</tr>

<?php
  $dbconn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=postgres")
    or die('Could not connect: ' . pg_last_error());
  $usermail = $_SESSION['emailaddress'];
	$query = "SELECT i.id, i.name, b.bidder_email, b.status FROM item i, bid b WHERE i.id = b.item_id AND i.owner = '$usermail'";
  $result = pg_query($query) or die('Query failed: ' . pg_last_error());

  //echo "<b>SQL: </b>".$query."<br><br>";

	while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "\t<tr>\n";
    foreach ($line as $col_value) {
        echo "\t\t<td>$col_value</td>\n";
    }
    echo "\t</tr>\n";
  }

	pg_free_result($result);
?>
</td> </tr>
<?php
pg_close($dbconn);
?>

</table>

<br><br>

<form method="post">
        ID: <input type="text" name="ID" id="ID">
        Bidder email: <input type="text" name="Bidder_email" id="Bidder_email">
        <input type="radio" name="Choice" id="Accept" value="Accepted">Accept
        <input type="radio" name="Choice" id="Decline" value="Declined">Decline
        <input type="submit" name="BidSubmit" value="Accept" >
</form>

<?php
        if(isset($_POST['BidSubmit'])) {
            $dbconn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=postgres")
            or die('Could not connect: ' . pg_last_error());
            $usermail = $_SESSION['emailaddress'];
            $bidder_email = $_POST['Bidder_email'];
            $item_id = $_POST['ID'];
            $choice = $_POST['Choice'];
            $query = "UPDATE bid SET status = '$choice' FROM item WHERE bid.item_id = item.id AND item.id = $item_id AND bid.bidder_email = '$bidder_email' AND item.owner = '$usermail'";
            $result = pg_query($query) or die('Query failed: ' . pg_last_error());
            header("Refresh:0"); //Update page
            pg_free_result($result);
            pg_close($dbconn);
        }
?>

<br><br>

<table>
<tr> <td colspan="4" style="background-color:#FFA500; text-align:center;">
<h1> Your bids </h1> </td>
</tr>

<tr>
  <td style="background-color:#eeeeee;">ID</td>
  <td style="background-color:#eeeeee;">Name</td>
  <td style="background-color:#eeeeee;">Owner email</td>
  <td style="background-color:#eeeeee;">Status</td>
</tr>

<?php
  $dbconn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=postgres")
    or die('Could not connect: ' . pg_last_error());
  $usermail = $_SESSION['emailaddress'];
	$query = "SELECT i.id, i.name, i.owner, b.status FROM item i, bid b WHERE i.id = b.item_id AND b.bidder_email = '$usermail'";
  $result = pg_query($query) or die('Query failed: ' . pg_last_error());

  ?>

<?php
	while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
    echo "\t<tr>\n";
    foreach ($line as $col_value) {
        echo "\t\t<td>$col_value</td>\n";
    }
    echo "\t</tr>\n";
  }

	pg_free_result($result);
?>
</td> </tr>
<?php
pg_close($dbconn);
?>

</table>
</body>
</html>
