<?php
session_start();
// 定义一个常量，用来授权调用includes里的文件
define('IN_TG', true);

// 引入公共文件
require dirname(__FILE__) . '/includes/conmon.inc.php';
// 登录状态判断
_login_state();
// 开始处理登录状态
if ($_GET['action'] == 'login') {
    _check_code($_POST['yzm'], $_SESSION['code']);
    // 引入验证文件
    include ROOT_PATH . 'includes/login.func.php';
    // 接收数据
    $_clean = array();
    $_clean['username'] = _check_username($_POST['username'], 2, 20);
    $_clean['password'] = _check_password($_POST['password'], 6);
    $_clean['time'] = _check_time($_POST['time']);
    
    // 到数据库区验证
    if (! ! $_rows = _fetch_array("SELECT js_username,js_uniqid FROM js_user WHERE js_username='{$_clean['username']}' AND js_password='{$_clean['password']}' LIMIT 1")) {
        _close();
        _session_destroy();
        _setcookies($_rows['js_username'], $_rows['js_uniqid'], $_clean['time']);
        _location(null, 'index.php');
    } else {
        _close();
        _session_destroy();
        _location('用户名密码不正确或该账户未被激活', 'login.php');
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="fonts/iconfont.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/login.css">
<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/code.js"></script>
<script type="text/javascript" src="js/login.js"></script>
<title>sign</title>
</head>
<body>
	<div class="sign">
		<div class="logo hidden-xs">
			<a href="index.php"> <img src="images/logo.png" alt="">
			</a>
		</div>
		<div class="main">
			<h4 class="title">
				<div class="normal-title">
					<a href="login.php" id="login-btn">登录</a> <b>·</b> <a
						href="register.php" id="register-btn">注册</a>
				</div>
			</h4>
			<div class="login-container">
				<form class="user" action="login.php?action=login" name='login'
					method="post">
					<div class="input-prepend restyle">
						<input type="text" name="username" placeholder="你的昵称"> <span
							class="iconfont icon-yonghuming"></span>
					</div>

					<div class="input-prepend restyle no-radius">
						<input type="password" name="password" placeholder="输入密码"> <span
							class="iconfont icon-mima"></span>
					</div>
					<div class="input-prepend">
						<input type="text" name="yzm" placeholder="验证码" class="yzm" /> <img
							src="code.php" id="pan">
					</div>
					<div class="form-group">
						<div class="col-sm-12"
							style="text-align: left; font-size: 14px; margin-bottom: 15px;">
							记住密码： <label class="radio-inline"> <input type="radio"
								name="time" value="0" checked>不保留
							</label> <label class="radio-inline"> <input type="radio"
								name="time" value="1">保留一天
							</label> <label class="radio-inline" style="margin-left: 74px;">
								<input type="radio" name="time" value="2">保留一周
							</label> <label class="radio-inline"> <input type="radio"
								name="time" value="3">保留一月
							</label>
						</div>
					</div>
					<input type="submit" value="登录" class="login-button">

				</form>
				<div class="more-sign">
					<h6>社交账号直接登录</h6>
					<ul>
						<li><a href="#" class="weixin"><span class="iconfont icon-weixin"></span></a></li>
						<li><a href="#" class="weibo"><span class="iconfont icon-weibo"></span></a></li>
						<li><a href="#" class="qq"><span class="iconfont icon-QQ"></span></a></li>
					</ul>
				</div>
			</div>

		</div>
	</div>
</body>
</html>