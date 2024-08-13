<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/wishlist_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Quick View | Purna Variety</title>

   <!-- Font Awesome CDN Link -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- New Stylesheet for Modern UI (Cloudflare) -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

   <!-- Custom CSS File Link -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<section class="quick-view animate__animated animate__fadeIn">

   <h1 class="heading">Quick View</h1>

   <?php
     if(isset($_GET['pid']) && !empty($_GET['pid'])){
        $pid = htmlspecialchars($_GET['pid']);
        $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?"); 
        $select_products->execute([$pid]);
        if($select_products->rowCount() > 0){
          while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="box">
      <input type="hidden" name="pid" value="<?= htmlspecialchars($fetch_product['id']); ?>">
      <input type="hidden" name="name" value="<?= htmlspecialchars($fetch_product['name']); ?>">
      <input type="hidden" name="price" value="<?= htmlspecialchars($fetch_product['price']); ?>">
      <input type="hidden" name="image" value="<?= htmlspecialchars($fetch_product['image_01']); ?>">
      <div class="row">
         <div class="image-container animate__animated animate__zoomIn">
            <div class="main-image">
               <img src="uploaded_img/<?= htmlspecialchars($fetch_product['image_01']); ?>" alt="<?= htmlspecialchars($fetch_product['name']); ?>">
            </div>
            <div class="sub-image">
               <img src="uploaded_img/<?= htmlspecialchars($fetch_product['image_01']); ?>" alt="">
               <img src="uploaded_img/<?= htmlspecialchars($fetch_product['image_02']); ?>" alt="">
               <img src="uploaded_img/<?= htmlspecialchars($fetch_product['image_03']); ?>" alt="">
            </div>
         </div>
         <div class="content">
            <div class="name"><?= htmlspecialchars($fetch_product['name']); ?></div>
            <div class="flex">
               <div class="price"><span>$</span><?= htmlspecialchars($fetch_product['price']); ?><span>/-</span></div>
               <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
            </div>
            <div class="details"><?= nl2br(htmlspecialchars($fetch_product['details'])); ?></div>
            <div class="flex-btn">
               <input type="submit" value="Add to Cart" class="btn animate__animated animate__heartBeat" name="add_to_cart">
               <input class="option-btn" type="submit" name="add_to_wishlist" value="Add to Wishlist">
            </div>
         </div>
      </div>
   </form>
   <?php
         }
      } else {
         echo '<p class="empty">Product not found!</p>';
      }
   } else {
      echo '<p class="empty">Invalid product ID!</p>';
   }
   ?>

</section>

<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
