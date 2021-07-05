<?php
$mysqli = new mysqli("localhost", "project", "wawasan", "Shopping");
if ($mysqli->connect_errno){
    printf("Unable to connect to the database:<br /> %s", $mysqli->connect_error);
    exit();
}
$query = "INSERT INTO Product VALUES 
(22103, 'Tribute Blend', 'Sun-dried beans from 
Ethiopia inspired by our collaboration with 
Ethiopian farmers.', 13.95),
(97902, 'Pike Place Roast', 'The smoother finish 
and soft acidity are attributed to a proprietary 
blend of high-altitude arabica beans.', 9.95),
(12948, 'French Roast', 'Blunt, smoky flavours 
are the objective in creating this, our darkest 
roasted coffee.', 10.95),
(12983, 'Sumatra', 'The concentrated spicy, 
herbal notes and earthy aroma are the 
telltale signatures of this well-loved coffee.', 10.95)
";
$result = $mysqli->query($query, MYSQLI_STORE_RESULT);
if(!$result){
    echo($mysqli->error);
    exit();
}
?>