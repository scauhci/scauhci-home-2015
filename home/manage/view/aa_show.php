<?php
$stmt = $pdo->prepare("select * from " . $t);
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$total = count($rows);

$page = new Page($total, $lite[$t]);

$stmt = $pdo->prepare("select * from " . $t . $page->getLimit());
$stmt->execute();
$allRows = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo '<table class="table table-striped"><tr><th><input type="checkbox" /></th>	<th>标题</th><th>日期</th><th>上传者</th><th>删除</th><th>编辑</th></tr>';


if ($allRows && $total > 0) {
    foreach ($allRows as $row) {
        echo '<tr>';
        echo '<td><input type="checkbox" /></td>';
        echo '<td>' . $row['title'] . '</td>';
        echo '<td>' . $row['time'] . '</td>';
        echo '<td>' . $row['author'] . '</td>';
        echo '<td><a onclick="return confirm(\'你确定要删除吗\')" href="./model/subaa.php?method=del&type=' . $t . '&id=' . $row['id'] . '">删除</a></td>';
        echo '<td><a href="./index.php?method=edit&t=' . $t . '&id=' . $row['id'] . '">编辑</a></td>';
        echo '</tr>';
    }
}
echo '</table>';
echo '<div>';
echo $page->fpage($total);
echo '</div>';
?>