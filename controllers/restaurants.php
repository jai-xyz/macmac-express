<?php

$config = require 'config.php';

$db = new Database($config['database']);

error_reporting(0);

session_start();

$query = "SELECT * FROM restaurant";
$restaurants = $db->query($query)->fetchAll();

require 'views/restaurants.view.php';
