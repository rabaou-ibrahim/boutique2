<?php

require "Cart.php";

class CartManager extends Model{
    private $carts;
    public function __construct(){
        $this->carts = [];
    }
    public function addCart($cart){
        $this->carts[] = $cart;
    }

    public function getCarts(){
        return $this->carts;
    }

    public function loadCarts(){
        $query = $this->getDb()->prepare("SELECT * FROM paniers");
        $query->execute();
        $myCarts = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();

        foreach($myCarts as $cart){
            $c = new Cart($cart['id_panier'], $cart['id_utilisateur']);
            $this->addCart($c);
        }
    }
    public function getCartbyId($id){
        for($i=0; count($this->carts); $i++){
            if($this->carts[$i]->getCartId() === $id){
                return $this->carts[$i];
            }
        }
    }
    
    public function getCartbyUserId($user_id){
        for ($i = 0; $i < count($this->carts); $i++) {
            if ($this->carts[$i]->getUsernameId() === $user_id) {
                return $this->carts[$i];
            }
        }
        return null;
    }
    public function getCartIdbyUserId($user_id){
        for ($i = 0; $i < count($this->carts); $i++) {
            if ($this->carts[$i]->getUsernameId() === $user_id) {
                return $this->carts[$i]->getCartId();
            }
        }
        return null;
    }
    
    function registerCartDb($user_id){
        $query = "INSERT INTO paniers (id_utilisateur) values (:id_utilisateur)";

        $stmt = $this->getDb()->prepare($query);
        $stmt->bindValue(":id_utilisateur", $user_id, PDO::PARAM_INT);
        $result = $stmt->execute();

        if ($result > 0){
            $cart = new Cart($this->getDb()->lastInsertId(), $user_id);
            $this->addCart($cart);
        }
    }
}
