<?php
require_once('../connection/database.php');
$sth=$db->query("SELECT*FROM news ORDER BY publishedDate DESC ");
$news=$sth->fetchAll(PDO::FETCH_ASSOC);
 ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>最新消息-享樂民宿</title>
<?php require_once("template/files.php"); ?>
</head>
<body>
 <?php require_once("template/header.php"); ?>
<div id="news">
  <div class="new">嚴選優惠</div>

  <div class="text">

  <table>
    <thead>
        <?php foreach($news as $row){ ?>
      <tr>
        <th class="StrTopic"><a href="singlepost.php?newsID=<?php echo $row['newsID'];?>"><?php echo $row['title'] ?></a></th>
      </tr>
    </thead>
    <tbody>
      <tr>
          <td class="StrContent"><a href="singlepost.php?newsID=<?php echo $row['newsID'];?>"><?php echo $row['publishedDate'] ?><br><?php echo mb_substr( $row['content'],0,40,"utf-8")."..."; ?></a></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>

  </div>
</div>
<div style="clear:both;"></div>
<?php require_once("template/footer.php"); ?>
</body>

</html>
