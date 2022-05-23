<!DOCTYPE html>
<?php 
    include_once('actions/session.php');
    sessionExist() 
?>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Article</title>
</head>
<body>
    <a href='blog.php'>Retour au blog</a>
    <a href='actions/logout.php'>Se déconnecter</a>
    <h1>Créer un article</h1>
    <?php
    include_once('utils.php');
    check_and_display_error();
    ?>
    <form action="actions/create.php" method="post">
        <p>
            <label for="title">Titre</label><input type="text" name="title" required>
        </p>
        <p>
            <label for="content">Contenu</label><textarea id="content" name="content" placeholder="Votre texte"></textarea>
        </p> 
        <button type="submit">Créer l'article</button>
    </form>
</body>
</html>