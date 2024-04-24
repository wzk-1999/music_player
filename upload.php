<?php
session_start();
include 'common/header.php';
include 'common/footer.html';
if (isset($_SESSION["uid"])) {
    ?>

    <body>
        <div id="alert_head"></div>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">add new playlist</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" onsubmit="return false" id="add_playlist">
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">playlist name</label>
                                <input type="text" class="form-control" id="recipient-name" name="playlist" required>
                            </div>

                            <button type="button" class="btn btn-secondary me-3" data-bs-dismiss="modal"
                                id="cancel">cancel</button>
                            <button type="submit" class="btn btn-primary ms-3" id="confirm">confirm</button>
                    </div>
                    </form>
                </div>

            </div>
        </div>

        <!-- action="upload_process.php" -->
        <form method="post" class="ms-5 ps-5" enctype="multipart/form-data" onsubmit="return upload_music()"
            id="upload_form">

            <div class="input-group w-75 p-5">
                <input type="file" class="form-control" id="inputGroupFile02" accept="audio/*" required name="music"
                    onfocus="remove_alert()">
                <label class="input-group-text" for="inputGroupFile02">Upload</label>
            </div>
            <div class="input-group mb-3 w-75 p-5">
                <label class="input-group-text" for="inputGroupSelect01">Playlist</label>
                <select class="form-select" id="inputGroupSelect01" required name="playlist" onclick="add_new_playlist()">
                    <option selected hidden disabled>Choose the playlist your want to add...</option>
                    <?php
                    include 'common/playlists.php';
                    //            echo mysqli_num_rows($result);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_array($result)) {
                            //                        echo $row['playlist'];
                            echo "<option value='$row[0]'>$row[0]</option>";
                        }

                    }
                    ?>


                </select>
            </div>
            <div class="input-group w-75 p-5">
                <span class="input-group-text">your desc</span>
                <textarea class="form-control" aria-label="With textarea" placeholder="about this song" name="user_desc"
                    onfocus="remove_alert()"></textarea>
            </div>
            <div class="container text-center">
                <div class="row">
                    <div class="col-6 offset-1 align-self-center">
                        <button type="submit" class="btn btn-info w-25">ok</button>
                    </div>
                </div>
            </div>

        </form>

    </body>

    <script src="jsFile/upload.js"></script>


    <?php
} else {
    include "common/alert.html";
    // sleep(2);
    $_SESSION["originalPage"] = "upload.php";
    echo "<script>setTimeout(function(){window.location.href='login.php'},1500)</script>";
}
?>