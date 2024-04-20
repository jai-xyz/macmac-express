<?php
require 'Database.php';
$config = require 'config.php';

$db = new Database($config['database']);

// Delete the order from the database
$order_id = $_GET['order_del'];
$query = "DELETE FROM users_orders WHERE o_id = :order_id";
$statement = $db->connection->prepare($query);
$statement->execute(['order_id' => $order_id]);

header("Location: /your_orders");
exit;
?>