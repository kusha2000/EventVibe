<?php

@include 'config.php';

session_start();

$planner_id = $_SESSION['planner_id'];

if(!isset($planner_id)){
   header('location:login.php');
};

if(isset($_POST['add_product'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $price = $_POST['price'];
   $details = mysqli_real_escape_string($conn, $_POST['details']);
   $event_type = mysqli_real_escape_string($conn, $_POST['event_types']);
   $subcategories = mysqli_real_escape_string($conn, $_POST['subcategories']);
   $district = mysqli_real_escape_string($conn, $_POST['district']);

   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folter = 'uploaded_img/'.$image;

   $image1 = $_FILES['image1']['name'];
   $image1_size = $_FILES['image1']['size'];
   $image1_tmp_name = $_FILES['image1']['tmp_name'];
   $image1_folter = 'uploaded_img/'.$image1;

   $image2 = $_FILES['image2']['name'];
   $image2_size = $_FILES['image2']['size'];
   $image2_tmp_name = $_FILES['image2']['tmp_name'];
   $image2_folter = 'uploaded_img/'.$image2;

   $image3 = $_FILES['image3']['name'];
   $image3_size = $_FILES['image3']['size'];
   $image3_tmp_name = $_FILES['image3']['tmp_name'];
   $image3_folter = 'uploaded_img/'.$image3;

   $image4 = $_FILES['image4']['name'];
   $image4_size = $_FILES['image4']['size'];
   $image4_tmp_name = $_FILES['image4']['tmp_name'];
   $image4_folter = 'uploaded_img/'.$image4;

   $basic_price = $_POST['price'];
   $basic_desc = mysqli_real_escape_string($conn, $_POST['basic_details']);
   $basic_include = mysqli_real_escape_string($conn, $_POST['basic_includes']);

   $standard_price = $_POST['standard_price'];
   $standard_desc = mysqli_real_escape_string($conn, $_POST['standard_details']);
   $standard_include = mysqli_real_escape_string($conn, $_POST['standard_includes']);
   
   $premium_price = $_POST['premium_price'];
   $premium_desc = mysqli_real_escape_string($conn, $_POST['premium_details']);
   $premium_include = mysqli_real_escape_string($conn, $_POST['premium_includes']);

   /*echo $name.'<br>';
   echo $price.'<br>';
   echo $details.'<br>';
   echo $event_type.'<br>';
   echo $subcategories.'<br>';
   echo $district.'<br>';
   echo $image.'<br>';
   echo $image1.'<br>';
   echo $image2.'<br>';
   echo $image3.'<br>';
   echo $image4.'<br>';
   echo $basic_price.'<br>';
   echo $basic_desc.'<br>';
   echo $basic_include.'<br>';
   echo $standard_price.'<br>';
   echo $standard_desc.'<br>';
   echo $standard_include.'<br>';
   echo $premium_price.'<br>';
   echo $standard_desc.'<br>';
   echo $premium_include.'<br>';*/


   $select_product_name = mysqli_query($conn, "SELECT name FROM `products` WHERE name = '$name'") or die('query failed-60');

   if(mysqli_num_rows($select_product_name) > 0){
      $message[] = 'product name already exist!';
   }else{
        $insert_product = mysqli_query($conn, "INSERT INTO `products`(name, details, price,event_type,subcategorie,district,image,image1,image2,image3,image4,planner_id) VALUES('$name', '$details', '$price', '$event_type','$subcategories','$district','$image','$image1','$image2','$image3','$image4','$planner_id')") or die('query failed-66');
     
      
      
      if($insert_product){
         if($image_size > 2000000 && $image1_size > 2000000 && $image2_size > 2000000 && $image3_size > 2000000 && $image4_size > 2000000){
            $message[] = 'image size is too large!';

         }else{
            move_uploaded_file($image_tmp_name, $image_folter);
            move_uploaded_file($image1_tmp_name, $image1_folter);
            move_uploaded_file($image2_tmp_name, $image2_folter);
            move_uploaded_file($image3_tmp_name, $image3_folter);
            move_uploaded_file($image4_tmp_name, $image4_folter);
            $select_product_id = mysqli_query($conn, "SELECT id FROM `products` WHERE name = '$name'") or die('query failed');
            $fetch_product_id = mysqli_fetch_assoc($select_product_id);
            $this_product_id=$fetch_product_id['id'];

            $insert_basic_product = mysqli_query($conn, "INSERT INTO `packages`(product_id, type, price, description,includes,have) VALUES('$this_product_id', 'basic', '$basic_price', '$basic_desc','$basic_include',1)") or die('query failed-80');
            $insert_standard_product = mysqli_query($conn, "INSERT INTO `packages`(product_id, type, price, description,includes,have) VALUES('$this_product_id', 'standard', '$standard_price', '$standard_desc','$standard_include',1)") or die('query failed-81');
            $insert_premium_product = mysqli_query($conn, "INSERT INTO `packages`(product_id, type, price, description,includes,have) VALUES('$this_product_id', 'premium', '$premium_price', '$premium_desc','$premium_include',1)") or die('query failed-82');
            //$insert_basic_product = mysqli_query($conn, "INSERT INTO `packages`(type, price, description,includes,have) VALUES('basic', '$basic_price', '$basic_desc','$basic_include',1)") or die('query failed-80');
            //$insert_standard_product = mysqli_query($conn, "INSERT INTO `packages`(product_id, type, price, description,includes,have) VALUES('$select_product_id', 'standard', '$standard_price', '$standard_desc','$standard_include',1)") or die('query failed-81');
            //$insert_premium_product = mysqli_query($conn, "INSERT INTO `packages`(product_id, type, price, description,includes,have) VALUES('$select_product_id', 'premium', '$premium_price', '$premium_desc','$premium_include',1)") or die('query failed-82');
            $message[] = 'product added successfully!';
            header('location:planner_products.php');
            
            
         }
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
   <title>products</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/planners_styles.css">

</head>
<body>
   
<?php @include 'planner_header.php'; ?>
<section class="heading">
    <h3>add new events</h3>
    <p> <a href="planner_page.php">home</a> / add </p>
</section>

<section class="add-products">
    
    <div class="main-details">
        <form action="" method="POST" enctype="multipart/form-data">
        <div class="form">
        <label class="label">Event Name</label><br>
        <input type="text" class="box" required placeholder="enter event name" name="name">
        
        <label class="label">Select event type:</label>
        <select class="options" name="event_types">
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


        <textarea name="details" class="box" required placeholder="enter event details" cols="1" rows="2"></textarea>
        <label class="label">Main Image</label>
        <input type="file" accept="image/jpg, image/jpeg, image/png" required class="box" name="image">
        <label class="label">Other Images</label><br>
        <input type="file" accept="image/jpg, image/jpeg, image/png" required class="box nimg" name="image1">
        <input type="file" accept="image/jpg, image/jpeg, image/png" required class="box nimg" name="image2">
        <input type="file" accept="image/jpg, image/jpeg, image/png" required class="box nimg" name="image3">
        <input type="file" accept="image/jpg, image/jpeg, image/png" required class="box nimg" name="image4">
        </div>

    </div>
    <div class="sub-flex">
        <div class="sub-pack basic-details">
            <div class="form">
                <h3>Basic Package</h3>
                <input type="number" min="0" class="box" required placeholder="enter basic price" name="price">
                <textarea name="basic_details" class="box" required placeholder="enter description for basic package" cols="1" rows="2" ></textarea>
                <textarea name="basic_includes" class="box" required placeholder="enter package includes for basic package" cols="1" rows="3"></textarea>
            </div>
        </div>
        <div class="sub-pack standard-details">
            <div class="form">
                <h3>Standard Package</h3>
                <input type="number" min="0" class="box" required placeholder="enter standard price" name="standard_price">
                <textarea name="standard_details" class="box" required placeholder="enter description for basic package" cols="1" rows="2"></textarea>
                <textarea name="standard_includes" class="box" required placeholder="enter package includes for basic package" cols="1" rows="3"></textarea>
            </div>
        </div>
        <div class="sub-pack premium-details">
            <div class="form">
                <h3>Premium Package</h3>
                <input type="number" min="0" class="box" required placeholder="enter premium price" name="premium_price">
                <textarea name="premium_details" class="box" required placeholder="enter description for basic package" cols="1" rows="2"></textarea>
                <textarea name="premium_includes" class="box" required placeholder="enter package includes for basic package" cols="1" rows="3"></textarea>
            </div>
        </div>
    </div>
    </section>
    <div class="last-btn" style="text-align:center;margin-bottom:30px;">
        <input type="submit" value="add event" name="add_product" class="btn add-product-btn" >
        <a href="planner_page.php" class="option-btn">go back</a>
    </form>
    </div>
    <!-- <a href="" style="margin-left:650px;margin-bottom: 50px;"></a> -->

    
<?php @include 'planner_footer.php'; ?>
<script src="js/admin_script.js"></script>

</body>
</html>