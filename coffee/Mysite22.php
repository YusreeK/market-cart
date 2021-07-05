<html>
<head>
<title>My Site 22</title>
</head>
<body>

<h1>Confirm Your Details</h1>
<form method="POST" action="MySite23.php">
<table border="1" width="50%">

<?php
$mysqli = new mysqli("localhost", "project", "wawasan", "Shopping");


if ($mysqli->connect_errno){
    printf("%s: %s", $mysqli->connect_errno,
$mysqli->connect_error);
}
$OrderTotal =$_POST['ordertotal'];
$query = "SELECT CustomerID, FullName, Email, Address FROM CUSTOMER";
$result = $mysqli->query($query);
if(!$result){
    echo($mysqli->error);
    exit();
}
while(list($CustomerID, $FullName, $Email, $Address) = $result->fetch_row())
{
    echo "<tr><td>Customer ID</td>";
    echo "<td><input type='text' name='CustomerID' value='$CustomerID' disabled>
    <input type='hidden' name='CustID' value='$CustomerID'></td></tr>";

    echo "<tr><td>Full name </td>";
    echo "<td><input type='text' name='FullName' value='$FullName'></td></tr>";

    echo "<tr><td>Email</td>";
    echo "<td><input type='text' name='Email' value='$Email'></td></tr>";

    echo "<tr><td>Address</td>";
    echo "<td><textarea name='Address' rows='3' cols='16'>$Address</textarea>";
    echo "<input type='hidden' name=''orderTotal' value='$OrderTotal'>";

    echo "</td></tr>";
}
$mysqli->close();
?>
</table><input type="submit" name="submit" value="confirm">
    </form>
</body>
</html>