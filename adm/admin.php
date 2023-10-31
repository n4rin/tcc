<?php

@include 'conexaoBD.php';

if(isset($_POST['add_product'])){
   $p_nome = $_POST['p_nome'];
   $p_precoVenda = $_POST['p_precoVenda'];
   $p_image = $_FILES['p_image']['nome'];
   $p_image_tmp_nome = $_FILES['p_image']['tmp_nome'];
   $p_image_folder = 'uploaded_img/'.$p_image;

   $stmt = $pdo->prepare("INSERT INTO `products`(nome, precoVenda, image) VALUES(:nome, :precoVenda, :image)");
   $stmt->execute([':nome' => $p_nome, ':precoVenda' => $p_precoVenda, ':image' => $p_image]);

   if($stmt){
      move_uploaded_file($p_image_tmp_nome, $p_image_folder);
      $message[] = 'product add succesfully';
   }else{
      $message[] = 'could not add the product';
   }
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   
   $stmt = $pdo->prepare("DELETE FROM `products` WHERE id = :id");
   $stmt->execute([':id' => $delete_id]);

   if($stmt){
      header('location:admin.php');
      $message[] = 'product has been deleted';
   }else{
      header('location:admin.php');
      $message[] = 'product could not be deleted';
   };
};

if(isset($_POST['update_product'])){
   $update_p_id = $_POST['update_p_id'];
   $update_p_nome = $_POST['update_p_nome'];
   $update_p_precoVenda = $_POST['update_p_precoVenda'];
   $update_p_image = $_FILES['update_p_image']['nome'];
   $update_p_image_tmp_nome = $_FILES['update_p_image']['tmp_nome'];
   $update_p_image_folder = 'uploaded_img/'.$update_p_image;

   $stmt = $pdo->prepare("UPDATE `products` SET nome = :nome, precoVenda = :precoVenda, image = :image WHERE id = :id");
   $stmt->execute([':nome' => $update_p_nome, ':precoVenda' => $update_p_precoVenda, ':image' => $update_p_image, ':id' =>  $update_p_id]);

   if($stmt){
      move_uploaded_file($update_p_image_tmp_nome, $update_p_image_folder);
      header('location:admin.php');
      $message[] = 'product updated succesfully';
      
   }else{
      header('location:admin.php');
      $message[] = 'product could not be updated';
      
   }

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta nome="viewport" content="width=device-width, initial-scale=1.0">
   <title>Administração</title>

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

<section>

<form action="" method="post" class="add-product-form" enctype="multipart/form-data">
   <h3>add novo produto</h3>
   <input type="text" nome="p_nome" placeholder="enter the product nome" class="box" required>
   <input type="number" nome="p_precoVenda" min="0" placeholder="enter the product precoVenda" class="box" required>
   <input type="file" nome="p_image" accept="image/png, image/jpg, image/jpeg" class="box" required>
   <input type="submit" value="add the product" nome="add_product" class="btn">
</form>

</section>

<section class="display-product-table">

   <table>

      <thead>
         <th>product image</th>
         <th>product nome</th>
         <th>product precoVenda</th>
         <th>action</th>
      </thead>

      <tbody>
         <?php
         
            $select_products = mysqli_query($conn, "SELECT * FROM `products`");
            if(mysqli_num_rows($select_products) > 0){
               while($row = mysqli_fetch_assoc($select_products)){
         ?>

         <tr>
            <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
            <td><?php echo $row['nome']; ?></td>
            <td>$<?php echo $row['precoVenda']; ?>/-</td>
            <td>
               <a href="admin.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('are your sure you want to delete this?');"> <i class="fas fa-trash"></i> delete </a>
               <a href="admin.php?edit=<?php echo $row['id']; ?>" class="option-btn"> <i class="fas fa-edit"></i> update </a>
            </td>
         </tr>

         <?php
            };    
            }else{
               echo "<div class='empty'>no product added</div>";
            };
         ?>
      </tbody>
   </table>

</section>

<section class="edit-form-container">

   <?php
   
   if(isset($_GET['edit'])){
      $edit_id = $_GET['edit'];
      $edit_query = mysqli_query($conn, "SELECT * FROM `products` WHERE id = $edit_id");
      if(mysqli_num_rows($edit_query) > 0){
         while($fetch_edit = mysqli_fetch_assoc($edit_query)){
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      <img src="uploaded_img/<?php echo $fetch_edit['image']; ?>" height="200" alt="">
      <input type="hidden" nome="update_p_id" value="<?php echo $fetch_edit['id']; ?>">
      <input type="text" class="box" required nome="update_p_nome" value="<?php echo $fetch_edit['nome']; ?>">
      <input type="number" min="0" class="box" required nome="update_p_precoVenda" value="<?php echo $fetch_edit['precoVenda']; ?>">
      <input type="file" class="box" required nome="update_p_image" accept="image/png, image/jpg, image/jpeg">
      <input type="submit" value="update the prodcut" nome="update_product" class="btn">
      <input type="reset" value="cancel" id="close-edit" class="option-btn">
   </form>

   <?php
            };
         };
         echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
      };
   ?>

</section>

</div>















<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>