<?php
include('includes/connect.php');
@session_start();
if (!isset($_SESSION['username'])) {

    echo "<script>window.open('login.php','_self')</script>";
    exit();
}
if(isset($_GET["invoice_number"]))
{
    $invoice_number=$_GET["invoice_number"];
    $select="delete from `user_orders` where invoice_number=$invoice_number";
    $result=mysqli_query($con,$select);
    $select1="delete from `pending_order` where invoice_number=$invoice_number";
    $result1=mysqli_query($con,$select1);
    echo"<script>window.open('user_profile.php?my_orders','_self')</script>";
}
?>