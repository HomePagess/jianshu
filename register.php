
<?php
session_start();

// 定义一个常量，用来授权调用includes里的文件
define('IN_TG', true);

// 引入公共文件
require dirname(__FILE__) . '/includes/conmon.inc.php';

// 登录状态判断
_login_state();

// 判断是否提交了
if ($_GET['action'] == 'register') {
    // 为了防止恶意注册，跨站攻击
    _check_code($_POST['yzm'], $_SESSION['code']);
    
    // 引入验证文件
    include ROOT_PATH . 'includes/check.func.php';
    // 创建一个数组，用来存放提交过来的合法数据
    $_clean = array();
    // 可以通过唯一标识符来防止恶意注册，伪装表单跨站攻击
    // 这个存放人数据库的唯一标识符还有第二个用处，就是登录的cookie验证
    $_clean['uniqid'] = _check_uniqid($_POST['uniqid'], $_SESSION['uniqid']);
    // 接收数据放入数组
    // active也是一个唯一标识符，用来刚注册的用户进行激活处理，方可登录
    $_clean['active'] = _sha1_uniqid();
    $_clean['username'] = _check_username($_POST['username'], 2, 20);
    $_clean['password'] = _check_password($_POST['password'], 6);
    $_clean['email'] = _check_email($_POST['email'], 6, 40);
    
    // 在新增之前，要判断用户名是否重复
    _is_repeat("SELECT js_username FROM js_user WHERE js_username='{$_clean['username']}'LIMIT 1", '对不起，此用户名已被注册！');
    
    // 新增用户
    _query("INSERT INTO js_user(
                                    js_uniqid,
                                    js_active,
                                    js_username,
                                    js_password,
                                    js_email,
                                    js_time,
                                    js_last_time,
                                    js_last_ip
                                )
                        VALUES(
                                    '{$_clean['uniqid']}',
                                    '{$_clean['active']}',
                                    '{$_clean['username']}',
                                    '{$_clean['password']}',
                                    '{$_clean['email']}',
                                    NOW(),
                                    NOW(),
                                    '{$_SERVER["REMOTE_ADDR"]}'
                                )");
    
    if (_affected_rows() == 1) {
        // 关闭数据库
        _close();
        _session_destroy();
        _location('恭喜你注册成功', 'active.php?active=' . $_clean['active']);
    } else {
        // 关闭数据库
        _close();
        _session_destroy();
        _location('很遗憾你注册失败', 'register.php');
    }
} else {
    $_SESSION['uniqid'] = $_uniqid = _sha1_uniqid();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="fonts/iconfont.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/register.css">
<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/code.js"></script>
<script type="text/javascript" src="js/register.js"></script>
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
					<a href="login.php">登录</a> <b>·</b> <a href="register.php"
						id="register-btn">注册</a>
				</div>
			</h4>
			<div class="register-container">
				<form class="new-user" action="register.php?action=register"
					name='register' method="post">
					<input type="hidden" name="uniqid" value="<?php echo $_uniqid?>">
					<div class="input-prepend restyle">
						<input type="text" name="username" placeholder="请输入昵称"> <span
							class="iconfont icon-yonghuming"></span>
					</div>
					
					<div class="input-prepend restyle no-radius">
						<input type="password" name="password" placeholder="请输入密码"> <span
							class="iconfont icon-mima"></span>
					</div>
					<div class="input-prepend restyle no-radius">
						<input type="email" name="email" placeholder="请输入邮箱"> <span
							class="iconfont icon-youxiang"></span>
					</div>
					<div class="input-prepend">
						<input type="text" name="yzm" placeholder="请输入验证码" class="yzm" />
						<img src="code.php" id="pan">
					</div>
					<input type="submit" value="注册" class="register-button">
					<p class="register-msg">
						点击 “注册” 即表示您同意并愿意遵守简书 <br /> <a href="#">用户协议</a> 和 <a href="#">隐私政策</a>
						。
					</p>
				</form>
				<div class="more-sign">
					<h6>社交帐号直接注册</h6>
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