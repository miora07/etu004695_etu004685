<?php
session_start(); 
include_once("functions.php");


if (!isset($_SESSION['id_membre'])){
    header("Location:index.php");exit();
}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un produit</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="font/bootstrap-icons.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow">


                <div class="card-body">

                    <form action="traitement_ajouter.php" method="GET">

                        <div class="mb-3">
                            <label class="form-label">Nom du produit</label>
                            <input type="text" class="form-control" name="nom" value="bonbon">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Catégorie</label>
                            <input type="text" class="form-control" name="nom_categorie" value="snack">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Prix</label>
                            <input type="number" class="form-control" name="prix_reference" value="500">
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" name="perime" value="1" id="perime">
                            <label class="form-check-label" for="perime">
                                Produit périmé
                            </label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-check-circle"></i>
                            Ajouter
                        </button>

                    </form>

                </div>

                <div class="card-footer text-end">
                    <a href="accueil.php" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i>
                        Retour
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
