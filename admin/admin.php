<?php
session_start();
include '../common/header.php';
include '../common/footer.html';
if (isset($_SESSION["uid"]) && $_SESSION["uid"] === "Admin@conestogac.on.ca") {
    ?>
    <div class="me-5">
        <table class="table table-striped table-primary table-hover mt-4 ms-3">
            <tr>
                <th>user</th>
                <th>playList</th>
                <th>music_name</th>
                <th>add_time</th>
                <th>Action</th>
            </tr>

            <?php
            include '../common/conn.php';


            $result = mysqli_query(
                $con
                ,
                "SELECT * FROM mus_playlists order by user_name,playlist,add_time desc;"
            );


            while ($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>" . $row['user_name'] . "</td><td>" . $row['playlist'] . "</td><td>" . $row['music_name'] . "</td><td>"
                    . $row['add_time'] . "</td>";

                echo "<td><a href='../detail.php?id=" . $row['id'] . "' class='mx-3'> <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' 
        class='bi bi-eye-fill' viewBox='0 0 16 16'>
        <path d = 'M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0' />
        <path d = 'M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7' />
    </svg ></a >
            <a href = '../edit.php?id=" . $row['id'] . "' class='mx-3' > <svg xmlns = 'http://www.w3.org/2000/svg' width = '16' height = '16' fill = 'currentColor' class='bi bi-pencil-fill' viewBox = '0 0 16 16' >
          <path d = 'M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z' />
        </svg ></a >
            <a href = '../delete.php?id=" . $row['id'] . "' class='mx-3' > <svg xmlns = 'http://www.w3.org/2000/svg' width = '16' height = '16' fill = 'currentColor' class='bi bi-trash-fill' viewBox = '0 0 16 16' >
          <path d = 'M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0' />
        </svg ></a ></td > ";


                echo "</tr > ";
            }
            echo "</table > ";
            mysqli_close($con);
            ?>
        </table>
    </div>


    <?php
} else {
    include "../common/alert_admin.html";
    // sleep(2);
    $_SESSION["originalPage"] = "admin/admin.php";
    echo "<script>setTimeout(function(){window.location.href='../login.php'},1500)</script>";
}
?>