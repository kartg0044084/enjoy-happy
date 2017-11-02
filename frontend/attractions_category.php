<?php
require_once('../connection/database.php');
$sth=$db->query("SELECT * FROM attractions");
$attractions_category=$sth->fetchAll(PDO::FETCH_ASSOC);

$totalRows = count($attractions_category); //count 計算變數資料筆數
// print_r($totalRows);
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
<h6>套裝景點</h6>

<p>共有 <?php echo $totalRows ?> 筆行程推薦</p>

<div class="thumb-frame">
  <?php foreach($attractions_category as $row){ ?>
  <a href="attractions.php?attractionsID=<?php echo $row['attractionsID'];?>"><img src="../uploads/attractions/<?php echo $row['picture']; ?>" alt="">

    <h5><?php echo $row['name']; ?></h5>
    <div class="price">$NT<?php echo $row['price']; ?></div>

    <div style="clear:both;"></div>
  </a>
<?php } ?>

</div>
</div>


<div style="clear:both;"></div>
<?php require_once("template/footer.php"); ?>
</body>

</html>
