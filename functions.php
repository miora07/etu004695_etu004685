<?php
function dbconnect()
{
    static $connect = null;
    if ($connect === null) {
        $connect = mysqli_connect('localhost','root','','vente');
        if (!$connect) {
            die('Erreur de connexion à la base de données : ' . mysqli_connect_error());
        }
        mysqli_set_charset($connect, 'utf8mb4');
    }
    return $connect;
}


function login($etu)
{
    $sql = "SELECT * FROM membre WHERE numero_etu ='%s'";
    $sql = sprintf($sql, $etu);
    $req = mysqli_query(dbconnect(),$sql );
    $result = mysqli_fetch_assoc($req);
    mysqli_free_result($req);
    return $result;
       
}
function inscription($nom, $etu,$image)
{
    $sql = "INSERT INTO membre (nom, numero_etu, image_profil) values ('%s','%s','%s')";
    $sql = sprintf($sql, $nom,$etu,$image);
    $req = mysqli_query(dbconnect(),$sql );
}


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




function get_all_produit($tri) {
    $sql = "SELECT membre.id_membre,membre.nom as membre, produit.id_produit,produit.nom ,produit_membre.id_produit_membre,
     produit_membre.prix_vente as prix , produit_membre.quantite_dispo as quantite , produit_membre.photo as photo
    from produit_membre
    join produit 
    on produit_membre.id_produit=produit.id_produit
    join membre 
    on produit_membre.id_membre=membre.id_membre";
    if ($tri == 'produit') {
        $sql =  $sql . " ORDER BY produit.nom";
    }

    if ($tri == 'categorie') {
        $sql = $sql . " ORDER BY produit.id_categorie";
    }

    return get_all_lines($sql);
}
 
function acheter_produit($id_produit,$id_produit_membre,$qte_acheter,$qte_produit){
    if($qte_produit < $qte_acheter ){
        return 1;
    }
    elseif($qte_produit == 0){
        return 0 ;
    }
    else {
        $nv_qte=$qte_produit - $qte_acheter;
        if($nv_qte < 0 ){
            return -1;
        }
        else {
            $vente = "INSERT INTO vente(id_produit_membre,quantite) values($id_produit_membre,$qte_acheter)";
            mysqli_query(dbconnect(), $vente);
            $update="UPDATE produit_membre set quantite_dispo=$nv_qte where id_produit=$id_produit";
            mysqli_query(dbconnect(), $update);
            return 2;
        }

    }
  

}


function liste_deroulante_vendre(){
    $sql = "Select * from produit";
    $req = mysqli_query(dbconnect(),$sql );
    $result = array();
    while ($line = mysqli_fetch_assoc($req)) {
        $result[] = $line;
    }
    mysqli_free_result($req);
    return $result;
}
function total_vente($id_produit){
    $sql = "SELECT membre.nom ,vente.id_produit_membre , SUM(vente.quantite*produit_membre.prix_vente) as total
    from vente
    join produit_membre
    on vente.id_produit_membre=produit_membre.id_produit_membre
    join membre
    on membre.id_membre=produit_membre.id_membre
    where produit_membre.id_produit= '%s' 
    group by produit_membre.id_produit_membre";
    $sql=sprintf($sql,$id_produit);
    return get_all_lines($sql);
}

function stat_categorie(){
    $sql="SELECT categorie.id_categorie, 
    categorie.nom_categorie as nom, 
    SUM(vente.quantite) as total 
    from  categorie
    left join produit
    on produit.id_categorie=categorie.id_categorie
    left join produit_membre 
    on produit_membre.id_produit=produit.id_produit
    left join vente 
    on produit_membre.id_produit_membre=vente.id_produit_membre
    group by categorie.id_categorie ,categorie.nom_categorie
    order by categorie.id_categorie ASC " ;
    return get_all_lines($sql);
}

function stat_produit($id_categorie){
    $sql="SELECT produit.id_produit, 
    produit.nom, 
    SUM(vente.quantite) as total 
    from  produit 
    left join produit_membre 
    on produit_membre.id_produit=produit.id_produit
    left join vente 
    on produit_membre.id_produit_membre=vente.id_produit_membre
    where produit.id_categorie= '%s'
    group by produit.id_categorie ,produit.nom
    order by produit.id_categorie ASC " ;

    $sql = sprintf($sql,$id_categorie);
    return get_all_lines($sql);
}
function stat_membre($id_produit){
    $sql="SELECT membre.id_membre, 
    membre.nom, 
    SUM(vente.quantite) as total 
    from  membre 
    left join produit_membre
    on  membre.id_membre = produit_membre.id_membre
    left join vente 
    on produit_membre.id_produit_membre=vente.id_produit_membre
    where produit_membre.id_produit= '%s'
    group by membre.id_membre ,membre.nom
    order by membre.id_membre ASC " ;

    $sql = sprintf($sql,$id_produit);
    return get_all_lines($sql);
}
function vendre($id_produit,$id_member,$prix,$qtt,$image){
    $date = date("Y-m-d");


    if (empty($image)) {
        $image = "upload/default_pic.png"; 
    }

    $sql = "UPDATE produit_membre set prix_vente=%f,quantite_dispo=%d,date_dispo='%s',photo='%s' 
    where id_produit=%d and id_membre=%d";

    $sql = sprintf($sql,$prix,$qtt,$date,$image,$id_produit,$id_member);
    mysqli_query(dbconnect(),$sql);
}

function upload($fichier){
    if (empty($fichier["name"])) {
        return null;
    }

    $dossier = "uploads/";
    $nom = $fichier["name"];
    $tmp = $fichier["tmp_name"];

    $extension = strtolower(pathinfo($nom, PATHINFO_EXTENSION));
    $autorise = ["jpg","jpeg","png"];
    if(!in_array($extension, $autorise)){
        die("Format non autorise");
    }
    $nv_nom = time() . "_" . rand(100,999) . "." . $extension;
    $chemin = $dossier . $nv_nom;
    move_uploaded_file($tmp, $chemin);
    return $chemin;
}
function get_id_categorie_by_nom($nom_categorie){
    $sql = "SELECT id_categorie from categorie where nom_categorie='%s'";
    $sql=sprintf($sql,$nom_categorie);
    return get_one_line($sql);
}

function ajouter_produit($nom,$nom_categorie,$prix_reference){
    $id_categorie = get_id_categorie_by_nom($nom_categorie);
    if (empty($id_categorie)){
        $sql = "INSERT INTO categorie(nom_categorie) values('%s')";
        $sql = sprintf($sql,$nom_categorie);
        mysqli_query(dbconnect(),$sql);
        $id_categorie = get_id_categorie_by_nom($nom_categorie);
    }
    $sql2 = "INSERT INTO produit(nom,id_categorie,prix_reference) values('%s',%d,%f)";
    $sql2 = sprintf($sql2,$nom,$id_categorie['id_categorie'],$prix_reference);
      mysqli_query(dbconnect(),$sql2);
}



