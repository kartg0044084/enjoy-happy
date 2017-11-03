<?php
 require_once('../connection/database.php');
 $sth2=$db->query("SELECT * FROM product WHERE productID=".$_GET['productID']."");
 $product=$sth2->fetch(PDO::FETCH_ASSOC);
// print_r($_GET['productID']);
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
 <div id="product_content">
   <h3>房型介紹</h3>

   <div class="contenttitle">DELUXE <?php echo $product['name']; ?></div>

   <img src="../uploads/products/<?php echo $product['picture'];?>" alt="">

   <table>
     <thead>
       <tr>
         <th>房型</th>
         <th>可住人數</th>
         <th>價錢</th>
         <th>說明</th>
       </tr>
     </thead>
     <tbody>
       <tr>
          <td><?php echo $product['room']; ?></td>
          <td><?php echo $product['people']; ?>人</td>
          <td>$NT<?php echo $product['price']; ?></td>
          <td style="text-align:left;padding:50px 50px;line-height:30px;font-size: 14px;"><?php echo $product['content']; ?></td>
       </tr>
     </tbody>
   </table>
    <a href="product_category.php?product_categoryID=<?php echo $product['product_categoryID'];?>">回上一頁</a>
 </div>
<div style="clear:both;"></div>




<div style="clear:both;"></div>
<?php require_once("template/footer.php"); ?>
</body>

</html>
