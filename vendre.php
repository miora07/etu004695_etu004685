<?php
include_once ('functions.php');
$liste = liste_deroulante_vendre();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Veuiller selectionne vos nouveaux articles</h1>
    <form action="traitement_vendre.php" method="get">
    Produit :   <select name="produit" id="">
                    <?php for ($i = 0; $i < count($liste); $i++){ ?>
                        <option value="<?php $i?>"><?php echo $liste[$i]['nom']?></option>
                    <?php } ?>
                </select><br>
    <br>
    Prix : <input type="number" name="prix"> <br>
    <br>
    Quantite : <input type="text" name="qtt">
    <br>
    <br> <input type="submit" value="Mettre en ligne">
</form>
</body>
</html>