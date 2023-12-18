<?php

require_once "./models/Product/ProductManager.php";

class ProductsController {
    private $productManager;
    public function __construct(){
        $this->productManager = new ProductManager;
        $this->productManager->loadProducts();
    }
    public function displayProducts(){
        require "views/user/products.view.php";
    }
    public function displayLogin(){
        require "views/user/login.view.php";
    }

    public function getAllProductsJson(){
        $myProducts = $this->productManager->getProducts();

        header('Content-Type: application/json');
        echo json_encode($myProducts);
    }

    public function getUserProductsJson(){
        $myProducts = $this->productManager->getProductsByUserId($_SESSION['id_user']);

        header('Content-Type: application/json');
        echo json_encode($myProducts);
    }
    public function verifyAddProductFields($title, $description){
        $products = $this->productManager->getProducts();

        $productTitles = [];
        $productDescriptions = [];

        $isTitleTaken = false;
        $isDescriptionTaken = false;

        if (!empty($products)) {

            foreach ($products as $product) {
                $productTitles[] = $product->getTitle();
                $productDescriptions[] = $product->getDescription();
            }
        
            foreach ($productTitles as $existingProductTitle) {
                if ($existingProductTitle === $title) {
                    $isTitleTaken = true;
                    break;
                }
            }
        
            foreach ($productDescriptions as $existingProductDescription) {
                if ($existingProductDescription === $description) {
                    $isDescriptionTaken = true;
                    break;
                }
            }
        }
    
        $AddMsg = '';
    
        if (!$isTitleTaken && !$isDescriptionTaken) {
            $AddMsg = "<p style='color:green'> Ajout effectué ! </p>";
        } elseif ($isTitleTaken) {
            $AddMsg = "Titre déjà pris";
        } elseif ($isDescriptionTaken) {
            $AddMsg = "Description déjà prise";
        }
    
        $responseData = [
            'success' => !$isTitleTaken && !$isDescriptionTaken,
            'message' => $AddMsg
        ];
    
        return $responseData;
    }
    public function AddProductValidation(){
        $response = $this->verifyAddProductFields(htmlspecialchars($_POST["title"]), htmlspecialchars($_POST["description"]));

        if ($response['success']) {
            $this->productManager->addProductDb(htmlspecialchars($_POST["title"]), htmlspecialchars($_POST["description"]), $_SESSION['id_user']);

            $responseData = [
                'success' => true,
                'message' => "Ajout effectué !",
                'product_title' => $_POST["title"],
                'product_description' => $_POST["description"],
            ];
        } else {
            $responseData = [
                'success' => false,
                'message' => $response['message']
            ];
        }
        header('Content-Type: application/json');
        echo json_encode($responseData);
    }

    public function deleteProduct($id){
        $this->productManager->deleteProductDb($id);

        header('Location: '.URL.'user/p');
    }

}

?>