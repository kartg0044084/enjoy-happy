<?php
// 完成10/26
require_once('../template/login_check.php');
require_once('../../connection/database.php');
$limit=6;
// 判斷目前第幾頁，若沒有page參數就預設為1
if (isset($_GET["page"])) {$page = $_GET["page"]; } else {$page=1; };
// 計算要從第幾筆開始
$start_from = ($page-1) * $limit;
$sth=$db->query("SELECT*FROM user_login_record ORDER BY publishedDate DESC LIMIT ".$start_from.",". $limit);
$user_login_record=$sth->fetchAll(PDO::FETCH_ASSOC);
$totalRows = count($user_login_record);
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
    <h1>登入紀錄管理</h1>
</div>
    <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">首頁</a></li>
    <li class="breadcrumb-item active">登入紀錄管理</li>
    </ol>

  <table>
    <thead>
      <tr>
        <th>登入日期</th>
        <th>登出日期</th>
        <th>帳號</th>
        <th>名稱</th>
      </tr>
    </thead>
      <tbody>
        <?php foreach($user_login_record as $row){ ?>
      <tr>
        <td><?php echo $row['publishedDate'] ?></td>
        <td><?php echo $row['enddate'] ?></td>
        <td><?php echo $row['account'] ?></td>
        <td><?php echo $row['name'] ?></td>
      </tr>
      <?php } ?>
    </tbody>
    </table>
    <?php  if($totalRows > 0){
        $sth = $db->query("SELECT * FROM user_login_record ORDER BY publishedDate DESC ");
        $data_count = count($sth ->fetchAll(PDO::FETCH_ASSOC));
        $total_pages = ceil($data_count / $limit);
       ?>
        <page aria-label="Page navigation example">
      <ul class="pagination">
          <?php   if($page > 1){ ?>
        <li class="page-item">
          <a class="page-link" href="login_record.php?page=<?php echo $page-1;?>">Previous</a>
        </li>
        <?php }else{ ?>
          <li>
            <a class="page-link" href="#">Previous</a>
          </li>
          <?php } ?>
          <?php for ($i=1; $i<=$total_pages; $i++) { ?>
        <li class="page-item">
          <a class="page-link" href="login_record.php?page=<?php echo $i;?>"><?php echo $i;?></a>
        </li>
        <?php } ?>
      <?php if($page < $total_pages){ ?>
        <li class="page-item">
          <a class="page-link" href="login_record.php?page=<?php echo $page+1;?>">Next</a>
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
