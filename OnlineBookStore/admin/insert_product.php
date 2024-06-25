<?php
include('../includes/connect.php');
@session_start();
if (!isset($_SESSION['admin_name'])) {

    echo "<script>window.open('login.php','_self')</script>";
    exit();
}
if (isset($_POST['insert_product'])) {
    $product_title = $_POST['product_title'];
    $product_description = $_POST['product_Description'];
    $product_keywords = $_POST['product_keyword'];  
    $product_category = $_POST['product_category'];
    $product_brand = $_POST['brand'];
    $product_price = $_POST['product_price'];
    $status = 'true';
    $product_image1 = $_FILES['product_image_1']['name'];

    $temp_image1 = $_FILES['product_image_1']['tmp_name'];

    if (
        empty($product_title) || empty($product_description) || empty($product_keywords) ||
        empty($product_category) || empty($product_brand) || empty($product_price) ||
         empty($product_image1)  
    ) {
        echo "<script>alert('Please complete all fields')</script>";
    } else {
        $query = "SELECT * FROM `products` WHERE product_title = '$product_title'";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Product with the same title already exists. Please choose a different title.')</script>";
        } else {
            move_uploaded_file($temp_image1, "./books_images/$product_image1");
           

            $insert = "INSERT INTO `products`
             (product_title, product_description, product_keywords, category_id, brand_id, product_image_1, product_price, date) VALUES 
            ('$product_title', '$product_description', '$product_keywords', '$product_category', '$product_brand', '$product_image1', '$product_price', NOW())";
            $result = mysqli_query($con, $insert);
            if ($result) {
                echo "<script>window.open('index.php','_self')</script>";
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
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
    <title>insert products</title>
</head>

<body>
    <div class="container">
        <h2 class="text-center mt-2 mb-2 text-uppercase fw-bold text-success">
            insert products
        </h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_title" class="form-label">Product Title</label>
                <input type="text" name="product_title" id="product_title" class="form-control"
                    placeholder="enter product title" autocomplete="off" required="required">

            </div>

            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_Description" class="form-label">Product Description</label>
                <input type="text" name="product_Description" id="product_Description" class="form-control"
                    placeholder="enter product Description" autocomplete="off" required="required">

            </div>

            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_keyword" class="form-label">Product keyword</label>
                <input type="text" name="product_keyword" id="product_keyword" class="form-control"
                    placeholder="enter product keyword" autocomplete="off" required="required">

            </div>

            <div class="form-outline mb-4 w-50 m-auto">

                <select name="product_category" id="" class="form-select">
                    <option value="">Select a category</option>
                    <?php
                    $select = "select * from `categorie`";
                    $result = mysqli_query($con, $select);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $title = $row['categorie_title'];
                        $id = $row['categorie_id'];
                        echo "<option value='$id'>$title</option>";
                    }


                    ?>
                    <!-- <option value="">category 1</option>
                    <option value="">category 2</option>
                    <option value="">category 3</option>
                    <option value="">category 4</option> -->
                </select>

            </div>
            <div class="form-outline mb-4 w-50 m-auto">

                <select name="brand" id="" class="form-select">
                    <option value="">Select a brand</option>
                    <?php
                    $select = "select * from `brands`";
                    $result = mysqli_query($con, $select);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $title = $row['brand_title'];
                        $id = $row['brand_id'];
                        echo "<option value='$id'>$title</option>";
                    }


                    ?>
                </select>

            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image1" class="form-label">Product image 1</label>
                <input type="file" name="product_image_1" id="product_image_1" class="form-control" required="required">

            </div>
            <!-- <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image2" class="form-label">Product image 2</label>
                <input type="file" name="product_image_2" id="product_image_2" class="form-control" required="required">

            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_image3" class="form-label">Product image 3</label>
                <input type="file" name="product_image_3" id="product_image_3" class="form-control" required="required">

            </div> -->
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_price" class="form-label">Product price</label>
                <input type="text" name="product_price" id="product_price" class="form-control"
                    placeholder="enter product price" autocomplete="off" required="required">

            </div>
            <div class="form-outline mb-4 d-flex justify-content-center">
                <input type="submit" name="insert_product" class="btn btn-success w-50" value="insert products">
            </div>

        </form>
    </div>
</body>

</html>