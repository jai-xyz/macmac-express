<?php

$config = require 'config.php';

$db = new Database($config['database']);

error_reporting(0);

session_start();
?>

<section>

  <p>404 NOT FOUND</p>

</section>
   
</html>