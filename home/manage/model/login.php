<?php
header('Content-type: text/html; charset=utf-8');
session_start();
require './db_connect.php';

if (isset($_POST["sub"])) {
    $stmt = $pdo->prepare("select name,password from users where name = ? and password = ?");
    $stmt->execute(array($_POST["username"], MD5($_POST["password"])));
}

if ($_SESSION = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $_SESSION["islogin"] = 1;
    header("Location:../index.php");
} 
else {
    echo '<script>alert("用户名或密码错误！");window.location.href="../view/login.html";</script>';
}
