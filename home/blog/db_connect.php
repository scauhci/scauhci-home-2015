<?php
try {
    $dbh = new PDO("mysql:host=localhost;dbname=hci", "root", "ilovehci");
    //$dbh = new PDO("mysql:host=" . SAE_MYSQL_HOST_M . ";port=" . SAE_MYSQL_PORT . ";dbname=" . SAE_MYSQL_DB, SAE_MYSQL_USER, SAE_MYSQL_PASS);

    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->query("SET NAMES UTF8");
} catch (PDOException $e) {
    echo '连接数据库失败' . $e->getMessage();
    exit;
}
?>