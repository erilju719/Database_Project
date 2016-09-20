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
          <a class="navbar-brand" href = "#">Stuffshare</a>
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
      		<div class="container" id ="jumbo-text">
      		<h1>Go ahead, search for something!</h1>
      		<p>Your search results will display below.</p>
          </div>
      </div>
          
      <?php if(isset($_POST['formSubmit'])) {
        $title = $_POST['searched'];
        $query = "SELECT DISTINCT b.title FROM book b WHERE b.title LIKE '%$title%'";
        $result = pg_query($query) or die('Query failed: ' . pg_last_error());
        $count = 0;
        while ($line = pg_fetch_array($result, null, PGSQL_ASSOC)) {
          foreach ($line as $col_value) {
            echo '<div class="col-md-4">';
            if ($count % 2 == 0) {
              echo '<h2 class="entry-odd">';
              echo "$col_value</h2>";
            } else {
              echo '<h2 class="entry-even">';
              echo "$col_value</h2>";
            }
            echo '<a href="bid.php" class="btn btn-info" role="button">Add/modify bid!</a>';
            echo "</div>";
            $count++;
            }
          } 
          pg_free_result($result);
        }
        ?>

      <?php pg_close($dbconn); ?> 

</body>
</html>