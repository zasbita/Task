<?php

if (!isset($_COOKIE['user'])) {
    header("Location: index.php");
} else if (isset($_COOKIE['user']) != "") {
    header("Location: home.php");
}

if (isset($_GET['logout'])) {
    setcookie("user", "", time()-3600);
    setcookie("email", "", time()-3600);
    header("Location: index.php");
}
?>