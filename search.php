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
          </div>
      </nav>


      <!-- Main body -->
  		<div class="jumbotron">
      		<div class="container-fluid" id ="jumbo-text">
      		<h1>Go ahead, search for something!</h1>
      		<p>Your search results are displayed below.</p>
          </div>
      </div>

      <div class = "container-fluid">
      <?php if(isset($_POST['formSubmit'])) {
        //Query
        $item = $_POST['searched'];
        $username = $_SESSION['emailaddress'];
        $query = "SELECT DISTINCT i.name, i.condition, i.description, a.name, i.id FROM item i, account a WHERE UPPER(i.name) LIKE UPPER('%$item%') AND i.owner!='$username' AND i.availability AND a.email=i.owner";
        $result = pg_query($query) or die('Query failed: ' . pg_last_error());

        //Display query result
        $count = 0;
        while ($line = pg_fetch_array($result, null, PGSQL_NUM)) {
          if ($count % 2 == 0) {
            echo "\t<div class='col-md-4' id='line-odd'>\n";
          } else {
            echo "\t<div class='col-md-4' id='line-even'>\n";
          }

          echo "\t\t<div class ='row-fluid'>\n";
          echo "\t\t\t<div class='col-md-9'>\n";

          echo "\t\t\t\t<h3 class = 'entry-odd'>";
          echo "Item name: " . $line[0] . "</h3>\n";

          echo "\t\t\t\t<h3 class = 'entry-even'>";
          echo "Condition: " . $line[1] . "</h3>\n";

          echo "\t\t\t\t<h3 class = 'entry-odd'>";
          if (is_null($line[2])) {
            echo "Description: None </h3>\n";
          } else {
            echo "Description: " . $line[2] . "</h3>\n";
          }
          
          echo "\t\t\t\t<h3 class = 'entry-even'>";
          echo "Owner: " . $line[3] . "</h3>\n";

          echo "\t\t\t</div>\n";

          echo "\t\t\t<div class='col-md-3' id = 'bid-col'>\n";
          echo "\t\t\t\t<a href='bid.php?id=".$line[4]."' class='btn btn-info' role='button'> Add bid!</a>\n";
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
