<?php
require_once('../../connection/database.php');
session_start();

if((!empty($_SESSION['check_word'])) && (!empty($_POST['checkword']))){  //判斷此兩個檢查碼變數是否為空

     if($_SESSION['check_word'] == $_POST['checkword']){ //判斷此兩個變數是否相同

          $sql= "INSERT INTO member(account, password, createdDate, phone, birthday) VALUES ( :account, :password, :createdDate, :phone, :birthday)";
          $sth = $db ->prepare($sql);
          $sth ->bindParam(":account", $_POST['account'], PDO::PARAM_STR);
          $sth ->bindParam(":password", $_POST['password'], PDO::PARAM_STR);
          $sth ->bindParam(":birthday", $_POST['birthday'], PDO::PARAM_STR);
          $sth ->bindParam(":createdDate", $_POST['createdDate'], PDO::PARAM_STR);
        	$sth ->bindParam(":phone", $_POST['phone'], PDO::PARAM_STR);
          $sth -> execute();
     }
}
 ?>
<!doctype html>
<!-- Website ../template by freewebsite../templates.com -->
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>享樂-會員申請</title>
	<?php require_once("../template/files2.php"); ?>
</head>
<body>
  <?php require_once("../template/header2.php"); ?>

	<div id="box">
    <header>
      <h1>會員專區</h1>
    </header>

      <div class="air">
        <?php if($_SESSION['check_word'] == $_POST['checkword']){ ?>
        <p style="font-size:30px;">申請會員成功!</p>
          <p>您已成功加入會員，請至 <a href="member_login.php">登入頁</a>，登入您的帳號，方可進行購物。</p>
        <?php }else{ ?>
          <p style="font-size:30px;">登入錯誤</p>
            <p>請確認您的帳號密碼是否有誤。</p>
        <?php } ?>
      </div>
      <?php $_SESSION['check_word'] = ''; //比對正確後，清空將check_word值 ?>
    </div>
    <div style="clear:both;"></div>
    <?php require_once("../template/footer2.php"); ?>
    <div style="clear:both;"></div>
  </body>
  </html>
