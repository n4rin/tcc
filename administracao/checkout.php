<?php
// Inclua o arquivo de configuração do PDO
@include 'config.php';

if (isset($_POST['order_btn'])) {

   $name = $_POST['name'];
   $number = $_POST['number'];
   $email = $_POST['email'];
   $method = $_POST['method'];
   $flat = $_POST['flat'];
   $street = $_POST['street'];
   $city = $_POST['city'];
   $state = $_POST['state'];
   $country = $_POST['country'];
   $pin_code = $_POST['pin_code'];

   $cart_query = $conn->query("SELECT * FROM `cart`");
   $price_total = 0;

   $product_name = [];
   $total_product = '';
   
   if ($cart_query->rowCount() > 0) {
      while ($product_item = $cart_query->fetch(PDO::FETCH_ASSOC)) {
         $product_name[] = $product_item['name'] . ' (' . $product_item['quantity'] . ')';
         $product_price = number_format($product_item['price'] * $product_item['quantity']);
         $price_total += $product_price;
      }
      $total_product = implode(', ', $product_name);
   }

   $detail_query = $conn->prepare("INSERT INTO `order`(name, number, email, method, flat, street, city, state, country, pin_code, total_products, total_price) VALUES(:name, :number, :email, :method, :flat, :street, :city, :state, :country, :pin_code, :total_product, :price_total)");
   $detail_query->bindParam(':name', $name);
   $detail_query->bindParam(':number', $number);
   $detail_query->bindParam(':email', $email);
   $detail_query->bindParam(':method', $method);
   $detail_query->bindParam(':flat', $flat);
   $detail_query->bindParam(':street', $street);
   $detail_query->bindParam(':city', $city);
   $detail_query->bindParam(':state', $state);
   $detail_query->bindParam(':country', $country);
   $detail_query->bindParam(':pin_code', $pin_code);
   $detail_query->bindParam(':total_product', $total_product);
   $detail_query->bindParam(':price_total', $price_total);
   
   if ($detail_query->execute()) {
      echo "
      <div class='order-message-container'>
      <div class='message-container'>
         <h3>obrigado pela compra!</h3>
         <div class='order-detail'>
            <span>" . $total_product . "</span>
            <span class='total'> total : R$" . $price_total . " </span>
         </div>
         <div class='customer-details'>
            <p> seu nome : <span>" . $name . "</span> </p>
            <p> seu número telefônico : <span>" . $number . "</span> </p>
            <p> seu e-mail : <span>" . $email . "</span> </p>
            <p> seu endereço : <span>" . $flat . ", " . $street . ", " . $city . ", " . $state . ", " . $country . " - " . $pin_code . "</span> </p>
            <p> seu método de pagamento : <span>" . $method . "</span> </p>
         </div>
            <a href='../Pagina/index.php' class='btn'>continue comprando</a>
         </div>
      </div>
      ";
   }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" type="image/x-icon" href="../imagem/logo.PNG">
   <title>informações de envio</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body style="background: rgb(0, 0, 0);
    background: radial-gradient(circle, rgba(0, 0, 0, 1) 0%, rgba(0, 62, 28, 1) 0%, rgba(0, 0, 0, 1) 100%);">

<div class="container">

<section class="checkout-form">

   <h1 class="heading">Complete com suas informações</h1>

   <form action="" method="post">

   <div class="display-order">
      <?php
         $select_cart = $conn->query("SELECT * FROM `cart`");
         $total = 0;
         $grand_total = 0;
         if ($select_cart->rowCount() > 0) {
            while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
            $total_price = number_format($fetch_cart['price'] * $fetch_cart['quantity']);
            $grand_total = $total += $total_price;
      ?>
      <span><?= $fetch_cart['name']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
      <?php
         }
      } else {
         echo "<div class='display-order'><span>Itens da compra!</span></div>";
      }
      ?>
      <span class="grand-total"> Total : R$<?= $grand_total; ?></span>
   </div>

      <div class="flex">
         <div class="inputBox">
            <span>Nome</span>
            <input type="text" placeholder="digite seu nome" name="name" required>
         </div>
         <div class="inputBox">
            <span>Número Telefonico</span>
            <input type="text" placeholder="digite seu numero telefonico" name="number" required>
         </div>
         <div class="inputBox">
            <span>E-mail</span>
            <input type="email" placeholder="digite seu e-mail" name="email" required>
         </div>
         <div class="inputBox">
            <span>Método de Pagamento</span>
            <select name="method">
               <option value="boleto" selected>boleto</option>
               <option value="cartao de credito">cartão de crédito</option>
               <option value="pix">pix</option>
            </select>
         </div>
         <div class="inputBox">
            <span>Endereço</span>
            <input type="text" placeholder="rua, bairro.." name="flat" required>
         </div>
         <div class="inputBox">
            <span>Complemento</span>
            <input type="text" placeholder="prédio, apto.." name="street" required>
         </div>
         <div class="inputBox">
            <span>Cidade</span>
            <input type="text" placeholder="ex. campinas.. " name="city" required>
         </div>
         <div class="inputBox">
            <span>Estado</span>
            <input type="text" placeholder="ex. sp, mg, rj.." name="state" required>
         </div>
         <div class="inputBox">
            <span>País</span>
            <input type="text" placeholder="ex. brasil.." name="country" required>
         </div>
         <div class="inputBox">
            <span>Número da residencia</span>
            <input type="text" placeholder="ex. 123456" name="pin_code" required>
         </div>
      </div>
      <input type="submit" value="Finalizar" name="order_btn" class="btn">
   </form>

</section>

</div>

<!-- custom js file link  -->
<script src="js/script.js"></script>
   
</body>
</html>
