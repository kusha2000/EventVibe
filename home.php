<?php

@include 'config.php';

session_start();



if(!isset($_SESSION['user_id'])){
   //header('location:login.php');
}else{
   $user_id = $_SESSION['user_id'];
}

if(isset($_POST['add_to_wishlist'])){

   $product_id = $_POST['product_id'];
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   
   $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_wishlist_numbers) > 0){
       $message[] = 'already added to wishlist';
   }elseif(mysqli_num_rows($check_cart_numbers) > 0){
       $message[] = 'already added to cart';
   }else{
       mysqli_query($conn, "INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_image')") or die('query failed');
       $message[] = 'product added to wishlist';
   }

}

if(isset($_POST['add_to_cart'])){

   $product_id = $_POST['product_id'];
   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = $_POST['product_quantity'];

   $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

   if(mysqli_num_rows($check_cart_numbers) > 0){
       $message[] = 'already added to cart';
   }else{

       $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');

       if(mysqli_num_rows($check_wishlist_numbers) > 0){
           mysqli_query($conn, "DELETE FROM `wishlist` WHERE name = '$product_name' AND user_id = '$user_id'") or die('query failed');
       }

       mysqli_query($conn, "INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES('$user_id', '$product_id', '$product_name', '$product_price', '$product_quantity', '$product_image')") or die('query failed');
       $message[] = 'product added to cart';
   }

}
if(isset($_POST['search-result'])){
   $search_value = $_POST['search'];
   
   header("location:search_page.php?searching=$search_value");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/styles.css">

</head>
<body>

<?php
if(!isset($user_id)){
   @include 'header_no.php'; 
}else{
   @include 'header.php'; 
}
?>



<section id="hero">
        <div class="col col1">
            <h2>Find the best event planner.</h2>
            <form action="" method="POST" >
                <input type="text" class="box" name="search" placeholder="What type of event planner you are looking for?">
                <input type="submit" class="btn" name="search-result" value="search" ">
                
                <?php
                  
                  
                  

               ?>
            </form>
        </div>
        <div class="col col2">
            <div class="sub-cols">
                <div class="t1">
                    <img src="images/img8.png" class="img1">
                    <img src="images/img4.png" class="img2">
                </div>
                <div class="t2">
                    <img src="images/img6.png" class="img3">
                    <img src="images/img2.png" class="img4">
                    
                    
                </div>
                <div class="t3">
                    <img src="images/img3.png" class="img5">
                    <img src="images/img5.png" class="img6">
                </div>
            </div>
        </div>
    </section>
<!-- <section class="home">
   <div class="content">
      <h3>new Events</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Maxime reiciendis, modi placeat sit cumque molestiae.</p>
      <a href="shop.php" class="btn">discover more</a>
   </div>

</section>

-->

<section class="products">

   <h1 class="title">latest events</h1>

   <div class="box-container">

      <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `products` LIMIT 10") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
      <form action="" method="POST" class="box">
         
         
         <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="" class="image">
         <a href="view_page.php?pid=<?php echo $fetch_products['id']; ?>" ><div class="name"><?php echo $fetch_products['name']; ?></div></a>
         
         <input type="hidden" name="product_id" value="<?php echo $fetch_products['id']; ?>">
         <input type="hidden" name="product_name" value="<?php echo $fetch_products['name']; ?>">
         <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
         <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">
         <!-- <input type="submit" value="add to wishlist" name="add_to_wishlist" class="option-btn"> -->
         <div class="price">Rs.<?php echo $fetch_products['price']; ?>/-</div>
         <?php
            $event_planner_id=$fetch_products['planner_id'];
            $select_event_planners = mysqli_query($conn, "SELECT * FROM `users` WHERE id='$event_planner_id'") or die('query failed');
            $fetch_planner = mysqli_fetch_assoc($select_event_planners);
         ?>
      


         <img src="uploaded_img/<?php echo $fetch_planner['image']; ?>" alt="" class="e-image">
         <div class="e-name"><?php echo $fetch_planner['name']; ?></div>

      </form>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
?>

</div>

   <div class="more-btn">
      <a href="shop.php" class="option-btn">load more</a>
   </div>

</section>

<section class="home-contact">

   <div class="content">
      <h3>have any questions?</h3>
      <p>We're here to help! Our friendly and knowledgeable customer support team is available to assist you with any questions or concerns you may have. Whether you need help with placing an order or simply have a question about our products or services, we're here to ensure your experience with us is a positive one. Contact us today and let us know how we can assist you.</p>
      <a href="contact.php" class="btn">Contact Us</a>
   </div>

</section>




<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>