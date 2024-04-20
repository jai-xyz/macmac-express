<?php

$config = require 'config.php';

$db = new Database($config['database']);

error_reporting(0);

session_start();


if (isset($_POST['submit'])) {
    $username = filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS);
    $password = $_POST['password'];

    if (!empty($_POST["submit"])) {
        $loginquery = "SELECT * FROM users WHERE username=:username";
        $statement = $db->query($loginquery, [':username' => $username]);
        $row = $statement->fetch(PDO::FETCH_ASSOC);
        
        if ($row && password_verify($password, $row['password'])) {
            $_SESSION["user_id"] = $row['u_id'];
            header("Location: /");
            exit();
        } else {
            header('Location: ../login?invalid=pwd');
            exit();     
        }
    }
}

require 'views/login.view.php';