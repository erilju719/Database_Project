<?php
// Start the session
session_start();
?>

<html>
<head> 
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrapValidator.css"/>
    <link href="assets/bootstrap/css/addpage.css" rel="stylesheet">

    <script type="text/javascript" src="assets/jquery/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/bootstrap/js/bootstrapValidator.js"></script>
    <title>Add item-page</title> 
</head>

<body>

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

  <div class="addItem">
    <div class="row">
        <!-- form: -->
      <section>
        <div class="col-lg-8 col-lg-offset-2">
          <div class="page-header">
            <h2><strong>Add new item</strong></h2>
          </div>

      <form id="addItem" method="post" class="form-horizontal"
        data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
        data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
        data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">

        <div class="form-group">
          <label class="col-lg-3 control-label">Item</label>
          <div class="col-lg-6">
            <input type="text" class="form-control" name="Itemname" placeholder="Item Name" required data-bv-notempty-message="Item name required"/>
          </div>
        </div>

        <div class="form-group">
          <label class="col-lg-3 control-label">Location</label>
          <div class="col-lg-6">
            <input type="text" class="form-control" name="Location" placeholder="Location" required data-bv-notempty-message="Location required"/>
          </div>
        </div>

        <div class="form-group">
          <label class="col-lg-3 control-label">Description</label>
          <div class="col-lg-6">
            <textarea class="form-control" name="Description" rows="10" placeholder="Give a short description of your item (Recommended, max 500 chars)"
              data-bv-stringlength data-bv-stringlength-max="500" data-bv-stringlength-message="Description is too long"></textarea>
          </div>
        </div>

        <div class="form-group">
          <label class="col-lg-3 control-label">Condition</label>
            <div class="col-lg-6">
              
              <div class="radio">
                <label>
                  <input type="radio" name="Condition" value="Excellent" /> Excellent 
                </label>
              </div>

              <div class="radio">
                <label>
                  <input type="radio" name="Condition" value="Good" /> Good 
                </label>
              </div>


              <div class="radio">
                <label>
                  <input type="radio" name="Condition" value="Poor" /> Poor 
                </label>
              </div>

              <div class="form-group">
                <div class="col-lg-12 col-lg-offset-5">
                    <button type="submit" class="btn btn-success" name="formSubmit">Submit!</button>
                </div>
              </div>
            </div>
          </div>
      </form>







<?php
if(isset($_POST['formSubmit'])) //Always use POST instead of GET!
{
    $usermail = $_SESSION['emailaddress'];
    $query = "INSERT INTO Item(name, location, condition, owner)
    VALUES('".$_POST['Itemname']."' , '".$_POST['Location']."' , '".$_POST['Condition']."' , '$usermail' )";
    $result = pg_query($query) or die('You did not fill in the form properly, try again please!');
    echo '<div class="alert alert-success">
            Bid successfully placed!
            </div>';
    /*pg_free_result($result);*/
}
?>

<?php
pg_close($dbconn);
?>

</body>

<script type="text/javascript">
    $(document).ready(function() {
        $('#addItem').bootstrapValidator();
    });
</script>

</html>
