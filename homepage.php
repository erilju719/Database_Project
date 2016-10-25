<?php
// Start the session
session_start();
?>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="refresh" content="20">

    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link href="assets/bootstrap/css/homepage.css" rel="stylesheet">

    <script type="text/javascript" src="assets/jquery/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>

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
                <input type="text" name = "searched" placeholder="Eg. Shirt" class="form-control" id="searchbar">
              </div>

              <div class= "btn-group">
                <button type = "button" class = "btn btn-primary dropdown-toggle" data-toggle = "dropdown" aria-expanded="false"" id="searchIcon"">
                <span class = "glyphicon glyphicon-filter"></span>
                </button>

                <div class = "dropdown-menu" role = "menu">
                  <div class="form-group">
                      <label>Location</label>
                      <select name = "location" value="All">
                        <option value="All">Any</option>
                        <option value="Admiralty">Admiralty</option>
                        <option value="Alexandra">Alexandra</option>
                        <option value="Ang Mo Kio">Ang Mo Kio</option>
                        <option value="Balestier">Balestier</option>
                        <option value="Balmoral">Balmoral</option>
                        <option value="Beach Road">Beach Road</option>
                        <option value="Bedok">Bedok</option>
                        <option value="Bishan">Bishan</option>
                        <option value="Braddell">Braddell</option>
                        <option value="Boon Lay">Boon Lay</option>
                        <option value="Bugis">Bugis</option>
                        <option value="Bukit Batok">Bukit Batok</option>
                        <option value="Bukit Merah">Bukit Merah</option>
                        <option value="Bukit Timah">Bukit Timah</option>
                        <option value="Bukit Panjang">Bukit Panjang</option>
                        <option value="Buona Vista">Buona Vista</option>
                        <option value="Cecil">Cecil</option>
                        <option value="Changi">Changi</option>
                        <option value="Choa Chu Kang">Choa Chu Kang</option>
                        <option value="Chinatown">Chinatown</option>
                        <option value="City Hall">City Hall</option>
                        <option value="Clark Quay">Clark Quay</option>
                        <option value="Clementi">Clementi</option>
                        <option value="Dairy Farm">Dairy Farm</option>
                        <option value="Farrer Park">Farrer Park</option>
                        <option value="Flora">Flora</option>
                        <option value="Geylang">Geylang</option>
                        <option value="Harbourfront">Harbourfront</option>
                        <option value="Hillview">Hillview</option>
                        <option value="Holland Village">Holland Village</option>
                        <option value="Hougang">Hougang</option>
                        <option value="Joo Chiat">Joo Chiat</option>
                        <option value="Jurong East">Jurong East</option>
                        <option value="Jurong West">Jurong West</option>
                        <option value="Alexandra">Alexandra</option>
                        <option value="Kallang">Kallang</option>
                        <option value="Katong">Katong</option>
                        <option value="Kranji">Kranji</option>
                        <option value="Little India">Little India</option>
                        <option value="Lim Chu Kang">Lim Chu Kang</option>
                        <option value="Loyang">Loyang</option>
                        <option value="Mandai">Mandai</option>
                        <option value="Marina">Marina</option>
                        <option value="Marine Parade">Marine Parade</option>
                        <option value="Macpherson">Macpherson</option>
                        <option value="Mount Faber">Mount Faber</option>
                        <option value="Novena">Novena</option>
                        <option value="Newton">Newton</option>
                        <option value="Orchard">Orchard</option>
                        <option value="Pasir Panjang">Pasir Panjang</option>
                        <option value="Pasir Ris">Pasir Ris</option>
                        <option value="Paya Lebar">Paya Lebar</option>
                        <option value="Punggol">Punggol</option>
                        <option value="Queenstown">Queenstown</option>
                        <option value="Raffles Place">Raffles Place</option>
                        <option value="River Valley">River Valley</option>
                        <option value="Seletar">Seletar</option>
                        <option value="Sembawang">Sembawang</option>
                        <option value="Sengkang">Sengkang</option>
                        <option value="Serangoon">Serangoon</option>
                        <option value="Siglap">Siglap</option>
                        <option value="Tampines">Tampines</option>
                        <option value="Tanjong Pagar">Tanjong Pagar</option>
                        <option value="Telok Blangah">Telok Blangah</option>
                        <option value="Tengah">Tengah</option>
                        <option value="Thomson">Thomson</option>
                        <option value="Tiong Bahru">Tiong Bahru</option>
                        <option value="Toa Payoh">Toa Payoh</option>
                        <option value="Tuas">Tuas</option>
                        <option value="Ulu Pandan">Ulu Pandan</option>
                        <option value="Upper Bukit Timah">Upper Bukit Timah</option>
                        <option value="Upper East Coast">Upper East Coast</option>
                        <option value="Woodlands">Woodlands</option>
                        <option value="Yio Chu Kang">Yio Chu Kang</option>
                        <option value="Yishun">Yishun</option>
                      </select>
                  </div>
                  <div role="separator" class="divider">
                  </div>
                  <div class="form-group">
                    <label>Condition</label>
                    <select name = "condition" value="All">
                        <option value="All">Any</option>
                        <option value="Excellent">Excellent</option>
                        <option value="Good">Good</option>
                        <option value="Poor">Poor</option>
                    </select>
                  </div>
                </div>
                <button type="submit" name = "formSubmit" class="btn btn-primary" id="searchIcon">
                  <span class = "glyphicon glyphicon-search"></span>
                </button>
              </div>
            </form></li>
            <li><a href = "index.php" id="barIcon"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
            </ul>
          </div>
      </nav>

  <div class="jumbotron">
  <table class = "table table-sm">
    <h2>Your items</h2>
    <thead>
      <tr class ="info">
        <th>Item ID</th>
        <th>Name</th>
        <th>Location</th>
        <th>Description</th>
        <th>Condition</th>
        <th>Edit / Modify bid</th>
      </tr>
    </thead>

    <tbody>
    <?php
      $dbconn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=postgres")
        or die('Could not connect: ' . pg_last_error());
        $usermail = $_SESSION['emailaddress'];
        $query = "SELECT i.id, i.name, i.location, i.description, i.condition FROM item i WHERE i.owner = '$usermail' AND i.hidden='FALSE'";
        $result = pg_query($query) or die('Query failed: ' . pg_last_error());

	 while ($line = pg_fetch_array($result, null, PGSQL_NUM)) {
      echo "<tr class='warning'>\n";
      foreach ($line as $col_value) {
        echo "<td>$col_value</td>\n";
        }

      echo "<td>\n";
      //Edit Item Button
      echo "\t<form method='post' action='modItem.php'>\n";
      echo "\t\t<input type='hidden' name='item_id' id='item_id' value=".$line[0].">\n";
      echo "\t\t<button type='submit' name='ItemSubmit' value='Edit' class='btn btn-warning'>Edit Item</button>\n";
      echo "\t</form>\n";
      //Delete Item Button
      echo "\t<form method='post'>\n";
      echo "\t\t<input type='hidden' name='item_id' id='item_id' value=".$line[0].">\n";
      echo "\t<button type='submit' name='deleteItem' value='Delete' class='btn btn-danger'>Delete Item</button>\n";
      echo "\t</form>\n";
      echo "</td>";
    }
      if(isset($_POST['deleteItem'])) {
            $item_id = $_POST['item_id'];
            $query =  "UPDATE item SET hidden='TRUE' WHERE id = '$item_id'";
            $result = pg_query($query) or die('Query failed: ' . pg_last_error());
            echo '<div class="alert alert-success">
            Item successfully deleted! Page will automatically refresh in a moment.
            </div>';

            $query2 = "UPDATE bid SET status = 'Declined' WHERE bid.item_id = '$item_id' AND status = 'Pending'";
            $result = pg_query($query2) or die('Query failed: ' . pg_last_error());
      }
	pg_free_result($result);
  ?>
  </tbody>
  </table>


<br><br>


<table class = "table table-sm">
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
            pg_query($autoDeclineQuery) or die('Query failed: ' . pg_last_error());
            echo "<script>alert('Bid has been accepted/declined! Page will auto refresh in a moment.');</script>";
            header("refresh:1;"); //Update page
            pg_free_result($result);
        }
        ?>

  <br><br>

    <table class="table table-sm">
    <h2>Your bids</h2>
    <thead>
        <tr class="info">
            <th>Item ID</th>
            <th>Bid ID</th>
            <th>Item Name</th>
            <th>Description</th>
            <th>Condition</th>
            <th>Owner Email</th>
            <th>Fee</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Status</th>
            <th>Delete Bid</th>
        </tr>
    </thead>

    <tbody>
    <?php
      $usermail = $_SESSION['emailaddress'];
      $query = "SELECT i.id AS itemID, b.id AS bidID, i.name, i.description, i.condition, i.owner, b.fee, b.startDate, b.endDate, b.status FROM bid b,item i WHERE b.bidder_email = '$usermail' AND b.item_id=i.id";
      $result = pg_query($query) or die('Query failed: ' . pg_last_error());
      while ($line = pg_fetch_array($result, null, PGSQL_NUM)) {
        $status = $line[9];
        if($status=="Accepted") {
          echo "\t<tr class='success'>\n";
        } elseif($status=="Declined") {
          echo "\t<tr class='danger'>\n";
        } else {
          echo "\t<tr class='warning'>\n";
        }
        foreach ($line as $col_value) {
          echo "\t\t<td>$col_value</td>\n";
        }
        if($status=="Pending") {
          echo "\t\t<td>\n";
          echo "\t<form method='post'>\n";
          echo "\t\t<input type='hidden' name='bid_id' id='bid_id' value=".$line[1].">\n";
          echo "\t\t<button type='submit' name='deleteBid' class='btn btn-danger'>";
          echo "Delete Bid</button>\n";
          echo "\t\t</form>\n";
          echo "\t\t</td>\n";
        }
        echo "\t</tr>\n";
      }
      pg_free_result($result);
      ?>
      </tbody>
  </table>

  <?php
        if(isset($_POST['deleteBid'])) {
            $bid_id = $_POST['bid_id'];
            $query = "DELETE FROM bid WHERE bid.id = '$bid_id'";
            $result = pg_query($query) or die('Query failed: ' . pg_last_error());
            echo '<div class="alert alert-success">
            Bid successfully deleted! Page will automatically refresh in a moment.
            </div>';
            pg_free_result($result);
        }
  ?>
</div>

<?php
pg_close($dbconn);
?>

<script type="text/javascript">
    $('.dropdown-menu').click(function(e) {
        e.stopPropagation();
    });
</script>

</body>
</html>
