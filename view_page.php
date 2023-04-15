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

    if(!isset($_SESSION['user_id'])){
        $message[] = 'You have to login first';
        header('location:login.php');
     }else{

        $user_id = $_SESSION['user_id'];
        $product_id = $_GET['pid'];
        $event_type = $_POST["pac_type"];
        //echo $event_type;


        $check_cart_numbers = mysqli_query($conn, "SELECT * FROM `cart` WHERE pid = '$product_id' AND user_id = '$user_id'") or die('query failed-48');

        if(mysqli_num_rows($check_cart_numbers) > 0){
            $message[] = 'already added to cart';
        }else{

            $check_wishlist_numbers = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE pid = '$product_id' AND user_id = '$user_id'") or die('query failed-54');

            if(mysqli_num_rows($check_wishlist_numbers) > 0){
                mysqli_query($conn, "DELETE FROM `wishlist` WHERE pid = '$product_id' AND user_id = '$user_id'") or die('query failed');
            }

            mysqli_query($conn, "INSERT INTO `cart`(user_id, pid, event_type) VALUES('$user_id', '$product_id', '$event_type')") or die('query failed-60');
            $message[] = 'product added to cart';
            header('location:before_checkout.php');
        }

     }

    

}




?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>quick view</title>

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

<section class="quick-view">

    

    <?php  
        if(isset($_GET['pid'])){
            $pid = $_GET['pid'];
            $select_basic_products = mysqli_query($conn, "SELECT * FROM `packages` WHERE type = 'basic' AND product_id='$pid'") or die('query failed');
            if(mysqli_num_rows($select_basic_products) > 0){
                $fetch_product_type = mysqli_fetch_assoc($select_basic_products);
                
            }
            
            $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$pid'") or die('query failed');
         if(mysqli_num_rows($select_products) > 0){
            while($fetch_products = mysqli_fetch_assoc($select_products)){
    ?>
    <div class="p-details">
        <h1 class="name"><?php echo $fetch_products['name']; ?></h1>
        <div class="second-line" >
            <div class="stars">
                <i class="fas fa-star" style="color:yellow"></i>    
                <i class="fas fa-star" style="color:yellow"></i>    
                <i class="fas fa-star" style="color:yellow"></i>    
                <i class="fas fa-star" style="color:yellow"></i>    
                <i class="fas fa-star" ></i>    
            </div>
            <div class="reviews">
                <span>81 reviews</span>
            </div>
            <?php
                $event_planner_id=$fetch_products['planner_id'];
                $select_event_planners = mysqli_query($conn, "SELECT * FROM `users` WHERE id='$event_planner_id'") or die('query failed');
                $fetch_planner = mysqli_fetch_assoc($select_event_planners);
            ?>
            <div class="planner">
                <img src="uploaded_img/<?php echo $fetch_planner['image'] ?>" alt="" class="e-image">
                <div class="e-name"><?php echo $fetch_planner['name']; ?></div>
            </div>
            <div class="wishlist">
                <a href="view_page.php?pid=<?=$pid?>&wish=1"><i class="fas fa-heart" ></i></a>
            </div>
            
        </div>
        <div class="pics">
            <div class="pic1">
                <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="" class="image">
            </div>
            <div class="grid">
                <div class="row">
                    <div class="column">
                        <img src="uploaded_img/<?php echo $fetch_products['image1']; ?>" alt="" class="image">
                        <img src="uploaded_img/<?php echo $fetch_products['image2']; ?>" alt="" class="image">
                    </div>
                    <div class="column">
                        <img src="uploaded_img/<?php echo $fetch_products['image3']; ?>" alt="" class="image">
                        <img src="uploaded_img/<?php echo $fetch_products['image4']; ?>" alt="" class="image">
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="third-sec">
            <div class="aboutme">
                <span>About Me</span>
                <div class="des">
                <?php
                    $select_user_details = mysqli_query($conn, "SELECT * FROM `users` WHERE id='$event_planner_id' ") or die('query failed');
                    $fetch_user_details = mysqli_fetch_assoc($select_user_details);
                    echo $fetch_user_details['about'];
                ?>
                    
                    <!-- Lorem ipsum, dolor sit amet consectetur adipisicing elit. Inventore saepe corporis corrupti dolorem accusamus, ducimus aspernatur quod libero blanditiis fugiat illum veniam amet, enim mollitia eius doloribus voluptatum voluptatem culpa.
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Laudantium, nobis tempora amet laborum quo perferendis id maiores, dolor nihil porro odit fugit sunt cumque impedit magnam. Ab possimus dolorum voluptas.<br><br>
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Inventore saepe corporis corrupti dolorem accusamus, ducimus aspernatur quod libero blanditiis fugiat illum veniam amet, enim mollitia eius doloribus voluptatum voluptatem culpa.
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Laudantium, nobis tempora amet laborum quo perferendis id maiores, dolor nihil porro odit fugit sunt cumque impedit magnam. Ab possimus dolorum voluptas.<br><br>
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit. Inventore saepe corporis corrupti dolorem accusamus, ducimus aspernatur quod libero blanditiis fugiat illum veniam amet, enim mollitia eius doloribus voluptatum voluptatem culpa.
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Laudantium, nobis tempora amet laborum quo perferendis id maiores, dolor nihil porro odit fugit sunt cumque impedit magnam. Ab possimus dolorum voluptas.<br> -->
                </div>
            </div>
            <div class="packs">
                
                <span>Packages</span>
                <form action="" method="POST">
                    <div class="select-pack">
                        <input type="submit" value="BASIC" name="basic" class="btn basic-btn active">
                        
                        <input type="submit" value="STANDARD" name="standard" class="btn standard-btn">
                        <input type="submit" value="PREMIUM" name="premium" class="btn premium-btn">
                        <?php
                            if(isset($_POST['basic']) || isset($_POST['standard']) || isset($_POST['premium']) ){
                                if(isset($_POST['basic'])){
                                    $type='basic';
                                    echo '<style type="text/css">
                                    .quick-view .p-details .third-sec .packs form .select-pack .basic-btn{
                                        background-color:#333;
                                    }
                                    .quick-view .p-details .third-sec .packs form .select-pack .standard-btn{
                                        background-color:#B6B6B6;
                                    }
                                    .quick-view .p-details .third-sec .packs form .select-pack .premium-btn{
                                        background-color:#B6B6B6;
                                    }
                                    </style>
                                    ';
                                }elseif(isset($_POST['standard'])){
                                    $type='standard';
                                    echo '<style type="text/css">
                                    .quick-view .p-details .third-sec .packs form .select-pack .basic-btn{
                                        background-color:#B6B6B6;
                                    }
                                    .quick-view .p-details .third-sec .packs form .select-pack .standard-btn{
                                        background-color:#333;
                                    }
                                    .quick-view .p-details .third-sec .packs form .select-pack .premium-btn{
                                        background-color:#B6B6B6;
                                    }
                                    </style>
                                    ';
                                }elseif(isset($_POST['premium'])){
                                    $type='premium';
                                    echo '<style type="text/css">
                                    .quick-view .p-details .third-sec .packs form .select-pack .basic-btn{
                                        background-color:#B6B6B6;
                                    }
                                    .quick-view .p-details .third-sec .packs form .select-pack .standard-btn{
                                        background-color:#B6B6B6;
                                    }
                                    .quick-view .p-details .third-sec .packs form .select-pack .premium-btn{
                                        background-color:#333;
                                    }
                                    </style>
                                    ';
                                }
                                $select_basic_products = mysqli_query($conn, "SELECT * FROM `packages` WHERE type = '$type' AND product_id='$pid'") or die('query failed');
                                if(mysqli_num_rows($select_basic_products) > 0){
                                    $fetch_product_type = mysqli_fetch_assoc($select_basic_products);
                                
                                }
                            }
                            
                        ?>
                    </div>
 
                    <div class="price">Rs <?php echo $fetch_product_type['price']; ?>/-</div>
                    <div class="details"><?php echo $fetch_product_type['description']; ?></div>
                    <span>Package includes</span><br>
                    <div class="include">
                    <?php echo $fetch_product_type['includes']; ?>
                    </div>
                    
                    <input type="hidden" value="<?=$fetch_product_type['type'] ?>" name="pac_type" class="btn buy-button">
                    <input type="submit" value="Buy Package" name="add_to_cart" class="btn buy-button">
                    <input type="hidden" value="<?=$fetch_product_type['type'] ?>" name="pac_type" class="btn contact-button">
                    <input type="submit" value="Contact Event Planner" name="add_to_cart" class="btn contact-button">
                </form>
                <?php
                    }
                }else{
                    echo '<p class="empty">no products details available!</p>';
                }
            }
                ?>
            </div>
        </div>

    </div>
    
    
  

    <div class="more-btn">
    <input type="submit" value="add to wishlist" name="add_to_wishlist" class="option-btn">
        <a href="home.php" class="option-btn">go to home page</a>
    </div>

</section>






<?php @include 'footer.php'; ?>

<script src="js/script.js"></scrip>

</body>
</html>