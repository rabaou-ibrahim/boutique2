<?php
    require_once "./models/Product/ProductManager.php";
    $productManager = new ProductManager;
    $productManager->loadProducts();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/boutique2/webfiles/Css/index.css">
    <title>Accueil</title>
</head>
<body>
    <header>
        <button class="header-btn"><a href="user/r">Inscription</a></button>
        <button class="header-btn"><a href="user/l">Connexion</a></button>
        <button class="header-btn"><a href="admin/l">Admin</a></button>
    </header>
    <div class="container">

        <section>
            <div class="items">
                <h3 class="items-number-shirt">T-shirts <?= $productManager->loadOccurences("T-shirt"); ?> </h3>
                <h3 class="items-number-jean">Jeans <?= $productManager->loadOccurences("Jean"); ?> </h3>
                <h3 class="items-number-veste">Vestes <?= $productManager->loadOccurences("Veste"); ?> </h3>
            </div>
            <div class="bar">
                <input type="text" placeholder="Recherche...">
            </div>
            <?php 
            $products = $productManager->getProducts();
            for($i=0; $i < count($products); $i++) : ?>
            <table class="table">
                <tr class="table-content">
                    <div class="table-content-text">
                    <td><img src = 'http://localhost/boutique2/webfiles/img/shop/<?= $products[$i]->getImage() ?>' width="80px"></td>
                    <td><?= $products[$i]->getName() ?></td>
                    <td><?= $products[$i]->getPrice() ?>€</td>
                    </div>
                    <div class="table-options">
                        <td><a href="<?= URL ?>user/v/<?= $products[$i]->getId() ?>"><button class="view-btn">Détails</button></td></a>
                    </div>
                </tr>
                <?php endfor; ?>
            </table>
        </section>
    </div>

    <footer>
        <ul>
            <li>contacts</li>
            <li>service client</li>
            <li>newsletter</li>
            <li>résaux</li>
        </ul>
    </footer>

</body>
</html>