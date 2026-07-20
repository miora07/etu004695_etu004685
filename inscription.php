<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="font/bootstrap-icons.css">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow">
                <div class="card-header bg-primary text-white text-center">
                    <h3><i class="bi bi-person-plus-fill"></i> Inscription</h3>
                </div>

                <div class="card-body">
                    <form action="traitement_inscription.php" method="get">

                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrez votre nom" required>
                        </div>

                        <div class="mb-3">
                            <label for="etu" class="form-label">ETU</label>
                            <input type="text" class="form-control" id="etu" name="etu" placeholder="Numéro ETU" required>
                        </div>

                        <div class="mb-3">
                            <label for="photo" class="form-label">Photo</label>
                            <input type="text" class="form-control" id="photo" name="photo" placeholder="Nom ou chemin de la photo">
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">
                                <i class="bi bi-check-circle"></i> Valider
                            </button>
                        </div>

                    </form>
                </div>

            </div>

        </div>
    </div>
</div>

<script src="js/bootstrap.bundle.min.js"></script>

</body>
</html>