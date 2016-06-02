<?php
$servername = "192.168.20.56";
$username = "root";
$password = "";

try {
    $db = new PDO("mysql:host=$servername;dbname=todo", $username, $password);
    // set the PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    echo "<p>Database connection failed. Please try refreshing the page in your browser</p>";
}

//class dbConnect extends PDO {
//    public $db;
//    private $host;
//    private $dbName;
//    private $user;
//    private $password;
//}