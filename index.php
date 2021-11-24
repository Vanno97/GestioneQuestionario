<?php
include "header.php";
?>

<?php
    require_once "util/Authorization.php";
    if(isset($_COOKIE['token'])) {
        $authorization = new Authorization();
        if ($authorization->checkAuthorization("ADMIN",$_COOKIE['token'])) {
            header("Location: admin-dashboard.php");
        } else if($authorization->checkAuthorization("USER",$_COOKIE['token'])) {
            header("Location: user-dashboard.php");
        } else {
            include "login.php";
        }
    } else {
        include "login.php";
    }
?>

<?php
include "footer.php";
?>