
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login | Online Food Ordering</title>
    <link rel="icon" href="images/icon.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

    <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
    <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

    <link rel="stylesheet" href="css/login.css">

    <style type="text/css">
    #buttn {
        color: #fff;
        background-color: #eb822d;
    }
    </style>


    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

</head>

<?php require 'partials/nav.php'; ?>

<body class="home">

    <div class="pen-title">
            </div>

                <div class="module form-module">
                    <div class="toggle">

                    </div>

                        <!-- LOG IN FORM  -->
                        
                    <div class="form"> 
                        <h2>Login to your account</h2>
                        
                        <form action="" method="post">
                            <input type="text" placeholder="Username" name="username" required autocomplete="off"/>
                            <input type="password" placeholder="Password" name="password" />
                            <input type="submit" id="buttn" name="submit" value="Login" />

                          
                        </form>
                        <?php 
                              if(isset($_GET['register'])) {
                                    if($_GET['register'] === 'success') {
                                    echo '<div class="success alert-success"  style="text-align: center;">Your account is good to go. </div>';  
                                }
                                  }

                                  if(isset($_GET['invalid'])) {
                                    if($_GET['invalid'] === 'pwd') {
                                    echo '<div class="danger alert-danger"  style="text-align: center;">Invalid username or password. </div>';  
                                }
                                  }
                                  
                                  ?>
                    </div>

                    <div class="cta">Not registered?<a href="/registration" style="color:#ea590b;;"> Create an account</a></div>
                </div>
                <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

                <div class="container-fluid pt-6">
                   <br><br><br>
                </div>



             


</body>


        <?php require 'partials/footer.php' ?>
</html>