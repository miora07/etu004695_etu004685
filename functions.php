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
function get_all_produit() {
    $sql = "SELECT membre.id_membre,membre.nom as membre, produit.id_produit,produit.nom , produit_membre.prix_vente as prix , produit_membre.quantite_dispo as quantite 
    from produit_membre
    join produit 
    on produit_membre.id_produit=produit.id_produit
    join membre 
    on produit_membre.id_membre=membre.id_membre
 ";
    return get_all_lines($sql); 

}
function acheter_produit($id,$qte_acheter,$qte_produit){
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
            $update="UPDATE produit_membre set quantite_dispo=$nv_qte where id_produit=$id";
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
// function vendre ($id_produit,$id_member,$prix,$qtt,$photo = null){
//     if(empty($photo)){
//         $req =  mysqli_query(dbconnect(), "SELECT photo FROM produit WHERE id_produit = $id_produit");
//         $p = mysqli_fetch_assoc($req);
//         $photo = $p['photo'];
//     }
//     $photo = mysqli_real_escape_string(dbconnect(), $photo);
//     if(empty($photo)){
//         $photo_sql = "uploads/default.jpeg";
//     }else {
//         $photo_sql = "'$photo'";
//     }
//     $sql = "INSERT INTO produit_membre (id_produit, id_membre, prix_vente, quantite_dispo, date_dispo) VALUES (%d,%d,%f,%d,NOW(),%s";
//     $sql = sprintf($sql, $id_produit,$id_member,$prix,$qtt,$photo_sql);
//     $req = mysqli_query(dbconnect(),$sql);
//     if(!$req){
//         die("Erreur SQL:" . mysqli_error(dbconnect()));
//     }
//     return $req;
// }
function vendre($id_produit,$id_member,$prix,$qtt,$image){
        $date = date("Y-m-d");
        $sql = "INSERT INTO 
        produit_membre(id_produit, id_membre, prix_vente, quantite_dispo, date_dispo,photo)
         VALUES (%d,%d,%f,%d,'%s','%s')";
       $sql = sprintf($sql, $id_produit,$id_member,$prix,$qtt,$date,$image);
       mysqli_query(dbconnect(),$sql);
}

// function upload ($fichier, $dossier="uploads/"){
//     if(!isset($fichier) || $fichier['error'] !== UPLOAD_ERR_OK){
//         return null;
//     }
//     $maxSize = 2 * 1024 *1024;
//     $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/png' ,'image/webp'];
//     if($fichier['size'] > $maxSize){
//         die('Erreur: l\Le fichier est trop volumineux');
//     }
//     $info = finfo_open(FILEINFO_MIME_TYPE);
//     $mime = finfo_file($info, $fichier['tmp_name']);
//     finfo_close($info);

//     if(!in_array($mime, $allowedMimeTypes)){
//         die('Erreur: Type de fichier non autorise');
//     }

//     if(!is_dir($dossier)){
//         mkdir($dossier, 0777, true);
//     }

//     $extension = pathinfo($fichier['name'], PATHINFO_EXTENSION);
//     $newName = uniqid() . '.' . $extension;
//     $chemin = $dossier . $newName;

//     if(move_uploaded_file($fichier['tmp_name'], $chemin)){
//         return $chemin;
//     } else {
//         die("Erreur: Echec du deplacement du fichier .");
//     }
// }


function upload($fichier){
    $dossier = "uploads/";
    $nom = $fichier["name"];
    $tmp=$fichier["tmp_name"];

    $extension =strtolower(pathinfo($nom,PATHINFO_EXTENSION));
    $autorise =["jpg","jpeg","png"];
    if(!in_array($extension , $autorise)){
        die("Format non autorise");
    }
    $nv_nom=time() . "_" . rand(100,999) . "." .$extension;
    $chemin = $dossier . $nv_nom;
    move_uploaded_file($tmp,$chemin);
    return $chemin;

}




?>




