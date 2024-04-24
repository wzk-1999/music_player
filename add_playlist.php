<?php

session_start();

include 'common/conn.php';
if (isset($_SESSION["uid"]) and isset($_POST["playlist"])) {
    //    echo "SELECT playlist FROM mus_songlist where user_name='" . $_SESSION["uid"] . "'";
    $result = mysqli_query(
        $con
        ,
        "SELECT playlist FROM mus_songlist where user_name='" . $_SESSION["uid"] . "' and playlist='" . $_POST["playlist"] . "'"
    );

    if (mysqli_num_rows($result) > 0) {
        echo "<div class=\"alert alert-warning alert-dismissible fade show w-75 mx-5 my-3\" role=\"alert\">
    the playlist <strong>" . $_POST['playlist'] . "</strong> already exists, please add again or cancel
    <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
  </div>";
    } else {

        date_default_timezone_set("America/New_York");
        $date = date('Y-m-d H:i:s');

        $result = mysqli_query(
            $con
            ,
            "insert into mus_songlist(user_name,playlist,add_time) 
            VALUES ('$_SESSION[uid]','$_POST[playlist]','$date')"
        );

        echo "<div class=\"alert alert-success alert-dismissible fade show w-75 mx-5 my-3\" role=\"alert\">
        playlist <strong>" . $_POST['playlist'] . "</strong> has been successfully added! <b>refresh</b> the page to choose new playlist<button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
      </div>";
    }
}

?>