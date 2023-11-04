<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="icon" type="image/x-icon" href="../imagem/logo.PNG">
    <link rel="stylesheet" href="produto.css">
    <link rel="stylesheet" href="../Pagina/style.css">
    <title>LivaTy - Chá Matte Leão</title>
</head>

<body style="background-color: #f7f3f2; color: #27211E;">
    <!--Inicio NavBar-->
    <?php include 'navbar2.php'; ?>


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
            </section>
            <div style="width: 35px; height: 671.19px;"></div>
            <section class="secaoProdutos" style="width: 355px; height: 671.19px;">
                <div style="width: 355px; height: 243.19px;">
                    <div style="margin: auto; height: 50px;">
                        <h4>Chá Matte Leão - 250g</h4>
                    </div>
                    <div style="height: 40px;">
                        <h5>R$: 12,90</h5>
                    </div>
                    <div style=" height: 40px;">
                        <div>
                            <p>Quantidade:</p>
                            <input type="number" max="100" min="1"
                                style="width: 80px; height: 40px; background-color: transparent; color: white; text-align: center; border-radius: 2px; border-color: grey;">
                        </div>
                        <div style="height: 20px;"></div>
                        <div>
                            <button class="btn-produtc"><a href="../Pagina/telaCarrinho.html">Adicionar ao Carrinho</a></button>
                        </div><br>
                        <h5>Descrição do produto. ex.: quantas gramas, quantas unidades, especificações especiais,etc.</h5>
                    </div>

                </div>
            </section>
        </div>

    </div><br>

    <!--Footer-->
    <?php include 'footer2.php'; ?>

    <script src="../Pagina/styles.js"></script>
    <script src="../Pagina/carrinho.js"></script>
</body>

</html>