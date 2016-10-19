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

 			<form id="s" method="post">
 			<select name="Location">
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
            Item successfully added!
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
