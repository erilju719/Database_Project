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
                <input type="text" name = "searched" placeholder="Eg. Lawnmower" class="form-control" id="searchbar">
              </div>
              <button type="submit" name = "formSubmit" class="btn btn-primary" id="searchIcon">
                <span class = "glyphicon glyphicon-search"></span>
              </button>
            </form></li>
            <li><a href = "index.php" id="barIcon"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
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
                            <input type="text" class="form-control" name="startDate" placeholder="YYYY/MM/DD" required data-bv-notempty-message="Start date required"
                            data-bv-date="true" data-bv-date-format="YYYY/MM/DD" data-bv-date-message="Invalid date" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">End Date</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="endDate" placeholder="YYYY/MM/DD" required data-bv-notempty-message="End date required"
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
				The item is not availible during this time period.
				</div>';
		}
        pg_free_result($result);
        }
        ?>
    </div>


</body>

<script type="text/javascript">
    $(document).ready(function() {
        $('#bidForm').bootstrapValidator();
    });
</script>


</html>












