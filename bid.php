<?php
// Start the session
session_start();
$_SESSION["id"]=$_GET["id"];
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/bootstrap/css/bootstrapValidator.css"/>
        <link href="assets/bootstrap/css/bid.css" rel="stylesheet">

      <script type="text/javascript" src="assets/jquery/jquery-1.10.2.min.js"></script>
      <script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="assets/bootstrap/js/bootstrapValidator.js"></script>
        <title> Bid page </title>
    </head>

    <body>
    <!-- Set up DB connection, get owner email -->
    <?php
    $dbconn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=postgres")
    or die('Could not connect: ' . pg_last_error());
    $id = $_SESSION['id'];
    $query = "SELECT i.owner FROM item i WHERE i.id= '$id'";
    $result = pg_query($query) or die('Query failed: ' . pg_last_error());
    $owner = pg_fetch_array($result, null, PGSQL_NUM)[0];
    $_SESSION["owner"]=$owner;
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

    <div class="bidForm">
        <div class="row">
        <!-- form: -->
        <section>
            <div class="col-lg-8 col-lg-offset-2">
                <div class="page-header">
                    <h2>Place bid</h2>
                </div>

                <form id="bidForm" method="post" class="form-horizontal"
                      data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
                      data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
                      data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Fee</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="fee" placeholder="Enter Bid Price in SGD" required data-bv-notempty-message="Bid rate required" data-bv-numeric="true" data-bv-numeric-message="Must be numeric" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Start Date</label>
                        <div class="col-lg-6">
                            <input type="date" class="form-control" name="startDate" required data-bv-notempty-message="Start date required"
                            data-bv-date="true" data-bv-date-format="YYYY/MM/DD" data-bv-date-message="Invalid date" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">End Date</label>
                        <div class="col-lg-6">
                            <input type="date" class="form-control" name="endDate" required data-bv-notempty-message="End date required"
                            data-bv-date-format="YYYY/MM/DD" data-bv-date="true" data-bv-date-message="Invalid date" />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-12 col-lg-offset-5">
                            <button type="submit" class="btn btn-success" name="formSubmit">Place your bid!</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
        <!-- :form -->
        </div>
    </div>

    <div class = "container-fluid">
      <?php if(isset($_POST["formSubmit"])) {
        //Query
        $id = $_SESSION['id'];
        $fee = $_POST['fee'];
        $startDate = $_POST['startDate'];
        $endDate = $_POST['endDate'];
        $username = $_SESSION['emailaddress'];
        $owner = $_SESSION['owner'];
        if ($owner == $username) {
            echo "<div class='alert alert-danger'>
            Can't bid for your own item!
            </div>";
            exit();
        }
		$queryclash = "SELECT * FROM bid WHERE status='Accepted' AND item_id='$id'
							AND (endDate>='$startDate' AND endDate<='$endDate') OR (startDate>='$startDate' AND startDate<='$endDate') OR (startDate<='$startDate' AND endDate>='$endDate')";


		$resultclash = pg_query($queryclash);

		if(pg_num_rows($resultclash)==0) {
			$query = "INSERT INTO bid(fee,startDate,endDate,item_id,bidder_email) VALUES('$fee','$startDate','$endDate','$id','$username')";
			$result = pg_query($query);
			if ($result) {
				echo '<div class="alert alert-success">
				Bid successfully placed!
				</div>';
			} else {
				$error = pg_last_error();
				if (preg_match('/bid_check/i', $error)) {
					echo '<div class="alert alert-danger">
					End date must be later than start date
					</div>';
				} else {
				echo '<div class="alert alert-danger">
				Please try again.
				</div>';
				}
			}
		} else {
			echo '<div class="alert alert-danger">
				The item is not available during this time period.
				</div>';
		}
        pg_free_result($result);
        }
        ?>
    </div>

<script type="text/javascript">
    $('.dropdown-menu').click(function(e) {
        e.stopPropagation();
    });
</script>

</body>

<script type="text/javascript">
    $(document).ready(function() {
        $('#bidForm').bootstrapValidator();
    });
</script>
</html>
