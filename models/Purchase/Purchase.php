<?

// class Purchase implements JsonSerializable {
//     private $purchase_id;
//     private $username_id;
//     private $product_id;

//     public function __construct($purchase_id, $username_id, $product_id){
//         $this->purchase_id = $purchase_id;
//         $this->username_id = $username_id;
//         $this->product_id = $product_id;
//     }

//     public function getPurchaseId(){
//         return $this->purchase_id;
//     }

//     public function setPurchaseId($purchase_id){
//         return $this->purchase_id = $purchase_id;
//     }
//     public function getUsernameId(){
//         return $this->username_id;
//     }

//     public function setUsernameId($username_id){
//         $this->username_id = $username_id;
//     }

//     public function getProductId(){
//         return $this->product_id;
//     }

//     public function setProductId($product_id){
//         $this->product_id = $product_id;
//     }
//     public function jsonSerialize() {
//         return [
//             'purchase_id' => $this->product_id,
//             'username_id' => $this->username_id,
//             'product_id' => $this->username_id,
//         ];
//     }
// }