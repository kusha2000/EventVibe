<?php

@include 'config.php';

session_start();

if(!isset($_SESSION['user_id'])){
   //header('location:login.php');
}else{
   $user_id = $_SESSION['user_id'];
}

if(isset($_POST['submit-planner'])){

   $filter_fname = filter_var($_POST['fname'], FILTER_SANITIZE_STRING);
   $fname = mysqli_real_escape_string($conn, $filter_fname);
   $filter_lname = filter_var($_POST['lname'], FILTER_SANITIZE_STRING);
   $lname = mysqli_real_escape_string($conn, $filter_lname);
   $filter_nic = filter_var($_POST['nic'], FILTER_SANITIZE_STRING);
   $nic = mysqli_real_escape_string($conn, $filter_nic);
   $tno = $_POST['tno'];
   $filter_email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
   $email = mysqli_real_escape_string($conn, $filter_email);
   $filter_name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
   $name = mysqli_real_escape_string($conn, $filter_name);
   $filter_pass = filter_var($_POST['pass'], FILTER_SANITIZE_STRING);
   $pass = mysqli_real_escape_string($conn, md5($filter_pass));
   $filter_cpass = filter_var($_POST['cpass'], FILTER_SANITIZE_STRING);
   $cpass = mysqli_real_escape_string($conn, md5($filter_cpass));
   $filter_about = filter_var($_POST['about'], FILTER_SANITIZE_STRING);
   $about = mysqli_real_escape_string($conn, $filter_about);

   if(isset($_FILES['images'])){
      $image = $_FILES['images']['name'];
      $image_size = $_FILES['images']['size'];
      $image_tmp_name = $_FILES['images']['tmp_name'];
      $image_folter = 'uploaded_img/'.$image;
   }
   

   $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('query failed');

   if(mysqli_num_rows($select_users) > 0){
      $message[] = 'user already exist!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         if(isset($_FILES['images'])){
            $insert_product=mysqli_query($conn, "INSERT INTO `users`(f_name,l_name,nic,t_no,name, email, password,about,image,user_type) VALUES('$fname','$lname','$nic','$tno','$name', '$email', '$pass','$about','$image','user')") or die('query failed');
         }else{
            $insert_product=mysqli_query($conn, "INSERT INTO `users`(f_name,l_name,nic,t_no,name, email, password,about,user_type) VALUES('$fname','$lname','$nic','$tno','$name', '$email', '$pass','$about','planner')") or die('query failed');
         }
         
         if($insert_product && isset($_FILES['images'])){
            if($image_size > 2000000){
               $message[] = 'image size is too large!';
            }else{
               move_uploaded_file($image_tmp_name, $image_folter);
            }
         }

         $message[] = 'registered successfully!';
         //header('location:.php');
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
   <title>register</title>

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
    <h3>Register as a Evnt Planner</h3>
</section>

<section class="form-container-register">

   <form action="" method="post">
      <label class="label">First Name:</label>
      <label class="label" style="margin-left:39%">Last Name:</label><br>
      <input type="text" style="width:47%"  name="fname" class="box" placeholder="enter your first name" required>
      <input type="text" style="width:47%;margin-left:5%" name="lname" class="box" placeholder="enter your last name" required><br>
      <label class="label">NIC:</label><br>
      <input type="text" style="width:75%" name="nic" class="box" placeholder="enter your NIC" required><br>
      <label class="label">Tel No:</label><br>
      <input type="text" style="width:75%" name="tno" class="box" placeholder="enter your telephone number" required><br>
      <label class="label">Email:</label><br>
      <input type="email" style="width:75%" name="email" class="box" placeholder="enter your email" required><br>
      <label class="label">User Name:</label><br>
      <input type="text" style="width:75%" name="name" class="box" placeholder="enter your username" required><br>
      <label class="label">Password:</label>
      <label class="label" style="margin-left:39%">Re-Password:</label><br>
      <input type="password" style="width:47%" name="pass" class="box" placeholder="enter your password" required>
      <input type="password" style="width:47%;margin-left:5%" name="cpass" class="box" placeholder="confirm your password" required><br>
      <label class="label">About You:</label><br>
      <textarea name="about" style="width:100%" class="box" required placeholder="enter description about you" cols="1" rows="7"></textarea><br>
      <label class="label">Your Image:</label><br>
      <input type="file" name="images" accept="image/jpg, image/jpeg, image/png" class="box"><br>
      <input type="submit" style="margin-left:40%" class="btn" name="submit-planner" value="register now">
   </form>

</section>

</body>
</html>