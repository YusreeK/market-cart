<HTML>
<head>
<title>My Site 23</title>
</head>
<body>
<?php
//INSERT INTO ORDERS
$mysqli = new mysqli("localhost", "project", "wawasan", "Shopping");
if ($mysqli->connect_errno){
    printf("%s: %s", $mysqli->connect_errno,
    $mysqli->connect_error);
}
date_default_timezone_set('Asia/Kuala_Lumpur');
$custID = $_POST['CustID'];
$OrderTotal = $_POST['orderTotal'];
$today = date("y-m-d");
$query = "INSERT INTO ORDERS (OrderID, CustomerID, Date, Total) VALUES (NULL, '$custID', 
'$today', $OrderTotal)";
$result = $mysqli->query($query);
// Get back OrderId
$orderID = $mysqli->insert_id;
if(!$result){
    echo($mysqli->error);
    exit();
}
?>

<?php
// Copy shopping_cart to Product_orders
$query = "SELECT ProductID, Quantity FROM shopping_cart";
$result = $mysqli->query($query, MYSQLI_STORE_RESULT);
if(!$result){
    echo($mysqli->error);
    exit();
}
while(list($ProductID, $Quantity) = $result->fetch_row())
{
    $query2 = "INSERT INTO Product_orders
    (OrderID, ProductID, Quantity) VALUES ('$orderID', '$ProductID', $Quantity)";
    $result2 = $mysqli->query($query2);
    if(!$result2){
        echo($mysqli->error);
        exit();
    }
}
?>
<?php
// Delete shopping_cart items
$query = "DELETE FROM shopping_cart";
$result = $mysqli->query($query);
if(!$result){
    echo ($mysqli->error);
    exit();
}
?>

<h1>Thank you for your order</h1>
<p>Bill to: </p>
<?php
$query = "SELECT CustomerID, Fullname, Email, Address FROM CUSTOMER WHERE CustomerID ='$custID'";
$result = $mysqli->query($query, MYSQLI_STORE_RESULT);
if(!$result){
    echo ($mysqli->error);
    exit();
}

while(list($CustomerID, $Fullname, $Email, $Address)= $result->fetch_row())
{
    echo "$Fullname (#$CustomerID)<br />";
    echo "$Email<br />";
    echo "$Address<br />";
}
?>

<p>Order ID<?php echo $orderID ?><br />
Summary of your purchase:</p>
<table border="0" width="50%">
<tr>
<th>Qty.</th>
<th>Item ID</th>
<th>Item Name</th>
<th>Price</th>
<th>Total</th>
</tr>
<?php
$query = "SELECT ProductID, Quantity, FROM Product_orders WHERE OrderID = $orderID";
$result = $mysqli->query($query, MYSQLI_STORE_RESULT);
if(!$result){
    echo ($mysqli->error);
    exit();

}
while (list($CartProdID, $CartQty)= $result->fetch_row()) {
    $query2 ="SELECT * FROM PRODUCT WHERE ProductID = '$CartProdID'";
    $result2 = $mysqli->query($query, MYSQLI_STORE_RESULT);
    if (!$result2) {
        echo($mysqli->error);
        exit();
    }
    while (list($CartProdID, $CartQty)= $result->fetch_row()) {
        $query2 = "SELECT * FROM PRODUCT WHERE ProductID = 'CartProdID'";
        $result2 = $mysqli->query($query2, MYSQLI_STORE_RESULT);
        if (!$result2) {
            echo($mysqli->error);
            exit();
        }
        while (list($ProductID, $Name, $Desc, $Price) = $result2->fetch_row()) {
            echo "<tr>";
            echo "<td>$CartQty</td>";
            echo "<td>#$ProductID</td>";
            echo"<td>$Name</td>";
            echo"<td>$$Price</td>";
            $Extprice = number_format($Price * $CartQty, 2);
            echo "<td>$$Extprice</td>";
            echo "</tr>";
        }
    }
    $mysqli->close();
}

?>
</table>
<table border="0" width="50%">
<tr><td>&nbsp;<td><td align="right">
Order Total: $
<?php echo number_format($OrderTotal, 2) ?>
</td></tr>
<tr><td>
<a href="MySite20.php">Back to Shopping</a></td>
</tr>
</table>
</body>
</HTML>