<?php
@session_start();
if (!isset($_SESSION['admin_name'])) {

  echo "<script>window.open('login.php','_self')</script>";
  exit();
}
if(isset($_GET['delete_brand']))
{
  $id=$_GET['delete_brand'];
  $delete_brand="delete from `brands` where brand_id =$id";
  $result=mysqli_query($con,$delete_brand);
  $delete_product="delete from `products` where brand_id=$id";
  $result1=mysqli_query($con,$delete_product);

  echo "<script>window.open('index.php?view_brands','_self')</script>";
}
?>