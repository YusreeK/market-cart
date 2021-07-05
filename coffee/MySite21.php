<html>
<head>
<title>MySite21</title>
</head>
<body>
<?php
$mysqli = new mysqli("localhost", "project", "wawasan", "Shopping");


if ($mysqli->connect_errno){
    printf("%s: %s", $mysqli->connect_errno,
$mysqli->connect_error);
}
$qty =$_POST['qty'];
$prodID = $_POST['prodID'];
$query = "INSERT INTO shopping_cart (Quantity, ProductID) VALUES ('$qty', $prodID)";
$result = $mysqli->query($query);
if(!$result){
    echo($mysqli->error);
    exit();
}
?>
<h1>MY Coffee Store Cart</h1>
<form method="POST" action="MySite22.php">
<table border="1" width="50%">
<tr>
<th>Qty.</th>
<th>Item ID</th>
<th>Item Name</th>
<th>Item Info</th>
<th>Price</th>
<th>Total</th>
</tr>
<?php
$query = "SELECT ProductID, Quantity FROM shopping_cart";
$result = $mysqli->query($query, MYSQLI_STORE_RESULT);
if(!$result) {
    echo ($mysqli->error);
    exit();
}
$OrderTotal = 0;
while (list($CartProdID, $CartQty) = $result->fetch_row())
{
    $query = "SELECT * FROM Product WHERE ProductID = $ProdID";
    $result2 = $mysqli->query($query, MYSQLI_STORE_RESULT);
    if(!$result2) {
        echo ($mysqli->error);
        exit();
    }

    while(list($ProductID, $Name, $DESC, $Price) = $result2->fetch_row())
            {
                echo "<tr>";
                    echo "<td><input type='text name='qty'
                    size='2' value='$CartQty'></td>";

                    echo "<td>#$ProductID</td>";
                    echo "<td>$Name</td>";
                    echo "<td>$Desc</td>";
                    echo "<td>$$Price</td>";
                    $Total = number_format($Price * 
                    $CartQty, 2);

                    echo "<td>$$Total</td>";
                    echo "</tr>";
            }
            $OrderTotal += $Total;

}
$mysqli->close();
?>

</table>
<table border="0" width="50%">
<tr><td>&nbsp;</td><td align="right"> Order Total: $
<?php echo number_format ($OrderTotal, 2);
echo "<input type='hidden' name='orderTotal' value='$OrderTotal'>";
?>
</td></tr>
<tr><td>
<a href="MySite20.php">Keep Shopping</a></td>
<td align="right">
    <input type="submit" name="Submit"
    value="Checkout >">

</td></tr>
</table></form>
</body>
</html>