<?php
include('./includes/connect.php');
echo"
<style>
.img
{
    height:200px;
    width:200px;
}
</style>";
function products()
{
    global $con;
    if (!isset($_GET['categorie'])) {
        if (!isset($_GET['brand'])) {
            $select = "select * from `products` order by rand() limit 0,3";
            $result = mysqli_query($con, $select);
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['product_id'];
                $title = $row['product_title'];
                $description = $row['product_description'];
                $image1 = $row['product_image_1'];
                $price = $row['product_price'];
                $category_id = $row['category_id'];
                $brand_id = $row['brand_id'];

                echo "
        <div class='col-md-4 mb-2 mt-2'>
        <div class='card'>
            <img src='./admin/books_images/$image1' class='img card-img-top' alt='$title'>
            <div class='card-body'>
                <h5 class='card-title'>$title</h5>
                <p class='card-text'>$description</p>
                <p class='card-text'>RS $price</p>

                <a href='index.php?added_to_cart=$id' class='btn btn-success mb-2'>Add to cart</a>
                
            </div>
        </div>
    </div>
        ";

            }
        }
    }
}

function uniquecategorie()
{
    global $con;
    if (isset($_GET['categorie'])) {
        $category_id = $_GET['categorie'];
        $select = "select * from `products` WHERE category_id =$category_id";
        $result = mysqli_query($con, $select);
        $count = mysqli_num_rows($result);
        if ($count == 0) {
            echo "<h1 class='text-center text-danger'>stock not found for this category</h1>";
        }

        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['product_id'];
            $title = $row['product_title'];
            $description = $row['product_description'];
            $image1 = $row['product_image_1'];
            $price = $row['product_price'];
            $category_id = $row['category_id'];
            $brand_id = $row['brand_id'];

            echo "
        <div class='col-md-4 mb-2 mt-2'>
        <div class='card'>
            <img src='./admin/books_images/$image1' class='img card-img-top' alt='$title'>
            <div class='card-body'>
                <h5 class='card-title'>$title</h5>
                <p class='card-text'>$description</p>
                <a href='index.php?added_to_cart=$id' class='btn btn-success mb-2'>Add to cart</a>
               
            </div>
        </div>
    </div>
        ";

        }
    }
}
function uniquebrands()
{
    global $con;
    if (isset($_GET['brand'])) {
        $brand_id = $_GET['brand'];
        $select = "select * from `products` where brand_id= $brand_id";
        $result = mysqli_query($con, $select);
        $count = mysqli_num_rows($result);
        if ($count == 0) {
            echo "<h1 class='text-center text-danger'>no stock</h1>";
        }

        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['product_id'];
            $title = $row['product_title'];
            $description = $row['product_description'];
            $image1 = $row['product_image_1'];
            $price = $row['product_price'];
            $category_id = $row['category_id'];
            $brand_id = $row['brand_id'];

            echo "
        <div class='col-md-4 mb-2 mt-2'>
        <div class='card'>
            <img src='./admin/books_images/$image1' class='img card-img-top' alt='$title'>
            <div class='card-body'>
                <h5 class='card-title'>$title</h5>
                <p class='card-text'>$description</p>
                <a href='index.php?added_to_cart=$id' class='btn btn-success mb-2'>Add to cart</a>
              
            </div>
        </div>
    </div>
        ";

        }
    }
}


function brands()
{
    global $con;
    $select = "select * from `brands`";
    $result = mysqli_query($con, $select);
    while ($row_data = mysqli_fetch_assoc($result)) {
        $title = $row_data['brand_title'];
        $id = $row_data['brand_id'];
        echo "<li class='nav-item'>
                    <a href='index.php?brand=$id' class='nav-link text-light'>$title</a>

                </li>";
    }
}

function categories()
{
    global $con;
    $select = "select * from `categorie`";
    $result = mysqli_query($con, $select);
    while ($row_data = mysqli_fetch_assoc($result)) {
        $title = $row_data['categorie_title'];
        $id = $row_data['categorie_id'];
        echo "<li class='nav-item'>
                    <a href='index.php?categorie=$id' class='nav-link text-light'>$title</a>

                </li>";
    }
}
function scearch_card()
{
    global $con;
    if (isset($_GET['scearch_data_product'])) {
        $scearch_value = $_GET['scearch_data'];
        $scearch = "select * from `products` where product_keywords like '%$scearch_value%'";
        $result = mysqli_query($con, $scearch);
        $count = mysqli_num_rows($result);
        if ($count == 0) {
            echo "<h1 class='text-center text-danger text-upper'>not found</h1>";
        }
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['product_id'];
            $title = $row['product_title'];
            $description = $row['product_description'];
            $image1 = $row['product_image_1'];
            $price = $row['product_price'];
            $category_id = $row['category_id'];
            $brand_id = $row['brand_id'];
            $product_price = $row['product_price'];

            echo "
        <div class='col-md-4 mb-2 mt-2'>
        <div class='card'>
            <img src='./admin/books_images/$image1' class='img card-img-top' alt='$title'>
            <div class='card-body'>
                <h5 class='card-title'>$title</h5>
                <p class='card-text'>$description</p>
                <p class='card-text'>$product_price</p>
                <a href='index.php?added_to_cart=$id' class='btn btn-success mb-2'>Add to cart</a>
              
            </div>
        </div>
    </div>
        ";

        }

    }
}

function allproducts()
{
    global $con;
    if (!isset($_GET['categorie'])) {
        if (!isset($_GET['brand'])) {
            $select = "select * from `products` order by rand()";
            $result = mysqli_query($con, $select);
            while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['product_id'];
                $title = $row['product_title'];
                $description = $row['product_description'];
                $image1 = $row['product_image_1'];
                $price = $row['product_price'];
                $category_id = $row['category_id'];
                $brand_id = $row['brand_id'];

                echo "
        <div class='col-md-4 mb-2 mt-2'>
        <div class='card'>
            <img src='./admin/books_images/$image1' class='img card-img-top' alt='$title'>
            <div class='card-body'>
                <h5 class='card-title'>$title</h5>
                <p class='card-text'>$description</p>
                <p class='card-text'>RS $price</p>
                <a href='index.php?added_to_cart=$id' class='btn btn-success mb-2'>Add to cart</a>
            </div>
        </div>
    </div>
        ";

            }
        }
    }
}


function getIPAddress()
{
    //whether ip is from the share internet  
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    }
    //whether ip is from the proxy  
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    //whether ip is from the remote address  
    else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function cart()
{


    if (isset($_GET['added_to_cart'])) {
       
        if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
            global $con;
            $product_id = (int) $_GET['added_to_cart'];
            $user_id = $_SESSION['user_id'];

            $select_cart = "SELECT * FROM cart_details WHERE user_id = $user_id AND product_id = $product_id";
            $result_cart = mysqli_query($con, $select_cart);

            if (mysqli_num_rows($result_cart) > 0) {
                $cart_data = mysqli_fetch_assoc($result_cart);
                $new_quantity = $cart_data['quantity'] + 1;

                $update = "UPDATE cart_details SET quantity = $new_quantity WHERE user_id = $user_id AND product_id = $product_id";
                $result_update = mysqli_query($con, $update);

                if (!$result_update) {
                    die('Error: ' . mysqli_error($con));
                } else {

                    echo "<script>window.open('index.php','_self')</script>";
                }
            } else {
                $insert_cart = "INSERT INTO cart_details (user_id, product_id, quantity) VALUES ($user_id, $product_id, 1)";
                $result_insert = mysqli_query($con, $insert_cart);

                if (!$result_insert) {
                    die('Error: ' . mysqli_error($con));
                } else {

                    echo "<script>window.open('index.php','_self')</script>";
                }
            }
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show text-center" role="alert">
            <strong>login first</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
    }

}

function cart_item_numbering($user_id)
{

    if (isset($_GET['added_to_cart'])) {
        global $con;
        $get_ip_address = getIPAddress();
        $select = "SELECT * FROM `cart_details` WHERE user_id = $user_id";
        $result = mysqli_query($con, $select);
        if (!$result) {
            die('Error: ' . mysqli_error($con));
        }
        $count = mysqli_num_rows($result);
    } else {
        global $con;
        $get_ip_address = getIPAddress();
        $select = "SELECT * FROM `cart_details`  WHERE user_id = $user_id";
        $result = mysqli_query($con, $select);
        if (!$result) {
            die('Error: ' . mysqli_error($con));
        }
        $count = mysqli_num_rows($result);

    }
    echo $count;

}

function total_price()
{
    global $con;
    $get_ip_address = getIPAddress();
    $total = 0;
    $cart = "select * from `cart_details`  WHERE ip_address = '$get_ip_address'";
    $result = mysqli_query($con, $cart);

    while ($row = mysqli_fetch_array($result)) {
        $product_id = $row['product_id'];
        $product_table = "select * from `products` where product_id=$product_id";
        $result1 = mysqli_query($con, $product_table);
        while ($row_product_price = mysqli_fetch_array($result1)) {
            $product_price = array($row_product_price['product_price']);
            $product_values = array_sum($product_price);
            $total += $product_values;
        }

    }
    echo $total;
}

function get_user_info()
{

    global $con;
    $user_id = $_SESSION['user_id'];
    if (!isset($_GET['edit_account'])) {
        if (!isset($_GET['my_orders'])) {
            if (!isset($_GET['pending_order'])) {
                if (!isset($_GET['delete_account'])) {


                    $user_id1 = $_SESSION['user_id'];
                    $user_name = $_SESSION['username'];
                    $select_data = "SELECT * FROM `user` WHERE user_name='$user_name'";
                    $result_data = mysqli_query($con, $select_data);
                    $row_img = mysqli_fetch_assoc($result_data);
                    $user_pass = $row_img['user_password'];
                    $lastname = $row_img['user_lastname'];
                    $email = $row_img['user_email'];
                    $address = $row_img['user_address'];
                    $cell = $row_img['user_cell'];
                    echo "
                    <h2 class='text-center text-success mt-5 text-uppercase'>user info</h2>
                    <div class='form-outline mt-4'>
                    <input type='text' class='w-50 form-control mx-auto' name='user_name' value='$user_name ' disabled>
                  </div>
                  <div class='form-outline mt-4'>
                    <input type='text' class='w-50 form-control mx-auto' name='last_name' 
                    value='$lastname' disabled>
                  </div>
                  <div class='form-outline mt-4'>
                    <input type='email' class='w-50 form-control mx-auto' name='email' value='$email' disabled>
                  </div>
          
             
                   
                  <div class='form-outline mt-4'>
                    <input type='text' class='w-50 form-control mx-auto' name='address' value='$address' disabled>
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


?>