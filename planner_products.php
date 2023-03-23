<?php

@include 'config.php';

session_start();

$planner_id = $_SESSION['planner_id'];

if(!isset($planner_id)){
   header('location:login.php');
};



if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $select_delete_image = mysqli_query($conn, "SELECT image FROM `products` WHERE id = '$delete_id'") or die('query failed');
   $fetch_delete_image = mysqli_fetch_assoc($select_delete_image);
   unlink('uploaded_img/'.$fetch_delete_image['image']);

   $select_delete_image1 = mysqli_query($conn, "SELECT image1 FROM `products` WHERE id = '$delete_id'") or die('query failed');
   $fetch_delete_image1 = mysqli_fetch_assoc($select_delete_image1);
   unlink('uploaded_img/'.$fetch_delete_image1['image1']);

   $select_delete_image2 = mysqli_query($conn, "SELECT image2 FROM `products` WHERE id = '$delete_id'") or die('query failed');
   $fetch_delete_image2 = mysqli_fetch_assoc($select_delete_image2);
   unlink('uploaded_img/'.$fetch_delete_image2['image2']);

   $select_delete_image3 = mysqli_query($conn, "SELECT image3 FROM `products` WHERE id = '$delete_id'") or die('query failed');
   $fetch_delete_image3 = mysqli_fetch_assoc($select_delete_image3);
   unlink('uploaded_img/'.$fetch_delete_image3['image3']);

   $select_delete_image4 = mysqli_query($conn, "SELECT image4 FROM `products` WHERE id = '$delete_id'") or die('query failed');
   $fetch_delete_image4 = mysqli_fetch_assoc($select_delete_image4);
   unlink('uploaded_img/'.$fetch_delete_image4['image4']);

   mysqli_query($conn, "DELETE FROM `products` WHERE id = '$delete_id'") or die('query failed');
   mysqli_query($conn, "DELETE FROM `wishlist` WHERE pid = '$delete_id'") or die('query failed');
   mysqli_query($conn, "DELETE FROM `cart` WHERE pid = '$delete_id'") or die('query failed');
   mysqli_query($conn, "DELETE FROM `packages` WHERE product_id = '$delete_id'") or die('query failed');
   header('location:planner_products.php');

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
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/planners_styles.css">

</head>
<body>
   
<?php @include 'planner_header.php'; ?>
<section class="heading">
    <h3>My Events</h3>
    <p> <a href="planner_page.php">home</a> / my events </p>
</section>


<section class="show-products">

   <div class="box-container">

      <?php
         $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE planner_id='$planner_id'") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
      ?>
      <div class="box">
         <div class="price">Rs.<?php echo $fetch_products['price']; ?>/-</div>
         <img class="image" src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
         <div class="show_event_type"><?php echo $fetch_products['event_type']; ?></div>
         <div class="name"><?php echo $fetch_products['name']; ?></div>
         
         <a href="planner_update_product.php?update=<?php echo $fetch_products['id']; ?>" class="option-btn">update</a>
         <a href="planner_products.php?delete=<?php echo $fetch_products['id']; ?>" class="delete-btn" onclick="return confirm('delete this product?');">delete</a>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">no products added yet!</p>';
      }
      ?>
   </div>
   

</section>

<?php @include 'planner_footer.php'; ?>
<script src="js/admin_script.js"></script>

</body>
</html>