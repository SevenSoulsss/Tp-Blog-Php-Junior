<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <?php
    session_start();
    if(!empty($_SESSION) && !empty($_SESSION["email"])) return header("Location: blog.php");

    if(!empty($_GET["status"])) {
        if($_GET["status"] == "registered") {
            echo "<div class='success'>Enregistrement réussi</div>";
        }
    }
    include_once('utils.php'); 
    check_and_display_error();
    ?>
    <form action="actions/login.php" method="post">
        <p><label for="email">Email</label><input type="email" name="email" required></p>
        <p><label for="password">Password</label><input type="password" name="password" required></p>
        <button type="submit">Se connecter</button>
        <a href="register_form.php">Pas encore de compte ? S'inscrire</a>
    </form>
</body>
</html>