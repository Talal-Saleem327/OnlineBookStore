<?php
include('includes/connect.php');
include('functions/functions.php');
session_start();

if (!isset($_SESSION['username'])) {
    echo "<script>window.open('login.php','_self')</script>";
    exit();
}

if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $invoice_number = mt_rand();

    $cart_query = "SELECT * FROM `cart_details` WHERE user_id = $user_id";
    $cart_result = mysqli_query($con, $cart_query);
    $row_count=mysqli_num_rows($cart_result);     
    $price = 0;
    $product_count = 0;
    $order_details = array();

    while ($cart_row = mysqli_fetch_array($cart_result)) {
        $product_id = $cart_row["product_id"];
        $quantity = $cart_row["quantity"];
        $product_query = "SELECT * FROM `products` WHERE product_id = $product_id";
        $product_result = mysqli_query($con, $product_query);
        if ($product_row = mysqli_fetch_array($product_result)) {
            $product_price = $product_row["product_price"];

            $pro_Price = $product_price * $quantity;
            $price += $pro_Price;
            $product_count += $quantity;
            $order_details[] = array(
                'product_id' => $product_id,
                'quantity' => $quantity
            );
        }
    }
    $subtotal = $price;
    $status = 'pending';
    $insert_orders = "INSERT INTO `user_orders` (user_id, amount_remaining, invoice_number, product_total, order_date, order_status) 
                      VALUES ($user_id, $subtotal, '$invoice_number', $row_count, NOW(), '$status')";
    $result_orders = mysqli_query($con, $insert_orders);

    if ($result_orders) {

        foreach ($order_details as $order_item) {
            $product_id = $order_item['product_id'];
            $quantity = $order_item['quantity'];

            $insert_order_details_query = "INSERT INTO `pending_order` (product_id, user_id, quantity, invoice_number,order_status) 
                                           VALUES ($product_id, $user_id, $quantity, '$invoice_number','$status')";
            $result_insert_order_details = mysqli_query($con, $insert_order_details_query);

            if ($result_insert_order_details) {
                echo "Order details inserted successfully!<br>";
            } else {
                echo "Error in inserting order details: " . mysqli_error($con) . "<br>";
            }
        }

        $empty_cart = "DELETE FROM `cart_details` WHERE user_id = $user_id";
        $result_empty = mysqli_query($con, $empty_cart);

        echo "<script>window.open('orderid.php','_self')</script>";
        exit();
    } else {
        echo "Error in inserting user order: " . mysqli_error($con) . "<br>";
    }
} else {
    echo "<p>Login first</p>";
}
?>
