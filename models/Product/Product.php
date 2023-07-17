<?php
class Product implements JsonSerializable {
    private $id;
    private $image; 
    private $name;
    private $description;
    private $price;

    public function __construct($id, $image, $name, $description, $price){
        $this->id = $id;
        $this->image = $image;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
    }

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getImage(){
        return $this->image;
    }

    public function setImage($image){
        $this->image = $image;
    }
    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getDescription(){
        return $this->description;
    }

    public function setDescription($description){
        $this->description = $description;
    }
    public function getPrice(){
        return $this->price;
    }

    public function setPrice($price){
        $this->price = $price;
    }
    public function jsonSerialize() {
        return [
            'id' => $this->id,
            'image' => $this->image,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price
        ];
    }

}