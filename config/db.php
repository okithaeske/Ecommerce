<?php

// database connection

$host = "localhost";
$dbname = "luxury_ecommerce";
$username = "root";
$password = "";

function getDBConn() {
    global $host, $dbname, $username, $password;
    try{
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
    catch(PDOException $e){
        echo "Connection Failed: ". $e->getMessage();
    }
}