<?php
include('includes/connect.php');
include('functions/functions.php');
session_start();
if (!isset($_SESSION['username'])) {

    echo "<script>window.open('login.php','_self')</script>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css"
        integrity="sha384-eoTu3+HydHRBIjnCVwsFyCpUDZHZSFKEJD0mc3ZqSBSb6YhZzRHeiomAUWCstIWo" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <title>cart</title>
    <style>
        .cart_img {
            height: 50px;
            width: 50px;
        }
    </style>
</head>

<body>
    <div class="container-fluid  p-0">
        <nav class="navbar navbar-expand-lg navbar-light bg-success">
            <div class="container-fluid ">
                <a class="navbar-brand" href="index.php">E-Bookshop</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="index.php">home</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link" href="display.php">products</a>
                        </li>
                        <li class="nav-item">
                        <?php
                            if (!isset($_SESSION['username'])) {
                            echo "
                            <a class='nav-link' href='registration.php'>register</a>";
                            }
                            else
                            {
                                echo "
                                <a class='nav-link' href='user_profile.php'>my profile</a>";
                            }
                            ?>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php">cart <i class="fa fa-shopping-cart"
                                    aria-hidden="true"></i><sup>

                                    <?php
                                    if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
                                        $user_id = $_SESSION['user_id'];
                                        cart_item_numbering($user_id);
                                    }?>
                                </sup></a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="#">Total Price:RS <?php total_price() ?></a>
                        </li> -->
                        <li class="nav-item">
                            <a class="nav-link" href="#">contact us</a>
                        </li>

                    </ul>

                </div>
            </div>
        </nav>
    </div>

    <?php
    cart()
        ?>
 <nav class="navbar navbar-expand-lg navbar-dark bg-secondary p-0">
        <ul class="navbar-nav me-auto">
            
            <?php
            if (!isset($_SESSION['user_id'])) {
                echo " <li class='nav-item'>
                <a class='nav-link' href='index.php'>Welcome GUEST</a>
            </li>";
            } else {
                echo " <li class='nav-item'>
                <a class='nav-link' href='user_profile.php'>Welcome ".$_SESSION['username']."</a>
            </li>";
            }
               if(!isset( $_SESSION['username']))
               {
                echo" <li class='nav-item'>
                <a class='nav-link' href='login.php'>login</a>
            </li>";
               } 
               else
               {
                echo" <li class='nav-item'>
                <a class='nav-link' href='logout.php'>logout</a>
            </li>";
               }
            ?>
        </ul>
    </nav>
    <div class="container mt-5">
        <div class="row">
            <form action="" method="post">
                <table class="table table-bordered text-center text-uppercase">
                    <?php

                   if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
                    global $con;
                    // $get_ip_address = getIPAddress();
                    $total = 0;

                    
                    $user_id = $_SESSION['user_id'];

                    $cart = "select * from `cart_details`  WHERE user_id = $user_id";
                    $result = mysqli_query($con, $cart);
                    $rows_count = mysqli_num_rows($result);
 


                    if ($rows_count > 0 ) {
                        echo "
                    <thead>
                        <tr>
                            <th>book title</th>
                            <th>book image</th>
                            <th>quantity</th>
                            <th>grand total</th>


                        </tr>
                    </thead>
                    <tbody>";
                    
                        while ($row = mysqli_fetch_array($result)) {
                            $product_id = $row['product_id'];
                            $product_table = "select * from `products` where product_id=$product_id";
                            $result1 = mysqli_query($con, $product_table);
                            while ($row_product_price = mysqli_fetch_array($result1)) {
                                $product_price = $row_product_price['product_price'];
                                $row_title = $row_product_price['product_title'];
                                $row_img = $row_product_price['product_image_1'];
                                $quantity = $row['quantity'];

                                $product_total = $product_price * $quantity;
                                $total += $product_total;
                                ?>

                                <tr>
                                    <td>
                                        <?php echo $row_title; ?>
                                    </td>
                                    <td><img src="./admin/books_images/<?php echo $row_img; ?>" class="cart_img" alt="image">
                                    </td>
                                    <td>
                                        <form method="post">
                                            <input type="text" class="form-input w-50" autocomplete="off" name="quantity"
                                                value="<?php echo $quantity; ?>">
                                            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                            <input type="submit" class="btn btn-success" value="update" name="update_cart">
                                            <input type="submit" class="btn btn-success" value="remove" name="remove_cart">


                                        </form>
                                    </td>
                                    <td>
                                        <?php echo $product_total; ?>
                                    </td>


                                </tr>
                            <?php }
                        }

                        if (isset($_POST['update_cart'])) {
                            $quantity = (int) $_POST['quantity'];
                            $product_id = (int) $_POST['product_id'];
                            $update_cart = "UPDATE `cart_details` SET quantity = $quantity WHERE product_id = $product_id AND user_id = $user_id";
                            $result2 = mysqli_query($con, $update_cart);

                            if (!$result2) {
                                die('Error: ' . mysqli_error($con));
                            }
                            echo "<script>window.open('cart.php','_self')</script>";
                        }

                        if (isset($_POST['remove_cart'])) {
                            $product_id = (int) $_POST['product_id'];
                            $delete_cart = "DELETE FROM `cart_details` WHERE product_id = $product_id AND user_id = $user_id";
                            $result3 = mysqli_query($con, $delete_cart);

                            if (!$result3) {
                                die('Error: ' . mysqli_error($con));
                            }

                            echo "<script>window.open('cart.php','_self')</script>";
                            exit;
                        }

                    } else {
                        echo "<h2 class='text-center text-uppercase'>cart is empty</h2>";
                        echo "<p class='text-center'>add items to cart</p>";
                    }
                    ?>

                    </tbody>

                </table>
                <div class="mt-2 d-flex mb-3">
                    <?php
                    global $con;
                    $get_ip_address = getIPAddress();
                    $cart = "select * from `cart_details`   WHERE user_id = $user_id";
                    $result = mysqli_query($con, $cart);
                    $rows_count = mysqli_num_rows($result);
                    if ($rows_count > 0) {
                        echo "<h6 class='text-uppercase'>subtotal: RS
                         $total 
                    </h6>
                    <input type='submit' name='continue_shopping' class='mx-2 btn btn-success' value='continue shopping' >
                     
                    <input type='submit' name='check_out' class='mx-2 btn btn-success' value='check out' >
                    ";
                    }
                    else
                    {
                      echo "<input type='submit' name='continue_shopping' class='mx-auto btn btn-success' value='continue shopping' >";
                    }
                    if (isset($_POST['continue_shopping'])) {
                        echo "<script>window.location.href = 'index.php';</script>";
                        exit;
                    }
                    if (isset($_POST['check_out'])) {
                        echo "<script>window.location.href = 'checkout.php';</script>";
                        exit;
                    }
                }
                else {
                    echo "<h2 class='text-center text-warning text-uppercase'>Please log in to view your cart.</h2>";
                }
                    
                    ?>
                </div>


            </form>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>