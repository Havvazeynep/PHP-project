<?php

$servername = "localhost";
$username = "root";
$password = "";
$db = "phpproject";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
    $conn->query("SET CHARACTER SET utf8");
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>
