<?php
ob_start();
session_start();
include 'common/header.php';
include 'common/footer.html';
// $validate = $_POST["validate"];
// echo $_POST["validate"];
// var_dump($_POST);

// echo $_SESSION["validate"];

// // echo $_POST["email"];
// if (isset($_POST["validate"])) {

//     echo "<div class=\"alert alert-success w-75 mx-5 my-3\" role=\"alert\">
//         Verification passed ! redirecting ...
//       </div>";

//     echo "<script>setTimeout(function(){document.getElementsByClassName('alert-success')[0].remove()},1500)</script>";

//     include 'common/conn.php';

//     $sql = "SELECT userName FROM mus_users WHERE userName ='" . $_POST["email"] . "' LIMIT 1";
//     // echo $sql;
//     $check_query = mysqli_query($con, $sql);
//     // echo $check_query;
//     $count_email = mysqli_num_rows($check_query);

//     if ($count_email > 0) {
//         echo "<div class=\"alert alert-danger w-75 mx-5 my-3\" role=\"alert\">
//         the user name already exists, please register again, redirecting ...
//       </div>";

//         echo "<script>setTimeout(function(){window.location.href='register.php'},1500)</script>";
//     } else {
//         $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
//         date_default_timezone_set("America/New_York");
//         $date = date('Y-m-d H:i:s');
//         $sql = "insert into mus_users(userName,password,register_time,is_admin) values
//         ('$_POST[email]','$password','$date','0')";

//         if (!mysqli_query($con, $sql)) {
//             die('error' . mysqli_error($con));
//         }

//         echo "<div class=\"alert alert-success w-75 mx-5 my-3\" role=\"alert\">
//         register success ! please login in ...
//         </div>
//         <script>setTimeout(function(){document.getElementsByClassName('alert-success')[0].remove()},1500)</script>";
//         $con->close();
//     }

// }
// ;

// if (isset($_POST["email"]))
if (isset($_COOKIE['password']) && isset($_COOKIE['email'])) {
    $email_cookie = $_COOKIE['email'];
    $password_cookie = $_COOKIE['password'];
} else {
    $email_cookie = $password_cookie = "";
}

// var_dump($_POST);

if (isset($_POST["email"])) {
    include 'common/conn.php';

    $sql = "SELECT userName,`password` FROM mus_users WHERE userName ='" . $_POST["email"] . "' LIMIT 1";

    // echo $sql;
    $check_query = mysqli_query($con, $sql);
    // echo $check_query;
    $count_email = mysqli_num_rows($check_query);



    if ($count_email == 0) {
        echo "<div class=\"alert alert-danger alert-dismissible fade show w-75 mx-5 my-3\" role=\"alert\">
        the user name doesn't exists, please confirm and type again !
        <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
      </div>";
    } else {

        $row = mysqli_fetch_array($check_query);
        $hashed_password = $row["password"];

        if (password_verify($_POST["password"], $hashed_password)) {

            if (isset($_POST['rememberPassword'])) {
                // /* echo '<script>alert("cookie set!");</script>';*/
                setcookie('email', $_POST['email'], time() + (60 * 60 * 24 * 7));
                setcookie('password', $_POST['password'], time() + (60 * 60 * 24 * 7));

                // setcookie('email', $_POST['email'], time() + 15);
                // setcookie('password', $_POST['password'], time() + 15);
            }



            echo "<div class=\"alert alert-primary w-75 mx-5 my-3\" role=\"alert\">
                log in successfully ! redirecting...     
            </div>";
            $_SESSION["uid"] = $row["userName"];

            if (!isset($_SESSION["originalPage"])) {
                $_SESSION["originalPage"] = "login.php";
            }
            echo "<script>setTimeout(function(){window.location.href='" . $_SESSION["originalPage"] . "'},1500)</script>";
        } else {
            echo "<div class=\"alert alert-secondary alert-dismissible fade show w-75 mx-5 my-3\" role=\"alert\">
                password not correct ! please try again
                <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>
            </div>";
        }

    }
    ;

    // unset($_POST['email'], $_POST['password']);
}

ob_end_flush();
?>






<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body class="position-relative">

    <!-- php echo $_SESSION["originalPage"]; ?> -->
    <div class="d-flex justify-content-center mt-5 pt-5">
        <form action="login.php" method="post" class="w-50">
            <div class=" mb-3">
                <label for="exampleInputEmail1" class="form-label">User name(email)</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    name="email" required value="<?php echo $email_cookie; ?>">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <div class="position-relative">
                    <input type="password" class="form-control" id="exampleInputPassword1" name="password" required
                        value="<?php echo $password_cookie; ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y me-3 d-none"
                        viewBox="0 0 16 16" id="eye-slash" onclick="showPassWord()">
                        <path
                            d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7 7 0 0 0-2.79.588l.77.771A6 6 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755q-.247.248-.517.486z" />
                        <path
                            d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829" />
                        <path
                            d="M3.35 5.47q-.27.24-.518.487A13 13 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7 7 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12z" />
                    </svg>

                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-eye position-absolute top-50 end-0 translate-middle-y me-3" viewBox="0 0 16 16"
                        onclick="showPassWord()" id="eye">
                        <path
                            d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                        <path
                            d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                    </svg>
                </div>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="rememberPassword" value="1">
                <label class="form-check-label" for="exampleCheck1">Remember account for 1 week</label>
            </div>
            <button type="submit" class="btn btn-primary w-25 d-grid mx-auto">Submit</button>
            <div class="mt-3 d-flex justify-content-center">
                No account? &nbsp;
                <a class="link-offset-2 link-offset-3-hover link-underline link-underline-opacity-0 link-underline-opacity-75-hover"
                    href="register.php">
                    Register
                </a>
            </div>

        </form>
    </div>

    <script src="jsFile/login.js"></script>

</body>

</html>