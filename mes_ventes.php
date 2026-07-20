<?php
include("functions.php");
$id_produit = $_GET["id"];
$total = total_vente($id_produit);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes ventes</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="font/bootstrap-icons.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">
                <i class="bi bi-cart-check"></i> Mes ventes
            </h3>
        </div>

        <div class="card-body">

            <table class="table table-bordered table-hover table-striped align-middle text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Membres</th>
                        <th>Total des ventes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($total)) { ?>
                        <?php foreach ($total as $t) { ?>
                            <tr>
                                <td><?= htmlspecialchars($t["nom"]) ?></td>
                                <td>
                                    <span class="badge bg-success fs-6">
                                        <?= htmlspecialchars($t["total"]) ?>
                                    </span>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="2" class="text-muted">
                                Aucune vente trouvée.
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>

        <div class="card-footer text-end">
            <a href="index.php" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Retour
            </a>
        </div>
    </div>
</div>

<script src="js/bootstrap.bundle.min.js"></script>

</body>
</html>