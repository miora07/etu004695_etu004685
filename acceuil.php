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
        <h1>Membre:  <?php echo $p["membre"]; ?> </h1>
        <h1> Nom: <?php echo $p["nom"]; ?> </h1>
        <h1> Prix :<?php echo $p["prix"]; ?></h1>
        <form action="acheter.php" method="get">
        <h1> Quantite a acheter  : <input type="text" name="quantite" value=1> </h1>
        <h1>Stock : <?= $p["quantite"]?></h1>
     


        <input type="hidden" name="i   group by membred_produit" value="<?=$p["id_produit"]?>">
        <input type="hidden" name="stock" value="<?=$p["quantite"]?>">
        <input type="submit" value="Acheter" >
        <h1><a href="mes_ventes.php?id=<?=$p["id_membre"]?>">Voir mes ventes</a></h1>
        <p>=================================================================================</p>
        </form>
        
        
    <?php }?>
  
    
    </body>
</html>