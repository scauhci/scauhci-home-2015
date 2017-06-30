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
$fileInfo = $_FILES['img'];
$allowExt = array('jpeg', 'jpg', 'gif', 'wbmp');

if (!strcmp($method, "new")) {
    
    if ($fileInfo['error'] == UPLOAD_ERR_OK) {
        $ext = pathinfo($fileInfo['name'], PATHINFO_EXTENSION);
        
        //判断文件是否为图片
        if (!in_array($ext, $allowExt)) {
            echo '<script>alert("The file type is not allowed");history.go(-1);</</script>';
        }
        $stmt = $pdo->prepare("insert into people(id,name,sex,grade,content,img,aspect,major) values(?,?,?,?,?,?,?,?)");
        $stmt->execute(array(null, $_POST['name'], $_POST['sex'], $_POST['grade'], $_POST['mycontent'], null, $_POST['aspect'], $_POST['major']));
        $dir = '../upimages/';
        
        //以id命名对应人员的图片，避免同名覆盖图片
        $dir.= $pdo->lastInsertId() . '.' . $ext;
        if (is_uploaded_file($_FILES['img']['tmp_name'])) {
            if (move_uploaded_file($fileInfo['tmp_name'], $dir)) {
                $stmt = $pdo->prepare("update people set img= ? where id = ?");
                $stmt->execute(array($pdo->lastInsertId() . '.' . $ext, $pdo->lastInsertId()));
                echo '<script>alert("insert success");window.location.href="../index.php";</script>';
            }
        }
    } 
    else {
        switch ($_FILES['img']['error']) {
            case UPLOAD_ERR_INI_SIZE:
                 //其值为 1，上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值
                die('The upload file exceeds the upload_max_filesize directive in php.ini');
                break;

            case UPLOAD_ERR_FORM_SIZE:
                 //其值为 2，上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值
                die('The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.');
                break;

            case UPLOAD_ERR_PARTIAL:
                 //其值为 3，文件只有部分被上传
                die('The uploaded file was only partially uploaded.');
                break;

            case UPLOAD_ERR_NO_FILE:
                 //其值为 4，没有文件被上传
                die('No file was uploaded.');
                break;

            case UPLOAD_ERR_NO_TMP_DIR:
                 //其值为 6，找不到临时文件夹
                die('The server is missing a temporary folder.');
                break;

            case UPLOAD_ERR_CANT_WRITE:
                 //其值为 7，文件写入失败
                die('The server failed to write the uploaded file to disk.');
                break;

            case UPLOAD_ERR_EXTENSION:
                 //其他异常
                die('File upload stopped by extension.');
                break;
        }
    }
} 
else if (!strcmp($method, "del")) {
    
    $result = $pdo->exec("delete from people where id=" . $id);
    if ($result) {
        echo '<script>alert("delete success");window.location.href="../index.php";</script>';
    } 
    else {
        echo '<script>alert("delete failed");window.location.href="../index.php";</script>';
    }
} 
else {
    $stmt = $pdo->prepare("select img from people where id=" . $_GET['id']);
    $stmt->execute();
    $img = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($_FILES['img']['size'] > 0) {
        
        if ($fileInfo['error'] == UPLOAD_ERR_OK) {
            $ext = pathinfo($fileInfo['name'], PATHINFO_EXTENSION);
            
            //判断文件是否为图片
            if (!in_array($ext, $allowExt)) {
                echo '<script>alert("The file type is not allowed");history.go(-1);</</script>';
            }
            $dir = '../upimages/';
            
            //以id命名对应人员的图片，避免同名覆盖图片
            $dir.= $_GET['id'] . '.' . $ext;
            if (is_uploaded_file($_FILES['img']['tmp_name'])) {
                if (move_uploaded_file($fileInfo['tmp_name'], $dir)) {
                    $stmt = $pdo->prepare("update people set name= ?,sex= ?,grade= ?,content= ?,img=?,aspect=?,major=? where id=" . $id);
                    $stmt->execute(array($_POST['name'], $_POST['sex'], $_POST['grade'], $_POST['mycontent'], $_GET['id'] . '.' . $ext, $_POST['aspect'], $_POST['major']));
                    $result = $stmt->rowCount();
                    if ($result) {
                        echo '<script>alert("update success");window.location.href="../index.php";</script>';
                    } 
                    else {
                        echo '<script>alert("update failed");window.location.href="../index.php";</script>';
                    }
                }
            }
        } 
        else {
            switch ($_FILES['img']['error']) {
                case UPLOAD_ERR_INI_SIZE:
                     //其值为 1，上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值
                    die('The upload file exceeds the upload_max_filesize directive in php.ini');
                    break;

                case UPLOAD_ERR_FORM_SIZE:
                     //其值为 2，上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值
                    die('The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.');
                    break;

                case UPLOAD_ERR_PARTIAL:
                     //其值为 3，文件只有部分被上传
                    die('The uploaded file was only partially uploaded.');
                    break;

                case UPLOAD_ERR_NO_FILE:
                     //其值为 4，没有文件被上传
                    die('No file was uploaded.');
                    break;

                case UPLOAD_ERR_NO_TMP_DIR:
                     //其值为 6，找不到临时文件夹
                    die('The server is missing a temporary folder.');
                    break;

                case UPLOAD_ERR_CANT_WRITE:
                     //其值为 7，文件写入失败
                    die('The server failed to write the uploaded file to disk.');
                    break;

                case UPLOAD_ERR_EXTENSION:
                     //其他异常
                    die('File upload stopped by extension.');
                    break;
            }
        }
    } 
    else {
        $stmt = $pdo->prepare("update people set name= ?,sex= ?,grade= ?,content= ?,aspect=?,major=? where id=" . $id);
        $stmt->execute(array($_POST['name'], $_POST['sex'], $_POST['grade'], $_POST['mycontent'], $_POST['aspect'], $_POST['major']));
        $result = $stmt->rowCount();
        if ($result) {
            echo '<script>alert("update success");window.location.href="../index.php";</script>';
        } 
        else {
            echo '<script>alert("update failed");window.location.href="../index.php";</script>';
        }
    }
}
