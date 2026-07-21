<?php
include_once ('functions.php');
session_start();
if (!isset($_SESSION['id_membre'])){
    header("Location: index.php"); exit();
}
$id_membre = $_SESSION['id_membre'];
$id_produit =$_POST['produit'];
$prix = $_POST['prix'];
$qtt = $_POST['qtt'];

// traitement photo
$chemin_photo = upload($_FILES['photo']);
($chemin_photo);

if(empty($id_produit)){
    die("Veuillez choisir un produit");
}

(vendre($id_produit,$id_membre,$prix,$qtt,$chemin_photo));
 header("Location: acceuil.php");
?>