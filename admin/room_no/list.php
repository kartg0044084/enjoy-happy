<?php
// 完成10/26
require_once('../template/login_check.php');
require_once('../../connection/database.php');
$sth=$db->query('SELECT*FROM room_no');
$room_no=$sth->fetchAll(PDO::FETCH_ASSOC);
 ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>享樂後台系統</title>
<?php include_once('../template/header.php'); ?>
</head>

<body>
<div id="container">
 <div id="row">

	<?php include_once('../template/nav.php'); ?>

<div id="content">
<div class="title">
    <h1>房號管理</h1>
</div>
    <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">首頁</a></li>
    <li class="breadcrumb-item active">房號管理</li>
    </ol>

    <a href="add.php" class="btn btn-outline-secondary">新增一筆</a>

  <table>
    <thead>
      <tr>
        <th>分類編號</th>
        <th>房號</th>
        <th>建立時間</th>
          <?php if ($_SESSION['level'] == 1) {?>
        <th>刪除</th>
      <?php } ?>
      </tr>
    </thead>

      <tbody>
        <?php foreach($room_no as $row){ ?>
      <tr>
        <td><?php echo $row['room_noID']; ?></td>
        <td><a href="../product/list.php?room_noID=<?php echo $row['room_noID']; ?>"><?php echo $row['room_no']; ?>號</td>
        <td><?php echo $row['publishedDate']; ?></td>
        <?php if ($_SESSION['level'] == 1) {?>
        <td><a href="delete.php?room_noID=<?php echo $row['room_noID']; ?>" class="btn btn-info" onclick="if(!confirm ('是否刪除此筆資料？')){return false;};" class="btn btn-default">Delete</a></td>
      <?php } ?>

      </tr>
      <?php } ?>
    </tbody>
    </table>
         <page aria-label="Page navigation example"><!--空區塊 -->
      <ul class="pagination">

      </ul>
    </page>

</div>
<?php include_once('../template/footer.php'); ?>



 </div>
</div>

</body>
</html>
