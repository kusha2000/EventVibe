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

        <a href="home.php" ><img src="images/logo.png" class="logo"></a>

        <nav class="navbar">
            <ul>
                
                <li><a href="#">Events ﹀</a>
                    <ul class="set1">
                        <li><a href="events.php?update=Weddings">Weddings</a></li>
                        <li><a href="events.php?update=Corprate events">Corprate events</a></li>
                        <li><a href="events.php?update=Non profit fundraisers">Non-profit fundraisers</a></li>
                        <li><a href="events.php?update=Birthday parties">Birthday parties</a></li>
                        <li><a href="events.php?update=Trade shows">Trade shows</a></li>
                        <li><a href="events.php?update=Music Festivals">Music Festivals</a></li>
                        <li><a href="events.php?update=Galas and award ceremonies">Galas and award ceremonies</a></li>
                        <li><a href="events.php?update=Sporting events">Sporting events</a></li>
                        <li><a href="events.php?update=Graduation parties">Graduation parties</a></li>
                    </ul>
                    <ul class="set2">
                        <li><a href="events.php?update=Baby showers">Baby showers</a></li>
                        <li><a href="events.php?update=Bridal showers">Bridal showers</a></li>
                        <li><a href="events.php?update=Engagement parties">Engagement parties</a></li>
                        <li><a href="events.php?update=Anniversary celebrations">Anniversary celebrations</a></li>
                        <li><a href="events.php?update=Reunions">Reunions</a></li>
                        <li><a href="events.php?update=Cocktail receptions">Cocktail receptions</a></li>
                        <li><a href="events.php?update=Art exhibitions">Art exhibitions</a></li>
                        <li><a href="events.php?update=Book launches">Book launches</a></li>
                        <li><a href="events.php?update=Charity auctions">Charity auctions</a></li>
                    </ul>
                    <ul class="set3">
                        <li><a href="events.php?update=Fashion shows">Fashion shows</a></li>
                        <li><a href="events.php?update=Film Premieres">Film Premieres</a></li>
                        <li><a href="events.php?update=Product launches">Product launches</a></li>
                        <li><a href="events.php?update=Community festival">Community festival</a></li>
                        <li><a href="events.php?update=Live performances">Live performances</a></li>
                        <li><a href="events.php?update=Team building events">Team building events</a></li>
                    </ul>
                    
                </li>
                <li><a href="shop.php">shop</a></li>
                <li><a href="orders.php">orders</a></li>
                <li><a href="register_planners.php" class="become">Become an Event Planner</a></li>
            </ul>
        </nav>

        <div class="icons">
            <div id="menu-btn" class="fas fa-bars"></div>
            <div id="user-btn" class="fas fa-user"></div>
            <?php
                $select_wishlist_count = mysqli_query($conn, "SELECT * FROM `wishlist` WHERE user_id = '$user_id'") or die('query failed');
                $wishlist_num_rows = mysqli_num_rows($select_wishlist_count);
            ?>
            <a href="wishlist.php"><i class="fas fa-heart"></i><span>(<?php echo $wishlist_num_rows; ?>)</span></a>
            <?php
                $select_cart_count = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
                $cart_num_rows = mysqli_num_rows($select_cart_count);
            ?>
            <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?php echo $cart_num_rows; ?>)</span></a>
        </div>

        <div class="account-box">
            <?php 
                $my_email=$_SESSION['user_email'];
                $select_profile = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$my_email'") or die('query failed');
                $my_profile = mysqli_fetch_assoc($select_profile);
            ?>
            <img class="pimage" src="uploaded_img/<?php echo $my_profile['image']; ?>" alt="">
            <p>username : <span><?php echo $_SESSION['user_name']; ?></span></p>
            <p>email : <span><?php echo $_SESSION['user_email']; ?></span></p>
            <a href="" class="option-btn">Edit Profile</a>
            <a href="logout.php" class="delete-btn">logout</a>
            
        </div>

    </div>

</header>