<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
</head>
<body>
    <a href='blog.php'>Retour au blog</a>

    <h1>Bienvenue sur le Blog</h1>
    <br>
    <a href="create_article.php">Ajouter un article</a>

    <?php // Ajouter un bouton modifier l'article sur chaque article avec le titre de l'article
    session_start(); 

    if(!empty($_GET["status"])) {
        if($_GET["status"] == "created") {
            echo "<div class='created' style='color: green'>Votre article a bien été créé</div>";
        }else if($_GET["status"] == "edited") {
            echo "<div class='created' style='color: green'>Votre article a bien été modifié</div>";
        }
    }

    function commuArticle($bdd, $id){
        echo "<h2>Articles de la communauté :</h2>";

        $rqt_all;

        $rqt_all = "SELECT * FROM article WHERE id_utilisateur != '$id'";

        if(!$id) $rqt_all = "SELECT * FROM article";

        $requete_preparee2 = $bdd->prepare($rqt_all); 

        $requete_preparee2->execute();
        
        $data2 = $requete_preparee2->fetchAll();

        $row2 = 0;

        if(count($data2) === 0) echo("<h3>Aucun autre article</h3>"); 

        while($row2 < count($data2)){
            
            $author_id = $data2[$row2]['id_utilisateur'];

            $target_user = "SELECT email FROM utilisateur WHERE id = '$author_id' LIMIT 1";

            $requete_preparee3 = $bdd->prepare($target_user); 

            $requete_preparee3->execute();
            
            $data3 = $requete_preparee3->fetchAll();

            $author = $data3[0]['email'];

            $update = $data2[$row2]['updated_at'];

            if($update === NULL) $update = "Jamais";

            $title2 = $data2[$row2]['titre'];
            $createdDate2 = $data2[$row2]['created_at'];
            $article_id2 = $data2[$row2]['id'];
            echo "<div style='border-radius: 24px; border: 3px solid rgb(0 140 2)'><a href='display_article.php?id=$article_id2'><h3>$title2</h3><h5>Créé le : $createdDate2 par $author, Dernière modification : $update</h5></a></div><br>";
            $row2 += 1;
        }
    }

    if(!empty($_SESSION) && !empty($_SESSION["email"])) { // Faire une requête qui récupère tous les articles qu'a fait l'utilisateur et afficher en dessous les articles de tout le monde du moment que author n'est pas égal à lui
        echo "<a href='actions/logout.php'>Se déconnecter</a>";
        echo "<h2>Vos articles :</h2>";
        try {
            // Connexion à la base de donnée : 
            require_once('actions/bdd.php');

            $bdd_options = ["PDO::ATTR_ERR_MODE" => PDO::ERRMODE_EXCEPTION];
            $bdd = new PDO("mysql:host=localhost;dbname=$db_name;port=$db_port", $db_user, $db_pass, $bdd_options); 

            $email = $_SESSION['email'];

            $rqt_user = "SELECT * FROM utilisateur WHERE email='$email';";

            $exec_user = $bdd->prepare($rqt_user);

            $exec_user->execute();

            $data = $exec_user->fetchAll();

            $id = $data[0]["id"];

            $rqt = "SELECT * FROM article WHERE id_utilisateur = '$id';"; 

            $requete_preparee = $bdd->prepare($rqt); 
    
            $requete_preparee->execute();
            
            $data = $requete_preparee->fetchAll();

            $row = 0;

            if(count($data) === 0) echo("<h3>Vous n'avez écrit aucun article</h3>"); 

            while($row < count($data)){
                
                $title = $data[$row]['titre'];
                $createdDate = $data[$row]['created_at'];
                $article_id = $data[$row]['id'];
                $update = $data[$row]['updated_at'];

                if($update === NULL) $update = "Jamais";

                echo "<div style='border-radius: 24px; border: 3px solid rgb(0 142 2)'><a href='display_article.php?id=$article_id'><h3>$title</h3><h5>Créé le : $createdDate par Vous, Dernière modification : $update</h5></a></div>";
                echo "<a href='edit_article.php?id=$article_id'>Modifier l'article</a><br>";
                $row += 1;
            }

            commuArticle($bdd, $id);

        } catch (Exception $e) {
            
            if($e->getCode() == 23000 ) { // Le code 23000 correspond à une entrée dupliquée :cela signifie que l'adresse mail est déjà en bdd
                redirect_with_error("../register_form.php","duplicate");
            }
        }
    }else{
        require_once('actions/bdd.php');

        echo "<a href='login_form.php'>Se connecter</a>";

        $bdd_options = ["PDO::ATTR_ERR_MODE" => PDO::ERRMODE_EXCEPTION];
        $bdd = new PDO("mysql:host=localhost;dbname=$db_name;port=$db_port", $db_user, $db_pass, $bdd_options);

        commuArticle($bdd, NULL);
    }

    include_once('utils.php'); 
    check_and_display_error();
    ?>
</body>
</html>
