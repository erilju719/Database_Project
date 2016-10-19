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

  <title>Stuffshare - Homepage</title>
</head>

<body>
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
      <ul class="nav navbar-nav">
        <li><a href = "homepage.php" id="barIcon"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        <li><a href = "addpage.php"  id="barIcon"><span class="glyphicon glyphicon-plus"></span> Add item</a></li>
        <li><form class="navbar-form" method="post" action = "search.php">
          <div class="form-group" id="search-form">
            <input type="text" name = "searched" placeholder="Eg. Lawnmower" class="form-control" id="searchbar">
          </div>
          <button type="submit" name = "formSubmit" class="btn btn-primary" id="searchIcon">
          <span class = "glyphicon glyphicon-search"></span>
          </button>
          </form></li>
          <li><a href = "index.php" id="barIcon"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
      </ul>
    </div>
  </nav>

  <div class="jumbotron">
  <table class = "table table-inverse">
    <h1> Your items </h1>
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Location</th>
        <th>Description</th>
        <th>Condition</th>
      </tr>
    </thead>

    <tbody>
    <?php
      $dbconn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=postgres")
        or die('Could not connect: ' . pg_last_error());
        $usermail = $_SESSION['emailaddress'];
        $query = "SELECT i.id, i.name, i.location, i.description, i.condition FROM item i WHERE i.owner = '$usermail'";
        $result = pg_query($query) or die('Query failed: ' . pg_last_error());

    //echo "<b>SQL: </b>".$query."<br><br>";

	 while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
      echo "<tr>\n";
      foreach ($line as $col_value) {
        echo "<td>$col_value</td>\n";
        }
      echo "</tr>\n";
    }
	pg_free_result($result);
  ?>
  </table>


<br><br>


<table class = "table table-inverse">
  <h1> Bids on your items </h1>
  <thead>
    <tr>
      <th>Item ID</th>
      <th>Name</th>
      <th>Bidder Email</th>
      <th>Status</th>
      <th>Start Date</th>
      <th>End Date</th>
    </tr>
  </thead>

  <tbody>
  <?php
  $usermail = $_SESSION['emailaddress'];
	$query = "SELECT i.id, i.name, b.bidder_email, b.status, b.startDate, b.endDate FROM item i, bid b WHERE i.id = b.item_id AND i.owner = '$usermail'";
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
</tbody>
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
            $usermail = $_SESSION['emailaddress'];
            $bidder_email = $_POST['Bidder_email'];
            $item_id = $_POST['ID'];
            $choice = $_POST['Choice'];
            $query = "UPDATE bid SET status = '$choice' FROM item WHERE bid.item_id = item.id AND item.id = $item_id AND bid.bidder_email = '$bidder_email' AND item.owner = '$usermail AND status = 'Pending' ";
            $result = pg_query($query) or die('Query failed: ' . pg_last_error());
            header("Refresh:0"); //Update page
            pg_free_result($result);
        }
?>

<br><br>

<table class="table table-inverse">
<h1> Your bids </h1>
<thead>
    <tr>
    <th>Item ID</th>
    <th>Bid ID</th>
    <th>Item Name</th>
    <th>Start Date</th>
    <th>End Date</th>
    <th>Owner Email</th>
    <th>Status</th>
    </tr>

<tbody>
<?php
  $usermail = $_SESSION['emailaddress'];
	$query = "SELECT i.id, b.num, i.name, b.startDate, b.endDate, i.owner, b.status FROM item i, bid b WHERE i.id = b.item_id AND b.bidder_email = '$usermail'";
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
</tbody>
<?php
pg_close($dbconn);
?>

</table>
</body>
</html>
