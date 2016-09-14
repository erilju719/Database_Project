<html>
<head>
  <title>Stuffshare</title>
  <style>
    table {border-collapse: collapse;}
    table, th, td {border: 1px solid black;}
</style>
</head>
<body>

<table>
<tr> <td colspan="5" style="background-color:#FFA500; text-align:center;">
<h1> Ur itemz </h1> </td>
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
  $usermail = "derp12@gmail.com";
	$query = "SELECT i.id, i.name, i.location, i.condition, i.availability FROM item i WHERE i.owner = '$usermail'";
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
  pg_close($dbconn);
?>

</table>


<br><br><br><br>



<table>
<tr> <td colspan="4" style="background-color:#FFA500; text-align:center;">
<h1> Bidz on ur itemz</h1> </td>
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
  $usermail = "derp12@gmail.com";
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
            $usermail = "derp12@gmail.com";
            $bidder_email = $_POST['Bidder_email'];
            $item_id = $_POST['ID'];
            $choice = $_POST['Choice'];
            $query = "UPDATE bid SET status = '$choice' FROM item WHERE bid.item_id = item.id AND item.id = $item_id AND bid.bidder_email = '$bidder_email' AND item.owner = '$usermail'";
            $result = pg_query($query) or die('Query failed: ' . pg_last_error());
            header("Refresh:0"); //Uppdatera sidan!
            pg_free_result($result);
            pg_close($dbconn);
        }
?>

<br><br>

<table>
<tr> <td colspan="4" style="background-color:#FFA500; text-align:center;">
<h1> Ur bidz </h1> </td>
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
  $usermail = "derp12@gmail.com";
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
