<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/icon.ico" type="image/x-icon">
    <title>Registration | Macmac Express</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<?php require 'partials/nav.php'; ?>

<div class="page-wrapper-registration">

    <div class="container">
        <ul>


        </ul>
    </div>

    <body>

        <section class="contact-page inner-page">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="widget">
                            <div class="widget-body">


                                <form action="" method="post">
                                    <div class="row">
                                        <div class="form-group col-sm-12">
                                            <label for="exampleInputEmail1">Username</label>
                                            <input class="form-control" type="text" name="username" id="example-text-input" required autocomplete="off">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="exampleInputEmail1">First name</label>
                                            <input class="form-control" type="text" name="firstname" id="example-text-input" required autocomplete="off">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="exampleInputEmail1">Last name</label>
                                            <input class="form-control" type="text" name="lastname" id="example-text-input-2" required autocomplete="off" >
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="exampleInputEmail1">Email address</label>
                                            <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" required autocomplete="off">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="exampleInputEmail1">Phone number</label>
                                            <input class="form-control" type="tel" name="phone" maxlength="11" id="example-tel-input-3" required autocomplete="off">
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="exampleInputPassword1">Password</label>
                                            <input type="password" class="form-control" name="password" id="exampleInputPassword1" required>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <label for="exampleInputPassword1">Confirm password</label>
                                            <input type="password" class="form-control" name="cpassword" id="exampleInputPassword2" required>
                                        </div>
                                        <div class="form-group col-sm-12">
                                            <label for="exampleTextarea">Delivery address</label>
                                            <textarea class="form-control" id="exampleTextarea" name="address" rows="3" required></textarea>
                                        </div>

                                    </div>
                                    <?php
                                                if(isset($_GET['error'])) {
                                                    if($_GET['error'] === 'wrongpwd') {
                                                        echo '<div class="danger alert-danger" style="text-align: center;">Password does not match.</div>';  
                                                    } else if($_GET['error'] === 'pwdlength') {
                                                    echo '<div class="danger alert-danger" style="text-align: center;">Password must be at least 6 characters long.</div>';  
                                                    } else if($_GET['error'] === 'invalidemail') {
                                                    echo '<div class="danger alert-danger" style="text-align: center;">Invalid email address, please provide a valid email!</div>';  
                                                    } else if($_GET['error'] === 'usertaken') {
                                                    echo '<div class="danger alert-danger" style="text-align: center;">Username already exists!</div>';  
                                                    } else if($_GET['error'] === 'emailtaken') {
                                                    echo '<div class="danger alert-danger" style="text-align: center;">Email already exists!</div>';  
                                                    }
                                                }
                                    
                                            ?>
                           
                                           <input type="submit" value="Register" name="submit" class="btn theme-btn btn-block"> 
                                     
                                           <p></p>
                                </form>

                            </div>

                        </div>

                    </div>

                </div>
            </div>



</div>
<script src="js/jquery.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/animsition.min.js"></script>
<script src="js/bootstrap-slider.min.js"></script>
<script src="js/jquery.isotope.min.js"></script>
<script src="js/headroom.js"></script>
<script src="js/foodpicky.min.js"></script>

</body>
<?php require 'partials/footer.php' ?>

</html>