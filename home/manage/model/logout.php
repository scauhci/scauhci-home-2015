<?php
session_start();
$_SESSION = array();
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time() - 100, '/');
}
session_destroy();
echo '<script>window.open("../view/login.html","_self");</script>';