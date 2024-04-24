<?php
include 'common/conn.php';
if (isset($_POST["email"])) {
    $sql = "SELECT userName FROM mus_users WHERE userName ='" . $_POST["email"] . "' LIMIT 1";

    // echo $sql;
    $check_query = mysqli_query($con, $sql);
    // echo $check_query;
    $count_email = mysqli_num_rows($check_query);

    if ($count_email == 0) {
        echo "<div class=\"alert alert-danger alert-dismissible fade show w-75 mx-5 my-3\" role=\"alert\">
         the user name doesn't exists, please confirm and type again!
         <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
       </div>";
    }
    ;
}
?>