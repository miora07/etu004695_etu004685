<?php 
include_once("functions.php");
$id_produit =$_GET["id_produit"];
$stat = stat_membre($id_produit);

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistique</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="font/bootstrap-icons.css">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">
            <h3 class="mb-0">
                <i class="bi bi-bar-chart"></i>
                Statistique par membre
            </h3>
        </div>

        <div class="card-body">

            <table class="table table-bordered table-striped table-hover text-center align-middle">

                <thead class="table-dark">
                    <tr>
                        <th>Membre</th>
                        <th>Total</th>
                    </tr>
                </thead>

                <tbody>

                <?php foreach($stat as $s) { ?>

                    <tr>

                        <td>
                            <a href="stat_membre.php?id_produit=<?= $s["id_produit"] ?>" 
                               class="text-decoration-none">
                                <i class="bi bi-folder"></i>
                                <?= $s["nom"] ?>
                            </a>
                        </td>

                        <td>
                            <span class="badge bg-success fs-6">
                                <?= $s["total"] ?? 0 ?>
                            </span>
                        </td>

                    </tr>

                <?php } ?>

                </tbody>

            </table>

        </div>

        <div class="card-footer text-end">

            <a href="accueil.php" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i>
                Retour
            </a>

        </div>

    </div>

</div>


<script src="js/bootstrap.bundle.min.js"></script>

</body>
</html>