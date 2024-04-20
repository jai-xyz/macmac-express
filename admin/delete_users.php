<?php
session_start();

require '../Database.php';

$config = require '../config.php';

$db = new Database($config['database']);

$query = $db->query("DELETE FROM users WHERE u_id = :user_id", ['user_id' => $_GET['user_del']]);

header("location:all_users.php");
?>