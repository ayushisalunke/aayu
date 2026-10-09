
<style>
    .invoice-btn{
   display: block;
    width: 50%;
    margin-top: 1rem;
    
    border-radius: 0.5rem;
    color: var(--white);
    font-size: 2rem;
    padding: 1.3rem 3rem;
    /* text-transform: capitalize; */
    cursor: pointer;
    text-align: center;
    text-decoration: none
   }
   .invoice-btn{
      background-color: #207626;
   }
   div .invoice-btn{
      justify-content: end;
   }
   
</style>
<?php

@include 'config.php';

session_start();

$user_id = (isset($_SESSION['user_id']))?$_SESSION['user_id']:'';

// if(!isset($user_id)){
//    header('location:login.php');
// };
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="placed-orders">

   <h1 class="title">Placed Orders</h1>

   <div class="box-container">

   <?php
      $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ?");
      $select_orders->execute([$user_id]);
      if($select_orders->rowCount() > 0){
         while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <div class="box" style="width:100%; height: 500px">


<div>

   <p> placed on : <span><?= $fetch_orders['placed_on']; ?></span> </p>
   <p> name : <span><?= $fetch_orders['name']; ?></span> </p>
   <p> number : <span><?= $fetch_orders['number']; ?></span> </p>
   <p> email : <span><?= $fetch_orders['email']; ?></span> </p>
   <p> address : <span><?= $fetch_orders['address']; ?></span> </p>
   <p> payment method : <span><?= $fetch_orders['method']; ?></span> </p>
   <p> your orders : <span><?= $fetch_orders['total_products']; ?></span> </p>
   <p> total price : <span><?= $fetch_orders['total_price']; ?>/-</span> </p>
   <p> payment status : <span style="color:<?php if($fetch_orders['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $fetch_orders['payment_status']; ?></span> </p>
</div>
<div>

      <!--   <a class="invoice-btn" style="justify-content: left;" href="generate_invoice.php?order_id=<?= $fetch_orders['id']; ?>" target="_blank">Download Invoice</a>-->
      </div>
   </div>

   <?php
      }
   }else{
      echo '<p class="empty">no orders placed yet!</p>';
   }
   ?>

   </div>

</section>









<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>