<?php    
    if (!$_SESSION['username']){
        header('location: ../home');   
    }

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
    <link rel="stylesheet" href="http://localhost/boutique2/webfiles/Css/warning.css">
    <title>Accueil</title>
</head>
<body>
    <header>
        <button class="profile-btn"><a href="h"><img src = 'http://localhost/boutique2/webfiles/img/user/user.png' width="40px" height="40px"><span class="tooltip-text">Mon profil</span></a></button>
        <button class="cart-btn"><a href="<?php $cartId = $cartManager->getCartIdbyUserId($_SESSION['id']); if ($cartId === null) { echo 'http://localhost/boutique2/user/wc'; } else { echo 'http://localhost/boutique2/user/c/' . $cartId; } ?>"><img src = 'http://localhost/boutique2/webfiles/img/user/shopping-cart.png' width="40px" height="40px"><span class="tooltip-text">Mon panier</span><span class="round-btn" id="round-btn"></span><span class="item-count" id="item-count">0</span></a></button>
        <button class="shop-btn"><a href="http://localhost/boutique2/user/s"><img src = 'http://localhost/boutique2/webfiles/img/user/shop.png' width="40px" height="40px"><span class="tooltip-text">Boutique</span></a></button>
        <button class="clock-btn"><a href="h"><img src = 'http://localhost/boutique2/webfiles/img/user/time.png' width="40px" height="40px"><span class="tooltip-text">Mon historique</span></a></button>
        <button class="logout-btn"><a href="http://localhost/boutique2/user/lo"><img src = 'http://localhost/boutique2/webfiles/img/user/power-on.png' width="40px" height="40px"><span class="tooltip-text">Me déconnecter</span></a></button>
    </header>
<button class="display-return"><a href="http://localhost/boutique2/user/s">Retour</a></button>
    <div class="warning-msg">
        <p>Pour accéder à votre panier. Veuillez ajouter des produits via la boutique</p>
    </div>
</body>
