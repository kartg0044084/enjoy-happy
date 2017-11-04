<?php
// 完成10/26
require_once('../template/login_check.php');
require_once('../../connection/database.php');
if(isset($_POST['MM_insert']) && $_POST['MM_insert'] == "INSERT"){
  $sql= "INSERT INTO news(publishedDate, title, content, createdDate) VALUES ( :publishedDate, :title, :content, :createdDate)";
  $sth = $db ->prepare($sql);
  $sth ->bindParam(":publishedDate", $_POST['publishedDate'], PDO::PARAM_STR);
  $sth ->bindParam(":title", $_POST['title'], PDO::PARAM_STR);
  $sth ->bindParam(":content", $_POST['content'], PDO::PARAM_STR);
  $sth ->bindParam(":createdDate", $_POST['createdDate'], PDO::PARAM_STR);
  $sth -> execute();

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
    <h1>最新活動管理</h1>
</div>
    <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">首頁</a></li>
    <li class="breadcrumb-item active">近期活動管理</li>
    <li class="breadcrumb-item active">新增一筆</li>
    </ol>

    <!--表單內容-->
    <form class="form-horizontal" role="form" data-toggle="validator" action="add.php" method="POST">
     <!--action="add.php" method="POST" form使用post方式回傳到本頁add.php -->
     <div class="form-group">
       <div class="col-sm-2">
         <label for="published_date" class="control-label">發布日期</label>
       </div>
       <div class="col-sm-10">
         <input type="text" class="form-control" id="published_date" name="published_date" data-error="請輸入字元" required>
         <div class="help-block"></div>
       </div>
     </div>

     <div class="form-group">
       <div class="col-sm-2">
         <label for="title" class="control-label">標題</label>
       </div>
       <div class="col-sm-10">
         <input type="text" class="form-control" id="title" name="title" data-error="請輸入字元" required>
         <div class="help-block"></div>
       </div>
     </div>
     <div class="form-group">
       <div class="col-sm-2">
         <label for="content" class="control-label">內容</label>
       </div>
       <div class="col-sm-10">
         <textarea class="form-control" id="content" name="content"></textarea>
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
