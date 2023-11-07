<header class="header">

   <div class="flex">

      <a href="#" class="logo">Administração</a>

      <nav class="navbar">

      </nav>

      <?php
      $select_rows = $conn->query("SELECT * FROM `cart`");
      if ($select_rows) {
         $row_count = $select_rows->rowCount();
      } else {
         die('query failed');
      }
      ?>


      <div id="menu-btn" class="fas fa-bars"></div>

   </div>

</header>