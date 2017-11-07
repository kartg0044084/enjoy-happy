<?php
require_once('connection/database.php');
$limit=3;
// 計算要從第幾筆開始
if (isset($_GET["page"])) {$page = $_GET["page"]; } else {$page=1; };
// 計算要從第幾筆開始
$start_from = ($page-1) * $limit;
$sth=$db->query("SELECT*FROM news ORDER BY publishedDate DESC LIMIT ".$start_from.",". $limit);
$news=$sth->fetchAll(PDO::FETCH_ASSOC);
 ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>享樂民宿</title>
<link rel="stylesheet" href="css/all.css">
<script src="js/jquery.js"></script>
<script src="js/all.js"></script>
<script src="js/wow.min.js"></script>
<script src="js/jquery.flexslider.js"></script>
</head>

<body>
          <!-- nav bar -->
   <div class="button_container" id="toggle">
   <span class="top"></span>
   <span class="middle"></span>
   <span class="bottom"></span>
 </div>
 <div class="overlay" id="overlay">
   <nav class="overlay-menu">
     <ul>
       <li><a href="index.php">首頁</a></li>
       <li><a href="frontend/about.php?pageID=1">民宿簡介</a></li>
       <li><a href="frontend/attractions_category.php">套裝景點</a></li>
       <li><a href="frontend/product_category.php">客房介紹</a></li>
       <li><a href="#">線上訂房系統</a></li>
       <li><a href="#">套裝行程</a></li>
     </ul>
   </nav>
 </div>
          <!-- nav bar -->
  <div id="top">
    <div class="logo"></div>
    <ul>
      <li><a href="frontend/member/member_apply.php">加入會員</a></li>
      <li><a href="frontend/member/member_login.php">會員登入</a></li>
      <li><a href="#">會員專區</a></li>
    </ul>
  </div>

  <div class="flexslider">
      <ul class="slides">
        <li><img src="img/pc/123.jpg" alt=""></li>
        <li><img src="img/pc/456.jpg" alt=""></li>
        <li><img src="img/pc/789.jpg" alt=""></li>
        <li><img src="img/pc/987.jpg" alt=""></li>
        <li><img src="img/pc/202.jpg" alt=""></li>
      </ul>
  </div>

<div id="content">
  <h6><a href="frontend/news.php">最新消息</a></h6>
<table>
      <?php foreach($news as $row){ ?>
    <tr>
      <td><a href="frontend/singlepost.php?newsID=<?php echo $row['newsID'];?>"> <?php echo $row['publishedDate'] ?> <?php echo $row['title'] ?> <?php echo mb_substr( $row['content'],0,40,"utf-8")."..."; ?></a></td>
    </tr>
    <?php } ?>
  </table>
<div class="address">
   <h5>貼心叮嚀</h5>
  <p>   ■	公共設施：冰箱、飲水機、無線寬頻上網(需自備電腦)。</p>
  <p>   ■	提供自行車使用服務。</p>
  <p>   ■	提供第四台有線頻道電視。</p>
  <p>   ■	無提供接送服務、早餐服務。</p>
  <p>   ■	代售海洋公園、兆豐農場門票。</p>
  <p>   ■	代辦賞鯨、溯溪、泛舟等套裝行程。</p>
  <p>   ■	代辦機車租賃服務。</p>
  <p>   ■	提前到或退房皆可行李寄放服務，但貴重物品請隨身攜帶，以免遺失。</p>

</div>
</div>

<div id="Introduction"></div>

<div id="room">
    <p>房間一覽</p>
    <div class="room1">
      <div><a href="#"><h4>和田雙人套房</h4><br>
      <br>※	冷氣、液晶電視、數位頻道、WIFI
      <br>※	精美牙刷沐浴組(拋棄式盥洗用品)、吹風機、大毛巾、小毛巾。
      <br>※	快煮壺、茶包、礦泉水
      <br>※	精緻拖鞋
      <br>※	觀光飯店等級高級獨立筒雙人床，羽絨被，床單天天換洗
      </a>
      </div>
    </div>
    <div class="room2">
      <div><a href="#"><h4>山嵐套房</h4><br>
      <br>※	冷氣、液晶電視、數位頻道、WIFI
      <br>※	精美牙刷沐浴組(拋棄式盥洗用品)、吹風機、大毛巾、小毛巾。
      <br>※	快煮壺、茶包、礦泉水
      <br>※	精緻拖鞋
      <br>※	觀光飯店等級高級獨立筒雙人床，羽絨被，床單天天換洗
      </a>
      </div>
    </div>
    <div class="room3">
      <div><a href="#"><h4>邀月六人套房</h4><br>
      <br>※	冷氣、液晶電視、數位頻道、WIFI
      <br>※	精美牙刷沐浴組(拋棄式盥洗用品)、吹風機、大毛巾、小毛巾。
      <br>※	快煮壺、茶包、礦泉水
      <br>※	精緻拖鞋
      <br>※	觀光飯店等級高級獨立筒雙人床，羽絨被，床單天天換洗
      </a>
      </div>
    </div>
</div>
<div style="clear:both;"></div>
 <div id="footer">
<div>
  <div class="list">
  <ul>
    <li><a href="frontend/about.php?pageID=1">開店動機</a></li>
    <li><a href="frontend/about.php?pageID=2">店名由來</a></li>
    <li><a href="#">交通資訊</a></li>
    <li><a href="#">台東市區</a></li>
    <li><a href="#">台東縱谷</a></li>
    <li><a href="#">東海岸線</a></li>
    <li><a href="#">訂房說明</a></li>
    <li><a href="#">貼心服務</a></li>
    <li><a href="#">訂房叮嚀</a></li>
    <li><a href="#" class="icon-google2"> google</a></li>
    <li><a href="#" class="icon-facebook2"> facebook</a></li>
    <li><a href="#" class="icon-twitter"> twitter</a></li>
  </ul>
  </div>
  <div class="mape">
   <img src="img/O1T1U65Y6U.png" alt="">
   <p>享樂民宿</p>
  <p>地址：宜蘭縣仁愛鄉大同村博望巷9-7號</p>
  <p>松崗派出所：049</p>
  </div>
</div>
</div>

<!-- 左側訂房商標 -->
<div id="Reservation" class="icon-home"><a href="#">空房查詢</a></div>
<!-- 左側訂房商標 -->
</body>
</html>
