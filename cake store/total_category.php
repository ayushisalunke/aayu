<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $category_name=$_GET['category_name'];
   $delete_message = $conn->prepare("DELETE FROM `category` WHERE id = ?");
   $delete_message->execute([$delete_id]);

   $delete_products= $conn->prepare("DELETE FROM `products` WHERE category = ?");
   $delete_products->execute([$category_name]);
   header('location:add_category.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>category</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="messages">

   <h1 class="title">category</h1>

   <div class="box-container">

   <?php
      $select_message = $conn->prepare("SELECT * FROM `category`");
      $select_message->execute();
      if($select_message->rowCount() > 0){
         while($fetch_message = $select_message->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
      <p> category id : <span><?= $fetch_message['id']; ?></span> </p>
      <p> category name : <span><?= $fetch_message['category_name']; ?></span> </p>
            
      <a href="total_category.php?delete=<?= $fetch_message['id']; ?>" onclick="return confirm('delete this category?');" class="delete-btn">delete</a>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">you have no category!</p>';
      }
   ?>

   </div>

</section>













<script src="js/script.js"></script>

</body>
</html>