<?php
session_start();

require '../Database.php';

$config = require '../config.php';

$db = new Database($config['database']);

$query = $db->query("DELETE FROM users_orders WHERE o_id = :order_id", ['order_id' => $_GET['order_del']]);

header("location:all_orders.php");
?>