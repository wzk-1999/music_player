<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include 'conn.php';
if (isset($row['user_name'])) {
    //    echo "SELECT playlist FROM mus_songlist where user_name='" . $_SESSION["uid"] . "'";
    $result = mysqli_query(
        $con
        ,
        "SELECT playlist FROM mus_songlist where user_name='" . $row['user_name'] . "'"
    );
} else if (isset($_SESSION["uid"])) {
    //    echo "SELECT playlist FROM mus_songlist where user_name='" . $_SESSION["uid"] . "'";
    $result = mysqli_query(
        $con
        ,
        "SELECT playlist FROM mus_songlist where user_name='" . $_SESSION["uid"] . "'"
    );
}

?>