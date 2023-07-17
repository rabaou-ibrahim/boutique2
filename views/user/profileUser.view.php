<?php    
    if (!$_SESSION['username']){
        header('location: ../home');   
    }
    require_once "../boutique2/controllers/ProductsController.php";
    $productController = new ProductsController;

    // require_once "../boutique2/controllers/PurchasesController.controller.php";
    // $purchaseController = new PurchasesController;

    require_once "./models/Product/ProductManager.php";
    $productManager = new ProductManager;
    $productManager->loadProducts();

    require_once "./models/Cart/CartManager.php";
    $cartManager = new CartManager;
    $cartManager->loadCarts();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/boutique2/webfiles/Css/profile.css">
    <title>Accueil</title>
</head>
<body>
    <header>
        <button class="profile-btn"><a href="http://localhost/boutique2/user/e/<?= $_SESSION['id'] ?>"><img src = 'http://localhost/boutique2/webfiles/img/user/user.png' width="40px" height="40px"><span class="tooltip-text">Mon profil</span></a></button>
        <button class="cart-btn"><a href="<?php $cartId = $cartManager->getCartIdbyUserId($_SESSION['id']); if ($cartId === null) { echo 'http://localhost/boutique2/user/wc'; } else { echo 'http://localhost/boutique2/user/c/' . $cartId; } ?>"><img src = 'http://localhost/boutique2/webfiles/img/user/shopping-cart.png' width="40px" height="40px"><span class="tooltip-text">Mon panier</span><span class="round-btn" id="round-btn"></span><span class="item-count" id="item-count">0</span></a></button>
        <button class="shop-btn"><a href="http://localhost/boutique2/user/s"><img src = 'http://localhost/boutique2/webfiles/img/user/shop.png' width="40px" height="40px"><span class="tooltip-text">Boutique</span></a></button>
        <button class="clock-btn"><a href="h"><img src = 'http://localhost/boutique2/webfiles/img/user/time.png' width="40px" height="40px"><span class="tooltip-text">Mon historique</span></a></button>
        <button class="logout-btn"><a href="http://localhost/boutique2/user/lo"><img src = 'http://localhost/boutique2/webfiles/img/user/power-on.png' width="40px" height="40px"><span class="tooltip-text">Me déconnecter</span></a></button>
    </header>

    <div class="welcome-msg">
        <h2>Bienvenue <?= $_SESSION['username'] ?></h2>
    </div>

    <div class="container">
        <div class="shop-block">
            <div class="image-preview">
                <?= $productController->getRandomImage(); ?>
            </div>
            <div class="text-articles">
                <h3>Découvrez ici nos derniers articles !</h3>
                <button class="btn-shop">Boutique</button>
            </div>
        </div>

        <div class="purchases-block">
            <h3>Achats</h3>
            <div class="text-purchases">
                <h3>Voir mes achats</h3>
                <br>
                <br>
                <button class="purchase-btn">Mes achats</button>
            </div>
        </div>
    </div>

    <div class="container2">
        <div class="cart-block">
            <div class="username">
               Salut <?= $_SESSION['username'] ?>
            </div>
            <div class="text">
                <p>Votre panier est disponible ici</p>
                <img src = 'http://localhost/boutique2/webfiles/img/user/shopping-cart.png' width="40px" height="40px"></a></button>
                <br>
                <br>
                <button class="shop-btn">Mon panier</button>
            </div>
        </div>

        <div class="purchases-block">
            <h3>Coordonnées</h3>
            <div class="text">
                <p>Modifier mon profil</p>
                <br>
                <button class="profile-btn">Mon profil</button>
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
    <script src="/boutique2/Js/user/cart.js"></script>
</body>
</html>