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
    <link rel="stylesheet" href="assets/bootstrap/css/modItem.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrapValidator.css"/>
    <link href="assets/bootstrap/css/addpage.css" rel="stylesheet">

    <script type="text/javascript" src="assets/jquery/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/bootstrap/js/bootstrapValidator.js"></script>
    <title>Mod Item page</title>
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
      
  <div class="addItem">
    <div class="row">
        <!-- form: -->
      <section>
        <div class="col-lg-8 col-lg-offset-2">
          <div class="page-header">
            <h2><strong>Edit item (TO BE EDITED)</strong></h2>
          </div>

<?php
  if(isset($_POST["ItemSubmit"])) {
    $item_id = $_POST['item_id'];
    $_SESSION['item_id']=$item_id;
    $query = "SELECT i.name, i.location, i.description, i.condition FROM item i WHERE i.id= '$item_id'";
    $result = pg_query($query) or die('Query failed: ' . pg_last_error());
    $line = pg_fetch_array($result, null, PGSQL_NUM);
    $item_name = $line[0];
    $item_location = $line[1];
    $item_description = $line[2];
    $item_condition = $line[3];
    }
?>

      <form id="addItem" method="post" class="form-horizontal"
        data-bv-feedbackicons-valid="glyphicon glyphicon-ok"
        data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
        data-bv-feedbackicons-validating="glyphicon glyphicon-refresh">

        <div class="form-group">
          <label class="col-lg-3 control-label">Item</label>
          <div class="col-lg-6">
            <input type="text" class="form-control" name="Itemname" value="<?php echo $item_name; ?>" required data-bv-notempty-message="Item name required"/>
          </div>
        </div>

        <div class="form-group">
          <label class="col-lg-3 control-label">Location</label>
          <div class="col-lg-6">

 			<form id="s" method="post">
 			<select name="Location" id="Location">
				<option value="Admiralty"
        <?php if ($item_location == 'Admiralty') echo ' selected="selected"'; ?>>
        Admiralty</option>

				<option value="Alexandra"
        <?php if ($item_location == 'Alexandra') echo ' selected="selected"'; ?>>
        Alexandra</option>

				<option value="Ang Mo Kio"
        <?php if ($item_location == 'Ang Mo Kio') echo ' selected="selected"'; ?>>
        Ang Mo Kio</option>

				<option value="Balestier"
        <?php if ($item_location == 'Balestier') echo ' selected="selected"'; ?>>
        Balestier</option>

				<option value="Balmoral"
        <?php if ($item_location == 'Balmoral') echo ' selected="selected"'; ?>>
        Balmoral</option>

				<option value="Beach Road"
        <?php if ($item_location == 'Beach Road') echo ' selected="selected"'; ?>>
        Beach Road</option>

				<option value="Bedok" 
        <?php if ($item_location == 'Bedok') echo ' selected="selected"'; ?>>
        Bedok</option>

				<option value="Bishan"
        <?php if ($item_location == 'Bishan') echo ' selected="selected"'; ?>>
        Bishan</option>

				<option value="Braddell"
        <?php if ($item_location == 'Braddell') echo ' selected="selected"'; ?>>
        Braddell</option>

				<option value="Boon Lay"
        <?php if ($item_location == 'Boon Lay') echo ' selected="selected"'; ?>>
        Boon Lay</option>

				<option value="Bugis"
        <?php if ($item_location == 'Bugis') echo ' selected="selected"'; ?>>
        Bugis</option>

				<option value="Bukit Batok"
        <?php if ($item_location == 'Bukit Batok') echo ' selected="selected"'; ?>>
        Bukit Batok</option>

				<option value="Bukit Merah"
        <?php if ($item_location == 'Bukit Merah') echo ' selected="selected"'; ?>>
        Bukit Merah</option>

				<option value="Bukit Timah"
        <?php if ($item_location == 'Bukit Timah') echo ' selected="selected"'; ?>>
        Bukit Timah</option>

				<option value="Bukit Panjang"
        <?php if ($item_location == 'Bukit Panjang') echo ' selected="selected"'; ?>>
        Bukit Panjang</option>

				<option value="Buona Vista"
        <?php if ($item_location == 'Buona Vista') echo ' selected="selected"'; ?>>
        Buona Vista</option>

				<option value="Cecil"
        <?php if ($item_location == 'Cecil') echo ' selected="selected"'; ?>>
        Cecil</option>

				<option value="Changi"
        <?php if ($item_location == 'Changi') echo ' selected="selected"'; ?>>
        Changi</option>

				<option value="Choa Chu Kang"
        <?php if ($item_location == 'Choa Chu Kang') echo ' selected="selected"'; ?>>
        Choa Chu Kang</option>

				<option value="Chinatown"
        <?php if ($item_location == 'Chinatown') echo ' selected="selected"'; ?>>
        Chinatown</option>

				<option value="City Hall"
        <?php if ($item_location == 'City Hall') echo ' selected="selected"'; ?>>
        City Hall</option>

				<option value="Clark Quay"
        <?php if ($item_location == 'Clark Quay') echo ' selected="selected"'; ?>>
        Clark Quay</option>

				<option value="Clementi"
        <?php if ($item_location == 'Clementi') echo ' selected="selected"'; ?>>
        Clementi</option>

				<option value="Dairy Farm"
        <?php if ($item_location == 'Dairy Farm') echo ' selected="selected"'; ?>>
        Dairy Farm</option>

				<option value="Farrer Park"
        <?php if ($item_location == 'Farrer Park') echo ' selected="selected"'; ?>>
        Farrer Park</option>

				<option value="Flora"
        <?php if ($item_location == 'Flora') echo ' selected="selected"'; ?>>
        Flora</option>

				<option value="Geylang"
        <?php if ($item_location == 'Geylang') echo ' selected="selected"'; ?>>
        Geylang</option>

				<option value="Harbourfront"
        <?php if ($item_location == 'Harbourfront') echo ' selected="selected"'; ?>>
        Harbourfront</option>

				<option value="Hillview"
        <?php if ($item_location == 'Hillview') echo ' selected="selected"'; ?>>
        Hillview</option>

				<option value="Holland Village"
        <?php if ($item_location == 'Holland Village') echo ' selected="selected"'; ?>>
        Holland Village</option>

				<option value="Hougang"
        <?php if ($item_location == 'Hougang') echo ' selected="selected"'; ?>>
        Hougang</option>

				<option value="Joo Chiat"
        <?php if ($item_location == 'Joo Chiat') echo ' selected="selected"'; ?>>
        Joo Chiat</option>

				<option value="Jurong East"
        <?php if ($item_location == 'Jurong East') echo ' selected="selected"'; ?>>
        Jurong East</option>

				<option value="Jurong West"
        <?php if ($item_location == 'Jurong West') echo ' selected="selected"'; ?>>
        Jurong West</option>

				<option value="Kallang"
        <?php if ($item_location == 'Kallang') echo ' selected="selected"'; ?>>
        Kallang</option>

				<option value="Katong"
        <?php if ($item_location == 'Katong') echo ' selected="selected"'; ?>>
        Katong</option>

				<option value="Kranji"
        <?php if ($item_location == 'Kranji') echo ' selected="selected"'; ?>>
        Kranji</option>

				<option value="Little India"
        <?php if ($item_location == 'Little India') echo ' selected="selected"'; ?>>
        Little India</option>

				<option value="Lim Chu Kang"
        <?php if ($item_location == 'Lim Chu Kang') echo ' selected="selected"'; ?>>
        Lim Chu Kang</option>

				<option value="Loyang"
        <?php if ($item_location == 'Loyang') echo ' selected="selected"'; ?>>
        Loyang</option>

				<option value="Mandai"
        <?php if ($item_location == 'Mandai') echo ' selected="selected"'; ?>>
        Mandai</option>

				<option value="Marina"
        <?php if ($item_location == 'Marina') echo ' selected="selected"'; ?>>
        Marina</option>

				<option value="Marine Parade"
        <?php if ($item_location == 'Marine Parade') echo ' selected="selected"'; ?>>
        Marine Parade</option>

				<option value="Macpherson"
        <?php if ($item_location == 'Macpherson') echo ' selected="selected"'; ?>>
        Macpherson</option>

				<option value="Mount Faber"
        <?php if ($item_location == 'Mount Faber') echo ' selected="selected"'; ?>>
        Mount Faber</option>

				<option value="Novena"
        <?php if ($item_location == 'Novena') echo ' selected="selected"'; ?>>
        Novena</option>

				<option value="Newton"
        <?php if ($item_location == 'Newton') echo ' selected="selected"'; ?>>
        Newton</option>

				<option value="Orchard"
        <?php if ($item_location == 'Orchard') echo ' selected="selected"'; ?>>
        Orchard</option>

				<option value="Pasir Panjang"
        <?php if ($item_location == 'Pasir Panjang') echo ' selected="selected"'; ?>>
        Pasir Panjang</option>

				<option value="Pasir Ris"
        <?php if ($item_location == 'Pasir Ris') echo ' selected="selected"'; ?>>
        Pasir Ris</option>

				<option value="Paya Lebar"
        <?php if ($item_location == 'Paya Lebar') echo ' selected="selected"'; ?>>
        Paya Lebar</option>

				<option value="Punggol"
        <?php if ($item_location == 'Punggol') echo ' selected="selected"'; ?>>
        Punggol</option>

				<option value="Queenstown"
        <?php if ($item_location == 'Queenstown') echo ' selected="selected"'; ?>>
        Queenstown</option>

				<option value="Raffles Place"
        <?php if ($item_location == 'Raffles') echo ' selected="selected"'; ?>>
        Raffles Place</option>

				<option value="River Valley"
        <?php if ($item_location == 'River Valley') echo ' selected="selected"'; ?>
        River Valley</option>

				<option value="Seletar"
        <?php if ($item_location == 'Seletar') echo ' selected="selected"'; ?>>
        Seletar</option>

				<option value="Sembawang"
        <?php if ($item_location == 'Sembawang') echo ' selected="selected"'; ?>>
        Sembawang</option>

				<option value="Sengkang"
        <?php if ($item_location == 'Sengkang') echo ' selected="selected"'; ?>>
        Sengkang</option>

				<option value="Serangoon"
        <?php if ($item_location == 'Serangoon') echo ' selected="selected"'; ?>>
        Serangoon</option>

				<option value="Siglap"
        <?php if ($item_location == 'Siglap') echo ' selected="selected"'; ?>>
        Siglap</option>

				<option value="Tampines"
        <?php if ($item_location == 'Tampines') echo ' selected="selected"'; ?>>
        Tampines</option>

				<option value="Tanjong Pagar"
        <?php if ($item_location == 'Tanjong Pagar') echo ' selected="selected"'; ?>>
        Tanjong Pagar</option>

				<option value="Telok Blangah"
        <?php if ($item_location == 'Telok Blangah') echo ' selected="selected"'; ?>>
        Telok Blangah</option>

				<option value="Tengah"
        <?php if ($item_location == 'Tengah') echo ' selected="selected"'; ?>>
        Tengah</option>

				<option value="Thomson"
        <?php if ($item_location == 'Thomson') echo ' selected="selected"'; ?>>
        Thomson</option>

				<option value="Tiong Bahru"
        <?php if ($item_location == 'Tiong Bahru') echo ' selected="selected"'; ?>>
        Tiong Bahru</option>

				<option value="Toa Payoh"
        <?php if ($item_location == 'Toa Payoh') echo ' selected="selected"'; ?>>
        Toa Payoh</option>

				<option value="Tuas"
        <?php if ($item_location == 'Tuas') echo ' selected="selected"'; ?>>
        Tuas</option>

				<option value="Ulu Pandan"
        <?php if ($item_location == 'Ulu Pandan') echo ' selected="selected"'; ?>>
        Ulu Pandan</option>

				<option value="Upper Bukit Timah"
        <?php if ($item_location == 'Upper Bukit Timah') echo ' selected="selected"'; ?>>
        Upper Bukit Timah</option>

				<option value="Upper East Coast"
        <?php if ($item_location == 'Upper East Coast') echo ' selected="selected"'; ?>>
        Upper East Coast</option>

				<option value="Woodlands"
        <?php if ($item_location == 'Woodlands') echo ' selected="selected"'; ?>>
        Woodlands</option>

				<option value="Yio Chu Kang"
        <?php if ($item_location == 'Yio Chu Kang') echo ' selected="selected"'; ?>>
        Yio Chu Kang</option>

				<option value="Yishun"
        <?php if ($item_location == 'Yishun') echo ' selected="selected"'; ?>>
        Yishun</option>
			</select>

          </div>
        </div>

        <div class="form-group">
          <label class="col-lg-3 control-label">Description</label>
          <div class="col-lg-6">
            <textarea class="form-control" name="Description" rows="10" 
              data-bv-stringlength data-bv-stringlength-max="500" data-bv-stringlength-message="Description is too long"><?php echo $item_description; ?></textarea>
          </div>
        </div>

        <div class="form-group">
          <label class="col-lg-3 control-label">Condition</label>
            <div class="col-lg-6">

              <div class="radio">
                <label>
                  <input type="radio" name="Condition" value="Excellent" <?php echo ($item_condition=='Excellent')?'checked':'' ?> /> Excellent
                </label>
              </div>

              <div class="radio">
                <label>
                  <input type="radio" name="Condition" value="Good" <?php echo ($item_condition=='Good')?'checked':'' ?> /> Good
                </label>
              </div>


              <div class="radio">
                <label>
                  <input type="radio" name="Condition" value="Poor" <?php echo ($item_condition=='Poor')?'checked':'' ?> /> Poor
                </label>
              </div>

              <div class="form-group">
                <div class="col-lg-12 col-lg-offset-5">
                    <button type="submit" class="btn btn-success" name="formSubmit">Modify item!</button>
                </div>
              </div>
            </div>
          </div>
      </form>







<?php
if(isset($_POST['formSubmit'])) //Always use POST instead of GET!
{
    $item_id = $_SESSION['item_id'];
    $item_name = $_POST['Itemname'];
    $item_location = $_POST['Location'];
    $item_description = $_POST['Description'];
    $item_condition = $_POST['Condition'];
    $query = "UPDATE item SET name = '$item_name', location = '$item_location', description = '$item_description', condition = '$item_condition' WHERE id = '$item_id'";
    $result = pg_query($query) or die('You did not fill in the form properly, try again please!');
    echo '<div class="alert alert-success">
            Item successfully modified!
            </div>';
}
?>

<?php
pg_close($dbconn);
?>

<script type="text/javascript">
    $('.dropdown-menu').click(function(e) {
        e.stopPropagation();
    });
</script>
</body>

<script type="text/javascript">
    $(document).ready(function() {
        $('#addItem').bootstrapValidator();
    });
</script>

</html>
