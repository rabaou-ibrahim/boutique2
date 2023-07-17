<?php

require_once "./models/User/UserManager.php";
require_once "./models/Admin/AdminManager.php";

class AdminsController{
    private $adminManager;
    private $userManager;

    public function __construct(){
        $this->adminManager = new AdminManager;
        $this->adminManager->loadAdmins();

        $this->userManager = new UserManager;
        $this->adminManager->loadAdmins();
    }
    public function displayAdminUsers(){
        require "views/admin/registerAdmin.view.php";
    }
    
    public function displayAdminUser($id){
        $user = $this->userManager->getUserbyId($id);
        require "views/admin/registerAdmin.view.php";
    }
    public function displayAdminRegister(){
        require "views/admin/registerAdmin.view.php";
    }
    public function displayAdminLogin(){
        require "views/admin/loginAdmin.view.php";
    }
    public function displayWarning(){
        require "views/admin/warningAdmin.view.php";
    }
    public function AdminRegisterValidation() {
        $response = $this->AdminVerifyRegFields(htmlspecialchars($_POST['email']), htmlspecialchars($_POST['username']));
    
        if ($response['success']) {
            // Valid username and email
            $this->adminManager->registerAdminDb(htmlspecialchars($_POST["lastname"]), htmlspecialchars($_POST["firstname"]), htmlspecialchars($_POST['username']), htmlspecialchars($_POST["email"]), htmlspecialchars($_POST["password"]));
            $responseData = [
                'success' => true,
                'message' => "Inscription réussie !"
            ];
        } else {
            // Handle invalid username or email
            $responseData = [
                'success' => false,
                'message' => $response['message']
            ];
        }
    
        header('Content-Type: application/json');
        echo json_encode($responseData);
    }
    
    public function AdminVerifyRegFields($email, $username) {
        $admins = $this->adminManager->getAdmins();

        $adminUsernames = [];
        $adminEmails = [];

        $isAdminEmailTaken = false;
        $isAdminUsernameTaken = false;

        if (!empty($admins)){
            foreach ($admins as $admin) {
                $adminUsernames[] = $admin->getUsername();
                $adminEmails[] = $admin->getEmail();
            }
        
            foreach ($adminUsernames as $existingAdminUsername) {
                if ($existingAdminUsername === $username) {
                    $isAdminUsernameTaken = true;
                    break;
                }
            }
        
            foreach ($adminEmails as $existingAdminEmail) {
                if ($existingAdminEmail === $email) {
                    $isAdminEmailTaken = true;
                    break;
                }
            }
        }
    
        $AdminRegMsg = '';
    
        if ($isAdminUsernameTaken) {
            $AdminRegMsg = "Pseudo déjà pris";
        } elseif ($isAdminEmailTaken) {
            $AdminRegMsg = "Email déjà pris";
        }
    
        $responseData = [
            'success' => !$isAdminUsernameTaken && !$isAdminEmailTaken,
            'message' => $AdminRegMsg
        ];
    
        return $responseData;
    }
    public function AdminLogInValidation(){
        $response = $this->AdminVerifyLogFields(htmlspecialchars($_POST['username']), $_POST['username'], $_POST['password']);
    
        if ($response['success']) {
            $responseLogData = [
                'success' => true,
                'message' => "Connexion établie !"
            ];
            $_SESSION['admin-username'] = $_POST['username'];
        } else {
            $responseLogData = [
                'success' => false,
                'message' => $response['message']
            ];
        }
    
        header('Content-Type: application/json');
        echo json_encode($responseLogData);
    }
    public function AdminVerifyLogFields($email, $username, $password) {
        
        $admins = $this->adminManager->getAdmins();
        $foundAdmin = null;

        if (!empty($admins)){
            foreach ($admins as $admin) {
                if ($admin->getUsername() === $username || $admin->getEmail() === $email) {
                    $foundAdmin = $admin;
                    break;
                }
            }
        }
        
        if ($foundAdmin !== null) {
            $hashedPassword = $foundAdmin->getPassword();
        
            if (password_verify($password, $hashedPassword)) {
                $AdminLogMsg = "<p style='color:green'>Connexion établie !</p>";
                $AdminExists = true;
            } else {
                $AdminLogMsg = "Mot de passe incorrect";
                $AdminExists = false;
            }
        } else {
            $AdminLogMsg = "Pseudo ou email incorrect";
            $AdminExists = false;
        }
        
        $responseLogData = [
            'success' => $AdminExists,
            'message' => $AdminLogMsg
        ];
        
        return $responseLogData;
        
    }
    public function AdminLogOut(){
        session_start();
        session_destroy();
        header("location: ".URL."home");
    }
}