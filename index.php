<?php
session_start(); 
define("URL", str_replace("index.php","",(isset($_SERVER['HTTPS']) ? "https" : "http").
"://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

require_once "controllers/ProductsController.php";
require_once "controllers/UsersController.php";
require_once "controllers/AdminsController.php";
require_once "controllers/CartsController.php";
require_once "controllers/CartItemsController.php";
// require_once "controllers/PurchasesController.php";


$productController = new ProductsController;
$userController = new UsersController;
$adminController = new AdminsController;
$cartController = new CartsController;
$cartItemsController = new CartsItemsController;
// $purchaseController = new PurchasesController;

try{
    if(empty($_GET['page'])){
        require "views/home.view.php";
    }
        else {
            $url = explode("/", filter_var($_GET['page']), FILTER_SANITIZE_URL);
      
            switch($url[0]){
                case "home" : require "views/home.view.php";
                break;

                case "user";
                    if(empty($url[1])){
                        $userController->displayLogin();
                    } else if($url[1] === "l"){
                        $userController->displayLogin();                        
                    } else if($url[1] === "lv"){
                        $userController->logInValidation();
                    } else if($url[1] === "r"){
                        $userController->displayRegister();
                    } else if($url[1] === "rv"){
                        $userController->registerValidation();
                    } else if($url[1] === "e"){
                        $userController->displayEditUser($url[2]);
                    } else if($url[1] === "ev"){
                        $userController->editUserValidation();
                    } else if($url[1] === "v"){
                        $userController->displayProduct($url[2]);
                    } else if($url[1] === "c"){
                        $userController->displayCart($url[2]);
                    } else if($url[1] === "s"){
                        $userController->displayShop();
                    } else if($url[1] === "h"){
                        $userController->displayHistory($url[2]);
                    } else if($url[1] === "wc"){
                        $userController->displayCartWarning();
                    } else if($url[1] === "p"){
                        $userController->displayProfile();
                    } else if($url[1] === "gp"){
                        $productController->getAllProductsJson();
                    } else if($url[1] === "gc"){
                        $cartController->getUserCart();
                    } else if($url[1] === "ac"){
                        $cartItemsController->addProductToCartItems();
                    } else if($url[1] === "ap"){
                        $purchaseController->purchaseValidation();
                    } else if($url[1] === "sa"){
                        $userController->autoCompletionProducts();
                    } else if($url[1] === "lo"){
                        $userController->logOut();
                    }
                    else {
                        echo("La page n'existe pas");
                    }
                break;

                case "admin-home" : require "views/admin/products.view.php";
                break;

                case "admin";
                    if(empty($url[1])){
                        $productController->displayProducts();
                    } else if($url[1] === "v"){
                        $productController->displayProduct($url[2]);
                    } else if(($url[1]) === "vu"){
                        $adminController->displayAdminUsers();
                    } else if($url[1] === "v"){
                        $adminController->displayAdminUser($url[2]);
                    } else if($url[1] === "a"){
                        $productController->addProduct();
                    } else if($url[1] === "e"){
                        $productController->editProduct($url[2]);
                    } else if($url[1] === "d"){
                        $productController->deleteProduct($url[2]);
                    } else if($url[1] === "av"){
                       $productController->addProductValidation();
                    } else if($url[1] === "ev"){
                        $productController->editProductValidation();
                    } else if($url[1] === "r"){
                        $adminController->displayAdminRegister();
                    } else if($url[1] === "rv"){
                        $adminController->AdminRegisterValidation();
                    } else if($url[1] === "l"){
                        $adminController->displayAdminLogin();
                    } else if($url[1] === "lv"){
                        $adminController->AdminLogInValidation();
                    } else if($url[1] === "lo"){
                        $adminController->AdminLogOut();
                    } else if($url[1] === "w"){
                        $adminController->displayWarning();
                    } else {
                       echo("La page n'existe pas");
                    }
                break;
                default: echo("La page n'existe pas");
            }
        }
}  
catch(Exception $e){
    $e->getMessage();
}
    
?>