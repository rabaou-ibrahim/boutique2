<?php

require_once "./models/CartItems/CartItemsManager.php";
require_once "./models/User/UserManager.php";

class CartsItemsController{

    private $cartManager;
    private $cartItemsManager;
    private $userManager;
    private $userCartItems;

    public function __construct(){
        $this->cartManager = new CartManager;
        $this->cartManager->loadCarts();

        $this->cartItemsManager = new CartItemsManager;
        $this->cartItemsManager->loadCartItems();

        $this->userManager = new UserManager;
        $this->userManager->loadUsers();
    }

    public function addProductToCartItems() {

      $cart = $this->cartManager->getCartbyUserId($_SESSION['id']);

      if ((empty($cart))){
        $this->cartManager->registerCartDb($_SESSION['id']);
      }
    
      $cartId = $cart->getCartId();
      $productId = htmlspecialchars($_POST['productId']);
      $quantity = htmlspecialchars($_POST['quantity']);
      $price = htmlspecialchars($_POST['price']);

      $this->cartItemsManager->addItemToCart($cartId, $productId, $quantity, $price);

      $response = [
          'success' => true,
          'cartId' => $cart,
      ];

      header('Content-Type: application/json');
      echo json_encode($response);
    }

    public function loadUserCartItems() {
        $loggedInUser = $_SESSION['user'];
        $this->userCartItems = $this->cartItemsManager->getCartItemsByUserId($loggedInUser->getId());
        
        $roundBtnCount = count($this->userCartItems);
        echo "<script>updateItemCount($roundBtnCount);</script>";
    }

}