<?php

require_once "./models/Product/ProductManager.php";

class ProductsController{
    private $productManager;

    public function __construct(){
        $this->productManager = new ProductManager;
        $this->productManager->loadProducts();
    }

    public function displayProducts(){
        $products = $this->productManager->getProducts();
        require "views/admin/products.view.php";
    }

    public function displayProduct($id){
       $product = $this->productManager->getProductById($id);
        require "views/admin/displayProduct.view.php";
    }

    public function addProduct(){
        require "views/admin/addProduct.view.php";
    }
    public function addProductValidation(){

        $file = $_FILES['image'];
        $directory = 'webfiles/img/shop/';
        $response = $this->verifyProductFields($file, $directory, htmlspecialchars($_POST['name']));

        if ($response['success']) {
            $this->productManager->addProductDb($response, htmlspecialchars($_POST['name']), htmlspecialchars($_POST['description']), htmlspecialchars($_POST['price']));
            $responseData = [
                'success' => true,
                'message' => "Produit ajouté !"
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

    private function verifyProductFields($file, $dir, $name){
        
        $products = $this->productManager->getProducts();

        $productNames = [];

        $Error = false;
        $isProductNameTaken = false;

        foreach ($products as $product) {
            $productNames[] = $product->getName();
        }

        foreach ($productNames as $existingProductName) {
            if ($existingProductName === $name) {
                $isProductNameTaken = true;
                break;
            }
        }

        $AdminMsg = '';

        if(!isset($file['name']) || empty($file['name']))
        $AdminMsg = "Indiquez une image";

    if(!file_exists($dir)) mkdir($dir, 0777);

    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    $random = rand(0,99999);
    $target_file = $dir.$random."_".$file['name'];

    if(!getimagesize($file["tmp_name"]))
        $AdminMsg = "Le fichier n'est pas une image";
    if($extension !== "jpg" && $extension !== "jpeg" && $extension !== "png")
        $AdminMsg = "L'extension du fichier n'est pas reconnu";
    if(file_exists($target_file))
        $AdminMsg = "L'extension du fichier n'est pas reconnu";
    if($file['size'] > 500000)
        $AdminMsg = "Le fichier est trop gros";
    if(!move_uploaded_file($file["tmp_name"], $target_file))
        $AdminMsg = "l'ajout de l'image n'a pas fonctionné";
    else return ($random."_".$file['name']);

        if (!$isProductNameTaken && !$Error) {
            $AdminMsg = "<p style='color:green'> Produit ajouté </p>";
        }

        $responseData = [
            'success' => !$isProductNameTaken,
            'message' => $AdminMsg
        ];

        return $responseData;
    }

    
    public function getRandomImage(){
        $products = $this->productManager->getProducts();

        if (!empty($products)) {
            $randomProduct = $products[array_rand($products)];
            $randomImage = $randomProduct->getImage();

            echo '<img src="../webfiles/img/shop/' . $randomImage . '" width="100px" height="100px">';
        } else {
            echo 'Pas de produits en stock.';
        }
    }

    public function editProduct($id){
        $product = $this->productManager->getProductbyId($id);
        require "views/admin/editProduct.view.php";
    }
    public function editProductValidation(){
        $currentImage = $this->productManager->getProductById(htmlspecialchars($_POST["identifier"]))->getImage();
        $file = $_FILES['image'];

        if ($file > 0){
            unlink("webfiles/img/shop/".$currentImage);
            $directory = "webfiles/img/shop/";
            $imageToAddName = $this->verifyProductFields($file, $directory, htmlspecialchars($_POST['name']));
            $responseData = [
                'success' => true,
                'message' => "Produit modifié !"
            ];
        } else {
            $imageToAddName = $currentImage;
        }
        $this->productManager->editProductDb($_POST["identifier"], $imageToAddName, htmlspecialchars($_POST["name"]), htmlspecialchars($_POST["description"]), $_POST["price"]);

        header('Content-Type: application/json');
        echo json_encode($responseData);
    }

    public function deleteProduct($id){
        $response = $this->productManager->getProductbyId($id)->getImage();
        unlink("webfiles/img/shop/".$response);
        $this->productManager->deleteProductDb($id);
        
        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "Produit supprimé",
        ];
        
        header('Location: '.URL.'admin');
    }
}