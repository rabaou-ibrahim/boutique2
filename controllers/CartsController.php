<?php

require_once "./models/User/UserManager.php";
require_once "./models/Product/ProductManager.php";
require_once "./controllers/UsersController.php";
class CartsController{
    private $cartManager;
    private $userManager;
    private $productManager;
    private $cartItemsManager;

    public function __construct(){
        $this->cartManager = new CartManager;
        $this->cartManager->loadCarts();

        $this->userManager = new UserManager;
        $this->userManager->loadUsers();

        $this->productManager = new ProductManager;
        $this->productManager->loadProducts();

        $this->cartItemsManager = new CartItemsManager;
        $this->cartItemsManager->loadCartItems();
    }

    public function getUserCart() {
        if (!empty($_SESSION['username'])) {
    
            $userCart = $this->cartManager->getCartByUserId($_SESSION['id']);
    
            $cartItems = $this->cartItemsManager->getCartItemsByCartId($userCart->getCartId());
            $products = [];
    
            foreach ($cartItems as $cartItem) {
                $product = $this->productManager->getProductById($cartItem->getProductId());
    
                if ($product) {
                    $productData = [
                        'productId' => $product->getId(),
                        'quantity' => $cartItem->getQuantity()
                    ];
    
                    $products[] = $productData;
                }
            }
    
            $responseData2 = [
                'userCart' => $userCart,
                'products' => $products
            ];
    
            header('Content-Type: application/json');
            echo json_encode($responseData2);
            exit();
        }
    }
    public function getUserCartData() {
        if (!empty($_SESSION['username'])) {
            $userCart = $this->cartManager->getCartByUserId($_SESSION['id']);
            $cartItems = $this->cartItemsManager->getCartItemsByCartId($userCart->getCartId());
            $products = [];
    
            foreach ($cartItems as $cartItem) {
                $product = $this->productManager->getProductById($cartItem->getProductId());
    
                if ($product) {
                    $productData = [
                        'productId' => $product->getId(),
                        'name' => $product->getName(),
                        'description' => $product->getDescription(),
                        'image' => $product->getImage(),
                        'price' => $product->getPrice()*$cartItem->getQuantity(),
                        'quantity' => $cartItem->getQuantity()
                    ];
    
                    $products[] = $productData;
                }
            }
    
            return [
                'userCart' => $userCart,
                'products' => $products
            ];
        }
    
        return null;
    }
}