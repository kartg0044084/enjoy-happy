<?php
session_start();
require_once('../connection/database.php');
// 取得時間
 $_POST['enddate'] = date("Y-m-d H:i:s");
//  傳送登入紀錄,寫入資料庫

// $sth2=$db->query("SELECT*FROM user_login_record WHERE userID=". $_SESSION['userID']." AND publishedDate='". $_SESSION['publishedDate']."'");
$sql= "UPDATE user_login_record SET account =:account,
          name = :name,
          publishedDate = :publishedDate,
          enddate = :enddate,
          userID = :userID WHERE userID=". $_SESSION['userID']." AND publishedDate='". $_SESSION['publishedDate']."'";
$sth = $db ->prepare($sql);

$sth ->bindParam(":account", $_SESSION['account'], PDO::PARAM_STR);
$sth ->bindParam(":name", $_SESSION['name'], PDO::PARAM_STR);
$sth ->bindParam(":publishedDate", $_SESSION['publishedDate'], PDO::PARAM_STR);
$sth ->bindParam(":enddate", $_POST['enddate'], PDO::PARAM_STR);
$sth ->bindParam(":userID", $_SESSION['userID'], PDO::PARAM_INT);
$sth ->execute();
// 清除$_SESSION
unset($_SESSION['account']);
$msg='您以成功登出';
header('Location: login.php?msg='.$msg);
?>
