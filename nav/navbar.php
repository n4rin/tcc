<header class="header">
    <a href="index.php" class="logo"><img src="../imagem/logo.PNG" alt=""></a>
    <nav class="navbar">
        <a href="../Pagina/cafes.php">Cafés</a>
        <a href="../Pagina/chas.php">Chás</a>
        <a href="../Pagina/incensos.php">Incensos</a>

    </nav>
    <nav class="navbar2">
        <form method="post" action="search.php">
            <input type="text" name="query" placeholder="Pesquisar" style="background-color: transparent; color: white; border-color: white; border-radius: 15px; padding: 5px;">
            <input type="submit" value="Pesquisar">

            <?php
            @include '../administracao/config.php';
      $select_rows = $conn->query("SELECT * FROM `cart`");
      if ($select_rows) {
         $row_count = $select_rows->rowCount();
      } else {
         die('query failed');
      }
      ?>
            <a href="../administracao/cart.php" class=" shopping"><i class='bx bx-cart shopping'></i><span><?php echo $row_count; ?></span></a>
            <a href="<?php echo isset($_SESSION['email']) ? 'perfil.php' : '#'; ?>" class="btn-user"><i
                    class='bx bxs-user-circle'></i></a>
        </form>
        <?php
            if (isset($_SESSION['email'])) {
                // O usuário está logado, exibir o ícone/botão de logout
                echo '<a href="logout.php" class="logout-link" style="font-size: 1.9rem;"><i class="bx bx-log-out-circle"> Sair</i></a>';
            } else {
            }
            ?>

        <!-- (boxicons) precisa terminar - realizar logout -->
        <!--<a href="logout.php" class="logout-link" style="font-size: 1.9rem;"><i class='bx bx-log-out-circle'> Sair</i></a>-->

        <script>
            document.querySelector('.logout-link').addEventListener('click', function (event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Tem certeza?',
                    text: "Você será desconectado do site!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim, quero sair!',
                    //background: '#1AD162'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = 'logout.php';
                    }
                })
            });
        </script>

</header>