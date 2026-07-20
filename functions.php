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
?>