<html>
<head>
<title>My Site 20</title>
</head>
<body>
<h1>My Coffee Store.com</h1>
<table border="1" width="50%">
<?php
$mysqli = new mysqli("localhost", "project", "wawasan", "Shopping");


if ($mysqli->connect_errno){
    printf("%s: %s", $mysqli->connect_errno,
$mysqli->connect_error);
}
$query = "SELECT * FROM Product";
$result = $mysqli->query($query, MYSQLI_STORE_RESULT);
if(!$result) {
    echo($mysqli->error);
    exit();
}
while(list($ProductID, $Name, $DESC, $Price) =
$result->fetch_row())
{
    echo "<tr>";
    echo "<td>";
    
        echo "#$ProductID<br />$Name";
    echo"<tr>";
    echo "<td>";
    
        echo "$Name<br />$DESC<br />$$Price";
        echo "<form method='POST' action='MySite21.php'>";

        echo "#$ProductID Qty:";
        echo "<input type='text' name='qty' size='2'>";

        echo "<input type='hidden'
        name='prodID' value='ProductID'>";

        echo "<input type='submit'
        name='submit' value='Add to cart'>";
         
        echo "</form>";
        echo "</td>";
        echo "</tr>";
}
$mysqli->close();
?>
</table>
</body>
</html>