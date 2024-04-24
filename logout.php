<?php

session_start();

unset($_SESSION["uid"]);
if (isset($_SESSION["originalPage"])) {
    unset($_SESSION["originalPage"]);
}
header('Location: login.php'); // log out or change to other user


?>