<?php
session_start();
include 'common/header.php';
include 'common/footer.html';
include 'common/conn.php';

// echo isset($_POST['id']);
if (isset($_POST['id'])) {
    date_default_timezone_set("America/New_York");
    $date = date('Y-m-d H:i:s');

    $sql = "update mus_playlists set music_name='" . $_POST['song_name'] . "',playlist='" . $_POST['playlist_change'] . "',user_comment='" . $_POST['change_desc'] . "',update_time='" . $date . "' where id=" . $_POST['id'];
    // echo $sql;

    mysqli_query($con, $sql) or die(mysqli_error($con));

    if ($_GET['oldSongName'] != $_POST['song_name']) {
        $oldName = "music/" . $_POST['user_name'] . "/" . $_GET['oldPlayList'] . "/" . $_GET['oldSongName'] . ".*";
        // echo $oldName;
        $position = strpos(basename(glob($oldName)[0]), ".");
        $extension = substr(basename(glob($oldName)[0]), $position + 1);
        // echo $extension;

        $newName = "music/" . $_POST['user_name'] . "/" . $_GET['oldPlayList'] . "/" . $_POST['song_name'] . "." . $extension;
        rename(glob($oldName)[0], $newName);

        if ($_GET['oldPlayList'] != $_POST['playlist_change']) {
            $oldName = "music/" . $_POST['user_name'] . "/" . $_GET['oldPlayList'];
            $newName = "music/" . $_POST['user_name'] . "/" . $_POST['playlist_change'];
            rename($oldName, $newName);
        }
    }

    echo "<div class=\"alert alert-success alert-dismissible fade show w-75 mx-5 my-3\" role=\"alert\">
    edit music (id=<b class='text-warning'>" . $_POST['id'] . "</b>) information successfully !
    <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
  </div>";

    echo '<div class="container text-center mt-5">   
  <div class="row gx-5"> 
      <div class="col">   
      <button type="button" class="btn btn-secondary"><a href="view_music.php" class="link-light fw-bold link-underline link-underline-opacity-0">back to view</a></button>
      </div> 
      <div class="col">
      <button type="button" class="btn btn-info"><a href="edit.php?id=' . $_POST['id'] . '" class="link-light fw-bold link-underline link-underline-opacity-0">back to edit</a></button>
      </div>
  </div>
</div>';

    // unset($_POST['id']);
    // $_POST = array();


} else {
    if (isset($_SESSION["uid"]) and isset($_GET['id'])) {

        $result = mysqli_query($con, "SELECT * FROM mus_playlists where id=" . $_GET['id']);
        $row = mysqli_fetch_array($result);
        // echo var_dump($row);
        ?>
        <form action="edit.php?oldPlayList=<?= $row['playlist']; ?>&oldSongName=<?= $row['music_name']; ?>" method="post">

            <div class="input-group mb-3 w-75 p-5">
                <label class="input-group-text" for="change_song_name">change song name</label>
                <input type="text" class="form-control" id="change_song_name" name="song_name" value=<?php echo $row['music_name']; ?> required>
            </div>

            <div class="input-group mb-3 w-75 p-5">
                <label class="input-group-text" for="inputGroupSelect01">change the playlist</label>
                <select class="form-select" id="inputGroupSelect01" required name="playlist_change">
                    <?php
                    include 'common/playlists.php';

                    /* echo "<script>$(\"option[value=<?= $row[3]; ?>]\").attr('selected', true)</script>";*/
                    //            echo mysqli_num_rows($result);
                    if (mysqli_num_rows($result) > 0) {
                        while ($row_playlist = mysqli_fetch_array($result)) {
                            //                        echo $row['playlist'];
                            echo "<option value='$row_playlist[0]'>$row_playlist[0]</option>";

                        }

                    }
                    ?>
                </select>
            </div>
            <div class="input-group w-75 p-5">
                <span class="input-group-text">change desc</span>
                <textarea class="form-control" aria-label="With textarea"
                    name="change_desc"><?php echo $row['user_comment']; ?></textarea>
            </div>
            <div class="container text-center">
                <div class="row">
                    <div class="col-6 offset-1 align-self-center">
                        <button type="submit" class="btn btn-info w-25">confirm change</button>
                    </div>
                </div>
            </div>
            <input type="hidden" name="user_name" value="<?= $row['user_name']; ?>">
            <input type="hidden" name="id" value="<?= $row['id']; ?>">

        </form>
        <script>$("option[value='<?= $row[3]; ?>']").attr('selected', true)</script>
        <?php
    } else if (!isset($_SESSION["uid"])) {
        include "common/alert.html";
        // sleep(2);
        $_SESSION["originalPage"] = "edit.php?id=" . $_GET['id'];
        echo "<script>setTimeout(function(){window.location.href='login.php'},1500)</script>";
    }
}
?>