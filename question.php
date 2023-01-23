<?php
session_start();
if (!isset($_SESSION["idu"])) {

    header("location:connexion.php");
}

$id = mysqli_connect("127.0.0.1", "root", "", "qcm");
$idu = $_SESSION["idu"];
$reqpre = "select * from users where $idu=idu";
$respre = mysqli_query($id, $reqpre);
while ($ligne = mysqli_fetch_assoc($respre)) {
    $prenom = $ligne["prenom"];
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
    <span class="nom">Bonjour <?php echo "$prenom"; ?></span>
    <h1>QCM</h1>

    <div class="qcm">
        <form action="resultat.php" method="post">
            <ul>
                <?php
                $i = 1;
                $req = "select * from questions order by rand() limit 10";
                $res = mysqli_query($id, $req);
                while ($ligne = mysqli_fetch_assoc($res)) {
                    $idq = $ligne["idq"];
                ?>
                    <div class=question>
                        <li>
                            <?= $ligne["libelleQ"] ?>
                            <ul>
                                <?php
                                $req2 = "select libeller, idr, idq from reponses where idq='$idq'";
                                $res2 = mysqli_query($id, $req2);
                                while ($ligne = mysqli_fetch_assoc($res2)) {
                                    $rep = $ligne["idr"];
                                ?>
                                    <li><input type="radio" name="<?= $i ?>" value="<?= $rep ?>" required> <?= $ligne["libeller"] ?></li>
                                <?php
                                }
                                ?>
                            </ul>
                        </li>
                    </div>
                <?php
                    $i = $i + 1;
                }
                ?>
            </ul>
            <input type="submit" value="Valider" style="text-decoration: none;" name="bout">
            <div class="deconnexion">
                <a href="deconnexion.php">
                    Deconnexion
                </a>
            </div>
        </form>

    </div>
</body>

</html>