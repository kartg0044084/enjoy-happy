<?php
session_start();
require_once('../../connection/database.php');
unset($_SESSION['account']);
?>
<!doctype html>
<!-- Website ../template by freewebsite../templates.com -->
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>享樂民宿-會員申請</title>
<?php require_once("../template/files2.php"); ?>
</head>
<script type="text/javascript">
function refresh_code() {
document.getElementById('imgcode').src="captcha.php";
}
</script>
<body>

<div id="container">
<div id="row">
<?php require_once("../template/header2.php"); ?>
<div id="box">

<div class="air">

<header>
<h1>Login</h1>
</header>

<div class="row">
<div class="col-md-12">
<form action="login.php" method="post" data-toggle="validator">

<div class="form-group">
<div class="col-sm-2">
<label for="account" class="control-label">帳號</label>
</div>
<div class="col-sm-10">
<input type="email" class="form-control" id="account" name="account"  style="margin-bottom:10px;" value="account" data-error="請輸入帳號" required>
<div class="help-block with-errors"></div>
</div>
</div>

<div class="form-group">
<div class="col-sm-2">
<label for="password" class="control-label">密碼</label>
</div>
<div class="col-sm-10">
<input type="password" class="form-control" id="password" name="password" data-minlength="6" data-error="請輸入密碼" required>
<div class="help-block with-errors"></div>
</div>
</div>

<div class="col-sm-2">
<label for="phone" class="control-label">驗證碼</label>
</div>
<div class="form-group">
<div class="col-sm-10">
<input type="text" class="form-control" id="checkword" name="checkword" size="10" maxlength="10" data-error="請輸入驗證碼" required>
<div class="help-block with-errors"></div>
<h6>請輸入下圖字樣：</h6><h6><img id="imgcode" src="captcha.php" onclick="refresh_code()" /><br />
點擊圖片可以更換驗證碼
</h6>
</div>
</div>

<div class="form-group">
<div class="col-sm-12 text-center">
<button type="submit" class="btn btn-default" style="width:200px;">登入</button>
<!-- <a href="forget_password.php" style="margin-left:30px;">忘記密碼?</a> -->
</div>
</div>
</form>

<!-- <hr>
<h1>社群登入</h1>
<form action="apply_success.php" style="width:50%">
<input class="facebook" type="submit" value="facebook 登入" id="submit">
</form> -->

</div>
</div>
<hr>
<?php if(isset($_GET['msg']) && $_GET['msg'] != null){ ?>
<div class="alert alert-success">
<strong><?php echo $_GET['msg']; ?></strong>
</div>
<?php } ?>
</div>
</div>

<div style="clear:both;"></div>
<?php require_once("../template/footer2.php"); ?>
<div style="clear:both;"></div>
</div>
</div>

</body>
</html>
