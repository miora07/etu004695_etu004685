<?php
include_once('functions.php');
$liste = liste_deroulante_vendre();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendre un article</title>

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
                        <i class="bi bi-cart-plus"></i> Mettre un article en vente
                    </h3>
                </div>

                <div class="card-body">

                    <form action="traitement_vendre.php" method="post" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label class="form-label">Produit</label>
                            <select name="produit" class="form-select">
                                <?php for ($i = 0; $i < count($liste); $i++) { ?>
                                    <option value="<?= $liste[$i]["id_produit"] ?>">
                                        <?= $liste[$i]['nom'] ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Prix</label>
                            <input type="number" name="prix" class="form-control" placeholder="Entrez le prix" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Photo</label>
                            <input type="file" name="photo" class="form-control" >
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Quantité</label>
                            <input type="number" name="qtt" class="form-control" placeholder="Entrez la quantité" min="1" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-upload"></i> Mettre en ligne
                            </button>
                        </div>

                    </form>

                </div>

                <div class="card-footer text-end">
                    <a href="acceuil.php" class="btn btn-secondary">
                        <i class="bi bi-arrow-left"></i> Retour
                    </a>
                </div>

            </div>

        </div>
    </div>
</div>

<script src="js/bootstrap.bundle.min.js"></script>

</form>
</body>
</html>