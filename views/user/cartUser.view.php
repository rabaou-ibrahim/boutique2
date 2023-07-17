<?php    
    if (!$_SESSION['username']){
        header('location: ../home');   
    }
    // require_once "./models/User/UserManager.php";
    // $userManager = new UserManager;
    // $userManager->loadUsers();

    require_once "./models/Product/ProductManager.php";
    $productManager = new ProductManager;
    $productManager->loadProducts();

    require_once "./models/Cart/CartManager.php";
    $cartManager = new CartManager;
    $cartManager->loadCarts();

    require_once "./models/CartItems/CartItemsManager.php";
    $cartItemsManager = new CartItemsManager;
    $cartItemsManager->loadCartItems();

    require_once "./controllers/CartsController.php";
    $cartController = new CartsController;
    $userCartData = $cartController->getUserCartData();

    if ($userCartData) {
        $userCart = $userCartData['userCart'];
        $products = $userCartData['products'];
    } 
    else {
        echo ('Pas de produit ajouté');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/boutique2/webfiles/Css/cart.css">
    <title>Boutique</title> 
</head>
<body>
    <header>
        <button class="profile-btn"><a href="h"><img src = 'http://localhost/boutique2/webfiles/img/user/user.png' width="40px" height="40px"><span class="tooltip-text">Mon profil</span></a></button>
        <button class="cart-btn"><a href=""><img src = 'http://localhost/boutique2/webfiles/img/user/shopping-cart.png' width="40px" height="40px"><span class="tooltip-text">Mon panier</span><span class="round-btn" id="round-btn"></span><span class="item-count" id="item-count">0</span></a></button>
        <button class="shop-btn"><a href="http://localhost/boutique2/user/s"><img src = 'http://localhost/boutique2/webfiles/img/user/shop.png' width="40px" height="40px"><span class="tooltip-text">Boutique</span></a></button>
        <button class="clock-btn"><a href="h"><img src = 'http://localhost/boutique2/webfiles/img/user/time.png' width="40px" height="40px"><span class="tooltip-text">Mon historique</span></a></button>
        <button class="logout-btn"><a href="http://localhost/boutique2/user/lo"><img src = 'http://localhost/boutique2/webfiles/img/user/power-on.png' width="40px" height="40px"><span class="tooltip-text">Me déconnecter</span></a></button>
    </header>
    <button class="display-return"><a href="<?= URL ?>user/s">Retour</a></button>

    <div class="cart-container">
        <h2>Mon panier</h2>
        <?php foreach ($products as $index => $product) : ?>
            <div class="product">
                <h3><?= $product['name']; ?></h3>
                <div class="product-content">
                    <div class="product-image">
                        <img src="http://localhost/boutique2/webfiles/img/shop/<?= $product['image']; ?>" width="100px" height="100px" alt="Product Image">
                    </div>
                    <div class="product-details">
                        <div class="product-info">
                            <h3>Quantité </h3> <p><?= $product['quantity']; ?></p>
                            <h3>Total </h3> <p><?= $product['price']; ?>€</p>
                        </div>
                        <div class="product-actions">
                            <button class="delete-btn">Supprimer</button>
                            <button class="buy-btn">Acheter</button>
                        </div>
                    </div>
                </div>
                <hr>
            </div>
        <?php endforeach; ?>
        <div class="cart-actions">
            <button class="delete-all-btn">Tout supprimer</button>
        </div>
    </div>



    <script src="/boutique2/Js/user/cart.js"></script>
</body>