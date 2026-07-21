<?php
$mysqli = new mysqli("128.168.64.26","prangedb","OrchardM!S2024");

if($mysqli->connect_errno){
    die("Connection failed: " . $mysqli->connect_error);
}

echo "CONNECTED<br>";

$result = $mysqli->query("SHOW DATABASES");

while($row = $result->fetch_array()){
    echo $row[0] . "<br>";
}
?>