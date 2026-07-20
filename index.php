<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="font/bootstrap-icons.css">
</head>

<body class="bg-light">

    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card shadow p-4" style="width: 400px;">
            <h2 class="text-center mb-4">Log in</h2>

            <form action="traitement_log.php" method="get">

                <div class="mb-3">
                    <label for="etu" class="form-label">ETU</label>
                    <input type="text" class="form-control" id="etu" name="etu" value="etu004695" placeholder="Entrez votre numéro étudiant">
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">
                        Valider
                    </button>
                </div>

            </form>
        </div>
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>

</html>