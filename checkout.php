<!DOCTYPE html>
<html lang="en">

<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require 'Database.php';

$config = require 'config.php';

$db = new Database($config['database']);

session_start();

include_once 'controllers/product-action.php';

function function_alert()
{
    echo "<script>alert('Thank you. Your order has been placed!');</script>";
    echo "<script>window.location.replace('/your_orders');</script>";
}

$message = "";
$success = "";

if (empty($_SESSION["user_id"])) {
    header('location: /login');
    exit(); // Add this line to stop executing further code
} else {
    $config = require 'config.php';
    $db = new Database($config['database']);

    $item_total = isset($_GET['item_total']) ? $_GET['item_total'] : 0;

    if (isset($_POST['submit'])) { // Check if the 'submit' button is clicked
        foreach ($_SESSION["cart_item"] as $item) {
            $item_total += ($item["price"] * $item["quantity"]);

            $insertOrderQuery = "INSERT INTO users_orders (u_id, title, quantity, price) VALUES (?, ?, ?, ?)";
            $db->query($insertOrderQuery, [
                $_SESSION["user_id"],
                $item["title"],
                $item["quantity"],
                $item["price"]
            ]);
        }

        unset($_SESSION["cart_item"]);
        $success = "Thank you. Your order has been placed!";
        function_alert();
    }
}
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/icon.ico" type="image/x-icon">
    <title>Checkout | Macmac Express</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<?php require 'helpers.php'; ?>
<?php require 'views/partials/nav.php'; ?>

<body>

    <div class="site-wrapper">

        <div class="page-wrapper">
            <div class="top-links">
                <div class="container">
                    <ul class="row links">

                        <li class="col-xs-12 col-sm-4 link-item"><span>1</span><a href="restaurants.php">Choose Restaurant</a></li>
                        <li class="col-xs-12 col-sm-4 link-item "><span>2</span><a href="#">Pick Your favorite food</a></li>
                        <li class="col-xs-12 col-sm-4 link-item active"><span>3</span><a href="checkout.php">Order and Pay</a></li>
                    </ul>
                </div>
            </div>

            <div class="container">
                <span style="color:green;">
                    <?php echo $success; ?>
                </span>
            </div>

            <!-- CART ADDITION OF PRICES -->

            <div class="container m-t-30">
                <form action="" method="post">
                    <div class="widget clearfix">
                        <div class="widget-body">
                            <form method="post" action="#">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="cart-totals margin-b-20">
                                            <div class="cart-totals-title">
                                                <h4>Cart Summary</h4>
                                            </div>
                                            <div class="cart-totals-fields">

                                                <table class="table">
                                                    <tbody>
                                                        <tr>
                                                            <td>Cart Subtotal</td>
                                                            <td><?php echo "₱" . $item_total; ?></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Delivery Charges</td>
                                                            <td>Free</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="text-color"><strong>Total</strong></td>
                                                            <td class="text-color"><strong><?php echo "₱" . $item_total; ?></strong></td>
                                                        </tr>
                                                    </tbody>

                                                    <!-- PAYMENT OPTIONS  -->

                                                </table>
                                            </div>
                                        </div>
                                        <div class="payment-option">
                                            <ul class=" list-unstyled">
                                                <li>
                                                    <label class="custom-control custom-radio  m-b-20">
                                                        <input name="mod" id="radioStacked1" checked value="COD" type="radio" class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description">Cash on Delivery</span>
                                                    </label>
                                                </li>
                                                <li>
                                                    <label class="custom-control custom-radio  m-b-10">
                                                        <input name="mod" type="radio" value="paypal" disabled class="custom-control-input"> <span class="custom-control-indicator"></span> <span class="custom-control-description"><img src="images/gcash-banner.png" alt="Gcash" width="80px" height="25px">(Unavailable)</span> </label>
                                                </li>
                                            </ul>
                                            <p class="text-xs-center"> <input type="submit" onclick="return confirm('Do you want to confirm the order?');" name="submit" class="btn btn-success btn-block" value="Order Now"> </p>
                                        </div>
                            </form>
                        </div>
                    </div>
            </div>
        </div>
        </form>
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
    <br><br>
</body>


<?php require 'views/partials/footer.php'; ?>


</html>