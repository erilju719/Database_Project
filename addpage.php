<html>
<head> <title>Add item-page</title> </head>

<body>
<table>
<tr> <td colspan="2" style="background-color:#008B8B;">
<h1> <font color=#FFFAF0>Add new item</font></h1>
</td> </tr>

<?php
$dbconn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=postgres")
    or die('Could not connect: ' . pg_last_error());
?>

<tr>
<td style="background-color:#FFFAF0;">
<form>
        Item:     <input type="text" name="Itemname" id="Itemname" /></p>
        Location: <input type="text" name="Location" id="Location" /></p>
        Short descrition: <textarea name="Description" rows="3" cols="40"><?php echo $Description;?></textarea /></p>
        Condition: <input type="radio" name="Condition" id="condition1" value="Excellent">Excellent
        <input type="radio" name="Condition" id="condition2" value="Good">Good
        <input type="radio" name="Condition" id="condition3" value="Poor">Poor
        
        </select/></p>

        <input type="submit" name="formSubmit" value="Submit" >
        <input type="button" name="cancel" value="Cancel" onClick="window.location.href='http://localhost:8080/book-demo-1.php';" />	 	 

</form>
<?php

/*symlink ( string 'http://localhost:8080/book-demo-1.php' , string 'Homepage' );*/

if(isset($_GET['formSubmit'])) 
{
    $query = "INSERT INTO Item(name, location, condition, owner)
    VALUES('".$_GET['Itemname']."' , '".$_GET['Location']."' , '".$_GET['Condition']."' , 'derp12@gmail.com' )";
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
<td colspan="2" style="background-color:#008B8B; text-align:center;"> Lendstuff.com
</td> </tr>
</table>

</body>
</html>


