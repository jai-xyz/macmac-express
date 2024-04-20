<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

require 'Database.php';

$config = require 'config.php';

$db = new Database($config['database']);

session_start();

include_once 'controllers/product-action.php';

// Check if a restaurant ID is provided in the URL
if (isset($_GET['res_id'])) {
    $res_id = $_GET['res_id'];

    // Fetch the restaurant details
    $restaurant = $db->query("SELECT * FROM restaurant WHERE rs_id = ?", [$res_id])->fetch();
    $rows = $restaurant;
    

} else {
    // Redirect to the restaurants page if no restaurant ID is provided
    header("Location: restaurants.php");
    exit();
}

// Check if an action is specified in the URL (add/remove)
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    // Check if the action is to add a dish to the cart
    if ($action === 'add' && isset($_GET['id'])) {
        $dish_id = $_GET['id'];

        // Fetch the dish details for the specific restaurant
        $stmt = $db->query("SELECT * FROM dishes WHERE rs_id = ?", [$res_id]);
        $products = $stmt->fetchAll();

      
        // Add the dish to the cart
        if ($dish) {
            $cart_item = [
                'id' => $dish['d_id'],
                'title' => $dish['title'],
                'price' => $dish['price'],
                'quantity' => 1
            ];

            if (!isset($_SESSION["cart_item"])) {
                $_SESSION["cart_item"] = [];
            }

            $existing_item = array_filter($_SESSION["cart_item"], function ($item) use ($dish_id) {
                return $item['id'] === $dish_id;
            });

            if (!empty($existing_item)) {
                $key = key($existing_item);
                $_SESSION["cart_item"][$key]['quantity'] += 1;
            } else {
                $_SESSION["cart_item"][] = $cart_item;
            }
        }
    }

    // Check if the action is to remove a dish from the cart
    if ($action === 'remove' && isset($_GET['id'])) {
        $dish_id = $_GET['id'];
    
        if (!empty($_SESSION["cart_item"])) {
            foreach ($_SESSION["cart_item"] as $key => $item) {
                if ($dish_id == $item['id']) {
                    unset($_SESSION["cart_item"][$key]);
                    break;
                }
            }
        }
    }

    // Redirect back to the dishes page with the restaurant ID
    header("Location: dishes.php?res_id=$res_id");
    exit();
}

// Calculate the total price of items in the cart
$item_total = 0;
if (!empty($_SESSION["cart_item"])) {
    foreach ($_SESSION["cart_item"] as $item) {
        $item_total += ($item["price"] * $item["quantity"]);
    }
}
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
    <title>Dishes | Macmac Express</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
  
</head>

<?php require 'helpers.php'; ?>
<?php require 'views/partials/nav.php';?>

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
    <section class="inner-page-hero bg-image" style="background-image: url('images/img/indexbg3.png');">
        <div class="profile">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 profile-img">
                        <div class="image-wrap">
                            <figure>
                            <?php if (isset($rows['image'])) : ?>
                            <?php echo '<img src="admin/Res_img/' . $rows['image'] . '" alt="Restaurant logo">'; ?>
                           <?php endif; ?>
                            </figure>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 profile-desc">
                        <div class="pull-left right-text white-txt">    
        <h6><a href="#"><?php echo isset($rows['title']) ? $rows['title'] : ''; ?></a></h6>
        <p><?php echo isset($rows['address']) ? $rows['address'] : ''; ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container m-t-30">
        <div class="row">
            <div class="col-xs-12 col-sm-4 col-md-4 col-lg-3">
                <div class="widget widget-cart">
                    <div class="widget-heading">
                        <h3 class="widget-title text-dark">Your Cart</h3>
                        <div class="clearfix"></div>
                    </div>
                    <div class="order-row bg-white">
                        <div class="widget-body">
                        <?php
                            $item_total = 0;
                            if (isset($_SESSION["cart_item"]) && is_array($_SESSION["cart_item"])) {
                                foreach ($_SESSION["cart_item"] as $item) {
                                    ?>
                                    <div class="title-row">
                                        <?php echo $item["title"]; ?><a href="dishes.php?res_id=<?php echo $_GET['res_id']; ?>&action=remove&id=<?php echo $item["d_id"]; ?>">
                                            <i class="fa fa-trash pull-right"></i></a>
                                    </div>
                                    <div class="form-group row no-gutter">
                                        <div class="col-xs-8">
                                            <input type="text" class="form-control b-r-0" value=<?php echo "₱" . $item["price"]; ?> readonly id="exampleSelect1">
                                        </div>
                                        <div class="col-xs-4">
                                            <input class="form-control" type="text" readonly value='<?php echo "QTY " . $item["quantity"]; ?>' id="example-number-input">
                                        </div>
                                    </div>
                                    <?php
                                    $item_total += ($item["price"] * $item["quantity"]);
                                }
                            }
?>
                        </div>
                    </div>
                    <div class="widget-body">
                        <div class="price-wrap text-xs-center">
                            <p>TOTAL</p>
                            <h3 class="value"><strong><?php echo "₱" . $item_total; ?></strong></h3>
                            <p>Free Delivery!</p>
                            <?php if ($item_total == 0) { ?>
                                <a href="checkout.php?res_id=<?php echo $_GET['res_id']; ?>&action=check" class="btn btn-danger btn-lg disabled">Checkout</a>
                            <?php } else { ?>
                                <a href="checkout.php?res_id=<?php echo $_GET['res_id']; ?>&item_total=<?php echo $item_total; ?>" class="btn btn-success btn-lg active">Checkout</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="menu-widget" id="2">
                    <div class="widget-heading">
                        <h3 class="widget-title text-dark">
                            MENU
                            <a class="btn btn-linkpull-right" data-toggle="collapse" href="#popular2" aria-expanded="true">
                                <i class="fa fa-angle-right pull-right"></i>
                                <i class="fa fa-angle-down pull-right"></i>
                            </a>
                        </h3>
                        <div class="clearfix"></div>
                    </div>
                    <div class="collapse in" id="popular2">
                                <?php
                        $stmt = $db->query("SELECT * FROM dishes WHERE rs_id = ?", [$res_id]);
                        $products = $stmt->fetchAll();

                        if (!empty($products)) {
                            foreach ($products as $product) {
                        ?>
                              <div class="food-item">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-lg-8">
                                            <form method="post" action='dishes.php?res_id=<?php echo $_GET['res_id']; ?>&action=add&id=<?php echo $product['d_id']; ?>'>
                                                <div class="rest-logo pull-left">
                                                    <a class="restaurant-logo pull-left" href="#"><?php echo '<img src="admin/Res_img/dishes/' . $product['img'] . '" alt="Food logo">'; ?></a>
                                                </div>
                                                <div class="rest-descr">
                                                    <h6><a href="#"><?php echo $product['title']; ?></a></h6>
                                                    <p><?php echo $product['slogan']; ?></p>
                                                </div>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-lg-3 pull-right item-cart-info">
                                            <span class="price pull-left">₱<?php echo $product['price']; ?></span>
                                            <input class="b-r-0" type="text" name="quantity" style="margin-left:30px;" value="1" size="2" />
                                            <input type="submit" class="btn theme-btn" style="margin-left:40px;" value="Add To Cart" />
                                        </div>
                                        </form>
                                    </div>
                                </div>
                        <?php
                            }
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
<br>
</body>

<?php require 'views/partials/footer.php'; ?>

</html>