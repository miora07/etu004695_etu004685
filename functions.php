<?php
include_once 'connection.php';

function get_all_lines($sql){
    $req = mysqli_query(dbconnect(),$sql );
    $result = array();
    while ($line = mysqli_fetch_assoc($req)) {
        $result[] = $line;
    }
    mysqli_free_result($req);
    return $result;
}

function get_one_line($sql){
    $req = mysqli_query(dbconnect(),$sql );
    $result = mysqli_fetch_assoc($req);
    mysqli_free_result($req);
    return $result;
}

function checkLogin($email, $password)
{
    $sql = "SELECT * FROM users WHERE email='%s' AND password='%s'";
    $sql = sprintf($sql, $email, $password);
    return get_one_line($sql);
}




function get_all_produit() {
    $sql = "SELECT  produit.nom , produit_membre.prix_vente as prix , produit_membre.quantite_dispo as quantite 
    from produit_membre
    join produit 
    on produit_membre.id_produit=produit.id_produit";
    return get_all_lines($sql); 
}

?>