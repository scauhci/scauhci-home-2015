<?php
header("Content-Type:application/x-javascript");
require 'db_connect.php';
function search_article($content, $dbh) {
    $set = array();
    $stmt = $dbh->prepare("SELECT * from articles where * like '%{$content}%'");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        $set[] = array("id" => $row["id"], "title" => $row["title"], "author" => $row["author"], "time" => $row["time"], "img" => $row["img"], "intro" => $row["intro"]);
        break;
    }
    $json["search"] = $set;
    $set = json_encode($json);
    return $set;
}

function get_article_list($cl, $dbh) {
    $set = array();
    $stmt = $dbh->prepare("SELECT * from articles where cl='{$cl}' order by time desc");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        $set[] = array("id" => $row["id"], "title" => $row["title"], "author" => $row["author"], "time" => $row["time"], "img" => $row["img"], "intro" => $row["intro"]);
    }
    $json["article"] = $set;
    $set = json_encode($json);
    return $set;
}

function get_article_content($id, $dbh) {
    $stmt = $dbh->prepare('SELECT content from articles where id=' . $id);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        $set['content'] = $row['content'];
        $set = json_encode($set);
        return $set;
    }
}

function get_latest_articles($limit, $dbh) {
    $set = array();
    $stmt = $dbh->prepare("SELECT * from articles order by time desc limit {$limit}");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        $set[] = array("id" => $row["id"], "title" => $row["title"], "author" => $row["author"], "time" => $row["time"], "cl" => $row["cl"]);
    }
    $json["article"] = $set;
    $set = json_encode($json);
    return $set;
}
if (isset($_GET['wd'])) {
    $content = '/' . $_GET['wd'] . '/';
    $result = search_article($content, $dbh);
} 
else if (isset($_GET['lm'])) {
    $limit = $_GET['lm'];
    $result = get_latest_articles($limit, $dbh);
} 
else if (isset($_GET['cl'])) {
    $cl = $_GET['cl'];
    $result = get_article_list($cl, $dbh);
} 
else if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = get_article_content($id, $dbh);
}

echo $result;
