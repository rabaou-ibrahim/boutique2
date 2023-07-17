<?php
    // require_once "../boutique2/models/User/UserManager.class.php";
    // $userManager = new UserManager;
    // $userManager->loadUsers();

    // require_once "controllers/UsersController.controller.php";
    // $userController = new UsersController;
   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="http://localhost/boutique2/webfiles/Css/authentification.css">
</head>
<body>
<header>
    <button class="header-btn"><a href="<?= URL ?>home">Accueil</a></button>
    <button class="header-btn"><a href="<?= URL ?>user/l">Connexion</a></button>
</header>
<button class="display-return"><a href="<?= URL ?>home">Retour</a></button>

    <h3>Inscription</h3>

    <div class="form">

        <form id="reg-form" enctype="multipart/form-data" method="post" action="<?= URL ?>user/rv"> 
            <div id="registration-message" class="registration-message">
                <?php if (!empty($RegMsg)): ?>
                    <p><?php echo $RegMsg; ?></p>
                <?php endif; ?>
            </div>  
            <div class="form-group">
                <label for="lastname">Nom de famille :</label>
                <input type="text" class="form-control" id="lastname" placeholder="Nom" name="lastname" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="firstname">Prénom :</label>
                <input type="text" class="form-control" id="firstname" placeholder="Prénom" name="firstname" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="username">Pseudo :</label>
                <input type="text" class="form-control" id="username" placeholder="Pseudo" name="username" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="text" class="form-control" id="email" placeholder="Email" name="email" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" class="form-control" id="password" placeholder="Mot de passe" name="password" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="confirmed-password">Confirmation mdp :</label>
                <input type="password" class="form-control" id="confirmed-password" placeholder="Confirmation mot de passe" name="confirmed-password" autocomplete="off">
            </div>
            <button id="form-btn" type="submit" name="Envoyer" class="btn btn-primary">Valider</button>
            <div id="message">Déjà inscrit ? <a href="<?= URL ?>user/l"><b> Connectez-vous. </b></a></div>   
        </form>

    </div>

<footer>
<ul>
    <li>contacts</li>
    <li>service client</li>
    <li>newsletter</li>
    <li>résaux</li>
</ul>
</footer>
</body>
<script src="/boutique2/Js/user/userRegForm.js"></script>
</html>