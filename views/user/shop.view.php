<?php  
    if (!$_SESSION['username']){
        header('location: ../home');   
    }
    require_once "./models/User/UserManager.php";
    $userManager = new UserManager;
    $userManager->loadUsers();

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
    <link rel="stylesheet" href="http://localhost/boutique2/webfiles/Css/shop.css">
    <title>Accueil</title>
</head>
<body>
    <header>
        <button class="profile-btn"><a href="http://localhost/boutique2/user/p/<?= $_SESSION['id'] ?>"><img src = 'http://localhost/boutique2/webfiles/img/user/user.png' width="40px" height="40px"><span class="tooltip-text">Mon profil</span></a></button>
        <button class="cart-btn"><a href="<?php $cartId = $cartManager->getCartIdbyUserId($_SESSION['id']); if ($cartId === null) { echo 'http://localhost/boutique2/user/wc'; } else { echo 'http://localhost/boutique2/user/c/' . $cartId; } ?>"><img src = 'http://localhost/boutique2/webfiles/img/user/shopping-cart.png' width="40px" height="40px"><span class="tooltip-text">Mon panier</span><span class="round-btn" id="round-btn"></span><span class="item-count" id="item-count">0</span></a></button>
        <button class="shop-btn"><a href="http://localhost/boutique2/user/s"><img src = 'http://localhost/boutique2/webfiles/img/user/shop.png' width="40px" height="40px"><span class="tooltip-text">Boutique</span></a></button>
        <button class="clock-btn"><a href="h"><img src = 'http://localhost/boutique2/webfiles/img/user/time.png' width="40px" height="40px"><span class="tooltip-text">Mon historique</span></a></button>
        <button class="logout-btn"><a href="http://localhost/boutique2/user/lo"><img src = 'http://localhost/boutique2/webfiles/img/user/power-on.png' width="40px" height="40px"><span class="tooltip-text">Me déconnecter</span></a></button>
    </header>
    <div class="container">

    <section id="section">
        <div class="bar" id="bar">
            <input type="text" id="search-input" placeholder="Rechercher un produit..." autocomplete="off">
            <input id="search-button" type="image" src="http://localhost/boutique2/webfiles/img/user/search.png" width="40px" height="40px">
        </div>
        <div class="autocompletion-msg" id="autocompletion-msg"></div>
            <?php 
                $products = $productManager->getProducts();
                for ($i = 0; $i < count($products); $i++) : 
            ?>
            <table class="table" id="product-table">
                <tr class="table-content">
                    <td>
                        <div class="tooltip">
                            <img src="http://localhost/boutique2/webfiles/img/shop/<?= $products[$i]->getImage() ?>" width="150px">
                            <span class="tooltip-text">
                                <strong class="product-name">Nom:</strong> <?= $products[$i]->getName() ?><br>
                                <strong class="product-description">Description:</strong> <?= $products[$i]->getDescription() ?><br>
                                <strong class="product-price">Prix:</strong> <?= $products[$i]->getPrice() ?>€
                            </span>
                        </div>
                    </td>
                    <td><p><?= $products[$i]->getName() ?></p></td>
                    <td><a href="<?= URL ?>user/v/<?= $products[$i]->getId() ?>"><button class="view-btn">Voir</button></a></td> 
                    <td>
                        <form action="<?= URL ?>user/ac/" method="POST">
                            <input type="number" name="quantity" class="quantity-input" value="1" min="1">
                            <input type="hidden" name="productId" value="<?php echo $products[$i]->getId(); ?>">
                            <input type="hidden" name="price" value="<?php echo $products[$i]->getPrice(); ?>">
                            <button class="bookmark-btn" id="bookmark-btn">Ajouter</button>
                        </form>
                    </td>
                </tr>
            </table>
        <?php endfor; ?>
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
    <!-- Include your shop.js script -->
    <script src="/boutique2/Js/user/shop.js"></script>
</body>
</html>