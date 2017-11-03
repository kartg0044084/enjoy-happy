<?php
require_once('../connection/database.php');

$sth=$db->query("SELECT * FROM attractions WHERE attractionsID=".$_GET['attractionsID']."");
$attractions=$sth->fetch(PDO::FETCH_ASSOC);

 // print_r($attractions);
 ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>套裝景點-享樂民宿</title>
<?php require_once("template/files.php"); ?>
</head>
<body>
 <?php require_once("template/header.php"); ?>
<div id="attractions">
<h6><?php echo $attractions['name']; ?></h6>



<div id="attractions">
  <img src="../uploads/attractions/<?php echo $attractions['picture']; ?>" alt="" style="width: 500px;height: 300px;padding: 10px 10px;">
  <div class="title">行程內容</div>
  <div class="description"><?php echo $attractions['description']; ?></div>

  <div class="page-content-section">
    <p>電話: 03-4072999</p>
    <p>電子郵件: aspire.park@acer.com</p>
    <p>門票資訊: NT <?php echo $attractions['price']; ?></p>
    <p>服務設施: 公廁 停車場 販賣部 單車驛站 </p>
  </div>

</div>
  <div style="clear:both;"></div>
  <a class="a" href="attractions_category.php">回上一頁</a>
</div>


<div style="clear:both;"></div>
<?php require_once("template/footer.php"); ?>
</body>

</html>
