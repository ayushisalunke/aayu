<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
};

if (isset($_POST['category_name'])) {
    
    $id = $_POST['id'];
    $name = $_POST['category_name'];
    $name = filter_var($name, FILTER_SANITIZE_STRING);
    $old_category=$_GET['category_name'];
    $update_category = $conn->prepare("UPDATE `category` SET category_name = ? WHERE id = ?");
    $update_category->execute([$name, $id]);
    $update_product=$conn->prepare("UPDATE `products` SET category = ? WHERE category = ?");
    $update_product->execute([$name, $old_category]);
    if($update_category){
        header('location:add_category.php');
    }
    $message[] = 'category updated successfully!';

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>update category</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/admin_style.css">

</head>

<body>

    <?php include 'admin_header.php'; ?>

    <section class="update-product">

        <h1 class="title">update category</h1>

        <?php
        $update_id = $_GET['update'];
        $select_category = $conn->prepare("SELECT * FROM `category` WHERE id = ?");
        $select_category->execute([$update_id]);
        if ($select_category->rowCount() > 0) {
            while ($fetch_category = $select_category->fetch(PDO::FETCH_ASSOC)) {
        ?>
                <form action="" method="POST" enctype="multipart/form-data">

                    <div class="flex">
                        <div class="inputBox">
                            <input type="hidden" value="<?= $update_id ?>" name="id" class="box form-data">
                            <input type="text" style="width: 100%;" value="<?= $fetch_category['category_name'] ?>" name="category_name" class="box form-data" required placeholder="enter category name">
                        </div>
                    </div>
                    <input type="submit" class="btn" value="update category" name="add_category">
                </form>
        <?php
            }
        } else {
            echo '<p class="empty">no category found!</p>';
        }
        ?>

    </section>













    <script src="js/script.js"></script>

</body>

</html>