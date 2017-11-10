<?php
session_start();
require_once('../../connection/database.php');
unset($_SESSION['room']); //清除room 訂購資料
$_SESSION['room'] = "";
$sth=$db->query("SELECT * FROM product r LEFT JOIN customer_order b ON r.productID = b.productID WHERE b.productID IS NOT NULL" );//顯示customer_order
$customer_order=$sth->fetchAll(PDO::FETCH_ASSOC);

$sth=$db->query("SELECT * FROM product_category");
$product_categoryname=$sth->fetchAll(PDO::FETCH_ASSOC);

   if(isset($_POST['MM_inquire']) && $_POST['MM_inquire'] == "INQUIRE"){

     if($_POST['check_in_date']>$_POST['check_out_date']){//防呆機制 起始日期大於結束日期自動修正
       $indate=$_POST['check_out_date'];
       $outdate=$_POST['check_in_date'];
     }else{
       $indate=$_POST['check_in_date'];
       $outdate=$_POST['check_out_date'];
     }

     $sth=$db->query("SELECT*FROM product WHERE productID=".$_POST['productID']);//查詢房型ID
     $product=$sth->fetchAll(PDO::FETCH_ASSOC);

     foreach($product as $row){
         $sth=$db->query("SELECT*FROM customer_order WHERE productID=".$row['productID']);//查詢這個customer_order底下的房型ID
         $customer_order=$sth->fetchAll(PDO::FETCH_ASSOC);
       }
       if (isset($product) == ($customer_order) ) {//判斷房間有無在訂單中，如無則跳過檢查
        $is_existed = "true";
            foreach($customer_order as $row){
             if((strtotime($indate)<strtotime($row['check_in_date']) && strtotime($outdate)<strtotime($row['check_in_date'])) || (strtotime($indate)>=strtotime($row['check_out_date']) && strtotime($outdate)>strtotime($row['check_out_date']))) {
              echo $is_existed;
               // 將接收的房型資料儲存temp 陣列
              $temp['productID']  = $row['productID'];
              $temp['check_in_date']  = $indate;
              $temp['check_out_date']  = $outdate;
              $_SESSION['room'][] = $temp;
              $msg = '房間日期已選擇，請重新登入帳號，完成訂單';
              header('Location: member_login.php?msg='.$msg); //前往member_login登陸會員
             }else{
             $is_existed = "false";
             $msg = '房間所選日期已被預定，請重新選擇日期';
             header('Location: date.php?msg='.$msg);
              }
          }
       }else{
         $temp['productID']  = $row['productID'];
         $temp['check_in_date']  = $indate;
         $temp['check_out_date']  = $outdate;
         $_SESSION['room'][] = $temp;
         $msg = '房間日期已選擇，請重新登入帳號，完成訂單';
         header('Location: member_login.php?msg='.$msg); //前往member_login登陸會員
       }
   }
    // print_r($_SESSION['room']);
    // print_r($is_existed);
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
<script>
$( function() {

$('#calendar').fullCalendar({
  header: {
    left: 'prev,next today',
    center: 'title',
    right: 'month'//agendaWeek,agendaDay,listMonth
  },
  defaultDate: '<?php echo date("Y/m/d")?>',
  navLinks: true, // can click day/week names to navigate views
  businessHours: true, // display business hours
  editable: true,
  events: [

  <?php foreach($customer_order as $row){ ?>
    <?php if ( strtotime(date("Y/m/d")) < strtotime($row['check_out_date'])) {?>//如果過於等於訂房今日則不顯示
    {
      title: '已預定 <?php echo $row['room']; ?>',
      start: '<?php echo $row['check_in_date']; ?>',
      end: '<?php echo $row['check_out_date']; ?>',
      color: '#8A3034',
    },
  <?php } ?>
<?php } ?>
  ]
});

});
</script>
<body>
  <?php require_once("../template/header2.php"); ?>

	<div id="box">
    <header>
      <h1>線上訂房系統</h1>
    </header>

    <div id='calendar'></div>
    <div class="air">
      <form class="form-horizontal" role="form" data-toggle="validator" action="date.php" method="POST">

        <div class="form-group">
          <div class="col-sm-2">
            <label for="product_categoryID" class="control-label">房型</label>
          </div>

          <div class="col-sm-10">
          <select name="productID" id="productID">
            <?php foreach($product_categoryname as $row){ //查詢母體並單一排列?>
          　<optgroup label="<?php echo $row['category']; //顯示母體分類?>">

            <?php $sth=$db->query("SELECT * FROM product WHERE product_categoryID=".$row['product_categoryID']); //讓product依循母體進行分類?>
            <?php  $product=$sth->fetchAll(PDO::FETCH_ASSOC); ?>
            <?php foreach($product as $row){?>

            <option value="<?php echo $row['productID'];?>"><?php echo $row['name'];?></option>

          <?php } ?>

        <?php } ?>
          </select>
          </div>

        </div>

        <div class="form-group">
          <div class="col-sm-2">
            <label for="check_in_date" class="control-label">訂房日期</label>
          </div>
          <div class="col-sm-10">
            <input type="text" class="datepicker" id="check_in_date" name="check_in_date" required>
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-2">
            <label for="check_out_date" class="control-label">退房日期</label>
          </div>
          <div class="col-sm-10">
            <input type="text" class="datepicker" id="check_out_date" name="check_out_date" required>
          </div>
        </div>

        <input type="hidden" name="MM_inquire" value="INQUIRE">
      <button type="submit" class="btn btn-default">搜尋</button>
    </form>
    </div>
    <hr>

    <?php if(isset($_GET['msg']) && $_GET['msg'] != null){ ?>
    <div class="alert alert-danger">
    <strong><?php echo $_GET['msg']; ?></strong>
    </div>
    <?php } ?>
    </div>
    <div style="clear:both;"></div>
      <?php require_once("../template/footer2.php"); ?>
  </body>

  </html>
