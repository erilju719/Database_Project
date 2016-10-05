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
          <form class="navbar-form" method="post" action="search.php">
            <div class="form-group" id="search-form">
              <input type="text" name = "searched" placeholder="Eg. Lawnmower" class="form-control" id="searchbar">
            </div>
            <button type="submit" name = "formSubmit" class="btn btn-primary">
              <span class = "glyphicon glyphicon-search" id="search-btn"></span>
            </button>
          </form>
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
                      data-bv-message="This value is not valid"
                      data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
                      data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
                      data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Rate</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="rate" placeholder="Enter Bid Price in SGD" required data-bv-notempty-message="Bid rate is necessary" data-bv-numeric="true" data-bv-numeric-message="Must be numeric" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-lg-3 control-label">Duration</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="duration" placeholder="No. of days you wish to borrow item for"
                                   required data-bv-notempty-message="Duration is required and cannot be empty"
                                   data-bv-integer="true" data-bv-integer-message="Invalid whole number" />
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-lg-12 col-lg-offset-5">
                            <button type="submit" class="btn btn-primary" name="formSubmit">Place your bid!</button>
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
        $rate = $_POST['rate'];
        $duration = $_POST['duration'];
        $username = $_SESSION['emailaddress'];
        $query = "INSERT INTO bid(rate,duration,item_id,bidder_email) VALUES('$rate','$duration','$id','$username')";
        $result = pg_query($query);
        if ($result) {
            echo '<div class="alert alert-success">
            Bid successfully placed!
            </div>';
        } else {
            echo '<div class="alert alert-danger">
            Please try again.
            </div>';
            echo pg_last_error();
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












