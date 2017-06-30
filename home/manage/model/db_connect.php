<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=hci", "root", "ilovehci");
    
    // $pdo = new PDO("mysql:host=" . SAE_MYSQL_HOST_M . ";port=" . SAE_MYSQL_PORT . ";dbname=" . SAE_MYSQL_DB, SAE_MYSQL_USER, SAE_MYSQL_PASS);
    
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->query("SET NAMES UTF8");
}
catch(PDOException $e) {
    echo '连接数据库失败' . $e->getMessage();
    exit;
}
