<?php
session_start();

require '../Database.php';

$config = require '../config.php';

$db = new Database($config['database']);

$query = $db->query("DELETE FROM restaurant WHERE rs_id = :restaurant_id", ['restaurant_id' => $_GET['res_del']]);

header("location:all_restaurant.php");
?>