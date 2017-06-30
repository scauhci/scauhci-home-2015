<?php
$stmt = $pdo->prepare("select * from people");
$stmt->execute();
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$total = count($rows);

$page = new Page($total, "pep");

$stmt = $pdo->prepare("select * from people" . $page->getLimit());
$stmt->execute();
$allRows = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo '<table class="table table-striped"><tr><th><input type="checkbox" /></th>	<th>姓名</th><th>性别</th><th>年级</th><th>方向</th><th>删除</th><th>编辑</th></tr>';

if ($allRows && $total > 0 ) {

    foreach ($allRows as $row) {
        echo '<tr>';
        echo '<td><input type="checkbox" /></td>';
        echo '<td>' . $row['name'] . '</td>';
        echo '<td>' . $row['sex'] . '</td>';
        echo '<td>' . $row['grade'] . '</td>';
        echo '<td>' . $row['aspect'] . '</td>';
        echo '<td><a onclick="return confirm(\'你确定要删除吗\')" href="./model/subpep.php?method=del&type=people&id=' . $row['id'] . '">删除</a></td>';
        echo '<td><a href="./index.php?method=edit&t=people&id=' . $row['id'] . '">编辑</a></td>';
        echo '</tr>';
    }
}
echo '</table>';
echo '<div>';
echo $page->fpage($total);
echo '</div>';
?>