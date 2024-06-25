<?php
include('../includes/connect.php');
@session_start();
if (!isset($_SESSION['admin_name'])) {

    echo "<script>window.open('login.php','_self')</script>";
    exit();
}
if(isset($_GET['edit_products'])){
    $productid=$_GET['edit_products'];
    $select="select * from `products` where product_id=$productid";
    $result = mysqli_query($con,$select);
    $getdata=mysqli_fetch_assoc($result);
    
    $title=$getdata['product_title'];
    $description=$getdata['product_description'];
    $keywords=$getdata['product_keywords'];
    $categoryid=$getdata['category_id'];
    $brandid=$getdata['brand_id'];
    $img=$getdata['product_image_1'];
    $price=$getdata['product_price'];

    $selectcategory="select * from `categorie` where categorie_id=$categoryid";
    $resultcategory=mysqli_query($con,$selectcategory);
    $getcategory=mysqli_fetch_assoc($resultcategory);
    $categoryname=$getcategory["categorie_title"];
    $selectbrand="select *  from `brands` where brand_id=$brandid";
    $resultbrand=mysqli_query($con,$selectbrand);
    $getbrand=mysqli_fetch_assoc($resultbrand);
    $brandname=$getbrand["brand_title"];

}
if (isset($_POST['update_products']))
{
 $update_title=$_POST['update_product_title'];
 $update_description=$_POST['update_product_Description'];
 $update_keyword=$_POST['update_product_keyword'];
 $update_category=$_POST['update_product_category'];
 $update_brand=$_POST['update_brand'];
 $update_price=$_POST['update_product_price'];
 $update_img=$_FILES['update_product_image_1']['name'];
 $temp_update_img=$_FILES['update_product_image_1']['tmp_name'];
 if (empty($update_category)) {
    $update_category = $categoryid;
}

if (empty($update_brand)) {
    $update_brand = $brandid;
}

if (!empty($_FILES['update_product_image_1']['name'])) {
    $update_img=$_FILES['update_product_image_1']['name'];
    $temp_update_img=$_FILES['update_product_image_1']['tmp_name'];
    move_uploaded_file($temp_update_img, "./books_images/$update_img");
} else {
    $update_img = $img;
}
echo"$update_category";
echo" $update_brand";
$update_product="update `products` set brand_id='$update_brand',category_id='$update_category',date=NOW(),product_description='$update_description',product_image_1='$update_img',product_keywords='$update_keyword',product_price='$update_price',product_title='$update_title'  where product_id=$productid";
$result_update_product = mysqli_query($con,$update_product);
if($result_update_product)
{
    echo "<script>alert('product table updated successfully')</script>";
    echo "<script>window.open('index.php?view_products','_self')</script>";
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
    
    <title>Welcome
        
    </title>
    <style>
    .img
    {
    width: 50px;
    height: 50px;
    }
    </style>
</head>

<body>
 <h1 class="text-center text-uppercase text-success">
    edit products
 </h1>
 <div class="container-fluid">
 <form action="" method="post" enctype="multipart/form-data">
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_title" class="form-label">Product Title</label>
                <input type="text" name="update_product_title" id="update_product_title" class="form-control" value="<?php echo"$title"; ?>"
                    placeholder="enter product title" autocomplete="off" required="required">

            </div>

            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_Description" class="form-label">Product Description</label>
                <input type="text" name="update_product_Description" id="update_product_Description" class="form-control" value="<?php echo"$description"; ?>"
                    placeholder="enter product Description" autocomplete="off" required="required">

            </div>

            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_keyword" class="form-label">Product keyword</label>
                <input type="text" name="update_product_keyword" id="update_product_keyword" class="form-control" value="<?php echo"$keywords"; ?>"
                    placeholder="enter product keyword" autocomplete="off" required="required">

            </div>

            <div class="form-outline mb-4 w-50 m-auto">

                <select name="update_product_category" id="update_product_category" class="form-select">
                    <option value=""><?php echo"$categoryname"; ?></option>
                    <?php
                    $select = "select * from `categorie`";
                    $result = mysqli_query($con, $select);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $title = $row['categorie_title'];
                        $id = $row['categorie_id'];
                        echo "<option value='$id'>$title</option>";
                    }


                    ?>
                </select>

            </div>
            <div class="form-outline mb-4 w-50 m-auto">

                <select name="update_brand" id="update_brand" class="form-select">
                    <option value=""><?php echo"$brandname"; ?></option>
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
                <label for="product_image1" class="form-label">Product image</label>
                <input type="file" name="update_product_image_1" id="update_product_image_1" class="form-control">
                <img src="./books_images/<?php echo"$img"; ?>" class="img img-fluid" alt="img">

            </div>
            <div class="form-outline mb-4 w-50 m-auto">
                <label for="product_price" class="form-label">Product price</label>
                <input type="text" name="update_product_price" id="update_product_price" class="form-control" value="<?php echo"$price"; ?>"
                    placeholder="enter product price" autocomplete="off" required="required">

            </div>
            <div class="form-outline mb-4 d-flex justify-content-center ">
                <input type="submit" name="update_products" class="btn btn-success w-50" value="update products">
            </div>

        </form>
 </div>
     

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>
<?php

?>