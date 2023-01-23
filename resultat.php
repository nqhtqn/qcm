<?php
    session_start();
    if(!isset($_SESSION["idu"])){

        header("location:connexion.php");
    }

    $id=mysqli_connect("127.0.0.1","root","","qcm");
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
<div class="reponses">
    <?php
        $note=0;
        for($i=1;$i<=10;$i++){
            $rep = $_POST["$i"];
            $req="select idr, verite from reponses where idr='$rep'";
            $res=mysqli_query($id,$req);                            
            while($ligne=mysqli_fetch_assoc($res)){
                if($ligne["verite"]==1){
                    $note=$note+2;
                }
            }
        }
    ?>
    <div class=note>
        Vous avez eu une note de <?=$note?>/20
    </div>

    <?php
        if($note!=20){
            echo "<hr><span class=reponse>Voici vos mauvaises réponses :</span>";
        }
    ?>

    <?php
        for($i=1;$i<=10;$i++){  
            $rep = $_POST["$i"];
            $req="select idr, idq, verite from reponses where idr='$rep'";
            $res=mysqli_query($id,$req);                            
            while($ligne=mysqli_fetch_assoc($res)){

                $idq=$ligne["idq"];
                if($ligne["verite"]!=1){

                    $reqq="select idr,libelleQ from reponses, questions where idr='$rep' and reponses.idq=questions.idq";
                    $resq=mysqli_query($id,$reqq);
                    while($ligneq=mysqli_fetch_assoc($resq)){

                        $question=$ligneq["libelleQ"];
                        echo "<div class=correction> <span class=questionss> $question </span> <br>";

                        $reqr="select libeller, idr, idq, verite from reponses where idq='$idq'";
                        $resr=mysqli_query($id,$reqr);                            
                        while($ligne=mysqli_fetch_assoc($resr)){

                            $libeller=$ligne["libeller"];
                            if($ligne["verite"]==1){
                                echo "<span class=vrai>$libeller</span><br>";
                            }elseif($rep==$ligne["idr"]){
                                echo "<span class=faux>$libeller</span><br>";
                            }else{
                                echo "<span class=neutre>$libeller</span><br>";
                            }
                        }echo "</div><br>";
                    }
                }
            }
        }
        $idu=$_SESSION["idu"];
        $req="insert into resultats values (null,'$idu','$note',now())";
        $resultat=mysqli_query($id, $req);
    ?>
    <div class="deconnexion">
        <a href="deconnexion.php">
            Deconnexion
        </a>
    </div>
</div>
</body>
</html>