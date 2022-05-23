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
    include_once('actions/session.php');
    sessionExist();

    if(empty($_GET["id"])) return header("Location: blog.php");

    include_once('utils.php'); 
    check_and_display_error();
    ?>
    <?php $id = $_GET["id"]; echo "<form action='actions/edit.php?id=$id' method='post'>"; ?>
        <p>
            <label for="title">Titre</label>            
            <?php
                $id = htmlspecialchars($_GET["id"]);

                require_once('actions/bdd.php');
    
                try {
                    $bdd_options = ["PDO::ATTR_ERR_MODE" => PDO::ERRMODE_EXCEPTION];
                    $bdd = new PDO("mysql:host=localhost;dbname=$db_name;port=$db_port", $db_user, $db_pass, $bdd_options); 
            
                } catch(Exception $e) {
                    echo $e->getMessage();
                    exit;
                }

                $rqt = "SELECT * FROM article WHERE id = '$id' LIMIT 1;"; 

                $requete_preparee = $bdd->prepare($rqt); 
        
                $requete_preparee->execute();
                
                $data = $requete_preparee->fetchAll();
                    
                $title = $data[0]['titre'];
                $content = $data[0]['corps'];

                echo "<input type='text' name='title' value='$title' required></p>";

                echo "<p><label for='content'>Contenu</label><textarea id='content' name='content' placeholder='Votre texte'>$content</textarea></p>";
            ?>
        <button type="submit">Modifier l'article</button>
    </form>
</body>
</html>