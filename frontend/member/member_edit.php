<?php
session_start();
require_once('../../connection/database.php');

// 圖片上傳語法
if(isset($_FILES['picture']['name']) && $_FILES['picture']['name'] != null){
  if (!file_exists('../../uploads/products')) mkdir('../../uploads/products', 0755, true);
      $path = $_FILES['picture']['name'];
  //取得副檔名
  $ext = pathinfo($path, PATHINFO_EXTENSION);
  //重新命名, 2位數加時間
  $filename = rand(10,100).date('His').".".$ext;
  move_uploaded_file($_FILES['picture']['tmp_name'],"../../uploads/member/".$filename);   // 搬移上傳檔案
}

if(isset($_POST['MM_update']) && $_POST['MM_update'] == "UPDATE"){
$sql= "UPDATE member SET account =:account,
name = :name,
gender = :gender,
birthday = :birthday,
picture = :picture,
phone = :phone,
mobilephone = :mobilephone,
address = :address WHERE memberID=:memberID";
$sth = $db ->prepare($sql);

$sth ->bindParam(":account", $_POST['account'], PDO::PARAM_STR);
$sth ->bindParam(":name", $_POST['name'], PDO::PARAM_STR);
$sth ->bindParam(":gender", $_POST['gender'], PDO::PARAM_INT);
$sth ->bindParam(":birthday", $_POST['birthday'], PDO::PARAM_STR);
$sth ->bindParam(":picture", $filename, PDO::PARAM_STR);
$sth ->bindParam(":phone", $_POST['phone'], PDO::PARAM_INT);
$sth ->bindParam(":mobilephone", $_POST['mobilephone'], PDO::PARAM_INT);
$sth ->bindParam(":address", $_POST['address'], PDO::PARAM_STR);
$sth ->bindParam(":memberID", $_POST['memberID'], PDO::PARAM_INT);
$sth -> execute();

header('Location: member_edit.php');
}
$sth2=$db->query("SELECT*FROM member");
$member=$sth2->fetch(PDO::FETCH_ASSOC);
?>

<!doctype html>
<!-- Website ../template by freewebsite../templates.com -->
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0" >
<title>Cake House-會員資料修改</title>
<?php require_once("../template/files2.php"); ?>
</head>
<body>
<div id="container">
<div id="row">
<?php require_once("../template/header2.php"); ?>
<div id="box">

<header>
<h1>會員專區</h1>
</header>

<ul>
<li><a href="#" class="label label-info">會員資料更改</a></li>
<li><a href="#" class="label label-info">我的購物車</a></li>
<li><a href="#" class="label label-info">我的訂單</a></li>
</ul>
<div style="clear:both;"></div>

<div class="row">

<h2>會員資料修改</h2>
  <form class="form-horizontal" role="form" data-toggle="validator" action="member_edit.php" method="POST" enctype="multipart/form-data"> <!-- enctype="multipart/form-data" 為圖片上傳必要格式-->
<div class="form-group">
<div class="col-sm-2">
<label for="account" class="control-label">帳號</label>
</div>
<div class="col-sm-10">
<input type="text" class="form-control" id="account" name="account" value="<?php echo $member['account']?>">
<div class="help-block with-errors"></div>
</div>
</div>

<div class="form-group">
<div class="col-sm-2">
<label for="name" class="control-label">姓名：</label>
</div>
<div class="col-sm-10">
<input type="text" class="form-control" id="name" name="name" value="<?php echo $member['name']?>">
<div class="help-block with-errors"></div>
</div>
</div>

<div class="form-group">
<div class="col-sm-2">
<label for="gender" class="control-label">性別：</label>
</div>
<div class="col-sm-10">
<input type="radio" id="gender" name="gender" value="0" <?php if($member ['gender'] == 0) echo "checked"; ?>> 男
<input type="radio" id="gender" name="gender" value="1" <?php if($member ['gender'] == 1) echo "checked"; ?>> 女
<div class="help-block with-errors"></div>
</div>
</div>

<div class="form-group">
<div class="col-sm-2">
<label for="birthday" class="control-label">生日：</label>
</div>
<div class="col-sm-10">
<input type="text" class="datepicker  form-control" id="birthday" name="birthday" value="<?php echo $member['birthday']?>">
<div class="help-block with-errors"></div>
</div>
</div>

<div class="form-group">
  <div class="col-sm-2">
    <label for="picture" class="control-label">會員照片</label>
  </div>
  <div class="col-sm-10">
    <input type="file" class="form-control" id="picture" name="picture" value="<?php echo $member['picture']; ?>" >
    <div class="help-block"></div>
  </div>
</div>

<div class="form-group">
<div class="col-sm-2">
<label for="phone" class="control-label">聯絡電話：</label>
</div>
<div class="col-sm-10">
<input type="text" class="form-control" id="phone" name="phone" value="<?php echo $member['phone']?>">
<div class="help-block with-errors"></div>
</div>
</div>

<div class="form-group">
<div class="col-sm-2">
<label for="mobilephone" class="control-label">行動電話：</label>
</div>
<div class="col-sm-10">
<input type="text" class="form-control" id="mobilephone" name="mobilephone" value="<?php echo $member['mobilephone']?>">
<div class="help-block with-errors"></div>
</div>
</div>

<div class="form-group">
<div class="col-sm-2">
<label for="address" class="control-label">地址：</label>
</div>
<div class="col-sm-10">
<input type="text" class="form-control" id="address" name="address" value="<?php echo $member['address']?>">
<div class="help-block with-errors"></div>
</div>
</div>

<input type="hidden" name="memberID" value="<?php echo $member['memberID']; ?>">
<!-- 隱藏表單 透過 memberID 更新(由上往下跑) 完成更新 -->
<input type="hidden" name="MM_update" value="UPDATE">
<input type="submit" value="更新資料" id="submit" >
</form>
</div>
</div>

<div style="clear:both;"></div>
<?php require_once("../template/footer2.php"); ?>
<div style="clear:both;"></div>
</div>
</div>
</body>
</html>
