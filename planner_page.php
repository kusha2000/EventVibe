<?php

@include 'config.php';

session_start();

$planner_id = $_SESSION['planner_id'];

if(!isset($planner_id)){
   header('location:login.php');
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>dashboard</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/planners_styles.css">

</head>
<body>
   
<?php @include 'planner_header.php'; ?>


<section class="heading">
    <h3>dashboard</h3>
    <p> <a href="planner_page.php">home</a></p>
</section>

<section class="dashboard">
   <div class="box-container">

      <div class="box">
         <?php
            $total_pendings = 0;
            $select_pendings = mysqli_query($conn, "SELECT * FROM `orders` WHERE payment_status = 'pending' AND planner_id='$planner_id'") or die('query failed');
            while($fetch_pendings = mysqli_fetch_assoc($select_pendings)){
               $total_pendings += $fetch_pendings['total_price'];
            };
         ?>
         <h3>Rs.<?php echo $total_pendings; ?>/-</h3>
         <p>total pendings</p>
      </div>

      <div class="box">
         <?php
            $total_completes = 0;
            $select_completes = mysqli_query($conn, "SELECT * FROM `orders` WHERE payment_status = 'completed' AND planner_id='$planner_id'") or die('query failed');
            while($fetch_completes = mysqli_fetch_assoc($select_completes)){
               $total_completes += $fetch_completes['total_price'];
            };
         ?>
         <h3>Rs.<?php echo $total_completes; ?>/-</h3>
         <p>completed paymets</p>
      </div>

      <div class="box">
         <?php
            $select_orders = mysqli_query($conn, "SELECT * FROM `orders` WHERE planner_id='$planner_id'") or die('query failed');
            $number_of_orders = mysqli_num_rows($select_orders);
         ?>
         <h3><?php echo $number_of_orders; ?></h3>
         <p>orders placed</p>
      </div>

      <div class="box">
         <?php
            $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE planner_id='$planner_id' ") or die('query failed');
            $number_of_products = mysqli_num_rows($select_products);
         ?>
         <h3><?php echo $number_of_products; ?></h3>
         <p>products added</p>
      </div>

   

      <div class="box">
         <?php
            $select_messages = mysqli_query($conn, "SELECT * FROM `message` WHERE planner_id='$planner_id'") or die('query failed');
            $number_of_messages = mysqli_num_rows($select_messages);
         ?>
         <h3><?php echo $number_of_messages; ?></h3>
         <p>new messages</p>
      </div>

   </div>

</section>


<?php @include 'planner_footer.php'; ?>
<script src="js/admin_script.js"></script>

</body>
</html>