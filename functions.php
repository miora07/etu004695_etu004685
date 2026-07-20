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

function get_all_produit() {
    $sql = "SELECT  produit.nom , produit_membre.prix_vente as prix , produit_membre.quantite_dispo as quantite 
    from produit_membre
    join produit 
    on produit_membre.id_produit=produit.id_produit";
    return get_all_lines($sql); 
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


function get_random_songs($limit, $user_id)
{
    $sql = "SELECT 
    s.id,
    s.title,
    ar.name AS artiste,
    al.title AS album,
    SEC_TO_TIME(s.duration) AS duree,
    (l.song_id IS NOT NULL) AS liked
    FROM songs s
    JOIN artists ar ON s.artist_id = ar.id
    JOIN albums al ON s.album_id = al.id
    LEFT JOIN likes l 
        ON l.song_id = s.id 
        AND l.user_id = %d ORDER BY RAND() LIMIT %d";
    $sql = sprintf($sql, $user_id, $limit);
    //echo $sql;
    return get_all_lines($sql);
}

function manage_favorite($user_id, $song_id, $action)
{
    if ($action === 'like') {
        set_favorite($user_id, $song_id);
    } elseif ($action === 'unlike') {
        unset_favorite($user_id, $song_id);
    }
}

function set_favorite($user_id, $song_id)
{
    $sql = "INSERT INTO likes (user_id, song_id) VALUES (%d, %d)";
    $sql = sprintf($sql, $user_id, $song_id);
    mysqli_query(dbconnect(), $sql);
}

function unset_favorite($user_id, $song_id)
{
    $sql = "DELETE FROM likes WHERE user_id=%d AND song_id=%d";
    $sql = sprintf($sql, $user_id, $song_id);
    mysqli_query(dbconnect(), $sql);
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

?>




