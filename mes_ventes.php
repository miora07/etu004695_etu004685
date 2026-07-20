<?php
include("functions.php");
$id_produit=$_GET["id"];
$total=total_vente($id_produit);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes ventes</title>
</head>
<body>
    <table border="1">
        <tr>
            <th>Membres</th>
            <th>Total</th>
        </tr>
        <tr>
        <?php foreach($total as $t) { ?>
            <td><?=$t["nom"]?></td>
            <td><?=$t["total"]?></td>
        <?php } ?>
        </tr>
    </table>
</body>
</html>