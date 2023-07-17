<?php  
    if (!$_SESSION['admin-username']){
        header('location: ../home'); 
    }
    require_once "../boutique2/models/Product/ProductManager.php";
    $userManager = new ProductManager;
    $userManager->loadProducts();
    if(!empty($_SESSION['alert'])) :
?>

<div id="alert" class="alert alert-<?= $_SESSION['alert']['type'] ?>" role="alert">
    <p class="msg-alert" id="msg-alert"> <?= $_SESSION['alert']['msg'] ?> </p>
    <button class="close-alert" id="close-alert"> Fermer </button> 
</div>

<?php
    unset($_SESSION['alert']);
    endif;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="http://localhost/boutique2/webfiles/Css/admin.css">
    <title>Admin (<?= $_SESSION['admin-username'] ?>) - Produits</title>
</head>
<body>
    <header>
        <button class="header-round-btn"><a href="admin">TECHNO</a></button>
        <button class="header-btn"><a href="<?= URL ?>admin">Produits</a></button>
        <button class="header-btn"><a href="<?= URL ?>admin/l">Connexion</a></button>
        <button class="header-btn"><a href="<?= URL ?>admin/lo">Déconnexion</a></button>
    </header>
    <div class="container">
        <aside>
            <div class="admin">
                <div class="admin-title">
                    <img class="user-img" src="http://localhost/boutique2/webfiles/img/export.png" height="100px">
                    <h3>Admin username</h3>
                </div>
                <div class="button-icons">
                    <button><img src="http://localhost/boutique2/webfiles/img/gear-solid.svg" height="30px" width="40px"></a></button>
                    <button><img src="http://localhost/boutique2/webfiles/img/bell-solid.svg" height="30px" width="40px"></a></button>
                </div>    
            </div>
            <div class="admin-buttons">
                <button class="dashboard-btn"><?= $_SESSION['admin-username']; ?></button>
                <button class="profile-btn">Profil</button>
                <button class="users-btn">Gestion utilisateurs</button>
            </div>    
        </aside>

        <section>
            <div class="items">
                <h3 class="items-number-shirt">T-shirts <?= $productManager->loadOccurences("T-shirt"); ?> </h3>
                <h3 class="items-number-jean">Jeans <?= $productManager->loadOccurences("Jean"); ?> </h3>
                <h3 class="items-number-veste">Vestes <?= $productManager->loadOccurences("Veste"); ?> </h3>
            </div>
            <div class="bar">
                <a href="<?= URL ?>admin/a"><button class="add-btn"><p>Ajouter nouveau produit</p></button></a>
            </div>
            <?php 
            $users = $userManager->getProducts();
            for($i=0; $i < count($users); $i++) : ?>
            <table class="table" id="table">
                <tr class="table-content" id="table-content">
                    <div class="table-content-text">
                    <td><img src = 'http://localhost/boutique2/webfiles/img/shop/<?= $users[$i]->getImage() ?>' width="80px"></td>
                    <td><?= $users[$i]->getName() ?></td>
                    <td><?= $users[$i]->getPrice() ?>€</td>
                    </div>
                    <div class="table-options">
                        <td><a href="<?= URL ?>admin/v/<?= $users[$i]->getId() ?>"><button class="view-btn">Voir</button></td></a>
                        <td><a href="<?= URL ?>admin/e/<?= $users[$i]->getId();?>"><button class="edit-btn">Modifier</button></a></td>
                        <td>
                            <form method="POST" action="<?= URL ?>admin/d/<?= $users[$i]->getId();?>" onSubmit = "return confirm('Confirmer suppression ?');">
                                <button class="delete-btn" type="submit">Supprimer</button>
                            </form>
                        </td>
                    </div>
                </tr>
                <?php endfor; ?>
            </table>
            <div id="users-array">
                <?php  ?>
            </div>
        </section>

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
<script>
    var usersArray = <?php echo json_encode($users); ?>
</script>
<script src="Js/admin/app.js"></script>
</html>