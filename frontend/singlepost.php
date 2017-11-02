<?php
require_once('../connection/database.php');
$sth=$db->query("SELECT*FROM news WHERE newsID=".$_GET['newsID']);
$news=$sth->fetch(PDO::FETCH_ASSOC);
?>
<!doctype html>
<!-- Website template by freewebsitetemplates.com -->
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>最新消息-享樂民宿</title>
<?php require_once("template/files.php"); ?>
</head>
<body>
<?php require_once("template/header.php"); ?>

<div id="disviewrow">

	<div class="panel-heading"><?php echo $news['title'] ?></div>
	<div class="datebor"><?php echo $news['publishedDate'] ?></div>
	<div class="dis">優惠內容</div>
	<div class="dis_content"><?php echo $news['content'] ?></div>
	<a href="../index.php">回首頁</a>
	<a href="news.php">回上一頁</a>
</div>


<div style="clear:both;"></div>
<?php require_once("template/footer.php"); ?>
</body>

</html>
