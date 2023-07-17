<?php

// require_once "Purchase.php";
// class PurchaseManager extends Model{
//     private $purchases;

//     public function addPurchase($purchase){
//         $this->purchases[] = $purchase;
//     }

//     public function getPurchases(){
//         return $this->purchases;
//     }

//     public function loadPurchases(){
//         $query = $this->getDb()->prepare("SELECT * FROM achats");
//         $query->execute();
//         $myPurchases = $query->fetchAll(PDO::FETCH_ASSOC);
//         $query->closeCursor();

//         foreach($myPurchases as $purchase){
//             $pc = new Purchase($purchase['id'], $purchase['image'], $purchase['nom']);
//             $this->addPurchase($pc);
//         }
//     }
//     public function loadNbPurchases($value){
//        $query = "SELECT COUNT(*) AS count FROM achats WHERE purchase_id = :value";
//        $stmt = $this->getDb()->prepare($query);
//        $stmt->bindValue(':value', $value, PDO::PARAM_STR);
//        $stmt->execute();

//        $result = $stmt->fetch(PDO::FETCH_ASSOC);
//        $count = $result['count'];
//        return $count;
//     }

//     public function addPurchaseDb($user_id, $product_id){
//         $query = "INSERT INTO achats (id_utilisateur, id_produit) values (:id_utilisateur, :id_produit)";

//         $stmt = $this->getDb()->prepare($query);
//         $stmt->bindValue(":id_utilisateur", $user_id, PDO::PARAM_INT);
//         $stmt->bindValue(":id_produit", $product_id, PDO::PARAM_INT);
//         $result = $stmt->execute();

//         if ($result > 0){
//             $purchase = new Purchase($this->getDb()->lastInsertId(), $user_id, $product_id);
//             $this->addPurchase($purchase);
//         }
//     }
