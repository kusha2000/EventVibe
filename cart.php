<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$delete_id'") or die('query failed');
    header('location:cart.php');
}

if(isset($_GET['delete_all'])){
    mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
    header('location:cart.php');
};

if(isset($_POST['update_quantity'])){
    $cart_id = $_POST['cart_id'];
    $cart_quantity = $_POST['cart_quantity'];
    mysqli_query($conn, "UPDATE `cart` SET quantity = '$cart_quantity' WHERE id = '$cart_id'") or die('query failed');
    $message[] = 'cart quantity updated!';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>shopping cart</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/styles.css">

</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="heading">
    <h3>shopping cart</h3>
    <p> <a href="home.php">home</a> / cart </p>
</section>

<section class="shopping-cart">

    <h1 class="title">products added</h1>

    <div class="box-container">

    <?php
        $grand_total = 0;
        $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');

        if(mysqli_num_rows($select_cart) > 0){
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                $product_id=$fetch_cart['pid'];
                $select_event = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$product_id' ") or die('query failed');
                $fetch_event = mysqli_fetch_assoc($select_event);
                $event_type=$fetch_cart['event_type'];
                $select_event_pack = mysqli_query($conn, "SELECT * FROM `packages` WHERE product_id = '$product_id' AND type='$event_type' ") or die('query failed');
                $fetch_event_pack = mysqli_fetch_assoc($select_event_pack);
    ?>  
    <div  class="box">
        <a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="fas fa-times" onclick="return confirm('delete this from cart?');"></a>
        <a href="view_page.php?pid=<?php echo $fetch_cart['pid']; ?>" class="fas fa-eye"></a>
        <img src="uploaded_img/<?php echo $fetch_event['image']; ?>" alt="" class="image">
        <div class="event_type"><?php echo $fetch_event['event_type']; ?></div>
        <div class="name"><?php echo $fetch_event['name']; ?></div>
        <div class="pack"><?php echo $fetch_cart['event_type']; ?> package</div>
        <div class="sub-total"> sub-total : <span>Rs<?php echo $sub_total = $fetch_event_pack['price'];?>/-</span> </div>
    </div>
    <?php
    $grand_total += $sub_total;
        }
    }else{
        echo '<p class="empty">your cart is empty</p>';
    }
    ?>
    </div>

    <div class="more-btn">
        <a href="cart.php?delete_all" class="delete-btn <?php echo ($grand_total > 1)?'':'disabled' ?>" onclick="return confirm('delete all from cart?');">delete all</a>
    </div>

    <div class="cart-total">
        <p>grand total : <span>Rs<?php echo $grand_total; ?>/-</span></p>
        <a href="shop.php" class="option-btn">continue shopping</a>
        <a href="before_checkout.php" class="btn  <?php echo ($grand_total > 1)?'':'disabled' ?>">proceed to checkout</a>
    </div>

</section>






<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>