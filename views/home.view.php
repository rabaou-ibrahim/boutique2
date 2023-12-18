<?php
    require_once "./models/Product/ProductManager.php";
    $productManager = new ProductManager;
    $productManager->loadProducts();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@200&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./webfiles/Css/index.css">
</head>

<body>
    <nav>
        <input type="checkbox" id="nav-toggle">
        <div class="logo">SHOP</div>
            <ul class="links">
                <li><a href="<?= URL ?>admin/l">Admin</a></li>
                <li><a href="<?= URL ?>user/r">Inscription</a></li>
                <li><a href="<?= URL ?>user/l">Connexion</a></li>
                <li><a href="#footer">Contact</a></li>
            </ul>
            <label for="nav-toggle" class="icon-burger">
                <div class="line"></div>
                <div class="line"></div>
                <div class="line"></div>
            </label>
    </nav>

    <label for="nav-toggle" class="icon-burger">
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
    </label>

    <div class="container">
        <h2 class="container-title">Nos produits</h2>
        <div class="container-card" id="container-card">
            <!-- <div class="card">
                <div class="imgBx">
                    <img src="webfiles/img/shop/n6.png" alt="n6">
                </div>

                <div class="contentBx">

                    <h2>Nom du produit</h2>

                    <div class="price">
                        <h3>Prix :</h3>
                    </div>

                    <a href="#">Buy Now</a>
                </div>
            </div> -->
        </div>
    </div>

</body>
<script src="/boutique2/Js/user/home.js"></script>
</html>