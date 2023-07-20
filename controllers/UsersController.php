<?php

require_once "./models/User/UserManager.php";
require_once "./models/Product/ProductManager.php";
require_once "./models/Admin/AdminManager.php";
require_once "./models/Cart/CartManager.php";
require_once "./models/CartItems/CartItemsManager.php";
class UsersController {
    private $userManager;
    private $productManager;
    private $adminManager;
    private $cartManager;
    private $cartItemsManager;

    public function __construct(){
        $this->userManager = new UserManager;
        $this->userManager->loadUsers();

        $this->adminManager = new AdminManager();
        $this->adminManager->loadAdmins();

        $this->cartManager = new CartManager();
        $this->cartManager->loadCarts();

        $this->cartItemsManager = new CartItemsManager();
        $this->cartItemsManager->loadCartItems();

        $this->productManager = new ProductManager;
        $this->productManager->loadProducts();
    }
    public function displayProduct($id){
        $product = $this->productManager->getProductById($id);
         require "views/user/displayProduct.view.php";
    }
    public function displayRegister(){
        require "views/user/register.view.php";
    }
    public function registerValidation() {
        $response = $this->verifyRegFields(htmlspecialchars($_POST['email']), htmlspecialchars($_POST['username']));

        if ($response['success']) {
            $this->userManager->registerDb(htmlspecialchars($_POST["lastname"]), htmlspecialchars($_POST["firstname"]), htmlspecialchars($_POST['username']), htmlspecialchars($_POST["email"]), htmlspecialchars($_POST["password"]));
            $responseData = [
                'success' => true,
                'message' => "Inscription réussie !"
            ];
        } else {
            $responseData = [
                'success' => false,
                'message' => $response['message']
            ];
        }
        header('Content-Type: application/json');
        echo json_encode($responseData);
    }

    
    public function verifyRegFields($email, $username) {
        $admins = $this->adminManager->getAdmins();
        $users = $this->userManager->getUsers();

        $adminUsernames = [];
        $adminEmails = [];
        $emails = [];
        $usernames = [];

        $isEmailTaken = false;
        $isUsernameTaken = false;
        $isAdminEmailTaken = false;
        $isAdminUsernameTaken = false;

        if (!empty($admins)) {

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
    
        foreach ($users as $user) {
            $usernames[] = $user->getUsername();
            $emails[] = $user->getEmail();
        }
    
        foreach ($usernames as $existingUsername) {
            if ($existingUsername === $username) {
                $isUsernameTaken = true;
                break;
            }
        }
    
        foreach ($emails as $existingEmail) {
            if ($existingEmail === $email) {
                $isEmailTaken = true;
                break;
            }
        }
    
        $RegMsg = '';
    
        if (!$isUsernameTaken && !$isEmailTaken && !$isAdminUsernameTaken && !$isAdminEmailTaken) {
            $RegMsg = "<p style='color:green'> Inscription réussie ! </p>";
        } elseif ($isUsernameTaken) {
            $RegMsg = "Pseudo déjà pris";
        } elseif ($isEmailTaken) {
            $RegMsg = "Email déjà pris";
        } elseif ($isAdminUsernameTaken) {
            $RegMsg = "Pseudo déjà pris";
        } elseif ($isAdminEmailTaken) {
            $RegMsg = "Email déjà pris";
        }
    
        $responseData = [
            'success' => !$isUsernameTaken && !$isEmailTaken && !$isAdminUsernameTaken && !$isAdminEmailTaken,
            'message' => $RegMsg
        ];
    
        return $responseData;
    }
    
    public function displayLogin(){
        require "views/user/login.view.php";
    }
    public function logInValidation(){
        $response = $this->verifyLogFields(htmlspecialchars($_POST['username']), htmlspecialchars($_POST['username']), htmlspecialchars($_POST['password']));
    
        if ($response['success']) {
            $responseLogData = [
                'success' => true,
                'message' => "Connexion établie !"
            ];
            $loadedUser = $this->userManager->getUserByUsernameOrEmail($_POST['username'], $_POST['username']);
            $_SESSION['id'] = $loadedUser->getId();
            $_SESSION['username'] = $loadedUser->getUsername();
        } else {
            $responseLogData = [
                'success' => false,
                'message' => $response['message']
            ];
        }
    
        header('Content-Type: application/json');
        echo json_encode($responseLogData);
    }
    

    public function verifyLogFields($email, $username, $password) {
        
        $users = $this->userManager->getUsers();
        $foundUser = null;
        
        foreach ($users as $user) {
            if ($user->getUsername() === $username || $user->getEmail() === $email) {
                $foundUser = $user;
                break;
            }
        }
        
        if ($foundUser !== null) {
            $hashedPassword = $foundUser->getPassword();
        
            if (password_verify($password, $hashedPassword)) {
                $LogMsg = "<p style='color:green'>Connexion établie !</p>";
                $UserExists = true;
            } else {
                $LogMsg = "Mot de passe incorrect";
                $UserExists = false;
            }
        } else {
            $LogMsg = "Pseudo ou email incorrect";
            $UserExists = false;
        }
        
        $responseLogData = [
            'success' => $UserExists,
            'message' => $LogMsg
        ];
        
        return $responseLogData;
        
    }
    public function displayProfile(){
        require_once "views/user/profileUser.view.php";
    }

    public function editUser($id){
        $user = $this->userManager->getUserbyId($id);
        require "views/user/editUser.view.php";
    }

    public function editUserValidation(){
        $response = $this->verifyRegFields(htmlspecialchars($_POST['email']), htmlspecialchars($_POST['username']));

        if ($response['success']) {
            $this->userManager->editUserDb(htmlspecialchars($_POST['identifier']), htmlspecialchars($_POST["lastname"]), htmlspecialchars($_POST["firstname"]), htmlspecialchars($_POST['username']), htmlspecialchars($_POST["email"]), htmlspecialchars($_POST["password"]));
            $responseData = [
                'success' => true,
                'message' => "Modification réussie !"
            ];
        } else {
            $responseData = [
                'success' => false,
                'message' => $response['message']
            ];
        }

        header('Content-Type: application/json');
        echo json_encode($responseData);
    }
    public function displayCart($id){
        $userCart = $this->cartManager->getCartbyId($id);
        require "views/user/cartUser.view.php";      
    }
    public function displayShop(){
        require "views/user/shop.view.php";
    }
    public function autoCompletionProducts(){
        $products = $this->productManager->getProducts();

        header('Content-Type: application/json');
        echo json_encode($products);
    }   
    public function displayHistory($id){
        $user = $this->userManager->getUserbyId($id);
        require "views/user/historyUser.view.php";
    }
    public function logOut(){
        session_start();
        session_destroy();
        header("location: ".URL."home");
    }
    public function displayWarning(){
        require "views/user/warning.view.php";
    }
    public function displayCartWarning(){
        require "views/user/cartUserWarning.view.php";
    }
    public function displayEditUser($id){
        $user = $this->userManager->getUserbyId($id);
        require "views/user/editUser.view.php";
    }
}