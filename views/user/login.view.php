<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="http://localhost/boutique2/webfiles/Css/authentification.css">
</head>
<body>
<header>
    <button class="header-btn"><a href="<?= URL ?>home">Accueil</a></button>
    <button class="header-btn"><a href="<?= URL ?>user/r">Inscription</a></button>
</header>
<button class="display-return"><a href="<?= URL ?>home">Retour</a></button>
    <h3>Connexion</h3>

    <div class="form">

        <form id="log-form" enctype="multipart/form-data" method="post" action="<?= URL ?>user/lv">
            <div id="log-message" class="log-message">
                <?php if (!empty($LogMsg)): ?>
                    <p><?php echo $LogMsg; ?></p>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <label for="username">Pseudo ou Email :</label>
                <input type="text" class="form-control" id="username" name="username" autocomplete="off">
            </div>
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" class="form-control" id="password" name="password" autocomplete="off">
            </div>
            <button id="form-btn" type="submit" class="btn btn-primary">Valider</button>
            <div id="message">Pas encore inscrit ? <a href="<?= URL ?>user/r"><b> Inscrivez-vous. </b></a></div> 
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
<script src="/boutique2/Js/user/userLogForm.js"></script>
</html>