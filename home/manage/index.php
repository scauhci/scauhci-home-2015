<?php
header('Content-type: text/html; charset=utf-8');
session_start();
require './model/db_connect.php';
$cn = array('articles' => '文章', 'activities' => '活动', 'people' => '成员');
$order = array('articles' => 1, 'activities' => 2, 'people' => 3);
$lite = array('articles' => 'art', 'activities' => 'act', 'people' => 'pep');
$cl = array('articles' => 'classes', 'activities' => 'aclasses');
if (!isset($_SESSION['islogin']) && $_SESSION['islogin'] !== 1) {
    header("Location:./view/login.html");
} 
else {
    if (isset($_GET['t'])) {
        $t = $_GET['t'];
        $method = $_GET['method'];
        if (strcmp($t, 'articles') == 0 || strcmp($t, 'activities') == 0) {
            require './model/getclass.php';
            if (isset($_GET['id'])) {
                require './model/aa.php';
            }
            if (strcmp($method, 'new') == 0 || strcmp($method, 'edit') == 0) {
                require './view/aa_edit.php';
            }
        } 
        elseif (strcmp($t, 'people') == 0) {
            if (isset($_GET['id'])) {
                require './model/people.php';
            }
            if (strcmp($method, 'new') == 0 || strcmp($method, 'edit') == 0) {
                require './view/people_edit.php';
            }
        }
    } 
    else {
        require './view/page.class.php';
        require './view/main.php';
    }
}
