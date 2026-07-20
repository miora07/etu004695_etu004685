<?php 
include_once("functions.php");
$produits=get_all_produit();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceuil</title>
</head>
<body>
<a href="vendre.php"> Vendre des nouveaux produit</a>
    <?php foreach ($produits as $p) { ?>
   
        <h1> Nom: <?php echo $p["nom"]; ?> </h1>
        <h1> Prix :<?php echo $p["prix"]; ?></h1>
        <h1> Quantite :<?php echo $p["quantite"]; ?> </h1>
        <p> ======</p>
    <?php }?>
    </body>
</html>