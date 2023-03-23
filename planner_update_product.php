<?php

@include 'config.php';

session_start();

$planner_id = $_SESSION['planner_id'];

if(!isset($planner_id)){
   header('location:login.php');
};

if(isset($_POST['update_product'])){


   $update_p_id = $_POST['update_p_id'];
   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $price = mysqli_real_escape_string($conn, $_POST['price']);
   $details = mysqli_real_escape_string($conn, $_POST['details']);
   $event_type = mysqli_real_escape_string($conn, $_POST['event_types']);
   $subcategories = mysqli_real_escape_string($conn, $_POST['subcategories']);
   $district = mysqli_real_escape_string($conn, $_POST['district']);

   

   $basic_price = $_POST['price'];
   $basic_desc = mysqli_real_escape_string($conn, $_POST['basic_details']);
   $basic_include = mysqli_real_escape_string($conn, $_POST['basic_includes']);

   $standard_price = $_POST['standard_price'];
   $standard_desc = mysqli_real_escape_string($conn, $_POST['standard_details']);
   $standard_include = mysqli_real_escape_string($conn, $_POST['standard_includes']);
   
   $premium_price = $_POST['premium_price'];
   $premium_desc = mysqli_real_escape_string($conn, $_POST['premium_details']);
   $premium_include = mysqli_real_escape_string($conn, $_POST['premium_includes']);
   

   mysqli_query($conn, "UPDATE `products` SET name = '$name', details = '$details', price = '$price',event_type='$event_type', subcategorie='$subcategories', district='$district' WHERE id = '$update_p_id'") or die('query failed-38');
   mysqli_query($conn, "UPDATE `packages` SET price = '$basic_price', description = '$basic_desc', includes = '$basic_include' WHERE product_id = '$update_p_id' AND type='basic'") or die('query failed-39');
   mysqli_query($conn, "UPDATE `packages` SET price = '$standard_price', description = '$standard_desc', includes = '$standard_include' WHERE product_id = '$update_p_id' AND type='standard'") or die('query failed-39');
   mysqli_query($conn, "UPDATE `packages` SET price = '$premium_price', description = '$premium_desc', includes = '$premium_include' WHERE product_id = '$update_p_id' AND type='premium'") or die('query failed-39');

   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folter = 'uploaded_img/'.$image;
   $old_image = $_POST['update_p_image'];
    

   $image1 = $_FILES['image1']['name'];
   $image1_size = $_FILES['image1']['size'];
   $image1_tmp_name = $_FILES['image1']['tmp_name'];
   $image1_folter = 'uploaded_img/'.$image1;
   $old_image1 = $_POST['update_p_image1'];

   $image2 = $_FILES['image2']['name'];
   $image2_size = $_FILES['image2']['size'];
   $image2_tmp_name = $_FILES['image2']['tmp_name'];
   $image2_folter = 'uploaded_img/'.$image2;
   $old_image2 = $_POST['update_p_image2'];

   $image3 = $_FILES['image3']['name'];
   $image3_size = $_FILES['image3']['size'];
   $image3_tmp_name = $_FILES['image3']['tmp_name'];
   $image3_folter = 'uploaded_img/'.$image3;
   $old_image3 = $_POST['update_p_image3'];

   $image4 = $_FILES['image4']['name'];
   $image4_size = $_FILES['image4']['size'];
   $image4_tmp_name = $_FILES['image4']['tmp_name'];
   $image4_folter = 'uploaded_img/'.$image4;
   $old_image4 = $_POST['update_p_image4'];
   
   if(!empty($image)){
      if($image_size > 2000000){
         $message[] = 'image file size is too large!';
      }else{
         mysqli_query($conn, "UPDATE `products` SET image = '$image' WHERE id = '$update_p_id'") or die('query failed-77');
         move_uploaded_file($image_tmp_name, $image_folter);
         unlink('uploaded_img/'.$old_image);
         $message[] = 'image updated successfully!';
      }
   }
   if(!empty($image1)){
      if($image1_size > 2000000){
         $message[] = 'image1 file size is too large!';
      }else{
         mysqli_query($conn, "UPDATE `products` SET image1 = '$image1' WHERE id = '$update_p_id'") or die('query failed-87');
         move_uploaded_file($image1_tmp_name, $image1_folter);
         unlink('uploaded_img/'.$old_image1);
         $message[] = 'image1 updated successfully!';
      }
   }
   if(!empty($image2)){
      if($image2_size > 2000000){
         $message[] = 'image2 file size is too large!';
      }else{
         mysqli_query($conn, "UPDATE `products` SET image2 = '$image2' WHERE id = '$update_p_id'") or die('query failed-97');
         move_uploaded_file($image2_tmp_name, $image2_folter);
         unlink('uploaded_img/'.$old_image2);
         $message[] = 'image2 updated successfully!';
      }
   }
   if(!empty($image3)){
      if($image3_size > 2000000){
         $message[] = 'image3 file size is too large!';
      }else{
         mysqli_query($conn, "UPDATE `products` SET image3 = '$image3' WHERE id = '$update_p_id'") or die('query failed');
         move_uploaded_file($image3_tmp_name, $image3_folter);
         unlink('uploaded_img/'.$old_image3);
         $message[] = 'image3 updated successfully!';
      }
   }
   if(!empty($image4)){
      if($image4_size > 2000000){
         $message[] = 'image4 file size is too large!';
      }else{
         mysqli_query($conn, "UPDATE `products` SET image4 = '$image4' WHERE id = '$update_p_id'") or die('query failed');
         move_uploaded_file($image4_tmp_name, $image4_folter);
         unlink('uploaded_img/'.$old_image4);
         $message[] = 'image4 updated successfully!';
      }
   }

   $message[] = 'product updated successfully!';

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update product</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/planners_styles.css">

</head>
<body>
   
<?php @include 'planner_header.php'; ?>

<section class="update-products">

<?php

   $update_id = $_GET['update'];
   $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE id = '$update_id'") or die('query failed');
   $select_product_packs_basic = mysqli_query($conn, "SELECT * FROM `packages` WHERE product_id = '$update_id' AND type='basic'") or die('query failed');
   $select_product_packs_standard = mysqli_query($conn, "SELECT * FROM `packages` WHERE product_id = '$update_id' AND type='standard'") or die('query failed');
   $select_product_packs_premium = mysqli_query($conn, "SELECT * FROM `packages` WHERE product_id = '$update_id' AND type='premium'") or die('query failed');
   if(mysqli_num_rows($select_products) > 0){
      $fetch_products_basic = mysqli_fetch_assoc($select_product_packs_basic);
      $fetch_products_standard = mysqli_fetch_assoc($select_product_packs_standard);
      $fetch_products_premium = mysqli_fetch_assoc($select_product_packs_premium);
      while($fetch_products = mysqli_fetch_assoc($select_products)){
?>

<form action="" method="post" enctype="multipart/form-data">
<h1 class="proname"><?php echo $fetch_products['name']; ?></h1>
<div class="p-details">
    <div class="pic1">
        <img src="uploaded_img/<?php echo $fetch_products['image']; ?>" alt="" class="image">
        <input type="file" accept="image/jpg, image/jpeg, image/png" class="box" name="image">
    </div>
    <div class="grid">
        <div class="pic2">
        <img src="uploaded_img/<?php echo $fetch_products['image1']; ?>" alt="" class="image">
        <input type="file" accept="image/jpg, image/jpeg, image/png" class="box nimg" name="image1">
        </div>
        <div class="pic2">
        <img src="uploaded_img/<?php echo $fetch_products['image2']; ?>" alt="" class="image"> 
        <input type="file" accept="image/jpg, image/jpeg, image/png" class="box nimg" name="image2">
        
        </div>
        <div class="pic2"> 
        <img src="uploaded_img/<?php echo $fetch_products['image3']; ?>" alt="" class="image">
        <input type="file" accept="image/jpg, image/jpeg, image/png" class="box nimg" name="image3">
        
        </div>
        <div class="pic2">
        <img src="uploaded_img/<?php echo $fetch_products['image4']; ?>" alt="" class="image">
        <input type="file" accept="image/jpg, image/jpeg, image/png" class="box nimg" name="image4">
        </div>
    </div>
</div>

   <input type="hidden" value="<?php echo $fetch_products['id']; ?>" name="update_p_id">
   <input type="hidden" value="<?php echo $fetch_products['image']; ?>" name="update_p_image">
   <input type="hidden" value="<?php echo $fetch_products['image1']; ?>" name="update_p_image1">
   <input type="hidden" value="<?php echo $fetch_products['image2']; ?>" name="update_p_image2">
   <input type="hidden" value="<?php echo $fetch_products['image3']; ?>" name="update_p_image3">
   <input type="hidden" value="<?php echo $fetch_products['image4']; ?>" name="update_p_image4">

   <div class="add-products">
    
    <div class="main-details">
        <div class="form">
        <label class="label">Event Name</label><br>
        <input type="text" class="box" value="<?php echo $fetch_products['name']; ?>" required placeholder="enter event name" name="name">
        
        <label class="label">Select event type:</label>
        <select class="options" name="event_types" value="<?php echo $fetch_products['id']; ?>">
            <option value="<?php echo $fetch_products['event_type']; ?>"><?php echo $fetch_products['event_type']; ?></option>
            <option value="Weddings">Weddings</option>
            <option value="Corprate events">Corprate events</option>
            <option value="Non profit fundraisers">Non-profit fundraisers</option>
            <option value="Birthday parties">Birthday parties</option>
            <option value="Trade shows">Trade shows</option>
            <option value="Music Festivals">Music Festivals</option>
            <option value="Galas and award ceremonies">Galas and award ceremonies</option>
            <option value="Sporting vents">Sporting events</option>
            <option value="Graduation parties">Graduation parties</option>
            <option value="Baby showers">Baby showers</option>
            <option value="Bridal showers">Bridal showers</option>
            <option value="Engagement parties">Engagement parties</option>
            <option value="Anniversary celebrations">Anniversary celebrations</option>
            <option value="Reunions">Reunions</option>
            <option value="Cocktail receptions">Cocktail receptions</option>
            <option value="Art exhibitions">Art exhibitions</option>
            <option value="Book launches">Book launches</option>
            <option value="Charity auctions">Charity auctions</option>
            <option value="Fashion shows">Fashion shows</option>
            <option value="Film Premieres">Film Premieres</option>
            <option value="Product launches">Product launches</option>
            <option value="Community festival">Community festival</option>
            <option value="Live performances">Live performances</option>
            <option value="Team building events">Team building events</option>
        </select>
        <br>
        <label class="label">Subcategories:</label>
        <select class="options" name="subcategories">
            <option value="<?php echo $fetch_products['subcategorie']; ?>"><?php echo $fetch_products['subcategorie']; ?></option>
            <option value="Traditional">Traditional</option>
            <option value="Beach">Beach</option>
            <option value="Destination">Destination</option>
            <option value="Gardern">Gardern</option>
            <option value="Vintage">Vintage</option>
            <option value="Rustic">Rustic</option>
            <option value="Bohemian">Bohemian</option>
            <option value="Luxury">Luxury</option>
            <option value="Intimate">Intimate</option>
            <option value="Eco friendly">Eco-friendly</option>
        </select>
        <br>
        <label class="label">District:</label>
        <select class="options" name="district">
            <option value="<?php echo $fetch_products['district']; ?>"><?php echo $fetch_products['district']; ?></option>
            <option value="All Districts">All Districts</option>
            <option value="Ampara">Ampara</option>
            <option value="Anuradhapura">Anuradhapura</option>
            <option value="Badulla">Badulla</option>
            <option value="Batticaloa">Batticaloa</option>
            <option value="Colombo">Colombo</option>
            <option value="Galle">Galle</option>
            <option value="Gampaha">Gampaha</option>
            <option value="Hambantota">Hambantota</option>
            <option value="Jaffna">Jaffna</option>
            <option value="Kalutara">Kalutara</option>
            <option value="Kandy">Kandy</option>
            <option value="Kegalle">Kegalle</option>
            <option value="Kilinochchi">Kilinochchi</option>
            <option value="Kurunegala">Kurunegala</option>
            <option value="Mannar">Mannar</option>
            <option value="Matale">Matale</option>
            <option value="Matara">Matara</option>
            <option value="Monaragala">Monaragala</option>
            <option value="Mullaitivu">Mullaitivu</option>
            <option value="Nuwara Eliya">Nuwara Eliya</option>
            <option value="Polonnaruwa">Polonnaruwa</option>
            <option value="Puttalam">Puttalam</option>
            <option value="Ratnapura">Ratnapura</option>
            <option value="Trincomalee">Trincomalee</option>
            <option value="Vavuniya">Vavuniya</option>
        </select>


        <textarea name="details"  class="box"  required placeholder="enter event details" cols="1" rows="2"><?php echo $fetch_products['details']; ?></textarea>
        
        </div>

    </div>
    <div class="sub-flex">
        <div class="sub-pack basic-details">
            <div class="form">
                <h3>Basic Package</h3>
                <input type="number" min="0" class="box" required placeholder="enter basic price" name="price" value="<?php echo $fetch_products_basic['price'] ?>">
                <textarea name="basic_details" class="box" required placeholder="enter description for basic package" cols="1" rows="2" ><?php echo $fetch_products_basic['description'] ?></textarea>
                <textarea name="basic_includes" class="box" required placeholder="enter package includes for basic package" cols="1" rows="3"><?php echo $fetch_products_basic['includes'] ?></textarea>
            </div>
        </div>
        <div class="sub-pack standard-details">
            <div class="form">
                <h3>Standard Package</h3>
                <input type="number" min="0" class="box" required placeholder="enter standard price" name="standard_price" value="<?php echo $fetch_products_standard['price'] ?>">
                <textarea name="standard_details" class="box" required placeholder="enter description for basic package" cols="1" rows="2"><?php echo $fetch_products_standard['description'] ?></textarea>
                <textarea name="standard_includes" class="box" required placeholder="enter package includes for basic package" cols="1" rows="3"><?php echo $fetch_products_standard['includes'] ?></textarea>
            </div>
        </div>
        <div class="sub-pack premium-details">
            <div class="form">
                <h3>Premium Package</h3>
                <input type="number" min="0" class="box" required placeholder="enter premium price" name="premium_price" value="<?php echo $fetch_products_premium['price'] ?>">
                <textarea name="premium_details" class="box" required placeholder="enter description for basic package" cols="1" rows="2"><?php echo $fetch_products_premium['description'] ?></textarea>
                <textarea name="premium_includes" class="box" required placeholder="enter package includes for basic package" cols="1" rows="3"><?php echo $fetch_products_premium['includes'] ?></textarea>
            </div>
        </div>
    </div>
      </div>

      <div class="last-btn" style="text-align:center;margin-bottom:30px;">
        <input type="submit" value="update product" name="update_product" class="btn">
        <a href="planner_products.php" class="option-btn">go back</a>
      </div>
    

   
</form>



<?php
      }
   }else{
      echo '<p class="empty">no update product select</p>';
   }
?>

</section>

<?php @include 'planner_footer.php'; ?>

<script src="js/admin_script.js"></script>

</body>
</html>