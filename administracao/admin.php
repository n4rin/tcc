<?php
@include 'config.php';

if (isset($_POST['add_product'])) {
    $p_name = $_POST['p_name'];
    $p_price = $_POST['p_price'];
    $p_image = $_FILES['p_image']['name'];
    $p_image_tmp_name = $_FILES['p_image']['tmp_name'];
    $p_image_folder = 'uploaded_img/' . $p_image;

    $insert_query = $conn->prepare("INSERT INTO `products`(name, price, image) VALUES(:name, :price, :image)");
    $insert_query->bindParam(':name', $p_name);
    $insert_query->bindParam(':price', $p_price);
    $insert_query->bindParam(':image', $p_image);

    if ($insert_query->execute()) {
        move_uploaded_file($p_image_tmp_name, $p_image_folder);
        $message[] = 'product added successfully';
    } else {
        $message[] = 'could not add the product';
    }
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];

    $delete_query = $conn->prepare("DELETE FROM `products` WHERE id = :id");
    $delete_query->bindParam(':id', $delete_id);

    if ($delete_query->execute()) {
        header('location:admin.php');
        $message[] = 'product has been deleted';
    } else {
        header('location:admin.php');
        $message[] = 'product could not be deleted';
    }
}

if (isset($_POST['update_product'])) {
    $update_p_id = $_POST['update_p_id'];
    $update_p_name = $_POST['update_p_name'];
    $update_p_price = $_POST['update_p_price'];
    $update_p_image = $_FILES['update_p_image']['name'];
    $update_p_image_tmp_name = $_FILES['update_p_image']['tmp_name'];
    $update_p_image_folder = 'uploaded_img/' . $update_p_image;

    $update_query = $conn->prepare("UPDATE `products` SET name = :name, price = :price, image = :image WHERE id = :id");
    $update_query->bindParam(':name', $update_p_name);
    $update_query->bindParam(':price', $update_p_price);
    $update_query->bindParam(':image', $update_p_image);
    $update_query->bindParam(':id', $update_p_id);

    if ($update_query->execute()) {
        move_uploaded_file($update_p_image_tmp_name, $update_p_image_folder);
        $message[] = 'product updated successfully';
        header('location:admin.php');
    } else {
        $message[] = 'product could not be updated';
        header('location:admin.php');
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin panel</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php

if (isset($message)) {
   foreach ($message as $msg) {
       echo '<div class="message"><span>' . $msg . '</span> <i class="fas fa-times" onclick="this.parentElement.style.display = `none`;"></i> </div>';
   }
}

?>

<?php include 'header.php'; ?>

<div class="container">

    <section>

        <form action="" method="post" class="add-product-form" enctype="multipart/form-data">
            <h3>add novo produto</h3>
            <input type="text" name="p_name" placeholder="nome do produto" class="box" required>
            <input type="number" name="p_price" min="0" placeholder="preço do produto" class="box" required>
            <input type="file" name="p_image" accept="image/png, image/jpg, image/jpeg" class="box" required>
            <input type="submit" value="salvar" name="add_product" class="btn">
        </form>

    </section>

    <section class="display-product-table">

        <table>

            <thead>
                <th>imagem do produto</th>
                <th>nome do produto</th>
                <th>preço do produto</th>
                <th>updates</th>
            </thead>

            <tbody>
                <?php
                $select_products = $conn->query("SELECT * FROM `products`");
                if ($select_products->rowCount() > 0) {
                    while ($row = $select_products->fetch(PDO::FETCH_ASSOC)) {
                ?>

                        <tr>
                            <td><img src="uploaded_img/<?php echo $row['image']; ?>" height="100" alt=""></td>
                            <td><?php echo $row['name']; ?></td>
                            <td>$<?php echo $row['price']; ?>/-</td>
                            <td>
                                <a href="admin.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('are your sure you want to delete this?');"> <i class="fas fa-trash"></i> delete </a>
                                <a href="admin.php?edit=<?php echo $row['id']; ?>" class="option-btn"> <i class="fas fa-edit"></i> update </a>
                            </td>
                        </tr>

                <?php
                    }
                } else {
                    echo "<div class='empty'>no product added</div>";
                }
                ?>
            </tbody>
        </table>

    </section>

    <section class="edit-form-container">

        <?php
        if (isset($_GET['edit'])) {
            $edit_id = $_GET['edit'];
            $edit_query = $conn->prepare("SELECT * FROM `products` WHERE id = :id");
            $edit_query->bindParam(':id', $edit_id);
            $edit_query->execute();

            if ($edit_query->rowCount() > 0) {
                $fetch_edit = $edit_query->fetch(PDO::FETCH_ASSOC);
        ?>

                <form action="" method="post" enctype="multipart/form-data">
                    <img src="uploaded_img/<?php echo $fetch_edit['image']; ?>" height="200" alt="">
                    <input type="hidden" name="update_p_id" value="<?php echo $fetch_edit['id']; ?>">
                    <input type="text" class="box" required name="update_p_name" value="<?php echo $fetch_edit['name']; ?>">
                    <input type="number" min="0" class="box" required name="update_p_price" value="<?php echo $fetch_edit['price']; ?>">
                    <input type="file" class="box" required name="update_p_image" accept="image/png, image/jpg, image/jpeg">
                    <input type="submit" value="update the product" name="update_product" class="btn">
                    <input type="reset" value="cancel" id="close-edit" class="option-btn">
                </form>

        <?php
            }
            echo "<script>document.querySelector('.edit-form-container').style display = 'flex';</script>";
        }
        ?>

    </section>

</div>















<!-- custom js file link  -->
<script src="js/script.js"></script>

</body>
</html>