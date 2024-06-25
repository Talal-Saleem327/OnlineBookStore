<?php
include('../includes/connect.php');
session_start();
if (!isset($_SESSION['admin_name'])) {

    echo "<script>window.open('login.php','_self')</script>";
    exit();
}
function get_admin_info()
{

    global $con;
    $admin_id = $_SESSION['admin_id'];
    //echo"$admin_id";
    if (!isset($_GET['insert_category'])) {
        if (!isset($_GET['insert_brands'])) {
            if (!isset($_GET['view_products'])) {
                if (!isset($_GET['edit_products'])) {
                    if (!isset($_GET['delete_products'])) {
                        if (!isset($_GET['view_category'])) {
                            if (!isset($_GET['view_brands'])) {
                                if (!isset($_GET['edit_category'])) {
                                    if (!isset($_GET['delete_category'])) {
                                        if (!isset($_GET['edit_brand'])) {
                                            if (!isset($_GET['delete_brand'])) {
                                                if (!isset($_GET['all_payments'])) {
                                                    if (!isset($_GET['all_users'])) {
                                                        if (!isset($_GET['all_orders'])) {


                                                            $admin_id = $_SESSION['admin_id'];
                                                            $admin_name = $_SESSION['admin_name'];
                                                            $select_data = "SELECT * FROM `admin` WHERE admin_name='$admin_name'";
                                                            $result_data = mysqli_query($con, $select_data);
                                                            $row = mysqli_fetch_assoc($result_data);
                                                            $lastname = $row['last_name'];
                                                            $email = $row['email'];
                                                            $cell = $row['cell'];
                                                            $img = $row['img'];
                                                            echo "
                    <h2 class='text-center text-success mt-5 text-uppercase'>Admin info</h2>
                    <div class='form-outline m-auto mt-4'>
                    <img src='./admin_images/$img' class=' mx-auto d-block img-thumbnail bg-danger img img-fluid ' alt=''>
                  </div>
                    <div class='form-outline mt-4'>
                    <input type='text' class='w-50 form-control mx-auto' name='user_name' value='$admin_name ' disabled>
                  </div>
                  <div class='form-outline mt-4'>
                    <input type='text' class='w-50 form-control mx-auto' name='last_name' 
                    value='$lastname' disabled>
                  </div>
                  <div class='form-outline mt-4'>
                    <input type='email' class='w-50 form-control mx-auto' name='email' value='$email' disabled>
                  </div>
                  <div class='form-outline mt-4 mb-4'>
                    <input type='text' class='w-50 form-control mx-auto mt-4' name='cell' value='$cell' disabled>
                  </div>

                    ";



                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }


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
    <meta charset="UTF-8">
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
    <title>
        <?php
        if (!isset($_SESSION['admin_name'])) {
            echo "login";
        } else {
            echo "welcome" . $_SESSION['admin_name'];
        }
        ?>
    </title>
    <style>
        .img {
            height: 100px;
            width: 100px;
        }
    </style>
</head>

<body>

    <div class="container-fluid p-0">
        <div class="d-flex justify-content-between  bg-warning">
            <div class="text-uppercase d-flex justify-content-start fw-bold text-danger mt-2 mx-2 navbar-light">

                <?php
                if (!isset($_SESSION['admin_name'])) {
                    echo "
                 
                     <a class='nav-link' href='login.php'>Welcome GUEST</a>
                 ";
                } else {
                    echo "  
                     Welcome " . $_SESSION['admin_name'] .
                        "</a>
                 ";
                }
                ?>

            </div>
            <div class='d-flex justify-content-end'>
                <?php
                if (!isset($_SESSION['admin_name'])) {
                    echo "
                <a class='nav-link text-decoration-none' href='login.php'>login</a>
            ";
                } else {
                    echo "  
                <a class='nav-link text-decoration-none text-uppercase fw-bold text-danger' href='logout.php'>logout</a>
            ";
                }
                ?>

            </div>
        </div>
    </div>


    <div class="container-fluid">
        <div class="row">
            <div class="col-md-2 bg-success p-1">
                <div class="container-fluid">
                    <div class="text-uppercase fw-bold text-warning">
                        <h3 class="text-center p-2">
                            Admin work
                        </h3>
                    </div>
                </div>
                <div class="button text-center">
                    <button class="my-1 btn "><a href="insert_product.php"
                            class="nav-link text-light bg-success my-1">insert
                            product</a></button>
                    <button class="my-1 btn"><a href="index.php?view_products"
                            class="nav-link text-light bg-success my-1">view product</a></button>
                    <button class="my-1 btn"><a href="index.php?insert_category"
                            class="nav-link text-light bg-success my-1">insert category</a></button>
                    <button class="my-1 btn"><a href="index.php?view_category"
                            class="nav-link text-light bg-success my-1">view category</a></button>
                    <button class="my-1 btn"><a href="index.php?insert_brands"
                            class="nav-link text-light bg-success my-1">insert brands</a>
                    </button>
                    <button class="my-1 btn"><a href="index.php?view_brands"
                            class="nav-link text-light bg-success my-1">views brands</a></button>
                    <button class="my-1 btn"><a href="index.php?all_orders"
                            class="nav-link text-light bg-success my-1">all orders</a></button>
                    <button class="my-1 btn"><a href="index.php?all_payments"
                            class="nav-link text-light bg-success my-1">all payment</a></button>
                    <button class="my-1 btn"><a href="index.php?all_users"
                            class="nav-link text-light bg-success my-1">liew/view
                            users</a></button>
                </div>
            </div>
            <div class="col-md-10">
                <div class="container mt-3">
                    <?php
                    get_admin_info();
                    if (isset($_GET['insert_category'])) {
                        include('insert_category.php');
                    }
                    if (isset($_GET['insert_brands'])) {
                        include('insert_brand.php');
                    }
                    if (isset($_GET['view_products'])) {
                        include('view_products.php');
                    }
                    if (isset($_GET['edit_products'])) {
                        include('edit_products.php');
                    }
                    if (isset($_GET['delete_products'])) {
                        include('delete_products.php');
                    }
                    if (isset($_GET['view_category'])) {
                        include('view_category.php');
                    }
                    if (isset($_GET['view_brands'])) {
                        include('view_brands.php');
                    }
                    if (isset($_GET['edit_category'])) {
                        include('edit_category.php');
                    }
                    if (isset($_GET['delete_category'])) {
                        include('delete_category.php');
                    }
                    if (isset($_GET['edit_brand'])) {
                        include('edit_brand.php');
                    }
                    if (isset($_GET['delete_brand'])) {
                        include('delete_brand.php');
                    }
                    if (isset($_GET['all_orders'])) {
                        include('all_orders.php');
                    }
                    if (isset($_GET['all_payments'])) {
                        include('all_payments.php');
                    }
                    if (isset($_GET['all_users'])) {
                        include('all_users.php');
                    }

                    ?>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>