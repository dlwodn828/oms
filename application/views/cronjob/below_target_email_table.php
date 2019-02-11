<!DOCTYPE html>
<html>
<head>
<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>
</head>
<body>

<h2> 재고 부족 업체 List 입니다.</h2>

<table>
    <tr>
    <? foreach ($arrItem[0] as $key => $value): ?>
        <td><?=$key?></td>
    <? endforeach ?>
    </tr>
    <?php foreach ($arrItem as $item): ?>
    <tr>
        <? foreach ($item as $value): ?>
            <td><?=$value?></td>
        <? endforeach ?>
    </tr>
    <?php endforeach; ?>
</table>
</body>
</html>
