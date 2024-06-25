<?php
@session_start();
if (!isset($_SESSION['admin_name'])) {

  echo "<script>window.open('login.php','_self')</script>";
  exit();
}
if(isset($_GET['delete_category']))
{
  $id=$_GET['delete_category'];
  $delete_cartegory="delete from `categorie` where categorie_id=$id";
  $result=mysqli_query($con,$delete_cartegory);
  $delete_product="delete from `products` where category_id=$id";
  $result1=mysqli_query($con,$delete_product);

  echo "<script>window.open('index.php?view_category','_self')</script>";
}
?>