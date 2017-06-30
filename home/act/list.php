<?php
header("Content-Type:application/x-javascript");
require 'db_connect.php';

$set = array();
foreach ($dbh->query('select * from aclasses') as $row) {
    $set[] = array(
        'name' => $row['name'],
        'id' => $row['id'],
        'count' => $row['count']);
}
$json["list"] = $set;
$set = json_encode($json);
echo $set;
?>