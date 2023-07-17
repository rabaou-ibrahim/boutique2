<?php 

require_once "./models/Product/ProductManager.php";

require_once "User.php";

class UserManager extends Model{
    private $users;
    private $products;

    public function addUser($user){
        $this->users[] = $user;
    }

    public function getUsers(){
        return $this->users;
    }

    public function loadUsers(){
        $query = $this->getDb()->prepare("SELECT * FROM utilisateurs");
        $query->execute();
        $myUsers = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();

        foreach($myUsers as $user){
            $u = new User($user['id'], $user['nom'], $user['prenom'], $user['pseudo'], $user['email'], $user['password']);
            $this->addUser($u);
        }
    }
    public function getProductbyId($id){
        for($i=0; count($this->products); $i++){
            if($this->products[$i]->getId() === $id){
                return $this->products[$i];
            }
        }
    }
    public function getUserbyId($id){
        for($i=0; count($this->users); $i++){
            if($this->users[$i]->getId() === $id){
                return $this->users[$i];
            }
        }
    }
    public function getUserByUsername($username) {
        foreach ($this->users as $user) {
            if ($user->getUsername() === $username) {
                return $user;
            }
        }
        return null; 
    }
    public function registerDb($lastname, $firstname, $username, $email, $password){
        $query = "INSERT INTO utilisateurs (nom, prenom, pseudo, email, password) values (:nom, :prenom, :pseudo, :email, :password)";
        $passwordhash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->getDb()->prepare($query); 
        $stmt->bindValue(":nom", $lastname, PDO::PARAM_STR);
        $stmt->bindValue(":prenom", $firstname, PDO::PARAM_STR);
        $stmt->bindValue(":pseudo", $username, PDO::PARAM_STR);
        $stmt->bindValue(":email", $email, PDO::PARAM_STR);
        $stmt->bindValue(":password", $passwordhash, PDO::PARAM_STR);
        $result = $stmt->execute();

        if ($result > 0){
            $user = new User($this->getDb()->lastInsertId(), $lastname, $firstname, $username, $email, $passwordhash);
            $this->addUser($user);
        }
        
    }
    public function editUserDb($id, $lastname, $firstname, $username, $email, $password) {
        $query = "UPDATE utilisateurs SET nom = :nom, prenom = :prenom, pseudo = :pseudo, email = :email, password = :password WHERE id = :id";
        
        $passwordhash = password_hash($password, PASSWORD_DEFAULT);
    
        $stmt = $this->getDb()->prepare($query);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->bindValue(":nom", $lastname, PDO::PARAM_STR);
        $stmt->bindValue(":prenom", $firstname, PDO::PARAM_STR);
        $stmt->bindValue(":pseudo", $username, PDO::PARAM_STR);
        $stmt->bindValue(":email", $email, PDO::PARAM_STR);
        $stmt->bindValue(":password", $passwordhash, PDO::PARAM_STR);
        $result = $stmt->execute();
        $stmt->closeCursor();
    
        if ($result) {
            $user = $this->getUserbyId($id);
            if ($user) {
                $user->setLastname($lastname);
                $user->setFirstname($firstname);
                $user->setUsername($username);
                $user->setEmail($email);
                $user->setPassword($passwordhash);
            }
        }
    }
     
}