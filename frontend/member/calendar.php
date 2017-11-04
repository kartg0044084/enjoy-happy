<?php
require_once('../../connection/database.php');
session_start();
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
<body>
  <?php require_once("../template/header2.php"); ?>

	<div id="box">
    <header>
      <h1>訂房系統</h1>
    </header>
      <div class="air">

        <div class="form-group">
          <div class="col-sm-2">
            <label for="account" class="control-label">訂房日期</label>
          </div>
          <div class="col-sm-10">
            <input type="text" class="datepicker">
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-2">
            <label for="account" class="control-label">退房日期</label>
          </div>
          <div class="col-sm-10">
            <input type="text" class="datepicker">
          </div>
        </div>

      <button type="button" class="btn btn-default">搜尋</button>
      </div>
    </div>


    <div style="clear:both;"></div>
    <?php require_once("../template/footer2.php"); ?>
    <div style="clear:both;"></div>
  </body>
  </html>
