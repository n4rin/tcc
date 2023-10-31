<header class="header">

   <div class="flex">

      <a href="#" class="logo">Administração</a>

      <nav class="navbar">
         <a href="admin.php">add produtos</a>
         <a href="products.php">ver produtos</a>
      </nav>

      <?php
      $select_rows = $conn->query("SELECT * FROM `cart`");
      if ($select_rows) {
         $row_count = $select_rows->rowCount();
      } else {
         die('query failed');
      }
      ?>


      <a href="cart.php" class="cart">carrinho <span><?php echo $row_count; ?></span> </a>

      <div id="menu-btn" class="fas fa-bars"></div>

   </div>

</header>