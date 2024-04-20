<?php
$config = require 'config.php';

$db = new Database($config['database']);

error_reporting(0);

session_start();

if (isset($_POST['submit'])) {
    if (empty($_POST['firstname']) ||
      empty($_POST['username']) ||
        empty($_POST['lastname']) ||
        empty($_POST['email']) ||
        empty($_POST['phone']) ||
        empty($_POST['password']) ||
        empty($_POST['cpassword']) ||
        empty($_POST['address'])
    ) {
        echo "<script>alert('All fields must be required!');</script>";
    } else {
        $check_username = $db->query("SELECT username FROM users WHERE username = :username", [':username' => $_POST['username']]);
        $check_email = $db->query("SELECT email FROM users WHERE email = :email", [':email' => $_POST['email']]);

        if ($_POST['password'] != $_POST['cpassword']) {
            header('Location: ../registration?error=wrongpwd');
        } elseif (strlen($_POST['password']) < 6) {
            header('Location: ../registration?error=pwdlength');
            // echo "<script>alert('Password must be at least 6 characters long');</script>";
        } elseif (strlen($_POST['phone']) < 10) {
            echo "<script>alert('Invalid phone number!');</script>";
        } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            // echo "<script>alert('Invalid email address, please provide a valid email!');</script>";
               header('Location: ../registration?error=invalidemail');
        } elseif ($check_username->rowCount() > 0) {
            // echo "<script>alert('Username already exists!');</script>";
            header('Location: ../registration?error=usertaken');
        } elseif ($check_email->rowCount() > 0) {
            // echo "<script>alert('Email already exists!');</script>";
            header('Location: ../registration?error=emailtaken');
        } else {
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $mql = "INSERT INTO users (username, f_name, l_name, email, phone, password, address) VALUES (:username, :firstname, :lastname, :email, :phone, :password, :address)";
            $db->query($mql, [
                ':username' => $_POST['username'],
                ':firstname' => $_POST['firstname'],
                ':lastname' => $_POST['lastname'],
                ':email' => filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL),
                ':phone' => $_POST['phone'],
                ':password' => $password,
                ':address' => $_POST['address']
            ]);
            header('Location: ../login?register=success');
            exit();        
        }
    }
}

require 'views/registration.view.php';