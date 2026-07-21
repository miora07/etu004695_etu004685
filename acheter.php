<?php 
include_once("functions.php");

$id_produit = $_GET["id_produit"];
$id_produit_membre = $_GET["id_produit_membre"];
$qte_produit = $_GET["stock"];
$qte_acheter = $_GET["quantite"];

$achat = acheter_produit($id_produit, $id_produit_membre, $qte_acheter, $qte_produit);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Résultat de l'achat</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="font/bootstrap-icons.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">
                        <i class="bi bi-cart-check"></i> Résultat de l'achat
                    </h3>
                </div>

                <div class="card-body">

                    <?php if ($achat == 1) { ?>
                        <div class="alert alert-warning text-center">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            <strong>Pas assez de stock.</strong>
                        </div>

                    <?php } elseif ($achat == 0) { ?>
                        <div class="alert alert-danger text-center">
                            <i class="bi bi-x-circle-fill"></i>
                            <strong>Rupture de stock.</strong>
                        </div>

                    <?php } else { ?>
                        <div class="alert alert-success text-center">
                            <i class="bi bi-check-circle-fill"></i>
                            <strong>Achat effectué avec succès !</strong>
                        </div>
                    <?php } ?>

                    <div class="text-center mt-4">
                        <a href="acceuil.php" class="btn btn-primary">
                            <i class="bi bi-arrow-left"></i> Retour à l'accueil
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

<script src="js/bootstrap.bundle.min.js"></script>

</body>
</html>