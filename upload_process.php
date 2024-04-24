<?php
session_start();
include 'common/conn.php';

// var_dump($_FILES);
// var_dump($_POST);





$name = $_FILES['music']['name'];

$position = strpos($name, ".");

$name = substr($name, 0, $position);
// echo $name;

$sql = "select id from mus_playlists where user_name='$_SESSION[uid]' and playlist='$_POST[playlist]' and music_name='$name'";

$check_query = mysqli_query($con, $sql);
$count_music = mysqli_num_rows($check_query);

if ($count_music > 0) {
    echo "<div class=\"alert alert-danger alert-dismissible fade show w-75 mx-5 my-3\" role=\"alert\">
    you have already add this music in same playlist, upload is senseless
    <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
  </div>";
    exit();
} else {
    $fileName = "music/" . $_SESSION['uid'] . "/" . $_POST['playlist'] . "/";
    if (file_exists($fileName) == false) {
            mkdir("music/" . $_SESSION['uid'] . "/" . $_POST['playlist'], 0755, true);

    }

    move_uploaded_file($_FILES["music"]["tmp_name"], $fileName . $_FILES['music']['name']);



    date_default_timezone_set("America/New_York");
    $date = date('Y-m-d H:i:s');



    $sql = "INSERT INTO mus_playlists(user_name,add_time,playlist,music_name,user_comment) 
VALUES ('$_SESSION[uid]','$date','$_POST[playlist]','$name','$_POST[user_desc]')";

    // echo $sql;
    if (mysqli_query($con, $sql)) {
        echo "upload_success";
        // echo "<script> location.href='store.php'; </script>";
        // header('Location: view_music.php');
        exit();
    }
}

?>