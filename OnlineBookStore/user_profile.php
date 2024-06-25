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
    <title>Welcome <?php echo $_SESSION['username']?> </title>
    <style>
        .user_img
        {
            width: 100px;
            height: 100px;
        }
    </style>
</head>

<body>
    <div class="container-fluid  p-0">
        <nav class="navbar navbar-expand-lg navbar-light bg-success">
            <div class="container-fluid ">
                <a class="navbar-brand" href="#">E-Bookshop</a>
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
                        <li class="nav-item">
                            <a class="nav-link" href="#">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="display.php">products</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="registration.php">register</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="cart.php">cart <i class="fa fa-shopping-cart"
                                    aria-hidden="true"></i><sup>
                                    <?php
                                    if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
                                        $user_id = $_SESSION['user_id'];
                                        cart_item_numbering($user_id);
                                    } ?>
                                </sup></a>
                        </li> -->

                        <li class="nav-item">
                            <a class="nav-link" href="#">contact us</a>
                        </li>

                    </ul>
                    <!-- <form class="d-flex" action="scearch.php" method="get">
                        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                            name="scearch_data">

                        <input type="submit" value="scearch" class="btn btn-success" name="scearch_data_product">
                    </form> -->
                </div>
            </div>
        </nav>
    </div>

   

    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary p-0">
        <ul class="navbar-nav me-auto">


            <?php

            if (!isset($_SESSION['username'])) {
                echo " <li class='nav-item'>
                <a class='nav-link' href='index.php'>Welcome GUEST</a>
            </li>";
            } else {
                echo " <li class='nav-item'>
                <a class='nav-link' href='user_profile.php'>Welcome " . $_SESSION['username'] . $_SESSION['user_id'] . "</a>
            </li>";
            }
            if (!isset($_SESSION['username'])) {
                echo " <li class='nav-item'>
                <a class='nav-link' href='login.php'>login</a>
            </li>";
            } else {
                echo " <li class='nav-item'>
                <a class='nav-link' href='logout.php'>logout</a>
            </li>";
            }
            ?>
        </ul>
    </nav>

    <div class="row m-0">
        <div class="col-md-2 bg-secondary p-0">
            <ul class="navbar-nav me-auto text-center">
                <li class="nav-item bg-success">
                   
                        <h4 class="text-white mt-2">your profile</h4>
                    

                </li>
                <?php
                $user_name = $_SESSION['username'];
                $user_id = $_SESSION['user_id'];
                $select_img = "SELECT * FROM `user` where user_name='$user_name'";
                $result_img = mysqli_query($con, $select_img);
                $row_img = mysqli_fetch_assoc($result_img);
                $user_img = $row_img['user_img'];
                echo "<li class='nav-item'>
                <img src='./user_images/$user_img' class='img-thumbnail mt-3 img-fluid user_img' alt='user_img'>

            </li>";
                ?>

                <li class='nav-item'>
                    <a href='user_profile.php?pending_order' class='nav-link text-light'>pending order</a>
                </li>
                <li class='nav-item'>
                    <a href='user_profile.php?edit_account' class='nav-link text-light'>edit account</a>
                </li>
                <li class='nav-item'>
                    <a href='user_profile.php?my_orders' class='nav-link text-light'>my orders</a>
                </li>
                <li class='nav-item'>
                    <a href='user_profile.php?delete_account' class='nav-link text-light'>delete account</a>
                </li>

            </ul>


        </div>
        <div class="col-md-10">
             
            <?php
            get_user_info();
            if(isset($_GET['pending_order']))
            {
                include('pending_order.php');
            }
            if(isset($_GET['edit_account']))
            {
               include('edit_account.php');
            }
            if(isset($_GET['my_orders']))
            {
               include('user_orders.php');
            }
            if(isset($_GET['delete_account']))
            {
               include('deleteuser.php');
            }
            ?>
            
        </div>

    </div>

    <footer>
        <p class="text-center">a footer</p>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>