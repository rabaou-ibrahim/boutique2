<?php

require "CartItems.php";

class CartItemsManager extends Model{

    private $cart_items;

    public function addCartItem($cart_item){
        $this->cart_items[] = $cart_item;
    }

    public function getCartItems(){
        return $this->cart_items;
    }
    public function getCartItembyId($id){
        for($i=0; count($this->cart_items); $i++){
            if($this->cart_items[$i]->getCartItemsId() === $id){
                return $this->cart_items[$i];
            }
        }
    }
    public function getCartItemsByCartId($cart_id) {
        $userCartItems = [];
        foreach ($this->cart_items as $cart_item) {
            if ($cart_item->getCartId() === $cart_id) {
                $userCartItems[] = $cart_item;
            }
        }
        return $userCartItems;
    }
    public function getCartItemsByUserId($user_id) {
        $userCartItems = [];
        foreach ($this->cart_items as $cart_item) {
            if ($cart_item->getUsernameId() === $user_id) {
                $userCartItems[] = $cart_item;
            }
        }
        return $userCartItems;
    }
    
    public function loadCartItems(){
        $query = $this->getDb()->prepare("SELECT * FROM items_panier");
        $query->execute();
        $myCartItems = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();

        foreach ($myCartItems as $cart_item) {
            $c = new CartItems(
                $cart_item['item_panier_id'],
                $cart_item['panier_id'],
                $cart_item['produit_id'],
                $cart_item['quantite'],
                $cart_item['prix']
            );
            $this->addCartItem($c);
        }
    }

    public function addItemToCart($cartId, $productId, $quantity, $price){
        
        $existingItem = $this->getItemByCartAndProduct($cartId, $productId);
        
        if ($existingItem) {
            // Update the quantity and price of the existing item
            $newQuantity = $existingItem['quantite'] + $quantity;
            $newPrice = $existingItem['prix'] + $price;
            
            $this->updateCartItem($existingItem['item_panier_id'], $newQuantity, $newPrice);
        } else {
            // Insert a new item into the cart
            $this->insertCartItem($cartId, $productId, $quantity, $price);
        }
    }

    private function insertCartItem($cartId, $productId, $quantity, $price) {
        $query = "INSERT INTO items_panier (panier_id, produit_id, quantite, prix) VALUES (:cartId, :productId, :quantity, :price)";
        $stmt = $this->getDb()->prepare($query);
        $stmt->bindValue(":cartId", $cartId, PDO::PARAM_INT);
        $stmt->bindValue(":productId", $productId, PDO::PARAM_INT);
        $stmt->bindValue(":quantity", $quantity, PDO::PARAM_INT);
        $stmt->bindValue(":price", $price, PDO::PARAM_INT);
        $result = $stmt->execute();
    
        if ($result > 0) {
            $cartItem = new CartItems($this->getDb()->lastInsertId(), $cartId, $productId, $quantity, $price);
            $this->addCartItem($cartItem);
        }
    }
    

    private function updateCartItem($itemId, $quantity, $price){
        $query = "UPDATE items_panier SET quantite = :quantite, prix = :prix WHERE item_panier_id = :item_panier_id";
        $stmt = $this->getDb()->prepare($query);
        $stmt->bindValue(":item_panier_id", $itemId, PDO::PARAM_INT);
        $stmt->bindValue(":quantite", $quantity, PDO::PARAM_INT);
        $stmt->bindValue(":prix", $price, PDO::PARAM_STR);
        $result = $stmt->execute();
        $stmt->closeCursor();

        if ($result > 0) {
            $this->getCartItembyId($itemId)->setQuantity($quantity);
            $this->getCartItembyId($itemId)->setPrice($price);
        }
    }
    public function deleteCartItemDb($id){
        $query = "DELETE FROM items_panier WHERE id = :idCartItem";
        $stmt = $this->getDb()->prepare($query);
        $stmt->bindValue(":idCartItem", $id, PDO::PARAM_INT);
        $result = $stmt->execute();
        $stmt->closeCursor();

        if ($result > 0){
            $cart_item = $this->getCartItembyId($id);
            unset($cart_item);
        }
    }

    private function getItemByCartAndProduct($cartId, $productId){
        $query = "SELECT * FROM items_panier WHERE panier_id = :cartId AND produit_id = :productId";
        $stmt = $this->getDb()->prepare($query);
        $stmt->bindValue(":cartId", $cartId, PDO::PARAM_INT);
        $stmt->bindValue(":productId", $productId, PDO::PARAM_INT);
        $stmt->execute();
        
        // Fetch the cart item as an associative array
        $cartItem = $stmt->fetch(PDO::FETCH_ASSOC);
        
        // Close the cursor
        $stmt->closeCursor();
        
        return $cartItem;
    }

}