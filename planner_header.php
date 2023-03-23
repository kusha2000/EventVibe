<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

   <div class="flex">

   <a href="planner_page.php" ><img src="images/logo.png" class="logo"></a>

      <nav class="navbar">
         <a href="planner_page.php">home</a>
         <a href="planner_addproduct.php">add events</a>
         <a href="planner_products.php">my events</a>
         <a href="planner_orders.php">orders</a>
         <a href="planner_contacts.php">messages</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="account-box">
            <?php 
                $my_email=$_SESSION['planner_email'];
                $select_profile = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$my_email'") or die('query failed');
                $my_profile = mysqli_fetch_assoc($select_profile);
            ?>
         <img class="pimage" src="uploaded_img/<?php echo $my_profile['image']; ?>" alt="">
         <p>username : <span><?php echo $_SESSION['planner_name']; ?></span></p>
         <p>email : <span><?php echo $_SESSION['planner_email']; ?></span></p>
         <a href="" class="option-btn">Edit Profile</a>
         <a href="logout.php" class="delete-btn">logout</a>
         <div>new <a href="login.php">login</a> | <a href="register.php">register</a> </div>
      </div>

   </div>

</header>