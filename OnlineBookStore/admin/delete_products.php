<?php
include('../includes/connect.php');
@session_start();
if (!isset($_SESSION['admin_name'])) {

    echo "<script>window.open('login.php','_self')</script>";
    exit();
}
if(isset($_GET['delete_products']))
{
    $productid=$_GET['delete_products'];
    $delete="delete from `products` where product_id=$productid";
    $result=mysqli_query($con,$delete);
    if($result)
    {
        echo "<script>window.open('index.php?view_products','_self')</script>";
    }

}
?>