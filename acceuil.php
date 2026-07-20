<?php
session_start();
include_once("functions.php");

$id_membre = $_SESSION['id_membre'];
$produits = get_all_produit();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="font/bootstrap-icons.css">
</head>
<body class="bg-light">

<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Liste des produits</h2>

        <div>
            <a href="vendre.php" class="btn btn-success me-2">
                <i class="bi bi-plus-circle"></i>
                Vendre un nouveau produit
            </a>
            <a href="ajout_modif.php" class="btn btn-success me-2">
                <i class="bi bi-plus-circle"></i>
                Ajout/Modifier
            </a>

            <a href="stat.php" class="btn btn-success me-2">
                <i class="bi bi-bar-chart"></i>
                Voir statistiques
            </a>
        </div>
    </div>

    <div class="row">

        <?php foreach ($produits as $p) { ?>

            <div class="col-md-6 col-lg-4 mb-4">

                <div class="card shadow h-100">

                    
                    <div class="bg-light border d-flex justify-content-center align-items-center"
                         style="height:220px;">
                        <div class="text-center text-secondary">
                            <i class="bi bi-image fs-1"></i>
                            <p class="mt-2 mb-0">Image du produit</p>
                        </div>
                    </div>

                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><?= $p["nom"] ?></h5>
                    </div>

                    <div class="card-body">

                        <p>
                            <strong>Vendeur :</strong>
                            <?= $p["membre"] ?>
                        </p>

                        <p>
                            <strong>Prix :</strong>
                            <span class="badge bg-success">
                                <?= $p["prix"] ?> Ar
                            </span>
                        </p>

                        <p>
                            <strong>Stock :</strong>
                            <span class="badge bg-secondary">
                                <?= $p["quantite"] ?>
                            </span>
                        </p>

                        <form action="acheter.php" method="get">

                            <div class="mb-3">
                                <label class="form-label">
                                    Quantité à acheter
                                </label>

                                <input
                                    type="number"
                                    class="form-control"
                                    name="quantite"
                                    value="1"
                                    min="1"
                                    max="<?= $p["quantite"] ?>">
                            </div>

                            <input type="hidden" name="id_produit" value="<?= $p["id_produit"] ?>">
                            <input type="hidden" name="id_produit_membre" value="<?= $p["id_produit_membre"] ?>">
                            <input type="hidden" name="stock" value="<?= $p["quantite"] ?>">

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-cart-plus"></i>
                                    Acheter
                                </button>
                            </div>

                        </form>

                    </div>

                    <?php if ($p["id_membre"] == $id_membre) { ?>
                        <div class="card-footer text-center">
                            <a href="mes_ventes.php?id=<?= $p["id_produit"] ?>" class="btn btn-warning">
                                <i class="bi bi-bar-chart"></i>
                                Voir mes ventes
                            </a>
                        </div>
                    <?php } ?>

                </div>

            </div>

        <?php } ?>

    </div>

</div>

<script src="js/bootstrap.bundle.min.js"></script>

</body>
</html>