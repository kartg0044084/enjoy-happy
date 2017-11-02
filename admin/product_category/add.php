<?php
// 完成10/26
require_once('../template/login_check.php');
require_once('../../connection/database.php');

// 圖片上傳語法
if(isset($_FILES['picture']['name']) && $_FILES['picture']['name'] != null){
  if (!file_exists('../../uploads/products')) mkdir('../../uploads/products', 0755, true);
      $path = $_FILES['picture']['name'];
  //取得副檔名
  $ext = pathinfo($path, PATHINFO_EXTENSION);
  //重新命名, 2位數加時間
  $filename = rand(10,100).date('His').".".$ext;
  move_uploaded_file($_FILES['picture']['tmp_name'],"../../uploads/product_category/".$filename);   // 搬移上傳檔案
}

if(isset($_POST['MM_insert']) && $_POST['MM_insert'] == "INSERT"){
  $sql= "INSERT INTO product_category( category, picture) VALUES ( :category, :picture)";
  $sth = $db ->prepare($sql);
  $sth ->bindParam(":category", $_POST['category'], PDO::PARAM_STR);
  $sth ->bindParam(":picture", $filename, PDO::PARAM_STR);
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
    <h1>訂房分類管理</h1>
</div>
    <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="#">首頁</a></li>
    <li class="breadcrumb-item active">訂房分類管理</li>
    <li class="breadcrumb-item active">新增一筆</li>
    </ol>

    <!--表單內容-->
    <form class="form-horizontal" role="form" data-toggle="validator" action="add.php" method="POST" enctype="multipart/form-data"> <!-- enctype="multipart/form-data" 為圖片上傳必要格式-->
     <!--action="add.php" method="POST" form使用post方式回傳到本頁add.php -->
     <div class="form-group">
       <div class="col-sm-2">
         <label for="category" class="control-label">分類名稱</label>
       </div>
       <div class="col-sm-10">
         <input type="text" class="form-control" id="category" name="category" data-error="請輸入字元" required>
         <div class="help-block"></div>
       </div>
     </div>

     <div class="form-group">
       <div class="col-sm-2">
         <label for="picture" class="control-label">分類圖片</label>
       </div>
       <div class="col-sm-10">
         <input type="file" class="form-control" id="picture" name="picture" data-error="請輸入字元" required>
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
   <page aria-label="Page navigation example"><!--空區塊 -->
   <ul class="pagination">

   </ul>
   </page>



</div>
<?php include_once('../template/footer.php'); ?>



 </div>
</div>

</body>
</html>
