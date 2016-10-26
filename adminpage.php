<?php
// Start the session
session_start();
?>

<html>
<head>
    <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!--<meta http-equiv="refresh" content="20">-->

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
<tr> <td colspan="6" style="background-color:#FFA500; text-align:center;">
<h1> All Items</h1> </td>
</tr>


<tr>
  <td style="background-color:#eeeeee;">ID</td>
  <td style="background-color:#eeeeee;">Owner</td>
  <td style="background-color:#eeeeee;">Name</td>
  <td style="background-color:#eeeeee;">Location</td>
  <td style="background-color:#eeeeee;">Condition</td>
  <td style="background-color:#eeeeee;">Delete</td>
</tr>

<?php
  $dbconn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=postgres")
    or die('Could not connect: ' . pg_last_error());
  $usermail = $_SESSION['emailaddress'];
	$query = "SELECT i.id, i.owner, i.name, i.location, i.condition FROM item i WHERE i.hidden = 'FALSE' ORDER BY i.id";
  $result = pg_query($query) or die('Query failed: ' . pg_last_error());

  //echo "<b>SQL: </b>".$query."<br><br>";

	while ($line = pg_fetch_array($result, null, PGSQL_NUM)) {
    echo "<tr class ='warning'>\n";
    foreach ($line as $col_value) {
        echo "<td style='background-color:#eeeeee;'>$col_value</td>\n";
    }
    echo "\t\t<td style='background-color:#eeeeee;'>\n";
    echo "\t<form method='post'>\n";
    echo "\t\t<input type='hidden' name='yoon' id='yoon' value=".$line[0].">\n";
    echo "\t\t<button type='submit' name='deleteItem' class='btn btn-danger'>";
    echo "Delete Item</button>\n";
    echo "\t\t</form>\n";
    echo "\t\t</td>\n";
    echo "</tr>\n";
  }
  if(isset($_POST['deleteItem'])) {
    $x = $_POST['yoon'];
    $query =  "UPDATE item SET hidden='TRUE' WHERE id = '$x'";
    $result = pg_query($query) or die('Query failed: ' . pg_last_error());
    echo '<div class="alert alert-success">
    Item successfully deleted! Page will automatically refresh in a moment.
    </div>';
    $query2 = "UPDATE bid SET status = 'Declined' WHERE bid.item_id = '$x' AND status = 'Pending'";
    $result = pg_query($query2) or die('Query failed: ' . pg_last_error());
  }
	pg_free_result($result);
  pg_close($dbconn);
?>
</table>


<br>

<form method="post">
        ID: <input type="text" name="ID" id="ID">
        Owner: <input type="text" name="Owner" id="owner">
        Name: <input type="text" name="Name" id="name">
        Location: <input type="text" name="Location" id="location">
        Condition: <input type="text" name="Condition" id="condition">
        <input type="submit" name="modify" value="Modify" >
</form>

<br><br><br>

<?php
  $dbconn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=postgres")
            or die('Could not connect: ' . pg_last_error());
  if(isset($_POST['modify'])) {
    $id = $_POST['ID'];
    $owner = $_POST['Owner'];
    $name = $_POST['Name'];
    $location = $_POST['Location'];
    $condition = $_POST['Condition'];
    
    $query = "UPDATE item i SET ";
    $comma = false;
    if(!empty($owner)){
      $query .= " owner ='$owner'";
      $comma = true;
    }
    if(!empty($name)){
      if($comma){
        $query .= ", name = '$name'";
      }
      else{
        $query .= " name = '$name'";
        $comma = true;
      }
    }
    if(!empty($location)){
      if($comma){
        $query .= ", location = '$location'";
      }
      else{
        $query .= " location = '$location' ";
        $comma = true;
      }
    }
    if(!empty($condition)){
      if($comma){
        $query .= ", condition = '$condition'";
      }
      else{
        $query .= " condition = '$condition'";
      }
    }
    $query .= " WHERE i.id = '$id'";
    $result = pg_query($query) or die('Query failed: ' . pg_last_error());
    pg_free_result($result);
    pg_close($dbconn);
    header("Refresh:1");
  }  
?>

<br><br>

<table>
<tr> <td colspan="8" style="background-color:#FFA500; text-align:center;">
<h1> All Bids </h1> </td>
</tr>

<tr>
  <td style="background-color:#eeeeee;">Bid ID</td>
  <td style="background-color:#eeeeee;">Bidder</td>
  <td style="background-color:#eeeeee;">Name</td>
  <td style="background-color:#eeeeee;">Start Date</td>
  <td style="background-color:#eeeeee;">End Date</td>  
  <td style="background-color:#eeeeee;">Owner</td>
  <td style="background-color:#eeeeee;">Status</td>
  <td style="background-color:#eeeeee;">Delete</td>
</tr>

<?php
  $dbconn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=postgres")
    or die('Could not connect: ' . pg_last_error());


  $usermail = $_SESSION['emailaddress'];
	$query = "SELECT b.id, b.bidder_email, i.name, b.startDate, b.endDate, i.owner, b.status FROM item i, bid b WHERE i.id=b.item_id ORDER BY b.id;";
  $result = pg_query($query) or die('Query failed: ' . pg_last_error());


  while ($line = pg_fetch_array($result, null, PGSQL_NUM)) {
    echo "<tr>\n";
    foreach ($line as $col_value) {
        echo "<td style='background-color:#eeeeee;'>$col_value</td>\n";
    }
    echo "\t\t<td style='background-color:#eeeeee;'>\n";
    echo "\t<form method='post'>\n";
    echo "\t\t<input type='hidden' name='bid_id' id='bid_id' value=".$line[0].">\n";
    echo "\t\t<button type='submit' name='deleteBid' class='btn btn-danger'>";
    echo "Delete Bid</button>\n";
    echo "\t\t</form>\n";
    echo "\t\t</td>\n";
    echo "</tr>\n";
    echo "</tr>\n";
  }
  if(isset($_POST['deleteBid'])) {
      $bid_id = $_POST['bid_id'];
      $query = "DELETE FROM bid WHERE bid.id = '$bid_id'";
      $result = pg_query($query) or die('Query failed: ' . pg_last_error());
      echo '<div class="alert alert-success">
      Bid successfully deleted! Page will automatically refresh in a moment.
      </div>';
      pg_free_result($result);
  }

  pg_free_result($result);
  pg_close($dbconn);
?>



<form method="post">
        Bid ID: <input type="text" name="ID" id="ID">
        Bidder: <input type="text" name="Bidder" id="bidder">
        Name: <input type="text" name="Name" id="name">
        Start Date: <input type="date" name = "startDate" >
        End Date: <input type="date" name="endDate">
        Owner: <input type="text" name="Owner" id="owner">
        Status: <input type="text" name="Status" id="status">
        <input type="submit" name="modify1" value="Modify" >
</form>

<br>


<?php
  $dbconn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=postgres")
            or die('Could not connect: ' . pg_last_error());

  if(isset($_POST['modify1'])) {
    $id = $_POST['ID'];
    $bidder = $_POST['Bidder'];
    $name = $_POST['Name'];
    $sDate = $_POST['startDate'];
    $eDate = $_POST['endDate'];
    $owner = $_POST['Owner'];
    $status = $_POST['Status'];
    $comma = false;
    if(!empty($bidder) or !empty($status) or !empty($sDate) or !empty($eDate)){
        $query = "UPDATE bid SET ";
    if(!empty($bidder)){
      $query .= "bidder_email = '$bidder'";
      $comma = true;
    }
    if(!empty($status)){
      if($comma){
        $query .= ", status = '$status'";
      }
      else{
        $query .= "status = '$status'";
        $comma = true;
      }
    }
    if(!empty($sDate)){
      if($comma){
        $query .= ", startDate = '$sDate'";
      }
      else{
        $query .= "startDate = '$sDate'";
        $comma = true;
      }
    }
    if(!empty($eDate)){
      if($comma){
        $query .= ", endDate = '$eDate'";
      }
      else{
        $query .= "endDate = '$eDate'";
        $comma = true;
      }
    }
    $query .= " WHERE id = '$id'";
    echo $query . "\n";
    $result = pg_query($query) or die('Query failed: ' . pg_last_error());
    pg_free_result($result);
    }
    

    $comma = false;
    if(!empty($name) or !empty($owner)){
      $query = "UPDATE item SET ";
      if(!empty($name)){
        $query .= "name = '$name'";
        $comma = true;
      }
      if(!empty($owner)){
        if($comma){
          $query .= ", owner = '$owner'";
        }
        else{
          $query .= "owner = '$owner'";
          $comma = true;
        }
      }
      $query .= " FROM bid b WHERE b.id = '$id' AND b.item_id = item.id";
      $result = pg_query($query) or die('Query failed: ' . pg_last_error());
      pg_free_result($result);
      pg_close($dbconn);
      header("Refresh:1");
    }
    
  }
?>
</td> </tr>
</table>
</body>
</html>
