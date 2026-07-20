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
   
    <?php foreach ($produits as $p) { ?>
        <h1> Nom: <?php echo $p["nom"]; ?> </h1>
        <h1> Prix :<?php echo $p["prix"]; ?></h1>
        <form action="acheter.php" method="get">
        <h1> Quantite a acheter  : <input type="text" name="quantite" value=1> </h1>
        <h1>Stock : <?= $p["quantite"]?></h1>
     

       
        <input type="hidden" name="id_produit" value="<?=$p["id_produit"]?>">
        <input type="hidden" name="stock" value="<?=$p["quantite"]?>">
        <input type="submit" value="Acheter" >
        </form>
        <p> ======</p>
        
    <?php }?>
    
    </body>
</html>