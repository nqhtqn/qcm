<?php
$id = mysqli_connect("127.0.0.1", "root", "", "qcm");
if (isset($_POST["bout"])) {
    if ($_POST["verif_mdp"] != $_POST["mdp"]) {
        $erreur = "Les mots de passe ne sont pas identiques !";
    } else {

        $Merci = "Merci pour votre inscription !<br>Redirection en cours...";
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $mail = $_POST["mail"];
        $mdp = $_POST["mdp"];
        $verif_mdp = $_POST["verif_mdp"];
        $req1 = "insert into users values (null,'$nom','$prenom','$mail','$mdp')";
        $resultat = mysqli_query($id, $req1);
        header("refresh:5;url=connexion.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="qcm.css">
</head>

<body>
    <h1>Inscription</h1>
    <hr><br>

    <div class=connexion>

        <form action="inscription.php" method="post">
            <label for="nom">Nom :</label>
            <input type="text" name="nom" id="nom" placeholder="DELACROIX" required><br><br>
            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" id="prenom" placeholder="Fabrice" required><br><br>
            <label for="mail">E-mail :</label>
            <input type="email" name="mail" id="mail" placeholder="exemple@mail.fr" required><br><br>
            <label for="mdp">Mot de passe :</label>
            <input type="password" name="mdp" id="mdp" placeholder="*****"><br><br>
            <label for="mdp2">Vérification :</label>
            <input type="password" name="verif_mdp" id="mdp2" placeholder="*****"><br><br>
            <input type="submit" value="S'incrire" name="bout">
        </form>

        <?php
        if (isset($erreur)) {
            echo "<h3>$erreur</h3>";
        }
        if (isset($Merci)) {
            echo "<h3>$Merci</h3>";
        }
        ?>
    </div>

</body>

</html>