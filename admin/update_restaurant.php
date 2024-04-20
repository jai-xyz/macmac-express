<?php
session_start();

error_reporting(0);

require '../Database.php';

$config = require '../config.php';

$db = new Database($config['database']);

$error = "";
$success = "";
if (isset($_POST['submit'])) {
    if (empty($_POST['res_name']) || empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['url']) || empty($_POST['o_hr']) || empty($_POST['c_hr']) || empty($_POST['o_days']) || empty($_POST['address'])) {
        $error = '<div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>All fields Must be Fillup!</strong>
                </div>';
    } else {
        $fname = $_FILES['file']['name'];
        $temp = $_FILES['file']['tmp_name'];
        $fsize = $_FILES['file']['size'];
        $extension = explode('.', $fname);
        $extension = strtolower(end($extension));
        $fnew = uniqid() . '.' . $extension;

        $store = "Res_img/" . basename($fnew);

        if ($extension == 'jpg' || $extension == 'png' || $extension == 'gif') {
            if ($fsize >= 2000000) {
                $error = '<div class="alert alert-danger alert-dismissible fade show">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong>Max Image Size is 2MB!</strong> Try a different Image.
                        </div>';
            } else {
                $res_name = $_POST['res_name'];

                $query = "UPDATE restaurant SET c_id = :c_id, title = :title, email = :email, phone = :phone, url = :url, o_hr = :o_hr, c_hr = :c_hr, o_days = :o_days, address = :address, image = :image WHERE rs_id = :res_upd";
                $params = array(
                    ':c_id' => $_POST['c_name'],
                    ':title' => filter_input(INPUT_POST, "res_name",FILTER_SANITIZE_SPECIAL_CHARS),
                    ':email' => filter_input(INPUT_POST, "email",FILTER_SANITIZE_EMAIL),
                    ':phone' => filter_input(INPUT_POST, "phone",FILTER_SANITIZE_SPECIAL_CHARS),
                    ':url' => filter_input(INPUT_POST, "url",FILTER_SANITIZE_SPECIAL_CHARS),
                    ':o_hr' => filter_input(INPUT_POST, "o_hr",FILTER_SANITIZE_SPECIAL_CHARS),
                    ':c_hr' => filter_input(INPUT_POST, "c_hr",FILTER_SANITIZE_SPECIAL_CHARS),
                    ':o_days' =>  filter_input(INPUT_POST, "o_days",FILTER_SANITIZE_SPECIAL_CHARS),
                    ':address' =>  filter_input(INPUT_POST, "address",FILTER_SANITIZE_SPECIAL_CHARS),
                    ':image' => $fnew,
                    ':res_upd' => $_GET['res_upd']
                );

                $statement = $db->query($query, $params);
                move_uploaded_file($temp, $store);

                $success = '<div class="alert alert-success alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <strong>Record Updated!</strong>.
                            </div>';
            }
        } elseif ($extension == '') {
            $error = '<div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Select an image</strong>
                    </div>';
        } else {
            $error = '<div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Invalid extension!</strong> Only PNG, JPG, and GIF are accepted.
                    </div>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../images/icon.ico" type="image/x-icon">
    <title>Update Stall | Admin</title>
    <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
    <link href="css/helper.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body class="fix-header">

    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
        </svg>
    </div>

    <div id="main-wrapper">

        <div class="header">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
                <div class="navbar-header">
                    <a class="navbar-brand" href="dashboard.php">
                    <span><img class="img-rounded" src="images/finallogo-admin.png" alt=""  width="270px;"></span>
                    </a>
                </div>
                <div class="navbar-collapse">
                    <ul class="navbar-nav mr-auto mt-md-0">
                    </ul>
                    <ul class="navbar-nav my-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted  " href="#" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false"><img src="images/admin-logo-final.png" alt="user"
                                    class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right animated zoomIn">
                                <ul class="dropdown-user">
                                    <li><a href="logout.php"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <div class="left-sidebar">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li class="nav-label">Home</li>
                        <li> <a href="dashboard.php"><i class="fa fa-tachometer"></i><span>Dashboard</span></a></li>
                        <li class="nav-label">Log</li>
                        <li> <a href="all_users.php"> <span><i class="fa fa-user f-s-20 "></i></span><span>Users</span></a></li>
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-archive f-s-20 color-warning"></i><span
                                    class="hide-menu">Stall</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="all_restaurant.php">All Stalls</a></li>
                                <li><a href="add_category.php">Add Category</a></li>
                                <li><a href="add_restaurant.php">Add Stall</a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow  " href="#" aria-expanded="false"><i class="fa fa-cutlery" aria-hidden="true"></i><span
                                    class="hide-menu">Menu</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="all_menu.php">All Menus</a></li>
                                <li><a href="add_menu.php">Add Menu</a></li>
                            </ul>
                        </li>
                        <li> <a href="all_orders.php"><i class="fa fa-shopping-cart" aria-hidden="true"></i><span>Orders</span></a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <div class="page-wrapper">
            <div style="padding-top: 10px;"></div>
        
            <div class="container-fluid">
                <?php echo $error;
                    echo $success; ?>
                <div class="col-lg-12">
                    <div class="card card-outline-primary">
                        <div class="card-header">
                            <h4 class="m-b-0 text-white">Update Stall Details</h4>
                        </div>
                        <div class="card-body">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="form-body">
                                    <?php
                                        $query = "SELECT * FROM restaurant WHERE rs_id = :res_upd";
                                        $params = array(':res_upd' => $_GET['res_upd']);
                                        $statement = $db->query($query, $params);
                                        $row = $statement->fetch();
                                    ?>
                                    <hr>
                                    <div class="row p-t-20">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Stall Name</label>
                                                <input type="text" name="res_name" value="<?php echo $row['title']; ?>" class="form-control"
                                                    placeholder="" autocomplete="off" >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group has-danger">
                                                <label class="control-label">Business E-mail</label>
                                                <input type="text" name="email" value="<?php echo $row['email']; ?>" class="form-control form-control-danger"
                                                    placeholder="example@gmail.com" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row p-t-20">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Phone</label>
                                                <input type="text" name="phone" class="form-control" value="<?php echo $row['phone']; ?>"
                                                    placeholder="+63900000000" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group has-danger">
                                                <label class="control-label">Website URL</label>
                                                <input type="text" name="url" class="form-control form-control-danger" value="<?php echo $row['url']; ?>"
                                                    placeholder="http://example.com" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Open Hours</label>
                                                <select name="o_hr" class="form-control custom-select" data-placeholder="Choose a Category">
                                                    <option>--Select your Hours--</option>
                                                    <option value="6am">6am</option>
                                                    <option value="7am">7am</option>
                                                    <option value="8am">8am</option>
                                                    <option value="9am">9am</option>
                                                    <option value="10am">10am</option>
                                                    <option value="11am">11am</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Close Hours</label>
                                                <select name="c_hr" class="form-control custom-select" data-placeholder="Choose a Category">
                                                    <option>--Select your Hours--</option>
                                                    <option value="3pm">3pm</option>
                                                    <option value="4pm">4pm</option>
                                                    <option value="5pm">5pm</option>
                                                    <option value="6pm">6pm</option>
                                                    <option value="7pm">7pm</option>
                                                    <option value="8pm">8pm</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Open Days</label>
                                                <select name="o_days" class="form-control custom-select" data-placeholder="Choose a Category"
                                                    tabindex="1">
                                                    <option>--Select your Days--</option>
                                                    <option value="mon-tue">mon-tue</option>
                                                    <option value="mon-wed">mon-wed</option>
                                                    <option value="mon-thu">mon-thu</option>
                                                    <option value="mon-fri">mon-fri</option>
                                                    <option value="mon-sat">mon-sat</option>
                                                    <option value="24hr-x7">24hr-x7</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Image</label>
                                                <input type="file" name="file" id="lastName" class="form-control form-control-danger"
                                                    placeholder="12n">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label class="control-label">Select Category</label>
                                                <select name="c_name" class="form-control custom-select" data-placeholder="Choose a Category"
                                                    tabindex="1">
                                                    <option>--Select Category--</option>
                                                    <?php
                                                        $query = "SELECT * FROM res_category";
                                                        $statement = $db->query($query);
                                                        $rows = $statement->fetchAll();

                                                        foreach ($rows as $row) {
                                                            echo '<option value="' . $row['c_id'] . '">' . $row['c_name'] . '</option>';
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <h3 class="box-title m-t-40">Stall Number</h3>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <textarea name="address" type="text" style="height:100px;"
                                                    class="form-control"><?php echo $row['address']; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        <div class="form-actions">
                            <input type="submit" name="submit" class="btn btn-success" value="Save">
                            <a href="all_restaurant.php" class="btn btn-inverse">Cancel</a>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <?php require "partials/footer.php" ?>
        </div>
    </div>
    </div>
    </div>
    <script src="js/lib/jquery/jquery.min.js"></script>
    <script src="js/lib/bootstrap/js/popper.min.js"></script>
    <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
    <script src="js/jquery.slimscroll.js"></script>
    <script src="js/sidebarmenu.js"></script>
    <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="js/custom.min.js"></script>
</body>

</html>
