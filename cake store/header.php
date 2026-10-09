<style>
   .primary-btn {
      display: block;
      width: 100%;
      margin-top: 1rem;
      border-radius: 0.5rem;
      color: var(--white);
      font-size: 2rem;
      padding: 1.3rem 3rem;
      text-transform: capitalize;
      cursor: pointer;
      text-align: center;
      text-decoration: none
   }

   .primary-btn {
      background-color: #207626;
   }
</style>
<?php

if (isset($message)) {
   foreach ($message as $message) {
      echo '
      <div class="message">
         <span>' . $message . '</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}

?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<header class="header">

   <div class="flex">

      <a style="text-decoration: none;" href="home.php" class="logo"><b>Cake Ordering</b></a>

      <!-- <nav class="navbar">
         <a href="home.php">Home</a>
         <a href="flavour.php">Flavours</a>
         <a href="orders.php">Orders</a>
         <a href="about.php">About</a>
         <a href="contact.php">Contact</a>
      </nav> -->

      <nav class="navbar navbar-expand-sm ">
         <div class="container-fluid">

            <div class="collapse navbar-collapse" id="collapsibleNavbar">
               <ul class="navbar-nav">
                  <li class="nav-item">
                     <a href="home.php" class="nav-link">Home</a>
                  </li>
                  <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Flavours</a>
                     <ul class="dropdown-menu">
                        <?php $select_categories = $conn->query("SELECT category_name FROM category"); ?>
                        <?php
                        if ($select_categories && $select_categories->rowCount() > 0) {
                           // echo $select_categories;
                           while ($row = $select_categories->fetch(PDO::FETCH_ASSOC)) {
                              $category_name = $row['category_name'];
                              echo "<li><a class='dropdown-item' href='category.php?category=$category_name'>$category_name</a></li>";
                           }
                        } else {
                           echo "<li><a class='dropdown-item' href='javascript:0'>No Flavours Found</a></li>";
                        }
                        ?>
                     </ul>
                  </li>

                  <li class="nav-item">
                     <a href="orders.php" class="nav-link">Orders</a>
                  </li>
                  <li class="nav-item">
                     <a href="about.php" class="nav-link">About</a>
                  </li>
                  <li class="nav-item">
                     <a href="contact.php" class="nav-link">Contact</a>
                  </li>
               </ul>
            </div>
         </div>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
         <a style="text-decoration: none;" href="search_page.php" class="fas fa-search"></a>
         <?php
         $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
         $count_cart_items->execute([$user_id]);
         $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
         $count_wishlist_items->execute([$user_id]);
         ?>
         <a style="text-decoration: none;" href="wishlist.php"><i class="fas fa-heart"></i><span>(<?= $count_wishlist_items->rowCount(); ?>)</span></a>
         <a style="text-decoration: none;" href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?= $count_cart_items->rowCount(); ?>)</span></a>
      </div>

      <div class="profile">
         <?php
         $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
         $select_profile->execute([$user_id]);
         $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
         // print_r($fetch_profile);die;
         ?>
         <img src="uploaded_img/<?= (isset($fetch_profile['image'])) ? $fetch_profile['image'] : '' ?>" alt="">
         <p><?= (isset($fetch_profile['name'])) ? $fetch_profile['name'] : ''; ?></p>
         <?php
         if (isset($_SESSION['user_id'])) {  ?>

            <a href="user_profile_update.php" class="primary-btn">update profile</a>
            <a href="logout.php" class="delete-btn">logout</a>
         <?php } else { ?>
            <div class="flex-btn">
               <a href="login.php" class="option-btn">login</a>
               <a href="register.php" class="option-btn">register</a>
            </div>

         <?php }
         ?>
      </div>

   </div>

</header>