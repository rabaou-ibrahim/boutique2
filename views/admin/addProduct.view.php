<?php  
    if (!$_SESSION['admin-username']){
        header('location: ./w');   
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produit - Ajout</title>
    <link rel="stylesheet" href="http://localhost/boutique2/webfiles/Css/authentification.css">
</head>
<body>
<header>
    <button class="header-round-btn"><a href="<?= URL ?>admin">TECHNO</a></button>
    <button class="header-btn"><a href="<?= URL ?>admin/r">Inscription</a></button>
    <button class="header-btn"><a href="<?= URL ?>admin/l">Connexion</a></button>
    <button class="header-btn"><a href="<?= URL ?>admin">Accueil</a></button>
</header>
<button class="display-return"><a href="<?= URL ?>admin">Retour</a></button>
    <h3>Ajout d'un produit</h3>
    
    <div class="form">

    <form id="admin-add-form" enctype="multipart/form-data" method="post" action="<?= URL ?>admin/av">
        <div id="admin-message" class="admin-message">
            <?php if (!empty($AdminMsg)): ?>
                <p><?php echo $AdminMsg; ?></p>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="name">Nom :</label>
            <input type="text" class="form-control" id="name" name="name" autocomplete="off">
        </div>
        <div class="form-group">
            <label for="description">Description :</label>
            <input type="text" class="form-control" id="description" name="description" autocomplete="off">
        </div>
        <div class="form-group">
            <label for="price">Prix :</label>
            <input type="number" class="form-control" id="price" name="price" autocomplete="off">
        </div>
        <div class="form-group">
            <label for="image" class="label-image">Image :</label>
            <input type="file" class="form-control-file" id="image" name="image">
        </div>
        <button type="submit" class="btn btn-primary">Valider</button>
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
<script src="/boutique2/Js/admin/adminAddProductForm.js"></script>
</body>
</html>