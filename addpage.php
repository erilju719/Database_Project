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
    <link href="assets/bootstrap/css/addpage.css" rel="stylesheet">
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
            <li><a href = "login.php" id="barIcon"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
          </div>
      </nav>


<table>
<tr> <td colspan="2" style="background-color:#008B8B;">
<h1> <font color=#FFFAF0>Add new item</font></h1>
</td> </tr>

<tr>
<td style="background-color:#FFFAF0;">
<form>
        Item:     <input type="text" name="Itemname" id="Itemname" /></p>
        Location: <input type="text" name="Location" id="Location" /></p>
        Short description: <textarea name="Description" rows="3" cols="40"><?php echo $Description;?></textarea /></p>
        Condition: <input type="radio" name="Condition" id="condition1" value="Excellent">Excellent
        <input type="radio" name="Condition" id="condition2" value="Good">Good
        <input type="radio" name="Condition" id="condition3" value="Poor">Poor

        </select/></p>

        <input type="submit" name="formSubmit" value="Submit" >
        <input type="button" name="cancel" value="Back to homepage" onClick="window.location.href='/homepage.php';" />

</form>
<?php

/*symlink ( string 'http://localhost:8080/book-demo-1.php' , string 'Homepage' );*/

if(isset($_GET['formSubmit'])) //Always use POST instead of GET!
{
    $usermail = $_SESSION['emailaddress'];
    $query = "INSERT INTO Item(name, location, condition, owner)
    VALUES('".$_GET['Itemname']."' , '".$_GET['Location']."' , '".$_GET['Condition']."' , '$usermail' )";
    $result = pg_query($query) or die('You did not fill in the form properly, try again please!');
    echo "<b></b>".'Your item has been added, thank you!'."<br><br>";
    /*pg_free_result($result);*/
}
?>



</td> </tr>
<?php
pg_close($dbconn);
?>
<tr>
<!--<td colspan="2" style="background-color:#008B8B; text-align:center;"> Lendstuff.com-->
</td> </tr>
</table>

</body>
</html>
