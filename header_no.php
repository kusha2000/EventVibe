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
                
                <li><a href="#">Events 
                    <img src="images/dropdown" width=20px class="dropdown" class="grayscale" title="grayscale">
                </a>
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
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact Us</a></li>
            </ul>
        </nav>
        <div class="navbar">
            <ul>
                <li><a href="register_planners.php" class="become">Become an Event Planner</a></li>
                <li><a href="login.php" class="login1">Login</a></li>
                <li><a href="register.php" class="become">Sign up</a></li>
            </ul>
        </div>   
            

        

        

    </div>

</header>