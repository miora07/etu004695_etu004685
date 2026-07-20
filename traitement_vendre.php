<?php
include_once ('functions.php');
session_start();
$id = $_SESSION['id_membre'];
echo $id;
?>