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
    move_uploaded_file($_FILES['picture']['tmp_name'],"../../uploads/products/".$filename);   // 搬移上傳檔案
  }

  if(isset($_POST['MM_update']) && $_POST['MM_update'] == "UPDATE"){
    // 此處容易忘記
    $sql= "UPDATE product SET picture =:picture,
              name = :name,
              price = :price,
               room = :room,
               people = :people,
                content = :content,
              updatedDate = :updatedDate WHERE productID=:productID";
    $sth = $db ->prepare($sql);

    $sth ->bindParam(":picture", $filename, PDO::PARAM_STR);
    $sth ->bindParam(":name", $_POST['name'], PDO::PARAM_STR);
    $sth ->bindParam(":price", $_POST['price'], PDO::PARAM_INT);
    $sth ->bindParam(":room", $_POST['room'], PDO::PARAM_STR);
    $sth ->bindParam(":people", $_POST['people'], PDO::PARAM_STR);
    $sth ->bindParam(":content", $_POST['content'], PDO::PARAM_STR);
    $sth ->bindParam(":updatedDate", $_POST['updatedDate'], PDO::PARAM_STR);
    $sth ->bindParam(":productID", $_POST['productID'], PDO::PARAM_INT);
    $sth ->execute();

    header("Location: list.php?product_categoryID=".$_POST['product_categoryID']);
  }

  $sth = $db->query("SELECT * FROM product WHERE productID=".$_GET['productID']);
  $product = $sth->fetch(PDO::FETCH_ASSOC);
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
    <form class="form-horizontal" role="form" data-toggle="validator" action="edit.php" method="POST" enctype="multipart/form-data"> <!-- enctype="multipart/form-data" 為圖片上傳必要格式-->
     <!--action="add.php" method="POST" form使用post方式回傳到本頁add.php -->
     <div class="form-group">
       <div class="col-sm-2">
         <label for="picture" class="control-label">客房圖片</label>
       </div>
       <div class="col-sm-10">
         <img src="../../uploads/products/<?php echo $product['picture']; ?>"><?php echo $product['picture']; ?>
         <input type="file" class="form-control" id="picture" name="picture" data-error="請輸入字元" required>
         <div class="help-block"></div>
       </div>
     </div>

     <div class="form-group">
       <div class="col-sm-2">
         <label for="name" class="control-label">客房名稱</label>
       </div>
       <div class="col-sm-10">
         <input type="text" class="form-control" id="name" name="name" value="<?php echo $product['name']; ?>" data-error="請輸入字元" required>
         <div class="help-block"></div>
       </div>
     </div>

     <div class="form-group">
       <div class="col-sm-2">
         <label for="price" class="control-label">客房價格</label>
       </div>
       <div class="col-sm-10">
         <input type="text" class="form-control" id="price" name="price" value="<?php echo $product['price']; ?>" data-error="請輸入字元" required>
         <div class="help-block"></div>
       </div>
     </div>

     <div class="form-group">
       <div class="col-sm-2">
         <label for="room" class="control-label">客房類型</label>
       </div>
       <div class="col-sm-10">
         <input type="text" class="form-control" id="room" name="room" value="<?php echo $product['room']; ?>" data-error="請輸入字元" required>
         <div class="help-block"></div>
       </div>
     </div>

     <div class="form-group">
       <div class="col-sm-2">
         <label for="people" class="control-label">可住人數</label>
       </div>
       <div class="col-sm-10">
         <input type="text" class="form-control" id="people" name="people" value="<?php echo $product['people']; ?>" data-error="請輸入字元" required>
         <div class="help-block"></div>
       </div>
     </div>

     <div class="form-group">
       <div class="col-sm-2">
         <label for="content" class="control-label">客房介紹</label>
       </div>
       <div class="col-sm-10">
         <textarea type="text" class="form-control" id="content" name="content"><?php echo $product['content']; ?></textarea>
       </div>
     <div class="form-group">
       <div class="col-sm-10 col-sm-offset-2 text-right">
         <input type="hidden" name="product_categoryID" value="<?php echo $_GET['product_categoryID']; ?>">
         <input type="hidden" name="productID" value="<?php echo $product['productID']; ?>">
         <input type="hidden" name="MM_update" value="UPDATE"> <!--form表單隱藏欄位-->
          <input type="text" name="updatedDate" value="<?php echo date('Y-m-d H:i:s'); ?>">
         <button type="submit" class="btn btn-primary">送出</button>
          <a href="list.php" class="btn btn-primary">返回</a>
       </div>
     </div>
   </form>

</div>

 </div>
 <?php include_once('../template/footer.php'); ?>
</div>


</body>
</html>
