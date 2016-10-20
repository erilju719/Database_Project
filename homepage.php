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
  <table class = "table table-striped">
    <h2>Your items</h2>
    <thead>
      <tr class ="info">
        <th>Item ID</th>
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
  </tbody>
  </table>


<br><br>


<table class = "table table-striped">
  <h2>Bids on your items</h2>
  <thead>
    <tr class = "info">
      <th>Item ID</th>
      <th>Item Name</th>
      <th>Bidder Email</th>
      <th>Fee</th>
      <th>Start Date</th>
      <th>End Date</th>
      <th>Status</th>
      <th>Accept / Decline bid</th>
    </tr>
  </thead>

  <tbody>
  <?php
  $usermail = $_SESSION['emailaddress'];
	$query = "SELECT b.id, i.id, i.name, b.bidder_email, b.fee, b.startDate, b.endDate, b.status FROM item i, bid b WHERE i.id = b.item_id AND i.owner = '$usermail'";
  $result = pg_query($query) or die('Query failed: ' . pg_last_error());

  //echo "<b>SQL: </b>".$query."<br><br>";

	while ($line = pg_fetch_array($result, null, PGSQL_NUM)) {
    $status = $line[7];
    
    if($status=="Accepted"){
      echo "\t<tr class='success'>\n";
    } elseif($status=="Declined"){
      echo "\t<tr class='danger'>\n";
    } else {
      echo "\t<tr class='warning'>\n";
    }

    for ($x=1;$x<=7;$x++) {
      echo "\t\t<td>".$line[$x]."</td>\n";
    }
    if($status == "Pending"){
      echo "<td>\n";
      echo "\t<form method='post'>\n";
      echo "\t\t<input type='hidden' name='Bidder_email' id='Bidder_email' value=".$line[3].">\n";
      echo "\t\t<input type='hidden' name='bid_id' id='bid_id' value=".$line[0].">\n"; 
      echo "\t\t<button type='submit' name='BidSubmit' value='Accepted' class='btn btn-success'>Accept</button>\n";
      echo "\t<button type='submit' name='BidSubmit' value='Declined' class='btn btn-warning'>Decline</button>\n";
      echo "\t</form>\n";
      echo "</td>";
    }
    echo "\t</tr>\n";
    }

	pg_free_result($result);
  ?>
  </tbody>
  </table>

  <?php
        if(isset($_POST['BidSubmit'])) {
            $usermail = $_SESSION['emailaddress'];
            $bidder_email = $_POST['Bidder_email'];
            $bid_id = $_POST['bid_id'];
            $choice = $_POST['BidSubmit'];
            $query = "UPDATE bid SET status = '$choice' FROM item WHERE bid.item_id = item.id AND bid.id = '$bid_id' AND bid.bidder_email = '$bidder_email' AND item.owner = '$usermail'";
            $result = pg_query($query) or die('Query failed: ' . pg_last_error());

            if($choice=='Accepted') {
              $getDatesQuery = "SELECT item_id, startDate, endDate FROM bid WHERE bid.id = '$bid_id'";
              $result = pg_query($getDatesQuery);
              $line = pg_fetch_array($result, null, PGSQL_NUM);
              $item_id = $line[0];
              $startDate = $line[1];
              $endDate = $line[2];

              $autoDeclineQuery = "UPDATE bid SET status = 'Declined' WHERE 
              bid.item_id = '$item_id' AND bid.id<>'$bid_id' AND
              ((bid.endDate>='$startDate' AND bid.endDate<='$endDate') OR 
              (bid.startDate>='$startDate' AND bid.startDate<='$endDate') OR 
              (bid.startDate<='$startDate' AND bid.endDate>='$endDate'))";
            }
            pg_query($autoDeclineQuery);
            header("Refresh:0"); //Update page
            pg_free_result($result);
        }
        ?>

  <br><br>

    <table class="table table-striped">
    <h2>Your bids</h2>
    <thead>
        <tr class="info">
            <th>Item ID</th>
            <th>Item Name</th>
            <th>Description</th>
            <th>Owner Email</th>
            <th>Fee</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Status</th>
        </tr>
    </thead>

    <tbody>
    <?php
      $usermail = $_SESSION['emailaddress'];
      $query = "SELECT i.id, i.name, i.description, i.owner, b.fee, b.startDate, b.endDate, b.status FROM bid b,item i WHERE b.bidder_email = '$usermail' AND b.item_id=i.id";
      $result = pg_query($query) or die('Query failed: ' . pg_last_error());
      while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
        if($line['status']=="Accepted") {
          echo "\t<tr class='success'>\n";
        } elseif($status=="Declined") {
          echo "\t<tr class='danger'>\n";
        } else {
          echo "\t<tr class='warning'>\n";
        }
        foreach ($line as $col_value) {
          echo "\t\t<td>$col_value</td>\n";
        }
        echo "\t</tr>\n";
      }
      pg_free_result($result);
      ?>
      </tbody>
   </table>
</div>
<?php
pg_close($dbconn);
?>
</body>
</html>
