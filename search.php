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
        $locationQuery = ' AND TRUE';
        $conditionQuery = ' AND TRUE';
        $location = $_POST['location'];
        if ($location != 'All') {
          $locationQuery = " AND i.location ='" . $location . "'"; 
        }

        $condition = $_POST['condition'];
        if ($condition != 'All') {
          $conditionQuery = " AND i.condition = '" . $condition . "'"; 
        }

        $username = $_SESSION['emailaddress'];
        $query = "SELECT DISTINCT i.name, i.condition, i.description, a.name, i.id 
                  FROM item i, account a 
                  WHERE UPPER(i.name) LIKE UPPER('%$item%') AND i.owner!='$username' AND a.email=i.owner AND i.hidden='FALSE'";
        $query .= $locationQuery;
        $query .= $conditionQuery;
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

<script type="text/javascript">
    $('.dropdown-menu').click(function(e) {
        e.stopPropagation();
    });
</script>
</body>
</html>
