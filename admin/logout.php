        <?php
session_start();
session_destroy();
$url = 'http://localhost:8888/admin';
header('Location: ' . $url);

?>