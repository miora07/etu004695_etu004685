<?php 
$etu = $_GET['etu'];
$nom = $_GET['nom'];
$photo = $_GET['photo'];
include_once ('functions.php');
inscription($nom,$etu,$photo);
header("Location: index.php");

?>