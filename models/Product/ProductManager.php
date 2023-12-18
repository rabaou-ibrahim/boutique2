<?php 

require_once "./models/Model.php";
require_once "Product.php";

class ProductManager extends Model{
    private ?array $products;

    public function addProduct($product){
        $this->products[] = $product;
    }
    
    // Function that returns the array that contains every saved product
    public function getProducts(){
        return $this->products;
    }

    // Function that loads every product with a query
    public function loadProducts(){
        $query = $this->getDb()->prepare("SELECT * FROM produits ORDER BY `produits`.`id` ASC");
        $query->execute();
        $myProducts = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();

        foreach($myProducts as $product){
            $p = new Product($product['id'], $product['image'], $product['nom'], $product['description'], $product['prix']);
            $this->addProduct($p);
        }
    }

    // Load User Products
    public function getProductsByUserId($id_user){
        $query = "SELECT * FROM produits WHERE id_user = :id_user ORDER BY `produits`.`id` ASC";

        $stmt = $this->getDb()->prepare($query);
        $stmt->bindValue(":id_user", $id_user, PDO::PARAM_INT);
        $stmt->execute();
        $myProducts = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt->closeCursor();

        return $myProducts;
    }

    // Function that returns a product by its id
    public function getProductbyId($id){
        for($i = 0; $i < count($this->products); $i++){
            if($this->products[$i]->getId() === $id){
                return $this->products[$i];
            }
        }
    }
    
    // Function that adds a new product to db table product.
    public function addProductDb($image, $name, $description, $price){
        $query = "INSERT INTO produits (image, nom, description, prix) values (:image, :name, :description, :prix)";

        $stmt = $this->getDb()->prepare($query); 
        $stmt->bindValue(":image", $image, PDO::PARAM_STR);
        $stmt->bindValue(":name", $name, PDO::PARAM_STR);
        $stmt->bindValue(":description", $description, PDO::PARAM_STR);
        $stmt->bindValue(":price", $price, PDO::PARAM_STR);
        $result = $stmt->execute();

        if ($result > 0){
            $product = new Product($this->getDb()->lastInsertId(), $image, $name, $description, $price);
            $this->addProduct($product);
        }
    }
    
    // Function that edits an already added product
    public function editProductDb($image, $name, $description, $price){
        $query = "UPDATE produits SET image = :image, nom = :name, description = :description, prix = :price)";

        $stmt = $this->getDb()->prepare($query); 
        $stmt->bindValue(":image", $image, PDO::PARAM_STR);
        $stmt->bindValue(":name", $name, PDO::PARAM_STR);
        $stmt->bindValue(":description", $description, PDO::PARAM_STR);
        $stmt->bindValue(":price", $price, PDO::PARAM_STR);
        $result = $stmt->execute();

        if ($result > 0){
            $product = new Product($this->getDb()->lastInsertId(), $image, $name, $description, $price);
            $this->addProduct($product);
        }
    }
    
    // Function that deletes a product in database.
    public function deleteProductDb($id){
        $query1 = "DELETE FROM produits WHERE id = :id";
        $stmt = $this->getDb()->prepare($query1);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $result = $stmt->execute();
        $stmt->closeCursor();

        if ($result > 0){
            $product = $this->getProductbyId($id);
            unset($product);
        }
    }

}
