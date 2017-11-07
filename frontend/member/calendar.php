<?php
require_once('../../connection/database.php');
session_start();

$sth=$db->query("SELECT * FROM product_category");
$product_categoryname=$sth->fetchAll(PDO::FETCH_ASSOC);

if(isset($_POST['MM_inquire']) && $_POST['MM_inquire'] == "INQUIRE"){

  if($_POST['check_in_date']>$_POST['check_out_date']){//防呆機制 起始日期大於結束日期自動修正
    $indate=$_POST['check_out_date'];
    $outdate=$_POST['check_in_date'];
  }else{
    $indate=$_POST['check_in_date'];
    $outdate=$_POST['check_out_date'];
  }

    $sth=$db->query("SELECT*FROM product WHERE product_categoryID=".$_POST['product_categoryID']);//查詢這個分類底下之商品
    $product=$sth->fetchAll(PDO::FETCH_ASSOC);

    // for ( $i=0 ; $i<count($product) ; $i++ ) {//count統整產品比數， 直到比數搜尋完成

      foreach($product as $row){//將$product裏頭產品逐一帶入收尋

      $sth=$db->query("SELECT*FROM customer_order WHERE productID=".$row['productID']);//查詢這個分類底下之商品
      $customer_order=$sth->fetchAll(PDO::FETCH_ASSOC);

       foreach($customer_order as $row){

      //   if ($indate<$row['check_in_date'] AND $outdate<$row['check_in_date'])  ($indate>$row['check_out_date'] AND $outdate>$row['check_out_date']) {
      //
      //    }
      // }
  //     }
    }
    }
  }


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
      <h1>線上訂房系統</h1>
    </header>
      <div class="air">

      <form class="form-horizontal" role="form" data-toggle="validator" action="calendar.php" method="POST">

        <div class="form-group">
          <div class="col-sm-2">
            <label for="product_categoryID" class="control-label">房型</label>
          </div>

          <div class="col-sm-10">
          <select name="product_categoryID" id="product_categoryID">
            <?php foreach($product_categoryname as $row){ //查詢母體並單一排列?>
          　<optgroup label="<?php echo $row['category']; //顯示母體分類?>">

            <?php $sth=$db->query("SELECT * FROM product WHERE product_categoryID=".$row['product_categoryID']); //讓product依循母體進行分類?>
            <?php  $product=$sth->fetchAll(PDO::FETCH_ASSOC); ?>
            <?php foreach($product as $row){?>

            <option value="<?php echo $row['product_categoryID'];?>"><?php echo $row['name'];?></option>

          <?php } ?>

        <?php } ?>
          </select>
          </div>

        </div>

        <div class="form-group">
          <div class="col-sm-2">
            <label for="check_in_date" class="control-label">訂房日期</label>
          </div>
          <div class="col-sm-10">
            <input type="text" class="datepicker" id="check_in_date" name="check_in_date" required>
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-2">
            <label for="check_out_date" class="control-label">退房日期</label>
          </div>
          <div class="col-sm-10">
            <input type="text" class="datepicker" id="check_out_date" name="check_out_date" required>
          </div>
        </div>

        <input type="hidden" name="MM_inquire" value="INQUIRE">
      <button type="submit" class="btn btn-default">搜尋</button>
    </form>

      </div>
    </div>

    <div style="clear:both;"></div>
    <?php require_once("../template/footer2.php"); ?>
    <div style="clear:both;"></div>
  </body>
  </html>
