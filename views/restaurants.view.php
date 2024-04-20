<?php

$config = require 'config.php';
$db = new Database($config['database']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/icon.ico" type="image/x-icon">
    <title>Stalls | Macmac Express</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<?php require 'partials/nav.php' ?>

<body>
    <div class="page-wrapper">
        <div class="top-links">
            <div class="container">
                <ul class="row links">
                    <li class="col-xs-12 col-sm-4 link-item active"><span>1</span><a href="#">Choose Stall</a></li>
                    <li class="col-xs-12 col-sm-4 link-item"><span>2</span><a href="#">Pick Your favorite food</a></li>
                    <li class="col-xs-12 col-sm-4 link-item"><span>3</span><a href="#">Order and Pay</a></li>
                </ul>
            </div>
        </div>
        <div class="inner-page-hero bg-image" style="background-image: url('images/img/stallbg3.png'); ">
            <div class="container"></div>
        </div>
        <div class="result-show">
            <div class="container">
                <div class="row">
                </div>
            </div>
        </div>
        <section class="restaurants-page">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-3">
                    </div>
                    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-9">
                        <div class="bg-gray restaurant-entry">
                            <div class="row">
                                <?php

                                foreach ($restaurants as $row) {
                                    echo '
                    <div class="col-sm-12 col-md-12 col-lg-8 text-xs-center text-sm-left">
                        <div class="entry-logo">
                            <a class="img-fluid" href="dishes.php?res_id=' . $row['rs_id'] . '">
                                <img src="admin/Res_img/' . $row['image'] . '" alt="Food logo">
                            </a>
                        </div>
                        <!-- end:Logo -->
                        <div class="entry-dscr">
                            <h5>
                                <a href="dishes.php?res_id=' . $row['rs_id'] . '">' . $row['title'] . '</a>
                            </h5>
                            <span>' . $row['address'] . '</span>
                        </div>
                        <!-- end:Entry description -->
                    </div>
                    <div class="col-sm-12 col-md-12 col-lg-4 text-xs-center">
                        <div class="right-content bg-white">
                            <div class="right-review">
                                <a href="dishes.php?res_id=' . $row['rs_id'] . '" class="btn btn-purple">View Menu</a>
                            </div>
                        </div>
                        <!-- end:right info -->
                    </div>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

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