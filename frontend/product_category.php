<?php
require_once('../connection/database.php');
$sth=$db->query("SELECT * FROM product_category");
$product_category=$sth->fetchAll(PDO::FETCH_ASSOC);
 // print_r($attractions);
 if (isset($_GET['product_categoryID']) != NULL ) {
   $sth2=$db->query("SELECT * FROM product WHERE product_categoryID=".$_GET['product_categoryID']."");
   $categorie=$sth2->fetchAll(PDO::FETCH_ASSOC);
//if判斷式:判斷是否回傳$_GET['product_categoryID']
 }
 // print_r($_GET['product_categoryID']);
 ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>套裝景點-享樂民宿</title>
<?php require_once("template/files.php"); ?>
</head>
<body>
 <?php require_once("template/header.php"); ?>
<div id="product_category">
  <h3>房型介紹</h3>
  <div class="product">
      <?php if (isset($_GET['product_categoryID']) != NULL ) { ?>
        <h2>房型種類
      <?php }else{ ?>
    <h2>各式房型介紹
    <?php } ?>
      <ul>
        <?php if (isset($_GET['product_categoryID']) != NULL ) { ?>
          <?php foreach($categorie as $qq){ ?>
            <li><a href="product_content.php?productID=<?php echo $qq['productID'];?>"><?php echo $qq['name']; ?></a></li>
            <?php } ?>
        <?php }else{ ?>
        <?php foreach($product_category as $row){ ?>
        <li><a href="product_category.php?product_categoryID=<?php echo $row['product_categoryID'];?>"><?php echo $row['category']; ?></a></li>
      <?php } ?>
    <?php } ?>
      </ul>
    </h2>
  </div>
  <?php if (isset($_GET['product_categoryID']) != NULL ) { ?>
  <div class="product_category_img2"></div>
<?php }else{ ?>
  <div class="product_category_img"></div>
<?php } ?>
  <div style="clear:both;"></div>


  </div>





  <div style="clear:both;"></div>

</div>


<div style="clear:both;"></div>
<?php require_once("template/footer.php"); ?>
</body>

</html>
