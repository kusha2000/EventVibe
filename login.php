<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

   $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
   $email = mysqli_real_escape_string($conn, $filter_email);
   $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
   $pass = mysqli_real_escape_string($conn, md5($filter_pass));

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email' AND password = '$pass'") or die('query failed');


   if(mysqli_num_rows($select_users) > 0){
      
      $row = mysqli_fetch_assoc($select_users);

      if($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name'];
         $_SESSION['admin_email'] = $row['email'];
         $_SESSION['admin_id'] = $row['id'];
         header('location:admin_page.php');

      }elseif($row['user_type'] == 'user'){

         $_SESSION['user_name'] = $row['name'];
         $_SESSION['user_email'] = $row['email'];
         $_SESSION['user_id'] = $row['id'];
         header('location:home.php');

      }elseif($row['user_type'] == 'planner'){

         $_SESSION['planner_name'] = $row['name'];
         $_SESSION['planner_email'] = $row['email'];
         $_SESSION['planner_id'] = $row['id'];
         header('location:planner_page.php');

      }else{
         $message[] = 'no user found!';
      }

   }else{
      $message[] = 'incorrect email or password!';
   }

}

if(!isset($_SESSION['user_id'])){
   //header('location:login.php');
}else{
   $user_id = $_SESSION['user_id'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
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

<section class="heading">
    <h3>Login</h3>
</section>
   
<section class="form-container">

   <form action="" method="post">
      <h3>login now</h3>
      <label class="label">Email:</label>
      <input type="email" name="email" class="box" placeholder="enter your email" required>
      <label class="label">Password:</label>
      <input type="password" name="pass" class="box" placeholder="enter your password" required>
      <input type="submit" class="btn" name="submit" value="login now">
      <p>don't have an account? <a href="register.php">register now</a></p>
   </form>

</section>

</body>
</html>