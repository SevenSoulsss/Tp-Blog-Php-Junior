<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <h1>Enregistrement</h1>
    <?php
    session_start();
    if(!empty($_SESSION) && !empty($_SESSION["email"])) return header("Location: blog.php");

    include_once('utils.php');
    check_and_display_error();
    ?>
    <form action="actions/register.php" method="post">
        <p>
            <label for="email">email</label><input type="email" name="email"  required>
        </p>
        <p>
            <label for="password">password</label>
            <input type="password" name="password"  required >
        </p>
        <p>
            <label for="conf_password">Confirmation</label><input type="password" name="conf_password" required />
        </p>
        <button type="submit">S'inscrire</button>
        <a href="login_form.php">Déjà un compte ? Se connecter</a>
    </form>
</body>
</html>