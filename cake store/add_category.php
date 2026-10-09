<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_POST['add_category'])){
 
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);

    $insert_products = $conn->prepare("INSERT INTO `category`(category_name) VALUES(?)");
    $insert_products->execute([$name]);

    if($insert_products){
        $message[] = 'new category added!';

    }
};


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>add category</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="add-products">

   <h1 class="title">add category</h1>

   <form action="" method="POST" enctype="multipart/form-data">
  
      <div class="flex">
         <div class="inputBox">
         <input type="text" style="width: 202%;" name="name" class="box form-data" required placeholder="enter category name">
         </div>
      </div>
      <input type="submit" class="btn" value="add category" name="add_category">
   </form>

</section>
<section class="messages">

   <h1 class="title">category</h1>

   <div class="box-container" style="gap: 12.5rem;" >

   <?php
      $select_message = $conn->prepare("SELECT * FROM `category`");
      $select_message->execute();
      if($select_message->rowCount() > 0){
         while($fetch_message = $select_message->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box" style="width: 400px;">
      <p> category id : <span><?= $fetch_message['id']; ?></span> </p>
      <p> category name : <span><?= $fetch_message['category_name']; ?></span> </p>
      <div class="flex-btn">
      <a href="admin_update_category.php?update=<?= $fetch_message['id']; ?>&&category_name=<?= $fetch_message['category_name'] ?>" class="option-btn">update</a>
      <a href="total_category.php?delete=<?= $fetch_message['id']; ?>&&category_name=<?= $fetch_message['category_name'] ?>" onclick="return confirm('delete this category?');" class="delete-btn">delete</a>
   </div>
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