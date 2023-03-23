<?php

@include 'config.php';

session_start();

$planner_id = $_SESSION['planner_id'];

if(!isset($planner_id)){
   header('location:login.php');
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `message` WHERE id = '$delete_id'") or die('query failed');
   header('location:planner_contacts.php');
}

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
    <h3>messages</h3>
    <p> <a href="planner_page.php">home</a> / my products </p>
</section>

<section class="messages">

   <div class="box-container">

      <?php
       $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE planner_id='$planner_id'") or die('query failed');
       if(mysqli_num_rows($select_message) > 0){
          while($fetch_message = mysqli_fetch_assoc($select_message)){
      ?>
      <div class="box">
         <p>user id : <span><?php echo $fetch_message['user_id']; ?></span> </p>
         <p>name : <span><?php echo $fetch_message['name']; ?></span> </p>
         <p>number : <span><?php echo $fetch_message['number']; ?></span> </p>
         <p>email : <span><?php echo $fetch_message['email']; ?></span> </p>
         <p>message : <span><?php echo $fetch_message['message']; ?></span> </p>
         <a href="planner_contacts.php?delete=<?php echo $fetch_message['id']; ?>" onclick="return confirm('delete this message?');" class="delete-btn">delete</a>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">you have no messages!</p>';
      }
      ?>
   </div>

</section>

<?php @include 'planner_footer.php'; ?>
<script src="js/admin_script.js"></script>

</body>
</html>