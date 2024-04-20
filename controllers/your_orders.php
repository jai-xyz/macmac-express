<?php

$config = require 'config.php';

$db = new Database($config['database']);

error_reporting(0);

session_start();

$query = "SELECT * FROM users_orders WHERE u_id = :user_id";
$statement = $db->query($query, [':user_id' => $_SESSION['user_id']]);
$orders = $statement->fetchAll();

require 'views/your_orders.view.php';