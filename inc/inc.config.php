<?php

$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName = "db_task";

try {
    // Connections are established by creating instances of the PDO base class.    
    // http://php.net/manual/en/pdo.connections.php
    $dbCon = new PDO("mysql:host={$dbHost};dbname={$dbName}", $dbUser, $dbPass);
    $dbCon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo $e->getMessage();
}

include_once 'inc.class.crud.php';
$crud = new Crud($dbCon);
include_once 'inc.class.user.php';
$user = new User($dbCon);
