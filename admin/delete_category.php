<?php
session_start();

require '../Database.php';

$config = require '../config.php';

$db = new Database($config['database']);

$query = $db->query("DELETE FROM res_category WHERE c_id = :cat_id", ['cat_id' => $_GET['cat_del']]);

header("location:add_category.php");
?>