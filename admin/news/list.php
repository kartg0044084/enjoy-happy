<?php
// 完成10/26
require_once('../template/login_check.php');
require_once('../../connection/database.php');
$limit=3;
// 判斷目前第幾頁，若沒有page參數就預設為1
if (isset($_GET["page"])) {$page = $_GET["page"]; } else {$page=1; };
// 計算要從第幾筆開始
$start_from = ($page-1) * $limit;
$sth=$db->query("SELECT*FROM news ORDER BY publishedDate DESC LIMIT ".$start_from.",". $limit);
$news=$sth->fetchAll(PDO::FETCH_ASSOC);
$totalRows = count($news);
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
    <h1>最新活動管理</h1>
</div>
    <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">首頁</a></li>
    <li class="breadcrumb-item active">最新活動管理</li>
    </ol>

    <a href="add.php" class="btn btn-outline-secondary">新增一筆</a>

  <table>
    <thead>
      <tr>
        <th>發佈日期</th>
        <th>標題</th>
        <th>內容</th>
        <th>Update</th>
        <?php if ($_SESSION['level'] == 1) {?>
        <th>刪除</th>
      <?php } ?>
      </tr>
    </thead>
      <tbody>
        <?php foreach($news as $row){ ?>
      <tr>
        <td><?php echo $row['publishedDate'] ?></td>
        <td><?php echo $row['title'] ?></td>
        <td><?php echo $row['content'] ?></td>
        <td><a href="edit.php?newsID=<?php echo $row['newsID'];?>" class="btn btn-info">Update</a></td>
        <?php if ($_SESSION['level'] == 1) {?>
        <td><a href="delete.php?newsID=<?php echo $row['newsID'];?>" class="btn btn-info" onclick="if(!confirm('是否刪除此筆資料？')){return false;};">Delete</a></td>
      <?php } ?>

      </tr>
      <?php } ?>
    </tbody>
    </table>
    <?php  if($totalRows > 0){
        $sth = $db->query("SELECT * FROM news ORDER BY PublishedDate DESC ");
        $data_count = count($sth ->fetchAll(PDO::FETCH_ASSOC));
        $total_pages = ceil($data_count / $limit);
       ?>
        <page aria-label="Page navigation example">
      <ul class="pagination">
          <?php   if($page > 1){ ?>
        <li class="page-item">
          <a class="page-link" href="list.php?page=<?php echo $page-1;?>">Previous</a>
        </li>
        <?php }else{ ?>
          <li>
            <a class="page-link" href="#">Previous</a>
          </li>
          <?php } ?>
          <?php for ($i=1; $i<=$total_pages; $i++) { ?>
        <li class="page-item">
          <a class="page-link" href="list.php?page=<?php echo $i;?>"><?php echo $i;?></a>
        </li>
        <?php } ?>
      <?php if($page < $total_pages){ ?>
        <li class="page-item">
          <a class="page-link" href="list.php?page=<?php echo $page+1;?>">Next</a>
        </li>
        <?php }else{ ?>
          <li>
            <a class="page-link" href="#">Next</a>
          </li>
          <?php } ?>
      </ul>
    </page>
  <?php } ?>
</div>
<?php include_once('../template/footer.php'); ?>



 </div>
</div>

</body>
</html>
