<?php
include 'common/conn.php';
if (isset($_POST["email"])) {
    //php side database validation
    $sql = "SELECT userName FROM mus_users WHERE userName ='" . $_POST["email"] . "' LIMIT 1";

    // echo $sql;
    $check_query = mysqli_query($con, $sql);
    // echo $check_query;
    $count_email = mysqli_num_rows($check_query);

    if ($count_email > 0) {

        echo "<div class=\"alert alert-warning alert-dismissible fade show w-75 mx-5 my-3\" role=\"alert\">
         the user name already exists, please register again
         <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
       </div>";

        exit();
    } else {
        // echo "run";
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        date_default_timezone_set("America/New_York");
        $date = date('Y-m-d H:i:s');
        $sql = "insert into mus_users(userName,password,register_time,is_admin) values
         ('$_POST[email]','$password','$date','0')";


        if (mysqli_query($con, $sql)) {
            // $con->close();
            echo "<div class=\"alert alert-success w-75 mx-5 my-3\" role=\"alert\">
                register success ! please login in, redirecting ...
                </div>";
            echo "<script>setTimeout(function(){window.location.href='login.php'},1500)</script>";
            exit;

            // die('error' . mysqli_error($con));

        }



        // echo "<script>setTimeout(function(){window.location.href='login.php'},1500)</script>";
        // exit();
    }
}
?>