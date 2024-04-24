<?php
session_start();
include 'common/header.php';
include 'common/footer.html';
if (isset($_SESSION["uid"])) {
    ?>
    <div class="me-5">
        <table class="table table-info table-striped mt-4 ms-3">
            <tr>
                <th>playList</th>
                <th>music_name</th>
                <th>add_time</th>
                <th>desc</th>
                <th class="w-50 text-center">audio</th>
            </tr>

            <?php
            include 'common/conn.php';


            $result = mysqli_query(
                $con
                ,
                "SELECT * FROM mus_playlists where id=" . $_GET['id']
            );

            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td class='align-middle'>" . $row['playlist'] . "</td><td class='align-middle'>" . $row['music_name'] . "</td><td class='align-middle'>"
                    . $row['add_time'] . "</td><td class='align-middle'>" . $row['user_comment'] . "</td>";
                $src = "music/" . $row['user_name'] . "/" . $row['playlist'] . "/" . $row['music_name'] . ".*";
                echo "<td class='align-middle'><audio controls class='w-100'>
                <source src='" . glob($src)[0] . "'>
              Your browser does not support the audio element.
              </audio></td > ";


                echo "</tr > ";
            }
            echo "</table > ";
            mysqli_close($con);
            ?>
        </table>
    </div>
    <?php
} else {
    include "common/alert.html";
    // sleep(2);
    $_SESSION["originalPage"] = "detail.php?id=" . $_GET['id'];
    echo "<script>setTimeout(function(){window.location.href='login.php'},1500)</script>";
}
?>