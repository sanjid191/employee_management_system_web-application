<?php
$servername = "localhost";
$username = "root";
$password = "Sanjid#191";
$dbname = "EmplpyeeDataWeb";

// Create connection
$connection = new mysqli($servername, $username, $password, $dbname);

// Check connection
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}
else{
    echo("Connected successfully");
    echo("<br>");
}

$query = "SELECT * FROM AdminInfo";

$stmt = mysqli_query($connection, $query);

while ($row = mysqli_fetch_array($stmt, MYSQLI_ASSOC)){
    echo $row['username'];
    echo $row['password'];
    echo("<br>");
}


?>
