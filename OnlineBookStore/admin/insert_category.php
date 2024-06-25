<?php
include('../includes/connect.php');
if (!isset($_SESSION['admin_name'])) {

    echo "<script>window.open('login.php','_self')</script>";
    exit();
}
if(isset($_POST['insert_cat']))
{
    $category_title = $_POST['cat_title'];
    
    // Check if the input is null or empty
    if(empty($category_title))
    {
        echo "<script>alert('Please enter a category title.')</script>";
    }
    else
    {
        $select_query = "select * from `categorie` where categorie_title = '$category_title'";
        $result_select = mysqli_query($con, $select_query);
        $count = mysqli_num_rows($result_select);
        if($count > 0)
        {
            echo "<script>alert('This book category is already present in the book category.')</script>";
        }
        else
        {
            $insertquery = "insert into `categorie` (categorie_title) values ('$category_title')";
            $result = mysqli_query($con, $insertquery);
            if($result)
            {
                echo "<script>alert('Book category has been inserted successfully.')</script>";
            }
        }
    }
}
?>

<h1 class="text-center text-success text-uppercase fw-bold">insert categories</h1>
<form action="" method="post" class="mb-2 my-auto">
<div class="input-group w-90 my-auto mb-2">
  <span class="input-group-text bg-success text-light" id="basic-addon1"><i class="fas fa-receipt"></i></span>
  <input type="text" class="form-control" name="cat_title" placeholder="insert_categories" aria-label="category" aria-describedby="basic-addon1">
</div>
<div class="input-group   mb-2">
  
  <input type="submit" class="btn btn-success w-100" name="insert_cat" value="insert categorie">
 
</div>
</form>