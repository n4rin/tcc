<?php
// Inclua o arquivo de configuração do PDO
@include 'config.php';

if (isset($_POST['update_update_btn'])) {
    $update_value = $_POST['update_quantity'];
    $update_id = $_POST['update_quantity_id'];
    $update_quantity_query = $conn->prepare("UPDATE `cart` SET quantity = :update_value WHERE id = :update_id");
    $update_quantity_query->bindParam(':update_value', $update_value);
    $update_quantity_query->bindParam(':update_id', $update_id);
    if ($update_quantity_query->execute()) {
        header('location:cart.php');
    }
}

if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    $remove_query = $conn->prepare("DELETE FROM `cart` WHERE id = :remove_id");
    $remove_query->bindParam(':remove_id', $remove_id);
    if ($remove_query->execute()) {
        header('location:cart.php');
    }
}

if (isset($_GET['delete_all'])) {
    $delete_all_query = $conn->query("DELETE FROM `cart`");
    if ($delete_all_query) {
        header('location:cart.php');
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
   <title>Carrinho</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body style="background: rgb(0, 0, 0);
    background: radial-gradient(circle, rgba(0, 0, 0, 1) 0%, rgba(0, 62, 28, 1) 0%, rgba(0, 0, 0, 1) 100%);">
<div class="container">

<section class="shopping-cart">

   <h1 class="heading">Seu Carrinho</h1>

   <table>

      <thead>
         <th>Imagem</th>
         <th>Nome</th>
         <th>Preço</th>
         <th>Quantidade</th>
         <th>Preço Total</th>
         <th>Atualizar</th>
      </thead>

      <tbody>

         <?php 

         $select_cart = $conn->query("SELECT * FROM `cart`");
         $grand_total = 0;
         if ($select_cart->rowCount() > 0) {
            while ($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)) {
         ?>

         <tr>
            <td><img src="../upload/<?php echo $fetch_cart['imagem']; ?>" height="100" alt=""></td>
            <td><?php echo $fetch_cart['name']; ?></td>
            <td>$<?php echo number_format($fetch_cart['price']); ?>/-</td>
            <td>
               <form action="" method="post">
                  <input type="hidden" name="update_quantity_id"  value="<?php echo $fetch_cart['id']; ?>" >
                  <input type="number" name="update_quantity" min="1"  value="<?php echo $fetch_cart['quantity']; ?>" style="background-color: transparent; color: white;">
                  <input type="submit" value="atualizar" name="update_update_btn">
               </form>   
            </td>
            <td>$<?php echo $sub_total = number_format($fetch_cart['price'] * $fetch_cart['quantity']); ?>/-</td>
            <td><a href="cart.php?remove=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('deseja remover o item do carrinho?')" class="delete-btn"> <i class="fas fa-trash"></i> remove</a></td>
         </tr>
         <?php
           $grand_total += $sub_total;  
            };
         }
         ?>
         <tr class="table-bottom">
            <td><a href="../Pagina/index.php" class="option-btn" style="margin-top: 0;">continue comprando</a></td>
            <td colspan="3">valor total</td>
            <td>$<?php echo $grand_total; ?>/-</td>
            <td><a href="cart.php?delete_all" onclick="return confirm('tem certeza que deseja deletar todos os produtos?');" class="delete-btn"> <i class="fas fa-trash"></i>deletar tudo</a></td>
         </tr>

      </tbody>

   </table>

   <div class="checkout-btn">
      <a href="checkout.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">finalizar compra</a>
   </div>

</section>

</div>
   
<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>
