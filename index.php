<?php

use CRUD\Controller\PersonController;

include ("loader.php");

$servername = "localhost";
$username = "root";
$password = "1895Th1895!";

try {
    $conn = new PDO("mysql:host=$servername", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    ECHO "<h3>CANNOT CONNECT TO SERVER<h3/>";
    echo  $e->getMessage();
}

$sql = "
CREATE database IF NOT EXISTS crud;
use crud;
CREATE TABLE IF NOT EXISTS Person(
                                     id   INT AUTO_INCREMENT,
                                     first_name  VARCHAR(100) NOT NULL,
                                     last_name   VARCHAR(100) NOT NULL,
                                     username VARCHAR(50) Unique,
                                     PRIMARY KEY(id)
);
";
try {
    $conn->exec($sql);
}catch (PDOException $e){
    echo "cannot create database";
}

$controller = new PersonController();
$controller->switcher($_SERVER['PATH_INFO'],$_REQUEST);


