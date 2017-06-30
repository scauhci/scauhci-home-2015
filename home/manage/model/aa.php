<?php
$title = "";
$author = "";
$content = "";
$id = $_GET['id'];
$stmt = $pdo->prepare("select * from {$t} where id=" . $id);
$stmt->execute();
$allRows = $stmt->fetch(PDO::FETCH_ASSOC);
$title = $allRows['title'];
$author = $allRows['author'];
$content = $allRows['content'];
$classify = $allRows['cl'];
