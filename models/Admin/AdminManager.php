<?php

require_once "Admin.php";
class AdminManager extends Model{
    private $admins;

    public function addAdmin($admin){
        $this->admins[] = $admin;
    }

    public function getAdmins(){
        return $this->admins;
    }

    public function loadAdmins(){
        $query = $this->getDb()->prepare("SELECT * FROM admins");
        $query->execute();
        $myAdmins = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();

        foreach($myAdmins as $admin){
            $a = new Admin($admin['id'], $admin['nom'], $admin['prenom'], $admin['pseudo'], $admin['email'], $admin['password']);
            $this->addAdmin($a);
        }
    }
    public function getAdminbyId($id){
        for($i=0; count($this->admins); $i++){
            if($this->admins[$i]->getId() === $id){
                return $this->admins[$i];
            }
        }
    }
    public function registerAdminDb($lastname, $firstname, $username, $email, $password){
        $query = "INSERT INTO admins (nom, prenom, pseudo, email, password) values (:nom, :prenom, :pseudo, :email, :password)";
        $passwordhash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->getDb()->prepare($query); 
        $stmt->bindValue(":nom", $lastname, PDO::PARAM_STR);
        $stmt->bindValue(":prenom", $firstname, PDO::PARAM_STR);
        $stmt->bindValue(":pseudo", $username, PDO::PARAM_STR);
        $stmt->bindValue(":email", $email, PDO::PARAM_STR);
        $stmt->bindValue(":password", $passwordhash, PDO::PARAM_STR);
        $result = $stmt->execute();

        if ($result > 0){
            $admin = new Admin($this->getDb()->lastInsertId(), $lastname, $firstname, $username, $email, $passwordhash);
            $this->addAdmin($admin);
        }
    }
}