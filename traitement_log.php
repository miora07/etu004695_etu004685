<?php 
session_start();
$etu = $_GET['etu'];
include_once ('functions.php');
$resultat = login($etu);
if (isset($resultat)){
    $_SESSION['id_membre'] = $resultat['id_membre'];
    header("Location: acceuil.php");
}
else{
    header("Location: inscription.php");
}
?>