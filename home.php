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
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Purna Variety Store | Home</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<div class="home-bg">

<section class="home">

   <div class="swiper home-slider">
   
   <div class="swiper-wrapper">

      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/resized_image_1.jpg" alt="Pasni Sale">
         </div>
         <div class="content">
            <span>Up to 20% Off</span>
            <h3>Latest pasni collection</h3>
            <a href="shop.php" class="btn">Shop Now</a>
         </div>
      </div>

      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/resized_image_2.jpg" alt="kids clothing">
         </div>
         <div class="content">
            <span>Up to 10% Off</span>
            <h3>Latest kids item</h3>
            <a href="shop.php" class="btn">Shop Now</a>
         </div>
      </div>

      <div class="swiper-slide slide">
         <div class="image">
            <img src="images/resized_image_3.jpg" alt="Suit">
         </div>
         <div class="content">
            <span>Up to 5% Off</span>
            <h3>Latest baby suit</h3>
            <a href="shop.php" class="btn">Shop Now</a>
         </div>
      </div>

   </div>

      <div class="swiper-pagination"></div>

   </div>

</section>

</div>

<section class="category">

   <h1 class="heading">Shop by Category</h1>

   <div class="swiper category-slider">

   <div class="swiper-wrapper">

   <a href="category.php?category=baby" class="swiper-slide slide">
      <img src="images/babyicon.jpeg" alt="baby cloth">
      <h3>baby cloth</h3>
   </a>

   <a href="category.php?category=men" class="swiper-slide slide">
      <img src="images/meni.png" alt="Mens">
      <h3>Mens</h3>
   </a>

   <a href="category.php?category=women" class="swiper-slide slide">
      <img src="images/womeni.jpeg" alt="womens">
      <h3>womens</h3>
   </a>

   <a href="category.php?category=maternity" class="swiper-slide slide">
      <img src="images/maxi.icon.png" alt="maternity">
      <h3>maternity</h3>
   </a>

   <a href="category.php?category=pasni" class="swiper-slide slide">
      <img src="images/pasniicon.png" alt="pasni">
      <h3>pasni</h3>
   </a>

   <a href="category.php?category=cap" class="swiper-slide slide">
      <img src="images/capicon.png" alt="cap ">
      <h3>cap </h3>
   </a>

   <a href="category.php?category=cultural dress" class="swiper-slide slide">
      <img src="images/culticon.png" alt="cultural dress">
      <h3>cultural dress</h3>
   </a>

   <a href="category.php?category=nursing dress" class="swiper-slide slide">
      <img src="images/nursicon.png" alt="nursing dresses">
      <h3>nursing dresses</h3>
   </a>

   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>

<section class="home-products">

   <h1 class="heading">Latest Products</h1>

   <div class="swiper products-slider">

   <div class="swiper-wrapper">

   <?php
     $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6"); 
     $select_products->execute();
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="swiper-slide slide">
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
      <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
      <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="fas fa-eye"></a>
      <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="<?= $fetch_product['name']; ?>">
      <div class="name"><?= $fetch_product['name']; ?></div>
      <div class="flex">
         <div class="price"><span>$</span><?= $fetch_product['price']; ?><span>/-</span></div>
         <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
      </div>
      <input type="submit" value="Add to Cart" class="btn" name="add_to_cart">
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">No products added yet!</p>';
   }
   ?>

   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>

<?php include 'components/footer.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".home-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
    },
   autoplay: {
      delay: 3000,
      disableOnInteraction: false,
   },
   effect: 'fade', 
   fadeEffect: {
      crossFade: true
   }
});

 var swiper = new Swiper(".category-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: { slidesPerView: 2 },
      650: { slidesPerView: 3 },
      768: { slidesPerView: 4 },
      1024: { slidesPerView: 5 },
   },
   autoplay: {
      delay: 3500,
      disableOnInteraction: false,
   },
   effect: 'coverflow', 
   coverflowEffect: {
      rotate: 50,
      stretch: 0,
      depth: 100,
      modifier: 1,
      slideShadows: true,
   }
});

var swiper = new Swiper(".products-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      550: { slidesPerView: 2 },
      768: { slidesPerView: 2 },
      1024: { slidesPerView: 3 },
   },
   autoplay: {
      delay: 3000,
      disableOnInteraction: false,
   },
   effect: 'slide', 
});

</script>

</body>
</html>
