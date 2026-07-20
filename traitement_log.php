<?php 
$etu = $_GET['etu'];
include_once ('functions.php');
$resultat = login($etu);


if (isset($resultat)){
    header("Location: acceuil.php");
}
else{
    header("Location: inscription.php");
}
?>