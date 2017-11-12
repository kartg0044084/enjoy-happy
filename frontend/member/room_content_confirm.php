<?php
session_start();
require_once('../../connection/database.php');

if(!isset($_SESSION['account'])){
header('Location: member_login.php');
}
$sth=$db->query("SELECT * FROM attractions WHERE attractionsID= ".$_SESSION['attractionsID']."");
$attractions=$sth->fetch(PDO::FETCH_ASSOC);

$sth=$db->query("SELECT * FROM product WHERE productID=".$_SESSION['room']['0']['productID']."");
$product=$sth->fetch(PDO::FETCH_ASSOC);
?>
<!doctype html>
<!-- Website ../template by freewebsite../templates.com -->
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>享樂-訂房系統</title>
<?php require_once("../template/files2.php"); ?>
</head>
<body>
<?php require_once("../template/header2.php"); ?>

<div id="box">
<header>
<h1>訂房確認</h1>
</header>

<div class="row">
<div class="col-md-12">

<form action="order_success.php" method="post" data-toggle="validator">

<div class="form-group">
<div class="col-sm-2">
<label for="check_in_date" class="control-label">入住日期</label>
</div>
<div class="col-sm-10">
<label for="check_in_date" class="control-label"><?php echo $_SESSION['room']['0']['check_in_date']; ?></label>
<div class="help-block with-errors"></div>
</div>
</div>
<!--$_SESSION入住日期 以傳送 -->

<div class="form-group">
<div class="col-sm-2">
<label for="check_out_date" class="control-label">退房日期</label>
</div>
<div class="col-sm-10">
<label for="check_in_date" class="control-label"><?php echo $_SESSION['room']['0']['check_out_date']; ?></label>
<div class="help-block with-errors"></div>
</div>
</div>
<!--$_SESSION退房日期 以傳送 -->

<?php $totaldate = 0; ?>  <!--宣告初始=0 -->
<div class="form-group">
<div class="col-sm-2">
<label class="control-label">入住天數</label>
</div>
<div class="col-sm-10">
<label class="control-label"><?php $totaldate= strtotime($_SESSION['room']['0']['check_out_date']) - strtotime($_SESSION['room']['0']['check_in_date']); echo floor($totaldate / (60 * 60 * 24)); ?>天</label> <!--strtotime 时间戳數值必須轉換day格式 -->
<div class="help-block with-errors"></div>
</div>
</div>

<div class="form-group">
<div class="col-sm-2">
<label for="productID" class="control-label">房間名稱</label>
</div>
<div class="col-sm-10">
<a href="../product_content.php?productID=<?php echo $_SESSION['room']['0']['productID'];?>" target="_blank"><label for="productID" class="control-label"><?php echo $product['name']; ?></label></a>
<div class="help-block with-errors"></div>
</div>
</div>
<!--$_SESSION房間名稱 以傳送 -->

<?php $totaldateprice = 0; ?>  <!--宣告初始=0 -->
<div class="form-group">
<div class="col-sm-2">
<label class="control-label">房間總額</label>
</div>
<div class="col-sm-10">
<label class="control-label"><?php $totaldateprice= $product['price'] * floor($totaldate / (60 * 60 * 24)); echo $totaldateprice; ?>元</label> <!--strtotime 时间戳數值必須轉換day格式 -->
<div class="help-block with-errors"></div>
</div>
</div>

<?php if ($_SESSION['attractionsID'] != 0 ) {?> <!--如傳入值=0(無)則不顯示-->

<div class="form-group">
<div class="col-sm-2">
<label for="attractionsID" class="control-label">景點行程</label>
</div>
<div class="col-sm-10">
<label for="attractionsID" class="control-label"><?php echo $attractions['name'];?></label>
<div class="help-block with-errors"></div>
</div>
</div>
<!--$_SESSION景點行程 以傳送 -->

<div class="form-group">
<div class="col-sm-2">
<label for="attractions_number" class="control-label">遊玩人數</label>
</div>
<div class="col-sm-10">
<label for="attractions_number" class="control-label"><?php echo $_SESSION['attractions_number'];?>人</label>
<div class="help-block with-errors"></div>
</div>
</div>
<!--$_SESSION遊玩人數 以傳送 -->

<?php } ?>

<?php $attractionsprice = 0?>  <!--宣告初始=0 -->

<?php if ($_SESSION['attractionsID'] != 0 ) {?> <!--如傳入值=0(無)則不顯示-->
<div class="form-group">
<div class="col-sm-2">
<label class="control-label">景點花費</label>
</div>
<div class="col-sm-10">
<label class="control-label"><?php echo $_SESSION['attractions_number'];?>人X<?php echo $attractions['price'];?>元=<?php $attractionsprice= $_SESSION['attractions_number'] * $attractions['price']; echo $attractionsprice?>元</label>
<div class="help-block with-errors"></div>
</div>
</div>
<?php } ?>

<div class="form-group">
<div class="col-sm-2">
<label for="name" class="control-label">聯絡人</label>
</div>
<div class="col-sm-10">
<label for="name" class="control-label"><?php echo $_SESSION['name'];?></label>
<div class="help-block with-errors"></div>
</div>
</div>
<!--$_SESSION聯絡人 以傳送 -->

<div class="form-group">
<div class="col-sm-2">
<label for="phone" class="control-label">聯絡電話</label>
</div>
<div class="col-sm-10">
<label for="phone" class="control-label"><?php echo $_SESSION['phone'];?></label>
<div class="help-block with-errors"></div>
</div>
</div>
<!--$_SESSION聯絡電話 以傳送 -->

<div class="form-group">
<div class="col-sm-2">
<label for="email" class="control-label">email</label>
</div>
<div class="col-sm-10">
<label for="email" class="control-label"><?php echo $_SESSION['email'];?></label>
<div class="help-block with-errors"></div>
</div>
</div>
<!--$_SESSION email 以傳送 -->

<?php $service_charge = 800 ?>
<div class="form-group">
<div class="col-sm-2">
<label for="service charge" class="control-label">清潔費</label>
</div>
<div class="col-sm-10">
<label for="service charge" class="control-label"><?php echo $service_charge?>元</label>
<div class="help-block with-errors"></div>
</div>
</div>
<!--$_POST 清潔費 以傳送 -->

<?php $totalprice = 0?>  <!--宣告初始=0 -->
<div class="form-group">
<div class="col-sm-2">
<label for="totalprice" class="control-label">總金額</label>
</div>
<div class="col-sm-10">
<label for="totalprice" class="control-label"><?php $totalprice= $attractionsprice+ $service_charge + $totaldateprice; echo $totalprice; ?>元</label>
<div class="help-block with-errors"></div>
</div>
</div>
<!--$_POST總金額 以傳送 -->

<div class="form-group">
<div class="col-sm-12 text-center">
<input type="hidden" name="orderNO" value="<?php echo 'SH'.date('YmdHis'); ?>">  <!--orderNO 以傳送 -->
<input type="hidden" name="orderDate" value="<?php echo date('Y-m-d H-i-s'); ?>">  <!--orderDate 以傳送 -->
<input type="hidden" name="memberID" value="<?php echo $_SESSION['memberID']; ?>">  <!--memberID 以傳送 -->
<input type="hidden" name="service_charge" value="<?php echo $service_charge; ?>"><!--service_charge 以傳送 -->
<input type="hidden" name="totalprice" value="<?php echo $totalprice; ?>"><!--totalprice 以傳送 -->
<button type="submit" class="btn btn-default" style="width:200px;">確定訂單</button>
</div>
</div>
</form>
<hr>
</div>
</div>
</div>
</div>

<div style="clear:both;"></div>
<?php require_once("../template/footer2.php"); ?>
</body>
</html>
