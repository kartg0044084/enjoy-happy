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
<!-- // // 取得最新一筆customer_order的id值
// $sth2 = $db->query("SELECT * FROM customer_order WHERE memberID = ".$_POST['memberID']." ORDER BY createdDate DESC");
// $last_order = $sth2->fetch(PDO::FETCH_ASSOC);
//
// //寫入訂單明細order_details
// for($i = 0; $i <count($_SESSION['cart']);$i++){
// $sql= "INSERT INTO order_details(customer_orderID, productID, picture, name, price, quantity, createdDate) VALUES ( :customer_orderID, :productID, :picture, :name, :price, :quantity, :createdDate)";
// $sth = $db ->prepare($sql);
//  $sth ->bindParam(":customer_orderID", $last_order['customer_orderID'], PDO::PARAM_INT);//寫入上頭$last_order儲存的customer_order
// $sth ->bindParam(":productID", $_SESSION['cart'][$i]['productID'], PDO::PARAM_INT);
// $sth ->bindParam(":picture", $_SESSION['cart'][$i]['picture'], PDO::PARAM_STR);
// $sth ->bindParam(":name", $_SESSION['cart'][$i]['name'], PDO::PARAM_STR);
// $sth ->bindParam(":price", $_SESSION['cart'][$i]['price'], PDO::PARAM_INT);
// $sth ->bindParam(":quantity",$_SESSION['cart'][$i]['quantity'], PDO::PARAM_INT);
// $sth ->bindParam(":createdDate", $_SESSION['createdDate'], PDO::PARAM_STR);
// $sth -> execute();
// }
// unset($_SESSION['cart']);
// //寄訂單完成信給會員(給管理者)之後要補程式 -->
