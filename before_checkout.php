<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_POST['order'])){

    $select_user_details = mysqli_query($conn, "SELECT * FROM `users` WHERE id='$user_id' ") or die('query failed');
    $fetch_user_details = mysqli_fetch_assoc($select_user_details);
    $user_id = $_SESSION['user_id'];
    $name = $fetch_user_details['name'];
    $number = $fetch_user_details['t_no'];
    $email = $fetch_user_details['email'];
    //$method = mysqli_real_escape_string($conn, $_POST['method']);
    $method = "after event";
    $address = mysqli_real_escape_string($conn,$_POST['flat'].', '. $_POST['street'].', '. $_POST['state'].', '. $_POST['city']);
    $e_date=mysqli_real_escape_string($conn, $_POST['date']);
    $amount=$_POST['amount'];
    $placed_on = date('d-M-Y');

    $cart_total = 0;
    $cart_products = 0;

    $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed-28');
    if(mysqli_num_rows($cart_query) > 0){
        while($cart_item = mysqli_fetch_assoc($cart_query)){
            $event_product_id=$cart_item['pid'];
            $event_product_pack=$cart_item['event_type'];

            $select_pack_price = mysqli_query($conn, "SELECT * FROM `packages` WHERE product_id='$event_product_id' AND type='$event_product_pack'") or die('query failed-34');
            $fetch_pack_price = mysqli_fetch_assoc($select_pack_price);

            $select_event_planner = mysqli_query($conn, "SELECT * FROM `products` WHERE id='$event_product_id' ") or die('query failed-37');
            $fetch_event_planner = mysqli_fetch_assoc($select_event_planner);
            $planner_id = $fetch_event_planner['planner_id'];

            $cart_products +=1;
            $sub_total = $fetch_pack_price['price'];
            $cart_total += $sub_total;
        }
    }


    $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$cart_products' AND total_price = '$cart_total'") or die('query failed-45');

    if($cart_total == 0){
        $message[] = 'your cart is empty!';
    }elseif(mysqli_num_rows($order_query) > 0){
        $message[] = 'order placed already!';
    }else{
        // echo $user_id.'<br>';
        // echo $name.'<br>';
        // echo $number.'<br>';
        // echo $email.'<br>';
        // echo $method.'<br>';
        // echo $address.'<br>';
        // echo $e_date.'<br>';
        // echo $amount.'<br>';
        // echo $cart_products.'<br>';
        // echo $cart_total.'<br>';
        // echo $placed_on.'<br>';
        // echo $planner_id.'<br>';
        
        mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, method, address,event_date,participants, total_products, total_price, placed_on,planner_id,pid,package) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address','$e_date','$amount', '$cart_products', '$cart_total', '$placed_on','$planner_id','$event_product_id','$event_product_pack')") or die(mysqli_error($conn));
        //mysqli_query($conn, "INSERT INTO `orders`(name) VALUES('$name')") or die('query failed-52');
        //mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$cart_products', '$cart_total', '$placed_on')") or die('query failed');
        mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
        $message[] = 'order placed successfully!';
        header('location:thanks.php');
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Confirm and Pay</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/styles.css">

</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="before-checkout">
    <h2>Selecting Package > Confirm and Pay</h2>
    <div class="flex">
        <div class="check">
            <h1>Confirm and Pay</h1>
            <h3 class="h3">pay with</h3>
            <img src="images/visa-bar.png" class="visa">
            <h3 class="h3">How do you want to pay?</h3>
            <div class="pay-option">
                <div class="row row1">
                    <div class="col col1">
                        <img src="images/circle.png" class="circle1">
                    </div>
                    <div class="col col2">
                        <span>Pay in Full</span>
                    </div>
                    <div class="col col3">
                    <?php
                        $grand_total = 0;
                        $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                        if(mysqli_num_rows($select_cart) > 0){
                            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                                $event_product_id=$fetch_cart['pid'];
                                $event_product_pack=$fetch_cart['event_type'];

                                $select_pack_price = mysqli_query($conn, "SELECT * FROM `packages` WHERE product_id='$event_product_id' AND type='$event_product_pack'") or die('query failed');
                                $fetch_pack_price = mysqli_fetch_assoc($select_pack_price);


                                $total_price = $fetch_pack_price['price'];
                                $grand_total += $total_price;
                            }
                        }
                    ?>
                        <span>Rs <?php echo $grand_total?></span>
                    </div>
                </div>
                <div class="row row2">
                    <div class="col col1">
                        <img src="images/circle.png" class="circle2">
                    </div>
                    <div class="col col2">
                        <span>Pay upfront and rest later</span>
                    </div>
                    <div class="col col3">
                    <?php
                        $grand_total = 0;
                        $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                        if(mysqli_num_rows($select_cart) > 0){
                            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                                $event_product_id=$fetch_cart['pid'];
                                $event_product_pack=$fetch_cart['event_type'];

                                $select_pack_price = mysqli_query($conn, "SELECT * FROM `packages` WHERE product_id='$event_product_id' AND type='$event_product_pack'") or die('query failed');
                                $fetch_pack_price = mysqli_fetch_assoc($select_pack_price);

                                $total_price = $fetch_pack_price['price'];
                                $grand_total += $total_price;
                            }
                        }
                        $half_total = round($grand_total/2);
                    ?>
                        <span>Rs <?php echo $half_total?></span>
                    </div>
                </div>
            </div>
            <h3 class="h3" style="text-decoration: underline;">Terms and conditions apply</h3>
            <a href="#checkout" class="option-btn confirm-btn">Confirm and pay</a>
            
        </div>
        <div class="display">
            
                <?php
                    
                    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                    if(mysqli_num_rows($select_cart) > 0){
                        while($fetch_cart = mysqli_fetch_assoc($select_cart)){

                            $event_product_id=$fetch_cart['pid'];

                            $select_event = mysqli_query($conn, "SELECT * FROM `products` WHERE id='$event_product_id'") or die('query failed');
                            $fetch_event = mysqli_fetch_assoc($select_event);
                            $event_planner_id=$fetch_event['planner_id'];
    
                            $select_user = mysqli_query($conn, "SELECT * FROM `users` WHERE id='$event_planner_id'") or die('query failed');
                            $fetch_user = mysqli_fetch_assoc($select_user);
                            $event_planner_image=$fetch_user['image'];
                            $event_planner_name=$fetch_user['name'];
    
    
                            $select_event_planners = mysqli_query($conn, "SELECT * FROM `users` WHERE id='$event_planner_id'") or die('query failed');
                            $fetch_planner = mysqli_fetch_assoc($select_event_planners);
                ?>    
                        
            <div class="pbox">
                <h1 class="name"><?php echo $fetch_event['name']; ?></h1>
                <div class="second-line">
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
        
                        
                    ?>
                    <div class="planner">
                        <img src="uploaded_img/<?php echo $event_planner_image; ?>" alt="" class="e-image">
                        <div class="e-name"><?php echo $event_planner_name; ?></div>
                    </div>
            
                </div>
                <div class="pics">
                    <img src="uploaded_img/<?php echo $fetch_event['image']; ?>" alt="" class="image">
                </div>
        
        
            
                
            </div>
            <?php
                        }
                    }else{
                        echo '<p class="empty">your cart is empty</p>';
                    }
                ?>
        </div>
    </div>
</section>

<section class="checkout" id="checkout">

    <form action="" method="POST">

        <h3>Place your Order</h3>
        <?php
            $select_user_details = mysqli_query($conn, "SELECT * FROM `users` WHERE id='$user_id' ") or die('query failed');
            $fetch_user_details = mysqli_fetch_assoc($select_user_details);
        ?>
        <div class="flex">
            <div class="inputBox">
                <span>Name :</span>
                <input type="text" name="name" placeholder="Enter your name" value="<?=$fetch_user_details['name'] ?>" disabled>
            </div>
            <div class="inputBox">
                <span>Tel No :</span>
                <input type="number" name="number" min="0" placeholder="Enter your telephone number" value="<?=$fetch_user_details['t_no'] ?>" disabled>
            </div>
            <div class="inputBox">
                <span>Email :</span>
                <input type="email" name="email" placeholder="Enter your email" value="<?=$fetch_user_details['email'] ?>" disabled>
            </div>
            <div class="inputBox">
                <span>Payment Method :</span>
                <select name="method" disabled>
                    <option value="after event">After Event</option>
                    <option value="credit card">Credit Card</option>
                    <option value="paypal">Paypal</option>
                    <option value="paytm">Paytm</option>
                </select>
            </div>
            <div class="inputBox">
                <span>Address Line 01 :</span>
                <input type="text" required name="flat" placeholder="e.g. flat no.">
            </div>
            <div class="inputBox">
                <span>Address Line 02 :</span>
                <input type="text" required name="street" placeholder="e.g.  street name">
            </div>
            <div class="inputBox">
                <span>State :</span>
                <input type="text" required name="state" placeholder="e.g. Kottawa">
            </div>
            <div class="inputBox">
                <span>City :</span>
                <input type="text" required name="city" placeholder="e.g. Colombo">
            </div>
            <div class="inputBox">
                <span>Event Date :</span>
                <input type="date" required name="date" placeholder="Enter your event date">
            </div>
            <div class="inputBox">
                <span>Participants :</span>
                <input type="text" required name="amount" placeholder="Enter the amount of participants">
            </div>
        </div>

        <input type="submit" name="order" value="Order Now" class="btn" >

    </form>

</section>










<?php @include 'footer.php'; ?>

<!-- <script type="text/javascript">
    document.getElementsByClass("row1").onclick= function(){

    document.getElementByClass("circle2").style.bacground-color="yellow";
    }
    document.getElementsByClass("row2").onclick= function(){

    document.getElementByClass("circle2").style.display="inline-block";
    }
</script> -->

<script src="js/script.js"></>

</body>
</html>