<?php

class Cart implements JsonSerializable {
    private $cart_id;
    private $username_id;

    public function __construct($cart_id, $username_id){
        $this->cart_id = $cart_id;
        $this->username_id = $username_id;
    }

    public function getCartId(){
        return $this->cart_id;
    }

    public function setCartId($cart_id){
        $this->cart_id = $cart_id;
    }
    public function getUsernameId(){
        return $this->username_id;
    }

    public function setUsernameId($username_id){
        $this->username_id = $username_id;
    }
    public function jsonSerialize() {
        return [
            'cart_id' => $this->cart_id,
            'username_id' => $this->username_id,
        ];
    }
}