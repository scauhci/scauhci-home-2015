<?php
$id = $_GET['id'];
$stmt = $pdo->prepare("select * from people where id=" . $_GET['id']);
$stmt->execute();
$allRows = $stmt->fetch(PDO::FETCH_ASSOC);
$name = $allRows['name'];
$sex = $allRows['sex'];
$grade = $allRows['grade'];
$aspect = $allRows['aspect'];
$major = $allRows['major'];
if ($allRows['img'] != null) {
    $img = './upimages/' . $allRows['img'];
}
$content = $allRows['content'];
