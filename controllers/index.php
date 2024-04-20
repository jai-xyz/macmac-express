<?php

$config = require 'config.php';

$db = new Database($config['database']);

$statement = $db->query('SELECT * FROM dishes LIMIT 6');
$dishes = $statement->fetchAll();

$res = $db->query("SELECT * FROM res_category");
$categories = $res->fetchAll();

$ress = $db->query("SELECT * FROM restaurant");
$restaurants = $ress->fetchAll();

require 'views/index.view.php';