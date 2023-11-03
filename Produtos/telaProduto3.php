<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="icon" type="image/x-icon" href="../imagem/logo.PNG">
    <link rel="stylesheet" href="produto.css">
    <link rel="stylesheet" href="../Pagina/style.css">
    <title>LivaTy - Chá de Capim Cidreira</title>
</head>

<body style="background-color: #f7f3f2; color: #27211E;">
    <!--Inicio NavBar-->
    <header class="header">
        <a href="../Pagina/index.php" class="logo"><img src="../imagem/logo.PNG" alt=""></a>
        <nav class="navbar">
            <a href="../Pagina/cafes.php">Cafés</a>
            <a href="../Pagina/chas.php">Chás</a>
            <a href="../Pagina/incensos.php">Incensos</a>

        </nav>
        <nav class="navbar2">
                    <a href="#"><i class='bx bx-search'></i></a>
                    <a href="# class="shopping"><i class='bx bx-cart shopping'></i><span class="quantity" style="left: 83%;">0</span></a>
                    <a href="<?php echo isset($_SESSION['email']) ? 'perfil.php' : '#'; ?>" class="btn-user"><i
                            class='bx bxs-user-circle'></i></a>
            
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
    <br>
    <div style="height: 90px;"></div>
    <div id="achubaba" class="container border border-secondary-subtle row"
        style="  display: flex; width: 980px; height: 722px; margin: auto; border-radius: 20px;"><br>
        <div id="achubaba" style="width: 890px; height: 671.19px; margin: auto;">
            <section style="left: 100%; width: 500px; height: 671.1px;">
                <div style="width: 500px; height: 500px;">
                    <img src="../imagem/3.webp" alt="cafe"
                        style="width: 500px; height: 500px; border-radius: 10px;">
                </div>
                <div style="width: 500px; height: 150px;"><br>
                    <h5>
                       Descrição do produto. ex.: quantas gramas, quantas unidades, especificações especiais,etc.
                    </h5>
                </div>
            </section>
            <div style="width: 35px; height: 671.19px;"></div>
            <section class="secaoProdutos" style="width: 355px; height: 671.19px;">
                <div style="width: 355px; height: 243.19px;">
                    <div style="margin: auto; height: 50px;">
                        <h4>Chá de Capim Cidreira - 10g</h4>
                    </div>
                    <div style="height: 40px;">
                        <h5>R$: 26,50</h5>
                    </div>
                    <div style=" height: 40px;">
                        <div>
                            <p>Quantidade</p>
                            <input type="number" max="100" min="1"
                                style="width: 80px; height: 40px; background-color: #f7f3f2; text-align: center; border-radius: 2px; border-color: #27211E;">
                        </div>
                        <div style="height: 20px;"></div>
                        <div>
                            <a href="../Pagina/telaCarrinho.html">
                                  <button class="btn fifth">
                                    <h5>Adicionar ao Carrinho</h5>
                            </button>
                            </a>
                          
                        </div>
                    </div>

                </div>

                <div>
                    <div class="accordion accordion-flush color-scheme: dark;" id="accordionFlushExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseOne" aria-expanded="false"
                                    aria-controls="flush-collapseOne">
                                    <h5>Detalhes do Produto</h5>
                                </button>
                            </h2>
                            <div id="flush-collapseOne" class="accordion-collapse collapse"
                                data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    Placeholder content for this accordion, which is intended to demonstrate the
                                    <code>.accordion-flush</code> class. This is the first item's accordion body.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                    aria-controls="flush-collapseTwo">
                                    <h5>Informações de Envio</h5>
                                </button>
                            </h2>
                            <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    Placeholder content for this accordion, which is intended to demonstrate the
                                    <code>.accordion-flush</code> class. This is the second item's accordion body. Let's
                                    imagine this being filled with some actual content.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#flush-collapseThree" aria-expanded="false"
                                    aria-controls="flush-collapseThree">
                                    <h5>Politica de Devolução e Reembolso</h5>
                                </button>
                            </h2>
                            <div id="flush-collapseThree" class="accordion-collapse collapse"
                                data-bs-parent="#accordionFlushExample">
                                <div class="accordion-body">
                                    Placeholder content for this accordion, which is intended to demonstrate the
                                    <code>.accordion-flush</code> class. This is the third item's accordion body.
                                    Nothing more exciting happening here in terms of content, but just filling up the
                                    space to make it look, at least at first glance, a bit more representative of how
                                    this would look in a real-world application.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

    </div><br>

    <!--Footer-->
    <footer>
        <div id="footer-content">
            <div id="footer-contacts">
                <h2>LIVATY</h2>
                <p>Nos siga nas redes sociais</p>

                <div id="footer-social-media">
                    <a href="#" class="footer-link" id="instagram"><i class='bx bxl-instagram'></i></a>
                    <a href="#" class="footer-link" id="facebook"><i class='bx bxl-facebook-square'></i></a>
                    <a href="#" class="footer-link" id="whatsapp"><i class='bx bxl-whatsapp'></i></a>
                </div>
            </div>

            <ul class="footer-list">
                <li>
                    <h3>Atendimento</h3>
                </li>
                <li><a href="#" class="footer-link">Formas de Pagamento</a></li>
                <li><a href="#" class="footer-link">Catálogo</a></li>
                <li><a href="#" class="footer-link">Institucional</a></li>
            </ul>

            <ul class="footer-list">
                <li>
                    <h3>Produtos</h3>
                </li>
                <li><a href="#" class="footer-link">Cafés</a></li>
                <li><a href="#" class="footer-link">Chás</a></li>
                <li><a href="#" class="footer-link">Incensos</a></li>
            </ul>

            <div id="footer-map">
                <h3>Nossa sede:</h3>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3684.4530145073554!2d-47.42621522712088!3d-22.562154025640524!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94c8806c2c324933%3A0xe2108428886c8646!2sCol%C3%A9gio%20T%C3%A9cnico%20de%20Limeira%20-%20Unicamp!5e0!3m2!1spt-BR!2sbr!4v1696366241972!5m2!1spt-BR!2sbr"
                    width="300" height="200" style="border-radius:15px;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
            <div id="footer-copyright">
                &#169
                2023 all rights reserved
            </div>

    </footer>

    <script src="../Pagina/styles.js"></script>
    <script src="../Pagina/carrinho.js"></script>
</body>

</html>