<?php
// 完成10/26
require_once('../template/login_check.php');
require_once('../../connection/database.php');
// 方法一
$sth=$db->query("SELECT * FROM product WHERE product_categoryID=".$_GET['product_categoryID']." ORDER BY createdDate DESC");
$all_product=$sth->fetchAll(PDO::FETCH_ASSOC);

$sth ->execute();
$products = $sth->fetchAll(PDO::FETCH_ASSOC);
$totalRaws = count($products);
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
    <h1>訂房管理</h1>
</div>
    <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">首頁</a></li>
    <li class="breadcrumb-item active">訂房管理</li>
    </ol>
<a href="../product_category/list.php" class="btn btn-outline-secondary">回上一層</a>&nbsp;
<a href="add.php?product_categoryID=<?php echo $_GET['product_categoryID']; ?>" class="btn btn-outline-secondary">新增一筆</a>
  <table>
    <thead>
      <tr>
        <th>房間照片</th>
        <th>房名</th>
        <th>價格</th>
        <th>房型</th>
        <th>可住人數</th>
        <th>說明</th>
        <th>Update</th>
        <?php if ($_SESSION['level'] == 1) {?>
        <th>刪除</th>
      <?php } ?>
      </tr>
    </thead>
      <tbody>
        <?php if($totalRaws > 0){ ?>
        <?php foreach($all_product as $row){ ?>
      <tr>
        <td><a class="fancybox" rel="group" href="../../uploads/products/<?php echo $row['picture']; ?>" target="_blank"><img src="../../uploads/products/<?php echo $row['picture']; ?>" class="img-thumbnail"/><a></td>
        <td><?php echo $row['name']; ?></td>
        <td>$NT: <?php echo $row['price']; ?></td>
        <td><?php echo $row['room']; ?></td>
        <td><?php echo $row['people']; ?></td>
        <td><?php echo mb_substr( $row['content'],0,30,"utf-8")."..."; ?></td>
        <td><a href="edit.php?product_categoryID=<?php echo $row['product_categoryID']; ?>&productID=<?php echo $row['productID'];?>" class="btn btn-info">Update</a></td>
        <?php if ($_SESSION['level'] == 1) {?>
        <td><a href="delete.php?product_categoryID=<?php echo $row['product_categoryID']; ?>&productID=<?php echo $row['productID'];?>" class="btn btn-info" onclick="if(!confirm('是否刪除此筆資料？')){return false;};" class="btn btn-default">Delete</a></td>
      <?php } ?>

        <!-- 此處容易忘記 -->
      </tr>
        <?php } ?>
        <?php }else{ ?>
          <tr>
            <td colspan="7">目前無資料，請新增一筆</td>
          </tr>
        <?php } ?>
    </tbody>
    </table>

        <page aria-label="Page navigation example">
      <ul class="pagination">
        <!-- <li class="page-item"><a class="page-link" href="#">Previous</a></li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item"><a class="page-link" href="#">Next</a></li> -->
      </ul>
    </page>

</div>
<?php include_once('../template/footer.php'); ?>

 </div>
</div>

</body>
</html>
