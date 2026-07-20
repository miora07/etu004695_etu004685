<?php
include_once ('functions.php');
session_start();
if (!isset($_SESSION['id_membre'])){
    header("Location: index.php"); exit();
}
$id_membre = $_SESSION['id_membre'];
$id_produit =$_GET['produit'];
$prix = $_GET['prix'];
$qtt = $_GET['qtt'];
if(empty($id_produit)){
    die("Veuillez choisir un produit");
}
vendre($id_produit,$id_membre,$prix,$qtt);
header("Location: acceuil.php");
?>