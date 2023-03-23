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

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shop</title>

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

  $event_name = $_GET['update'];
  if(isset($_GET['subupdate'])){
    $sub_event_name = $_GET['subupdate'];
  }
  if(isset($_GET['location'])){
    $location = $_GET['location'];
  }

  
?>

<section class="events">
   <div class="flex">
        <div class="left-bar">
            <div class="sub">
                <h3>Subcategories</h3>
                <a href="events.php?update=<?php echo $event_name ?>">All types</a><br>
                <a href="events.php?update=<?php echo $event_name ?>&subupdate=Traditional">Traditional <?php echo $event_name ?></a><br>
                <a href="events.php?update=<?php echo $event_name ?>&subupdate=Beach">Beach <?php echo $event_name ?></a><br>
                <a href="events.php?update=<?php echo $event_name ?>&subupdate=Destination">Destination <?php echo $event_name ?></a><br>
                <a href="events.php?update=<?php echo $event_name ?>&subupdate=Gardern">Gardern <?php echo $event_name ?></a><br>
                <a href="events.php?update=<?php echo $event_name ?>&subupdate=Vintage">Vintage <?php echo $event_name ?></a><br>
                <a href="events.php?update=<?php echo $event_name ?>&subupdate=Rustic">Rustic <?php echo $event_name ?></a><br>
                <a href="events.php?update=<?php echo $event_name ?>&subupdate=Bohemian">Bohemian <?php echo $event_name ?></a><br>
                <a href="events.php?update=<?php echo $event_name ?>&subupdate=Luxury">Luxury <?php echo $event_name ?></a><br>
                <a href="events.php?update=<?php echo $event_name ?>&subupdate=Intimate">Intimate <?php echo $event_name ?></a><br>
                <a href="events.php?update=<?php echo $event_name ?>&subupdate=Eco friendly">Eco-friendly <?php echo $event_name ?></a><br>
            </div>
            <div class="sub">
                <h3>Location</h3>
                <a href="events.php?update=<?php echo $event_name ?>">All Country</a><br>
                <a href="events.php?update=<?php echo $event_name ?>&location=Ampara">Ampara</a><br>
                <a href="events.php?update=<?php echo $event_name ?>&location=Anuradhapura">Anuradhapura</a><br>
                <a href="events.php?update=<?php echo $event_name ?>&location=Badulla">Badulla</a><br>
                <a href="events.php?update=<?php echo $event_name ?>&location=Colombo">Colombo</a><br>
                <a href="events.php?update=<?php echo $event_name ?>&location=Galle">Galle</a><br>
                <a href="events.php?update=<?php echo $event_name ?>&location=Gampaha">Gampaha</a><br>
                <a href="events.php?update=<?php echo $event_name ?>&location=Hambantota">Hambantota</a><br>
                <a href="events.php?update=<?php echo $event_name ?>&location=Kalutara">Kalutara</a><br>
                <a href="events.php?update=<?php echo $event_name ?>&location=Kandy">Kandy</a><br>
                <a href="events.php?update=<?php echo $event_name ?>&location=Kegalle">Kegalle</a><br>
                <a href="events.php?update=<?php echo $event_name ?>&location=Kilinochchi">Kilinochchi</a><br>
                <a href="events.php?update=<?php echo $event_name ?>&location=Kurunegala">Kurunegala</a><br>
                <a href="events.php?update=<?php echo $event_name ?>&location=Mannar">Mannar</a><br>
                <a href="events.php?update=<?php echo $event_name ?>&location=Matale">Matale</a><br>
                <a href="events.php?update=<?php echo $event_name ?>&location=Matara">Matara</a><br>
                <a href="events.php?update=<?php echo $event_name ?>&location=Monaragala">Monaragala</a><br>
                <a href="events.php?update=<?php echo $event_name ?>&location=Mullaitivu">Mullaitivu</a><br>
                <a href="events.php?update=<?php echo $event_name ?>&location=Nuwara Eliya">Nuwara Eliya</a><br>
                <a href="events.php?update=<?php echo $event_name ?>&location=Polonnaruwa">Polonnaruwa</a><br>
                <a href="events.php?update=<?php echo $event_name ?>&location=Puttalam">Puttalam</a><br>
                <a href="events.php?update=<?php echo $event_name ?>&location=Ratnapura">Ratnapura</a><br>
                <a href="events.php?update=<?php echo $event_name ?>&location=Trincomalee">Trincomalee</a><br>
                <a href="events.php?update=<?php echo $event_name ?>&location=Vavuniya">Vavuniya</a><br>
            </div>
        </div>

        <div class="products">

            <div class="eve_name">
                <h3>
                    <?php 
                    if(isset($_GET['subupdate'])){
                        echo $event_name ;
                        echo " - ";
                        echo "<span style='color:#666;'>".$sub_event_name."</span>";
                    }elseif(isset($_GET['location'])){
                        echo $event_name ;
                        echo " - ";
                        echo "<span style='color:#666;'>".$location."</span>";
                    }else{
                        echo $event_name ;
                    }

                    ?>
                </h3>
            </div>
            
            <div class="box-container">


                <?php
                    if(isset($sub_event_name)){
                        $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE event_type='$event_name' AND subcategorie='$sub_event_name'") or die('query failed');
                    }elseif(isset($location)){
                        $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE event_type='$event_name' AND district='$location'") or die('query failed');
                    }else{
                        $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE event_type='$event_name'") or die('query failed');
                    }
                ?>

                <?php
                    
                    
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
                    echo '<p class="empty">no events added yet!</p>';
                }
                ?>

            </div>

        </div>
    </div>
</section>
   






<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>