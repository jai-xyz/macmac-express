
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/icon.ico" type="image/x-icon">
    <title>My Orders | Macmac Express</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <style type="text/css" rel="stylesheet">
    .indent-small {
        margin-left: 5px;
    }

    .form-group.internal {
        margin-bottom: 0;
    }

    .dialog-panel {
        margin: 10px;
    }

    .datepicker-dropdown {
        z-index: 200 !important;
    }

    .panel-body {
        background: #e5e5e5;
        /* Old browsers */
        background: -moz-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
        /* FF3.6+ */
        background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, #e5e5e5), color-stop(100%, #ffffff));
        /* Chrome,Safari4+ */
        background: -webkit-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
        /* Chrome10+,Safari5.1+ */
        background: -o-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
        /* Opera 12+ */
        background: -ms-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
        /* IE10+ */
        background: radial-gradient(ellipse at center, #e5e5e5 0%, #ffffff 100%);
        /* W3C */
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#e5e5e5', endColorstr='#ffffff', GradientType=1);
        font: 600 15px "Open Sans", Arial, sans-serif;
    }

    label.control-label {
        font-weight: 600;
        color: #777;
    }

    @media only screen and (max-width: 760px),
    (min-device-width: 768px) and (max-device-width: 1024px) {
    }
        </style>

</head>

<?php require 'partials/nav.php'; ?>

<div class="page-wrapper">

    <div class="inner-page-hero" style="background-image: url('images/img/indexbg3.png'); background-size: cover; background-position: center center;">
        <div class="container"> </div>

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
            <div class="col-xs-12">
            </div>
            <div class="col-xs-12">
                <div class="bg-gray">
                    <div class="row">

                    <!-- TABLE ORDERS -->
                    <table class="table table-bordered table-hover">
                    <thead style="background: #404040; color:white;">
                        <tr>
                            <th>Food</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                         <?php
                            if (empty($orders)) {
                                echo '<tr><td colspan="6"><center> You have NO orders placed YET. </center></td></tr>';
                            } else {
                                foreach ($orders as $row) {
                            ?>
                            <tr>
                                    <td data-column="Food"><?php echo $row['title']; ?></td>
                                    <td data-column="Quantity"><?php echo $row['quantity']; ?></td>
                                    <td data-column="price">₱<?php echo $row['price']; ?></td>
                                    <td data-column="status">
                                    <?php 
                                        $status = $row['status'];
                                        if ($status == "" || $status == "NULL") {
                                        ?>
                                       <button type="button" class="btn btn-info"><span class="fa fa-bars" aria-hidden="true"></span> Dispatch</button>
                                        <?php 
                                        } elseif ($status == "in process") { 
                                        ?>
                                        <button type="button" class="btn btn-warning"><span class="fa fa-cog fa-spin" aria-hidden="true"></span> On The Way!</button>
                                        <?php
                                        } elseif ($status == "closed") {
                                        ?>
                                        <button type="button" class="btn btn-success"><span class="fa fa-check-circle" aria-hidden="true"></span> Delivered</button>
                                        <?php 
                                        } elseif ($status == "rejected") { 
                                        ?>
                                        <button type="button" class="btn btn-danger"> <i class="fa fa-close"></i> Cancelled</button>
                                        <?php 
                                        } 
                                        ?>
                                      </td>
                                <td data-column="Date"><?php echo $row['date']; ?></td>
                                <td data-column="Action">
                                    <a href="delete_orders.php?order_del=<?php echo $row['o_id'];?>" onclick="return confirm('Are you sure you want to cancel your order?');" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10">
                                        <i class="fa fa-trash-o" style="font-size:16px"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php 
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br> <br> <br>
</section>


    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animsition.min.js"></script>
    <script src="js/bootstrap-slider.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/headroom.js"></script>
    <script src="js/foodpicky.min.js"></script>
<br><br><br><br><br><br>
</body>

<?php require 'partials/footer.php' ?>

</html>