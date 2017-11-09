<?php
session_start();
require_once('../../connection/database.php');

  $sth=$db->query("SELECT * FROM attractions");
  $attractions=$sth->fetchAll(PDO::FETCH_ASSOC);

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
      <h1>訂房資訊</h1>
    </header>
    <div class="row">
      <div class="col-md-12">

    <form action="#.php" method="post" data-toggle="validator">

      <div class="form-group">
        <div class="col-sm-2">
          <label for="check_in_date" class="control-label">入住日期</label>
        </div>
        <div class="col-sm-10">
          <label for="check_in_date" class="control-label"><?php echo $_SESSION['room']['0']['check_in_date']; ?></label>
          <div class="help-block with-errors"></div>
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-2">
          <label for="check_out_date" class="control-label">退房日期</label>
        </div>
        <div class="col-sm-10">
        <label for="check_in_date" class="control-label"><?php echo $_SESSION['room']['0']['check_out_date']; ?></label>
          <div class="help-block with-errors"></div>
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-2">
          <label for="productID" class="control-label">房間名稱</label>
        </div>
        <div class="col-sm-10">
        <label for="productID" class="control-label"><?php echo $product['name']; ?></label>
          <div class="help-block with-errors"></div>
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-2">
          <label for="attractionsID" class="control-label">景點行程</label>
        </div>
        <div class="col-sm-10">
          <select name="attractionsID" id="attractionsID">
          <option>無</option>
        <?php foreach($attractions as $row){ ?>
          <option value="<?php echo $row['attractionsID'];?>"><?php echo $row['name'];?>$NT<?php echo $row['price'];?></option>
        <?php } ?>
        </select>
          <div class="help-block with-errors"></div>
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-2">
          <label for="attractions_number" class="control-label">遊玩人數</label>
        </div>
        <div class="col-sm-10">
          <select name="attractionsID" id="attractionsID">
           <option>無</option>
           <option value="1">1人</option>
           <option value="2">2人</option>
           <option value="3">3人</option>
           <option value="4">4人</option>
           <option value="5">5人</option>
           <option value="6">6人</option>
        </select>
          <div class="help-block with-errors"></div>
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-2">
          <label for="phone" class="control-label">聯絡電話</label>
        </div>
        <div class="col-sm-10">
          <input type="text" class="form-control" id="phone" name="phone" data-error="請輸入聯絡電話" required>
          <div class="help-block with-errors"></div>
        </div>
      </div>

      <div class="form-group">

      <div class="form-group">
        <div class="col-sm-12 text-center">
          <input type="hidden" class="form-control" id="createdDate" name="createdDate" value="<?php echo date("Y-m-d H:i:s"); ?>">
          <button type="submit" class="btn btn-default" style="width:200px;">確認送出</button>
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
