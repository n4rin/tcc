<?php
    // Inicie a sessão
    session_start();
    @include 'config.php';

    // Inclua o arquivo de conexão com o banco de dados
    require_once '../Login/conexaoBD.php';

    // Constante para o tamanho máximo do arquivo de imagem
    define('TAMANHO_MAXIMO', (2 * 1024 * 1024));

    // Verifique se o formulário foi enviado
    if ($_SERVER["REQUEST_METHOD"] === 'POST') {

        // Use suas funções de CRUD para verificar se o nome de usuário e a senha estão corretos

        $nome = $_POST['nome'];
        $preco = $_POST['preco'];
        $descricao = $_POST['descricao'];
        $quantidade = $_POST['quantidade'];
        $tag = $_POST['tag'];

        // Diretório de upload
        $uploaddir = '../upload/'; //diretório onde será gravado a imagem

        // Imagem
        $imagem = $_FILES['p_image'];
        $nomeImagem = $imagem['name'];
        $tipoImagem = $imagem['type'];
        $tamanhoImagem = $imagem['size'];

        // Gerando novo nome para a imagem para evitar sobrescrita
        $info = new SplFileInfo($nomeImagem);
        $extensaoArq = $info->getExtension();
        $novoNomeImagem = $nome . "." . $extensaoArq;

        try {
            if ((trim($nome) == "")) {
                echo "<span id='warning'>Nome é obrigatório!</span>";

            } else if ( ($nomeImagem != "") && (!preg_match('/^image\/(jpeg|png|gif)$/', $tipoImagem)) ) { //validção tipo arquivo
                echo "<span id='error'>Isso não é uma imagem válida</span>";

            } else if ( ($nomeImagem != "") && ($tamanhoImagem > TAMANHO_MAXIMO) ) { //validação tamanho arquivo
                echo "<span id='error'>A imagem deve possuir no máximo 2 MB</span>";

            } else {
                if (
                    ($nomeImagem != "") && 
                    (move_uploaded_file($_FILES['p_image']['tmp_name'], 
                                        $uploaddir . $novoNomeImagem)
                    )
                ) {
                    // caminho/nome da imagem p/ gravar no BD
                    $uploadfile = $uploaddir . $novoNomeImagem; 
                } else {
                    $uploadfile = null;
                    echo "Sem upload de imagem.";
                }

                $insert_query = $pdo->prepare("INSERT INTO `produto`(nome, precoVenda, descricao, quantidade, tag, imagem) VALUES(:nome, :preco, :descricao, :quantidade, :tag, :imagem)");
                $insert_query->bindParam(':nome', $nome);
                $insert_query->bindParam(':preco', $preco);
                $insert_query->bindParam(':descricao', $descricao);
                $insert_query->bindParam(':quantidade', $quantidade);
                $insert_query->bindParam(':tag', $tag);
                $insert_query->bindParam(':imagem', $uploadfile);

                if ($insert_query->execute()) {
                    echo "Produto adicionado com sucesso";
                } else {
                    echo "Não foi possível adicionar o produto";
                }
            }
        } catch(PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    if (isset($_GET['delete'])) {
        $delete_id = $_GET['delete'];
        $delete_query = $pdo->prepare("DELETE FROM `produto` WHERE id = :id");
        $delete_query->bindParam(':id', $delete_id);
        $delete_query->execute();
        header("Location: admin.php");
    }

    // Verifique se o produto está sendo atualizado
    if (isset($_POST['update_product'])) {
        $update_id = $_POST['update_p_id'];
        $update_nome = $_POST['update_p_name'];
        $update_preco = $_POST['update_p_price'];

        // Imagem
        $imagem = $_FILES['update_p_image'];
        $nomeImagem = $imagem['name'];
        $tipoImagem = $imagem['type'];
        $tamanhoImagem = $imagem['size'];

        // Gerando novo nome para a imagem para evitar sobrescrita
        $info = new SplFileInfo($nomeImagem);
        $extensaoArq = $info->getExtension();
        $novoNomeImagem = $update_nome . "." . $extensaoArq;

        // Diretório de upload
        $uploaddir = '../upload/'; //diretório onde será gravado a imagem

        if ($nomeImagem != "") {
            if (!preg_match('/^image\/(jpeg|png|gif)$/', $tipoImagem)) { //validção tipo arquivo
                echo "<span id='error'>Isso não é uma imagem válida</span>";
                return;
            } else if ($tamanhoImagem > TAMANHO_MAXIMO) { //validação tamanho arquivo
                echo "<span id='error'>A imagem deve possuir no máximo 2 MB</span>";
                return;
            } else if (move_uploaded_file($_FILES['update_p_image']['tmp_name'], $uploaddir . $novoNomeImagem)) {
                // caminho/nome da imagem p/ gravar no BD
                $uploadfile = $uploaddir . $novoNomeImagem; 
            } else {
                echo "Falha no upload de imagem.";
                return;
            }
        } else {
            // Se nenhuma nova imagem for fornecida, mantenha a imagem original
            $select_query = $pdo->prepare("SELECT imagem FROM `produto` WHERE id = :id");
            $select_query->bindParam(':id', $update_id);
            $select_query->execute();
            $row = $select_query->fetch(PDO::FETCH_ASSOC);
            $uploadfile = $row['imagem'];
        }

        $update_query = $pdo->prepare("UPDATE `produto` SET nome = :nome, precoVenda = :preco, imagem = :imagem WHERE id = :id");
        $update_query->bindParam(':nome', $update_nome);
        $update_query->bindParam(':preco', $update_preco);
        $update_query->bindParam(':imagem', $uploadfile);
        $update_query->bindParam(':id', $update_id);

        if ($update_query->execute()) {
            echo "Produto atualizado com sucesso";
        } else {
            echo "Não foi possível atualizar o produto";
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
            <h3>Adicionar novo produto</h3>
            <input type="text" name="nome" placeholder="nome do produto" class="box" required>
            <input type="number" name="preco" min="0" placeholder="preço do produto" class="box" required>
            <input type="text" name="descricao" min="0" placeholder="descrição" class="box" required>
            <input type="number" name="quantidade" placeholder="quantidade" class="box" required>
            <input type="text" name="tag" placeholder="tag" class="box">
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
        $select_products = $pdo->query("SELECT * FROM `produto`");
        if ($select_products->rowCount() > 0) {
            while ($row = $select_products->fetch(PDO::FETCH_ASSOC)) {
        ?>

                <tr>
                    <td><img src="uploaded_img/<?php echo $row['imagem']; ?>" height="100" alt=""></td>
                    <td><?php echo $row['nome']; ?></td>
                    <td>R$<?php echo $row['precoVenda']; ?>/-</td>
                    <td>
                        <a href="admin.php?delete=<?php echo $row['id']; ?>" class="delete-btn" onclick="return confirm('are your sure you want to delete this?');"> <i class="fas fa-trash"></i> Deletar </a>
                        <a href="admin.php?edit=<?php echo $row['id']; ?>" class="option-btn"> <i class="fas fa-edit"></i> Editar </a>
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