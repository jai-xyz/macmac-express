<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/icon.ico" type="image/x-icon">
    <title>Dishes | Macmac Express</title>
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

                    <li class="col-xs-12 col-sm-4 link-item"><span>1</span><a href="restaurants.php">Choose Restaurant</a></li>
                    <li class="col-xs-12 col-sm-4 link-item active"><span>2</span><a href="dishes.php?res_id=<?php echo $_GET['res_id']; ?>">Pick Your favorite food</a></li>
                    <li class="col-xs-12 col-sm-4 link-item"><span>3</span><a href="#">Order and Pay</a></li>

                </ul>
            </div>
        </div>

        <section class="inner-page-hero bg-image" data-image-src="images/img/bg12.png">
        <div class="profile">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12  col-md-4 col-lg-4 profile-img">
                            <div class="image-wrap">
                                <figure><?php echo '<img src="admin/Res_img/'.$ress['image'].'" alt="Restaurant logo">'; ?></figure>
                            </div>
                        </div>
                   

                        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 profile-desc">
                            <div class="pull-left right-text white-txt">
                                <h6><a href="#"><?php echo $ress['title']; ?></a></h6>
                                <p><?php echo $ress['address']; ?></p>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </section>

        <div class="breadcrumb">
             <div class="container">
               

             </div>
        </div>

        <div class="container m-t-30">
            <div class="row">
                <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
                <div class="widget widget-cart">
                        <div class="widget-heading">
                            <h3 class="widget-title text-dark">
                                Your Cart
                            </h3>


                            <div class="clearfix"></div>
                        </div>
                        <div class="order-row bg-white">
                            <div class="widget-body">


                                <?php

$item_total = 0;

foreach ($_SESSION["cart_item"] as $item)  
{
?>

                                <div class="title-row">
                                    <?php echo $item["title"]; ?><a href="dishes.php?res_id=<?php echo $_GET['res_id']; ?>&action=remove&id=<?php echo $item["d_id"]; ?>">
                                        <i class="fa fa-trash pull-right"></i></a>
                                </div>

                                <div class="form-group row no-gutter">
                                    <div class="col-xs-8">
                                        <input type="text" class="form-control b-r-0" value=<?php echo "₱".$item["price"]; ?> readonly id="exampleSelect1">

                                    </div>
                                    <div class="col-xs-4">
                                        <input class="form-control" type="text" readonly value='<?php echo $item["quantity"]; ?>' id="example-number-input">
                                    </div>

                                </div>

                                <?php
$item_total += ($item["price"]*$item["quantity"]); 
}
?>
                              

                            </div>
                        </div>



                        <div class="widget-body">
                            <div class="price-wrap text-xs-center">
                                <p>TOTAL</p>
                                <h3 class="value"><strong><?php echo "₱".$item_total; ?></strong></h3>
                                <p>Free Delivery!</p>
                                <?php
                                        if($item_total==0){
                                        ?>


                                <a href="checkout.php?res_id=<?php echo $_GET['res_id'];?>&action=check" class="btn btn-danger btn-lg disabled">Checkout</a>

                                <?php
                                        }
                                        else{   
                                        ?>
                                <a href="checkout.php?res_id=<?php echo $_GET['res_id'];?>&action=check" class="btn btn-success btn-lg active">Checkout</a>
                                <?php   
                                        }
                                        ?>

                            </div>
                        </div>


                     


                    </div>
                </div>

                <div class="col-md-8">
                    <div class="menu-widget" id="2">
                    <div class="widget-heading">
                            <h3 class="widget-title text-dark">
                                MENU <a class="btn btn-link pull-right" data-toggle="collapse" href="#popular2" aria-expanded="true">
                                    <i class="fa fa-angle-right pull-right"></i>
                                    <i class="fa fa-angle-down pull-right"></i>
                                </a>
                            </h3>
                            <div class="clearfix"></div>
                        </div>
                        <div class="collapse in" id="popular2">
                            <?php
                            foreach ($dishes as $dish) {
                                echo '
                                <div class="food-item">
                                    <!-- Add the dish HTML code here -->
                                </div>';
                            }
                            ?>
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