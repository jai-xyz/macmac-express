<?php

$config = require 'config.php';

$db = new Database($config['database']);

error_reporting(0);

session_start();
?>

<section>
  <p>403 FORBIDDEN. You are not authorized to view this page.</p>
</section>
  
</html>