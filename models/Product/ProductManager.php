<?php 

require_once "./models/Model.php";

require_once "Product.php";
class ProductManager extends Model{
    private $products;

    public function addProduct($product){
        $this->products[] = $product;
    }

    public function getProducts(){
        return $this->products;
    }

    public function loadProducts(){
        $query = $this->getDb()->prepare("SELECT * FROM produits ORDER BY id DESC");
        $query->execute();
        $myProducts = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();

        foreach($myProducts as $product){
            $p = new Product($product['id'],  $product['image'], $product['nom'], $product['description'], $product['prix']);
            $this->addProduct($p);
        }
    }
    public function loadOccurences($value){
       $query = "SELECT COUNT(*) AS count FROM produits WHERE description = :value";
       $stmt = $this->getDb()->prepare($query);
       $stmt->bindValue(':value', $value, PDO::PARAM_STR);
       $stmt->execute();

       $result = $stmt->fetch(PDO::FETCH_ASSOC);
       $count = $result['count'];
       return $count;
    }
    
    public function getProductbyId($id){
        for($i=0; count($this->products); $i++){
            if($this->products[$i]->getId() === $id){
                return $this->products[$i];
            }
        }
    }
    public function addProductDb($image, $name, $description, $price){
        $query = "INSERT INTO produits (image, nom, description, prix) values (:image, :nom, :description, :prix)";
        $stmt = $this->getDb()->prepare($query);
        $stmt->bindValue(":image", $image, PDO::PARAM_STR);
        $stmt->bindValue(":nom", $name, PDO::PARAM_STR);
        $stmt->bindValue(":description", $description, PDO::PARAM_STR);
        $stmt->bindValue(":prix", $price, PDO::PARAM_INT);
        $result = $stmt->execute();

        if ($result > 0){
            $product = new Product($this->getDb()->lastInsertId(), $image, $name, $description, $price);
            $this->addProduct($product);
        }
    }

    public function deleteProductDb($id){
        $query = "DELETE FROM produits WHERE id = :idProduct";
        $stmt = $this->getDb()->prepare($query);
        $stmt->bindValue(":idProduct", $id, PDO::PARAM_INT);
        $result = $stmt->execute();
        $stmt->closeCursor();

        if ($result > 0){
            $product = $this->getProductbyId($id);
            unset($product);
        }
    }
    public function editProductDb($id, $image, $name, $description, $price){
        $query = "UPDATE produits SET image = :image, nom = :name, description = :description, prix = :price WHERE id = :id";
        $stmt = $this->getDb()->prepare($query);
        $stmt->bindValue(":id", $id,PDO::PARAM_INT);
        $stmt->bindValue(":image", $image,PDO::PARAM_STR);
        $stmt->bindValue(":name", $name,PDO::PARAM_STR);
        $stmt->bindValue(":description", $description,PDO::PARAM_STR);
        $stmt->bindValue(":price", $price,PDO::PARAM_INT);
        $result = $stmt->execute();
        $stmt->closeCursor();

        if ($result > 0) {
            $this->getProductbyId($id)->setImage($image);
            $this->getProductbyId($id)->setName($name);
            $this->getProductbyId($id)->setDescription($description);
            $this->getProductbyId($id)->setPrice($price);
        }
    }   
}