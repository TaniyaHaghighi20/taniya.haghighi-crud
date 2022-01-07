<?php

use CRUD\Controller\PersonController;

include ("loader.php");

$connection = new \CRUD\Helper\DBConnector();
$connection->connect();


$controller = new PersonController();
$controller->switcher($_SERVER['PATH_INFO'],$_REQUEST);


