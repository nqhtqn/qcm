<?php
session_start();
if (isset($_POST["bout"])) {

    $login = $_POST["login"];
    $mdp = $_POST["mdp"];
    $id = mysqli_connect("127.0.0.1", "root", "", "qcm");
    $req = "select * from users where mail='$login' and mdp='$mdp'";
    $resultat = mysqli_query($id, $req);
    while ($ligneid = mysqli_fetch_assoc($resultat)) {
        $idu = $ligneid["idu"];
    }
    if (mysqli_num_rows($resultat) > 0) {
        $_SESSION["idu"] = $idu;
        $ligne = mysqli_fetch_assoc($resultat);
        header("location:question.php");
    } else {
        $erreur = "Pseudo ou Mot de passe incorrecte";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="qcm.css">
    <title>Document</title>
</head>

<body>
    <h1>Connexion</h1>
    <hr><br>

    <div class="connexion">

        <form action="" method="post">
            <label for="login">Login :</label>
            <input type="email" name="login" id="login" placeholder="Entrez votre mail" required><br><br>
            <label for="mdp">Mot de passe :</label>
            <input type="password" name="mdp" placeholder="Entrez votre mot de passe" required><br><br>
            <input type="submit" value="Connexion" name="bout">
        </form>

        <?php
        if (isset($erreur)) echo "<h3>$erreur</h3>";
        ?>

        <div class="inscription">
            <a href="inscription.php">
                Pas de compte? Inscrivez-vous !
            </a>
        </div>
    </div>
</body>

</html>