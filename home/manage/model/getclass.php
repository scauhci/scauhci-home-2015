<?php
$stmt = $pdo->prepare("select name from {$cl[$t]}");
$stmt->execute();
$class_set = $stmt->fetchAll(PDO::FETCH_ASSOC);