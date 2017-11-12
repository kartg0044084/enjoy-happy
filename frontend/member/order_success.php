<?php
session_start();
require_once('../../connection/database.php');
$sql= "INSERT INTO customer_order(check_in_date, check_out_date, productID, attractionsID, attractions_number, name, phone, email, service_charge, totalprice, orderNO, orderDate, memberID) VALUES ( :check_in_date, :check_out_date, :productID, :attractionsID, :attractions_number, :name, :phone, :email, :service_charge, :totalprice, :orderNO, :orderDate, :memberID)";
$sth = $db ->prepare($sql);
$sth ->bindParam(":check_in_date", $_SESSION['room']['0']['check_in_date'], PDO::PARAM_STR);
$sth ->bindParam(":check_out_date", $_SESSION['room']['0']['check_out_date'], PDO::PARAM_STR);
$sth ->bindParam(":productID", $_SESSION['room']['0']['productID'], PDO::PARAM_INT);
$sth ->bindParam(":attractionsID", $_SESSION['attractionsID'], PDO::PARAM_INT);
$sth ->bindParam(":attractions_number", $_SESSION['attractions_number'], PDO::PARAM_INT);
$sth ->bindParam(":name", $_SESSION['name'], PDO::PARAM_STR);
$sth ->bindParam(":phone", $_SESSION['phone'], PDO::PARAM_STR);
$sth ->bindParam(":email", $_SESSION['email'], PDO::PARAM_STR);
$sth ->bindParam(":service_charge", $_POST['service_charge'], PDO::PARAM_INT);
$sth ->bindParam(":totalprice", $_POST['totalprice'], PDO::PARAM_INT);
$sth ->bindParam(":orderNO", $_POST['orderNO'], PDO::PARAM_STR);
$sth ->bindParam(":orderDate", $_POST['orderDate'], PDO::PARAM_STR);
$sth ->bindParam(":memberID", $_POST['memberID'], PDO::PARAM_INT);
$sth -> execute();
session_unset(); //清除所有session
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
      <h1>訂房完成</h1>
    </header>

<div class="air">
	<div class="text">
住房、退房時限規定：<br>
入住時間(check-in)    為15:00後。請依民宿之規定辦理入住，住房旅客必須提供本人身分證(或護照)，以便查核登記。<br>
若您無法在20:00前辦理入住手續，請提前與民宿電話確認保留，否則將視為取消訂房，恕不退費，同時民宿有權將房間給予其他候補旅客。<br>
退房時間(check-out)  為11:00前。超過退房時間一個小時將依當日房價1/3計費，超過17：00將以當日房價計費。<br>
若持特殊優惠價格入住者，請在辦理住房手續時檢附證明文件。<br>
入住前一晚，民宿將會與入住之房客做電話確認。<br>
</div>
</div>
<div style="clear:both;"></div>
  </div>

    <div style="clear:both;"></div>
    <?php require_once("../template/footer2.php"); ?>
  </body>
  </html>
