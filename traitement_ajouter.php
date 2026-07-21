<?php 
session_start();
include_once("functions.php");

if (!isset($_SESSION['id_membre'])){
    header("Location:index.php");
    exit();
}

$nom = $_GET["nom"];
$nom_categorie = $_GET["nom_categorie"];
$prix_reference = $_GET["prix_reference"];

$ajout = ajouter_produit($nom, $nom_categorie, $prix_reference);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produit ajouté</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="font/bootstrap-icons.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow">

                <div class="card-header bg-success text-white">
                    <h3 class="mb-0">
                        <i class="bi bi-check-circle"></i>
                        Succès
                    </h3>
                </div>

                <div class="card-body text-center">

                    <h4 class="text-success mb-3">
                        Produit ajouté avec succès !
                    </h4>

                    <a href="acceuil.php" class="btn btn-primary">
                        <i class="bi bi-house-door"></i>
                        Retour à l'accueil
                    </a>

                </div>

            </div>

        </div>

    </div>
</div>

<script src="js/bootstrap.bundle.min.js"></script>

</body>
</html>
```
