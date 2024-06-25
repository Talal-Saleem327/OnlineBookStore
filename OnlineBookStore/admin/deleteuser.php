<?php
include('../includes/connect.php');
@session_start();
if (!isset($_SESSION['admin_name'])) {

    echo "<script>window.open('login.php','_self')</script>";
    exit();
}
if(isset($_GET['userid']))
{
    $userid=$_GET['userid'];
    $delete="delete from `user` where user_id =$userid";
    $result=mysqli_query($con,$delete);
    $deleteorder="delete from `user_orders` where user_id=$userid";
    $result1=mysqli_query($con,$deleteorder);
    $deletepayment="delete from `user_payment_details` where user_id=$userid";
    $result2=mysqli_query($con,$deletepayment);
    $deletecart="delete from `cart_details` where user_id=$userid";
    $result3=mysqli_query($con,$deletecart);
    
echo "<script>window.open('index.php?all_users','_self')</script>";
}
?>