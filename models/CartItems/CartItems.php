<?php

class CartItems {
    private $cart_items_id;
    private $cart_id;
    private $product_id;
    private $quantity;
    private $price;

    public function __construct($cart_items_id, $cart_id, $product_id, $quantity, $price){
        $this->cart_items_id = $cart_items_id;
        $this->cart_id = $cart_id;
        $this->product_id = $product_id;
        $this->quantity = $quantity;
        $this->price = $price;
    }

    public function getCartItemsId(){
        return $this->cart_items_id;
    }

    public function setCartItemsId($cart_items_id){
        $this->cart_items_id = $cart_items_id;
    }
    public function getCartId(){
        return $this->cart_id;
    }

    public function setCartId($cart_id){
        $this->cart_id = $cart_id;
    }
    public function getProductId(){
        return $this->product_id;
    }

    public function setProductId($product_id){
        $this->product_id = $product_id;
    }
    public function getQuantity(){
        return $this->quantity;
    }

    public function setQuantity($quantity){
        $this->quantity = $quantity;
    }
    public function getPrice(){
        return $this->price;
    }

    public function setPrice($price){
        $this->price = $price;
    }
}