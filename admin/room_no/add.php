<?php
// 完成10/26
require_once('../template/login_check.php');
require_once('../../connection/database.php');

if(isset($_POST['MM_insert']) && $_POST['MM_insert'] == "INSERT"){

  $room_no=($_POST['room_no']);   //初始號
  $room_no2=($_POST['room_no2']); //次數

for ( $i=0 ; $i<$room_no2 ; $i++ ) {
  $sql= "INSERT INTO room_no(room_noID, room_no, publishedDate) VALUES (:room_noID, :room_no, :publishedDate)";
  $sth = $db ->prepare($sql);
  $sth ->bindParam(":room_noID", $_POST['room_noID'], PDO::PARAM_INT);
  $sth ->bindParam(":room_no", $room_no, PDO::PARAM_INT);
  $sth ->bindParam(":publishedDate", $_POST['publishedDate'], PDO::PARAM_STR);
  $sth -> execute();

  $room_no++; //增加輸入的連號 201 202 203
}
  header('Location: list.php');
}
 ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>享樂後台系統</title>
<?php include_once('../template/header.php'); ?>

</head>

<body>
<div id="container">
 <div id="row">

	 <?php include_once('../template/nav.php'); ?>

<div id="content">
<div class="title">
    <h1>房號管理</h1>
</div>
    <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">首頁</a></li>
    <li class="breadcrumb-item active">房號管理</li>
    <li class="breadcrumb-item active">新增一筆</li>
    </ol>

    <!--表單內容-->
    <form class="form-horizontal" role="form" data-toggle="validator" action="add.php" method="POST">
     <!--action="add.php" method="POST" form使用post方式回傳到本頁add.php -->

     <div class="form-group">
       <div class="col-sm-2">
         <label for="room_noID" class="control-label">分類編號</label>
       </div>
       <div class="col-sm-10">
         <input type="radio"  id="room_noID" name="room_noID" value="1">1
         <input type="radio"  id="room_noID" name="room_noID" value="2">2
         <input type="radio"  id="room_noID" name="room_noID" value="3">3
         <input type="radio"  id="room_noID" name="room_noID" value="4">4
         <input type="radio"  id="room_noID" name="room_noID" value="5">5
         <div class="help-block"></div>
       </div>
     </div>

     <div class="form-group">
       <div class="col-sm-2">
         <label for="room_no" class="control-label">房號:請輸入3位數</label>
       </div>
       <div class="col-sm-10">
         <input type="text" class="form-control" id="room_no" name="room_no" pattern="[0-9]{3}" data-error="請輸入字元" required>
         <div class="help-block"></div>
       </div>
     </div>

     <div class="form-group">
       <div class="col-sm-2">
         <label for="room_no2" class="control-label">連號輸入</label>
       </div>
       <div class="col-sm-10">
         <input type="text" class="form-control" id="room_no2" name="room_no2" pattern="[0-9]{1}" data-error="請輸入字元" required>
         <div class="help-block"></div>
       </div>
     </div>

     <div class="form-group">
       <div class="col-sm-10 col-sm-offset-2 text-right">
          <input type="hidden" name="MM_insert" value="INSERT"> <!--form表單隱藏欄位-->
          <input type="text" name="publishedDate" value="<?php echo date('Y-m-d H:i:s'); ?>">
         <button type="submit" class="btn btn-primary">送出</button>
          <a href="list.php" class="btn btn-primary">返回</a>
       </div>
     </div>
   </form>




</div>
<?php include_once('../template/footer.php'); ?>



 </div>
</div>

</body>
</html>
