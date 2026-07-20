<?php 
include_once("functions.php");
$id=$_GET["id_produit"];
$qte_produit=$_GET["stock"];
$qte_acheter=$_GET["quantite"];
$achat=acheter_produit($id,$qte_acheter,$qte_produit);
if(($achat == 1)){ ?>
    <h1>Pas assez de stock</h1>
<?php } 
 elseif($achat == 0){ ?>
    <h1> Rupture de stock</h1>
<?php } 
 else { ?>
    <h1>Achat effectuer</h1>
<?php } ?>
<a href="acceuil.php">Revenir vers page d'achat</a>