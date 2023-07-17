<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Utilisateur - Modification</title>
    <link rel="stylesheet" href="http://localhost/boutique2/webfiles/Css/authentification.css">
</head>
<body>
<header>
    <button class="header-btn"><a href="<?= URL ?>user/s">Boutique</a></button>
    <button class="header-btn"><a href="<?= URL ?>user/p">Accueil</a></button>
    <button class="header-btn"><a href="<?= URL ?>user/lo">Déconnexion</a></button>
</header>
<button class="display-return"><a href="<?= URL ?>user/p">Retour</a></button>
    <h3><?= $user->getFirstname(); ?></h3>

    <div class="form">

<form id="edit-form" enctype="multipart/form-data" method="post" action="<?= URL ?>user/ev">
    <div id="edit-message" class="edit-message">
        <?php if (!empty($RegMsg)): ?>
            <p><?php echo $RegMsg; ?></p>
        <?php endif; ?>
    </div>
    <div class="form-group">
        <label for="lastname">Nom (de famille):</label>
        <input type="text" class="form-control" id="lastname" name="lastname" value="<?= $user->getFirstname(); ?>" placeholder="Nom de famille">
    </div>
    <div class="form-group">
        <label for="firstname">Prénom :</label>
        <input type="text" class="form-control" id="firstname" name="firstname" value="<?= $user->getLastname(); ?>" placeholder="Prénom">
    </div>
    <div class="form-group">
        <label for="username">Pseudo :</label>
        <input type="text" class="form-control" id="username" value="<?= $user->getUsername(); ?>" name="username" placeholder="Pseudo" autocomplete="off">
    </div>
    <div class="form-group">
        <label for="email">Email :</label>
        <input type="text" class="form-control" id="email" name="email" value="<?= $user->getEmail(); ?>" placeholder="Email">
    </div>
    <div class="form-group">
        <label for="password">Mot de passe :</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Mot de passe">
    </div>
    <div class="form-group">
        <label for="confirmed-password">Confirmation mdp :</label>
        <input type="password" class="form-control" id="confirmed-password" placeholder="Confirmation mot de passe" name="confirmed-password" autocomplete="off">
    </div>
    <input type="hidden" name="identifier" value="<?= $user->getId(); ?>">
    <button type="submit" id="form-btn" class="btn btn-primary">Valider</button>
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
<script src="/boutique2/Js/user/userEditForm.js"></script>
</html>