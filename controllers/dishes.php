<?php

$config = require 'config.php';

$db = new Database($config['database']);

error_reporting(0);

session_start();

require_once 'product-action.php';

// Fetch restaurant information
$resId = $_GET['res_id'];
$resQuery = "SELECT * FROM restaurant WHERE rs_id = :res_id";
$resParams = [':res_id' => $resId];
$ress = $db->query($resQuery, $resParams)->fetch();

// Fetch dishes for the restaurant
$dishQuery = "SELECT * FROM dishes WHERE rs_id = :res_id";
$dishParams = [':res_id' => $resId];
$stmt = $db->query($dishQuery, $dishParams);
$products = $stmt->get();

require 'views/dishes.view.php';
