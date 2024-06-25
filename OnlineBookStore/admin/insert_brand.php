<?php
include('../includes/connect.php');
@session_start();
if (!isset($_SESSION['admin_name'])) {

    echo "<script>window.open('login.php','_self')</script>";
    exit();
}
if(isset($_POST['insert_brand']))
{
    $brand_title = $_POST['brand_title'];

    if(empty($brand_title))
    {
        echo "<script>alert('Please enter a brand title.')</script>";
    }
    else
    {
        $select_query = "select * from `brands` where brand_title = '$brand_title'";
        $result_select = mysqli_query($con, $select_query);
        $count = mysqli_num_rows($result_select);
        if($count > 0)
        {
            echo "<script>alert('This brand is already present in the database.')</script>";
        }
        else
        {
            $insertquery = "insert into `brands` (brand_title) values ('$brand_title')";
            $result = mysqli_query($con, $insertquery);
            if($result)
            {
                echo "<script>alert('Brand has been inserted successfully.')</script>";
            }
        }
    }
}
?>
<h1 class="text-center text-success text-uppercase fw-bold">insert brand</h1>
<form action="" method="post" class="mb-2">
<div class="input-group w-90 mb-2">
  <span class="input-group-text bg-success text-light" id="basic-addon1"><i class="fas fa-receipt"></i></span>
  <input type="text" class="form-control" name="brand_title" placeholder="insert_brands" aria-label="brands" aria-describedby="basic-addon1">
</div>
<div class="input-group w-10 mb-2">
  
  <input type="submit" class=" btn btn-success w-100" name="insert_brand" value="insert institutions">
   
</div>
</form>