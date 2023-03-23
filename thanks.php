<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Thanks</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/styles.css">

</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="thanks">
        <div class="image">
            <img src="images/thanks-cover.png">
            
            <div class="text">
                <h1>Thank you for placing an</h1>
                <h1>order......</h1>
                <h2>Event planner will be in touch with you in a short while.</h2>
                <a href="orders.php">My Orders</a>
            </div>
        
    </div>
</section>










<?php @include 'footer.php'; ?>

<script src="js/script.js"></>

</body>
</html>