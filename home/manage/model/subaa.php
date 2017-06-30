<?php
require "db_connect.php";
require_once './Michelf/MarkdownInterface.php';
require_once './Michelf/Markdown.php';
require_once './Michelf/MarkdownExtra.php';
$method = $_GET['method'];
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
if(strcmp($_POST['md'],'yes')==0) {
    $parser = new MarkdownExtra();
    $content=$parser->transform($_POST['mdtext']);
}
else{
    $content=html_entity_decode($_POST['mycontent']);
}
if (!strcmp($method, "new")) {
    try {
        
        $stmt = $pdo->prepare('insert into ' . $_GET['type'] . ' (id,title,content,author,time,cl) values(?,?,?,?,?,?)');
        $stmt->execute(array(null, $_POST['title'], $content, $_POST['author'], date("Y-m-d H:i:s", time()), $_POST['classify']));
        $result = $stmt->rowCount();
        if ($result) {
            echo '<script>alert("insert success");window.location.href="../index.php";</script>';
        } 
        else {
            echo '<script>alert("insert failed");history.go(-1);</</script>';
        }
    }
    catch(Exception $e) {
        echo 'link database failed' . $e->getMessage();
        exit;
    }
} 
else if (!strcmp($method, "del")) {
    try {
        $result = $pdo->exec("delete from " . $_GET['type'] . " where id=" . $id);
        if ($result) {
            echo '<script>alert("delete success");window.location.href="../index.php";</script>';
        } 
        else {
            echo '<script>alert("delete  failed");window.location.href="../index.php";</script>';
        }
    }
    catch(Exception $e) {
        echo 'link database failed' . $e->getMessage();
        exit;
    }
} 
else {
    
    try {
        $stmt = $pdo->prepare("update " . $_GET['type'] . " set title= ?,content= ?,author= ?,time= ?,cl= ? where id= ?");
        $stmt->execute(array($_POST['title'], $content, $_POST['author'], date("Y-m-d H:i:s", time()), $_POST['classify'], $_GET['id']));
        $result = $stmt->rowCount();
        if ($result) {
            echo '<script>alert("update success");window.location.href="../index.php";</script>';
        } 
        else {
            echo '<script>alert("update failed");window.location.href="../index.php";</script>';
        }
    }
    catch(Exception $e) {
        echo 'link database failed' . $e->getMessage();
        exit;
    }
}
