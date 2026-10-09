<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};
if(isset($_POST['add_product'])){
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $category = $_POST['category'];
   $category = filter_var($category, FILTER_SANITIZE_STRING);
   $details = $_POST['details'];
   $details = filter_var($details, FILTER_SANITIZE_STRING);

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'project_images/';
   
   // Create the directory if it doesn't exist
   if (!file_exists($image_folder)) {
       mkdir($image_folder, 0777, true); // You can adjust the permission mode as needed
   }

   $select_products = $conn->prepare("SELECT * FROM `products` WHERE name = ?");
   $select_products->execute([$name]);

   if($select_products->rowCount() > 0){
       $message[] = 'Product name already exists!';
   }else{
       $insert_products = $conn->prepare("INSERT INTO `products`(name, category, details, price, image) VALUES(?,?,?,?,?)");
       // Bind parameters
       $insert_products->bindParam(1, $name);
       $insert_products->bindParam(2, $category);
       $insert_products->bindParam(3, $details);
       $insert_products->bindParam(4, $price);
       $insert_products->bindParam(5, $image);

       if($insert_products->execute()){
           if($image_size > 2000000){
               $message[] = 'Image size is too large!';
           }else{
               if(move_uploaded_file($image_tmp_name, $image_folder . $image)){
                   $message[] = 'New product added!';
               }else{
                   $message[] = 'Failed to move uploaded file!';
               }
           }
       }else{
           $message[] = 'Failed to insert product!';
       }
   }
}

// if(isset($_POST['add_product'])){
   
//    $name = $_POST['name'];
//    $name = filter_var($name, FILTER_SANITIZE_STRING);
//    $price = $_POST['price'];
//    $price = filter_var($price, FILTER_SANITIZE_STRING);
//    $category = $_POST['category'];
//    $category = filter_var($category, FILTER_SANITIZE_STRING);
//    $details = $_POST['details'];
//    $details = filter_var($details, FILTER_SANITIZE_STRING);

//    $image = $_FILES['image']['name'];
//    $image = filter_var($image, FILTER_SANITIZE_STRING);
//    $image_size = $_FILES['image']['size'];
//    $image_tmp_name =time().''. $_FILES['image']['tmp_name'];
//    // $image_folder = 'project images/'.$image;
//    $image_folder = 'images/';
//    $select_products = $conn->prepare("SELECT * FROM `products` WHERE name = ?");
//    $select_products->execute([$name]);

//    if($select_products->rowCount() > 0){
//       $message[] = 'product name already exist!';
//    }else{

//       $insert_products = $conn->prepare("INSERT INTO `products`(name, category, details, price, image) VALUES(?,?,?,?,?)");
//       $insert_products->execute([$name, $category, $details, $price, $image_tmp_name]);
//       // $insert_products->execute([$name, $category, $details, $price, $image]);

//       if($insert_products){
//          if($image_size > 2000000){
//             $message[] = 'image size is too large!';
//          }else{
//             move_uploaded_file($image_tmp_name, $image_folder);
//             $message[] = 'new product added!';
//          }

//       }

//    }

// };

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $select_delete_image = $conn->prepare("SELECT image FROM `products` WHERE id = ?");
   $select_delete_image->execute([$delete_id]);
   $fetch_delete_image = $select_delete_image->fetch(PDO::FETCH_ASSOC);
   unlink('project images/'.$fetch_delete_image['image']);
   $delete_products = $conn->prepare("DELETE FROM `products` WHERE id = ?");
   $delete_products->execute([$delete_id]);
   $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE pid = ?");
   $delete_wishlist->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
   $delete_cart->execute([$delete_id]);
   /*header('location:admin_products.php');*/


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>products</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="add-products">

   <h1 class="title">add new cakes</h1>
 
   <form action="" method="POST" enctype="multipart/form-data">
      <div class="flex">
         <div class="inputBox">
         <input type="text" name="name" class="box" required placeholder="Enter Cake Name">

         <!-- <select name="category" class="box" required>
            <option value="" selected disabled>select category</option>
               <option value="choclate">Choclate</option>
               <option value="fruits">Fruits</option>
               <option value="blackforest">Black forest</option>
               <option value="cupcakes">CupCakes</option>
         </select> -->
         <select name="category" class="box" required>
    <option value="" selected disabled>Select Category</option>
    <?php
    // Assuming $conn is your PDO database connection
    $select_categories = $conn->query("SELECT category_name FROM category");
    // Check if categories were fetched successfully
    if ($select_categories) {
        // Loop through each category
        while ($row = $select_categories->fetch(PDO::FETCH_ASSOC)) {
            $category_name = $row['category_name'];
            // Output an <option> element for each category
            echo "<option value=\"$category_name\">$category_name</option>";
        }
    } else {
        // If there's an error fetching categories, display a default option
        echo "<option value='' disabled>No categories available</option>";
    }
    ?>
</select>

         </div>
         <div class="inputBox">
         <input type="number" min="0" name="price" class="box" required placeholder="Enter Cake Price">
         <input type="file" name="image" required class="box" accept="image/jpg, image/jpeg, image/png">
         </div>
      </div>
      <textarea name="details" class="box" required placeholder="Enter Cake Details" cols="30" rows="10"></textarea>
      <input type="submit" class="btn" value="add product" name="add_product">
   </form>

</section>

<section class="show-products">

   <h1 class="title"></h1>

   <div class="box-container">

   <?php
      $show_products = $conn->prepare("SELECT * FROM `products`");
      $show_products->execute();
      if($show_products->rowCount() > 0){
         while($fetch_products = $show_products->fetch(PDO::FETCH_ASSOC)){  
   ?>
   <div class="box" style="max-width:400px; max-height: 600px;">
      <div class="price"><?= $fetch_products['price']; ?>/-</div>
      <img style="max-width: px; max-height: 162px" src="project_images/<?= $fetch_products['image']; ?>" alt="">
      <div class="name"><?= $fetch_products['name']; ?></div>
      <div class="cat"><?= $fetch_products['category']; ?></div>
      <div class="details"><?= $fetch_products['details']; ?></div>
      <div class="flex-btn">
         <a href="admin_update_product.php?update=<?= $fetch_products['id']; ?>" class="option-btn">update</a>
         <a href="admin_products.php?delete=<?= $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">delete</a>
      </div>
   </div>
   <?php
      }
   }else{
      echo '<p class="empty">now products added yet!</p>';
   }
   ?>

   </div>

</section>











<script src="js/script.js"></script>

</body>
</html>