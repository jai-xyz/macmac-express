<?php
session_start();

require '../Database.php';

$config = require '../config.php';

$db = new Database($config['database']);

$query = $db->query("DELETE FROM dishes WHERE d_id = :menu_id", ['menu_id' => $_GET['menu_del']]);

header("location:all_menu.php");
?>