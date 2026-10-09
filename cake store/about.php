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
   <title>about</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="about">

  
   </div>

</section>

<section class="reviews">

   <h1 class="title">clients reivews</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/pic-1.png" alt="">
         <p>Always Delicious!!- The whole Process of Ordering the cake was so easy and Convenient. The cake was delicious as alwayss. Everyone Love it!!</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Aaryan</h3>
      </div>

      <div class="box">
         <img src="images/pic-2.png" alt="">
       <p> Delicious!!-Beautiful cakes are not often yummy but this one absolutely was.We've orderd cakes and cupcakes before from Patty's and have been disappointed</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Anita</h3>
      </div>

      <div class="box">
         <img src="images/pic-3.png" alt="">
         <p>Pattys cakes did my wedding cake and I couldn't be happier!! The cake was supper moist and delicious! All my guests kept raving about it! </p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Arman</h3>
      </div>

      <div class="box">
         <img src="images/pic-4.png" alt="">
         <p>It's our one year anniversary and Patty's cake give free cake of your choice. We ordered exactly the same cake as our wedding cake.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Mahek</h3>
      </div>

      <div class="box">
         <img src="images/pic-5.png" alt="">
         <p>Orders my Wedding cake hare. custon banana cake with  blueberry filling and it was delicious. Also delicious a year later on our anniversary!</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Ayush</h3>
      </div>

      <div class="box">
         <img src="images/pic-6.png" alt="">
         <p>Daughters Birthday-What a easy Convenient and fun experience. first time orderding from Patty's Cakes.Cakes was very delicious and design was nice.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Sonal</h3>
      </div>

   </div>

</section>









<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>