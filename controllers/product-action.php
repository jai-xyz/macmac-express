<?php

$config = require 'config.php';

$db = new Database($config['database']);


if (!empty($_GET["action"])) {
    $productId = isset($_GET['id']) ? htmlspecialchars($_GET['id']) : '';
    $quantity = isset($_POST['quantity']) ? htmlspecialchars($_POST['quantity']) : '';

    switch ($_GET["action"]) {
        case "add":
            if (!empty($quantity)) {
                $query = "SELECT * FROM dishes WHERE d_id = :product_id";
                $statement = $db->connection->prepare($query);
                $statement->execute(['product_id' => $productId]);
                $productDetails = $statement->fetch();

                $itemArray = [
                    $productDetails['d_id'] => [
                        'title' => $productDetails['title'],
                        'd_id' => $productDetails['d_id'],
                        'quantity' => $quantity,
                        'price' => $productDetails['price']
                    ]
                ];

                if (!empty($_SESSION["cart_item"])) {
                    if (array_key_exists($productDetails['d_id'], $_SESSION["cart_item"])) {
                        $_SESSION["cart_item"][$productDetails['d_id']]["quantity"] += $quantity;
                    } else {
                        $_SESSION["cart_item"] += $itemArray;
                    }
                } else {
                    $_SESSION["cart_item"] = $itemArray;
                }
            }
            break;

        case "remove":
            if (!empty($_SESSION["cart_item"])) {
                if (array_key_exists($productId, $_SESSION["cart_item"])) {
                    unset($_SESSION["cart_item"][$productId]);
                }
            }
            break;

        case "empty":
            unset($_SESSION["cart_item"]);
            break;

        case "check":
            header("Location: checkout.php");
            exit;
            break;
    }
}
?>