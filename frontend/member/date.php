<?php
require_once('../../connection/database.php');
session_start();

$date=date("t");//本月天數
$days = array("");//定義空陣列
$product= array("");//定義空陣列

  for ( $i=1 ; $i<=$date ; $i++ ) {//迴圈列出日期

   $sth=$db->query("SELECT*FROM customer_order" );//顯示customer_order
   $customer_order=$sth->fetchAll(PDO::FETCH_ASSOC);

   foreach($customer_order as $row){
     //strtotime 便於讓字串比大小
     if((strtotime(date('Y/m/').$i) >= strtotime($row['check_in_date'])) && (strtotime(date('Y/m/').$i) < strtotime($row['check_out_date']))) { //判斷日期是否在訂單的時間區間內
          $days[$i]=$i;//讓陣列包入變數

          $product[$i][] = [ $days[$i] , $row['productID']];//將此變數陣列加入二維之中
          // print_r($product);


    }
  }
 }
 print_r($product);
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




      </div>
    </div>

    <div style="clear:both;"></div>
    <?php require_once("../template/footer2.php"); ?>
    <div style="clear:both;"></div>
  </body>
  </html>
