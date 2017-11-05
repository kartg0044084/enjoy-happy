<?php
require('../../connection/database.php');
session_start();

if((!empty($_SESSION['check_word'])) && (!empty($_POST['checkword']))){  //判斷此兩個檢查碼變數是否為空

     if($_SESSION['check_word'] == $_POST['checkword']){ //判斷此兩個變數是否相同

          $sth = $db->query("SELECT * FROM member WHERE Account='".$_POST['account']."' AND Password='".$_POST['password']."'");

          $member = $sth->fetch(PDO::FETCH_ASSOC);

          if($member != NULL){
            $_SESSION['account'] = $member['account'];
            $_SESSION['memberID'] = $member['memberID'];
            header('Location: member_edit.php');
          }else{
            header('Location: login_error.php');
          }

          $_SESSION['check_word'] = ''; //比對正確後，清空將check_word值
     }
}


 ?>
