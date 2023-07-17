<?php  
    if (!$_SESSION['admin-username']){
        header('location: views/admin/warningAdmin.view.php'); 
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produit - Affichage</title>
    <link rel="stylesheet" href="http://localhost/boutique2/webfiles/Css/authentification.css">
</head>
<body>
<header>
    <button class="header-round-btn"><a href="<?= URL ?>admin">TECHNO</a></button>
    <button class="header-btn"><a href="">Inscription</a></button>
    <button class="header-btn"><a href="">Connexion</a></button>
    <button class="header-btn"><a href="<?= URL ?>admin">Accueil</a></button>
</header>
<button class="display-return"><a href="<?= URL ?>admin">Retour</a></button>
    <h3>Aperçu du produit</h3>
    
    <div class="view-div">
        <div class="view">
            <div class="display-product-img">
                <p><img src = 'http://localhost/boutique2/webfiles/img/shop/<?= $product->getImage() ?>' width="200px" height="200px"></p>
                <div class="display-product-desc">
                    <p>Catégorie : <?= $product->getDescription() ?></p>
                    <p>Prix : <?= $product->getPrice() ?>€</p>
                </div>
            </div>
            <div class="display-product">
                <h2><?= $product->getName() ?></h2>
            </div>
        </div>
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