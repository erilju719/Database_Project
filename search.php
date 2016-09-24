<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html lang="en">
	<head>
    	<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1">
    	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">

      <link href="assets/bootstrap/css/search.css" rel="stylesheet">

      <script type="text/javascript" src="assets/jquery/jquery-1.10.2.min.js"></script>
      <script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
    	<title> Search page </title>
  	</head>

  	<body>
    <!-- Set up DB connection -->
    <?php
    $dbconn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=postgres")
    or die('Could not connect: ' . pg_last_error());
    ?>
      <!-- Top navigation bar (black) -->
      <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid">
          <div class="navbar-header">
          <a class="navbar-brand" href = "homepage.php">Stuffshare</a>
          </div>
          <form class="navbar-form" method="post">
            <div class="form-group" id="search-form">
              <input type="text" name = "searched" placeholder="Eg. Lawnmower" class="form-control" id="searchbar">
            </div>
            <button type="submit" name = "formSubmit" class="btn btn-primary">
              <span class = "glyphicon glyphicon-search" id="search-btn"></span>
            </button>
          </form>
        </div>
      </nav>


      <!-- Main body -->
  		<div class="jumbotron">
      		<div class="container-fluid" id ="jumbo-text">
      		<h1>Go ahead, search for something!</h1>
      		<p>Your search results will display below.</p>
          </div>
      </div>

      <div class = "container-fluid">    
      <?php if(isset($_POST['formSubmit'])) {
        //Query
        $item = $_POST['searched'];
        $username = $_SESSION['emailaddress'];
        $query = "SELECT DISTINCT i.name AS item_name, i.condition AS condition, a.name AS owner_name
        FROM item i, account a 
        WHERE i.name LIKE '%$item%' AND i.owner!='$username' AND i.availability";
        $result = pg_query($query) or die('Query failed: ' . pg_last_error());

        //Display query result
        $count = 0;
        while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
          if ($count % 2 == 0) {
            echo "\t<div class='col-md-4' id='line-odd'>\n";
          } else {
            echo "\t<div class='col-md-4' id='line-even'>\n";
          }

          echo "\t\t<div class ='row-fluid'>\n";
          echo "\t\t\t<div class='col-md-9'>\n";

          echo "\t\t\t\t<h3 class = 'entry-odd'>";
          echo "Item name: " . $line[item_name] . "</h3>\n";

          echo "\t\t\t\t<h3 class = 'entry-even'>";
          echo "Condition: " . $line[condition] . "</h3>\n";

          echo "\t\t\t\t<h3 class = 'entry-odd'>";
          echo "Owner: " . $line[owner_name] . "</h3>\n";

          echo "\t\t\t</div>\n";

          echo "\t\t\t<div class='col-md-3' id = 'bid-col'>\n";
          echo "\t\t\t\t<a href='bid.php' class='btn btn-info' role='button'>Add bid!</a>\n";
          echo "\t\t\t</div>\n"; 
          echo "\t\t</div>\n";
          echo "\t\t</div>\n";
          $count++;
        } 
      pg_free_result($result);
      }
      ?>

      <?php pg_close($dbconn); ?> 
      </div>
</body>
</html>