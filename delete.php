<?php
session_start();
include 'common/header.php';
include 'common/footer.html';

function deleteDirectory($dir)
{
    if (!file_exists($dir)) {
        return true;
    }

    if (!is_dir($dir)) {
        return unlink($dir);
    }

    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') {
            continue;
        }

        if (!deleteDirectory($dir . DIRECTORY_SEPARATOR . $item)) {
            return false;
        }

    }

    return rmdir($dir);
}


if (isset($_SESSION["uid"])) {
    include 'common/conn.php';

    $sql = "select * FROM mus_playlists WHERE id=" . $_GET['id'] . ";";

    // echo $sql;
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    if ($row !== null) {
        // var_dump($row);
        $file = "music/" . $row['user_name'] . "/" . $row['playlist'] . "/" . $row['music_name'] . ".*";
        // echo $file;
        array_map('unlink', glob($file));
        // unlink($file);


        $sql = "DELETE FROM mus_playlists WHERE id='" . $_GET['id'] . "';";

        if (mysqli_query($con, $sql)) {
            echo '<div class="alert alert-primary alert-dismissible fade show w-75 mx-5 my-3" role="alert">
             music <strong>' . $row['music_name'] . '</strong> in palylist <b class="text-warning">' . $row['playlist'] . '</b> has successful deleted!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>

    <div class="container text-center mt-5">   
        <div class="row gx-5"> 
            <div class="col">   
            <button type="button" class="btn btn-secondary"><a href="view_music.php" class="link-light fw-bold link-underline link-underline-opacity-0">back to view</a></button>
            </div> 
            <div class="col">
            <button type="button" class="btn btn-info"><a href="view_music.php?playlist=' . $row['playlist'] . '" class="link-light fw-bold link-underline link-underline-opacity-0">back to previous</a></button>
            </div>
        </div>
    </div>
    ';

        } else {
            die(mysqli_error($con));
        }

        $sql = "select count(id) song_in_this_user_and_playlist FROM mus_playlists WHERE user_name='" . $row['user_name'] . "' and playlist='" . $row['playlist'] . "';";
        // echo $sql;
        $result = mysqli_query($con, $sql);
        $check_row = mysqli_fetch_array($result);
        // echo $check_row[0];
        if ($check_row[0] == 0) {
            // there is no file in this user and same playlist, so delete the folder
            $dir = "music/" . $row['user_name'] . "/" . $row['playlist'];
            deleteDirectory($dir);
        }


        $sql = "select count(id) song_in_this_user FROM mus_playlists WHERE user_name='" . $row['user_name'] . "';";
        $result = mysqli_query($con, $sql);
        $check_row = mysqli_fetch_array($result);
        // echo $check_row[0];
        if ($check_row[0] == 0) {
            // there is no file in this user, so delete the folder
            $dir = "music/" . $row['user_name'];
            deleteDirectory($dir);
        }
    }



    mysqli_close($con);
    ?>

    <?php
} else {
    include "common/alert.html";
    // sleep(2);
    $_SESSION["originalPage"] = "delete.php";
    echo "<script>setTimeout(function(){window.location.href='login.php'},1500)</script>";
}
?>