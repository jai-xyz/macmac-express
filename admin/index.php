
<?php

session_start();

require '../Database.php';

$config = require '../config.php';

$db = new Database($config['database']);

$message = "";
$success = "";

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $staticUsername = "admin";
    $staticPassword = "password";

    if ($username === $staticUsername && $password === $staticPassword) {
        $_SESSION["adm_id"] = 1;
        $host = $_SERVER['HTTP_HOST'];
        header("refresh:1;url=http://localhost:8888/admin/dashboard.php");

    } else {
        $message = "Invalid Username or Password!";
    }
}
?>

<!DOCTYPE html>
          <html lang="en">
     
              <head>
    <meta charset="UTF-8">
    <link rel="icon" href="../images/icon.ico" type="image/x-icon">
    <title>Admin Login</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

    <link rel="stylesheet" href="css/login.css">

    <style type="text/css">
    #buttn {
        color: #fff;
        background-color:#eb822d;
    }
    </style>


    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

                <body>


                <body class="home">

<div class="pen-title">
        </div>

            <div class="module form-module">
                <div class="toggle">

                </div>

                    <!-- LOG IN FORM  -->
                    <div class="form" style="display: flex; flex-direction: column; align-items: center;">
                    <h3 style="text-align: center;">Admin Login</h2>
                 <br>
                    <span style="color:red;"><?php echo $message; ?></span>
                    <span style="color:green;"><?php echo $success; ?></span>
                    <form class="login-form" method="post">
                        <input type="text" placeholder="Username" name="username" />
                        <input type="password" placeholder="Password" name="password" />
                        <input type="submit" id="buttn" name="submit" value="Login" />
                    </form>
                </div>

            </div>
            <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

</body>

</html>