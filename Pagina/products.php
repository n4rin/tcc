<?php
// Inclua o arquivo de configuração do PDO
@include 'config.php';

if (isset($_POST['add_to_cart'])) {

   $product_name = $_POST['product_name'];
   $product_price = $_POST['product_price'];
   $product_image = $_POST['product_image'];
   $product_quantity = 1;

   $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE name = :product_name");
   $select_cart->bindParam(':product_name', $product_name);
   $select_cart->execute();

   if ($select_cart->rowCount() > 0) {
      $message[] = 'product already added to cart';
   } else {
      $insert_product = $conn->prepare("INSERT INTO `cart`(name, price, image, quantity) VALUES(:product_name, :product_price, :product_image, :product_quantity)");
      $insert_product->bindParam(':product_name', $product_name);
      $insert_product->bindParam(':product_price', $product_price);
      $insert_product->bindParam(':product_image', $product_image);
      $insert_product->bindParam(':product_quantity', $product_quantity);
      if ($insert_product->execute()) {
         $message[] = 'product added to cart successfully';
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

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php

if(isset($message)){
   foreach($message as $message){
      echo '<div class="message"><span>'.$message.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   };
};

?>

<?php include 'header.php'; ?>

<div class="container">

<section class="products">

   <h1 class="heading">latest products</h1>

   <div class="box-container">

      <?php

      $select_produtos = $conn->query("SELECT * FROM `produtos`");
      if ($select_produtos->rowCount() > 0) {
         while ($fetch_produtos = $select_products->fetch(PDO::FETCH_ASSOC)) {
      ?>

      <form action="" method="post">
         <div class="box">
            <img src="uploaded_img/<?php echo $fetch_product['image']; ?>" alt="">
            <h3><?php echo $fetch_produtos['name']; ?></h3>
            <div class="price">$<?php echo $fetch_product['price']; ?>/-</div>
            <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
            <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
            <input type="submit" class="btn" value="add to cart" name="add_to_cart">
         </div>
      </form>

      <?php
         };
      };
      ?>

   </div>

</section>

</div>

<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
