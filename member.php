<?php

// 定义一个常量，用来授权调用includes里的文件
define('IN_TG', true);

// 定义一个常量,用来指定本页的内容
define('SCRIPT', 'member');

// 引入公共文件
require dirname(__FILE__) . '/includes/conmon.inc.php';

if (isset($_COOKIE["username"])) {
    $_rows = _fetch_array("SELECT
                                    js_username,
                                    js_sex,
                                    js_face,
                                    js_email,
                                    js_address,
                                    js_birthday,
                                    js_telphone,
                                    js_school,
                                    js_qianming,
                                    js_time
                              FROM
                                    js_user
                             WHERE
                                    js_username='{$_COOKIE['username']}'
                                    ");
    if ($_rows) {
        $_html = array();
        $_html['username'] = $_rows['js_username'];
        $_html['sex'] = $_rows['js_sex'];
        $_html['face'] = $_rows['js_face'];
        $_html['email'] = $_rows['js_email'];
        $_html['address'] = $_rows['js_address'];
        $_html['birthday'] = $_rows['js_birthday'];
        $_html['telphone'] = $_rows['js_telphone'];
        $_html['school'] = $_rows['js_school'];
        $_html['qianming'] = $_rows['js_qianming'];
        $_html['time'] = $_rows['js_time'];
        if (empty($_html['sex'])) {
            $_html['sex'] = '请完善您的信息';
        } elseif ($_html['sex'] == 0) {
            $_html['sex'] = '男';
        } elseif ($_html['sex'] == 1) {
            $_html['sex'] = '女';
        }
        if (empty($_html['email'])) {
            $_html['email'] = '请完善您的信息';
        }
        if (empty($_html['address'])) {
            $_html['address'] = '请完善您的信息';
        }
        if (empty($_html['birthday'])) {
            $_html['birthday'] = '请完善您的信息';
        }
        if (empty($_html['telphone'])) {
            $_html['telphone'] = '请完善您的信息';
        }
        if (empty($_html['school'])) {
            $_html['school'] = '请完善您的信息';
        }
        if (empty($_html['qianming'])) {
            $_html['qianming'] = '请完善您的信息';
        }
        $_html = _html($_html);
    } else {
        _alert_back('此用户不存在');
    }
} else {
    _alert_back('非法登录');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
require ROOT_PATH . 'includes/title.inc.php';
?>
	<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<title>简书--个人中心</title>
</head>
<body>
	<!-- 导航栏开始 -->
    <?php
    require ROOT_PATH . 'includes/header.inc.php';
    ?>
	
    <!--个人中心顶部 -->
	<?php
require ROOT_PATH . 'includes/member_top.inc.php';
?>
	
	<div class="container" id="member_main">
		<div class="row">
			<?php
require ROOT_PATH . 'includes/member_sidebar.inc.php';
?>
			<div class="col-xs-10" id="member_main_right">
				<div class="member_show">
					<div class="person_info">
						<h4>个人信息</h4>
						<div class="info_show">
							<ul>
								<li><span class="labels">昵称</span> <span><?php echo $_html['username']?></span>
								</li>
								<li><span class="labels">性别</span> <span><?php echo $_html['sex']?></span>
								</li>
								<li><span class="labels">所在地</span> <span><?php echo $_html['address']?></span>
								</li>
								<li><span class="labels">生日</span> <span><?php echo $_html['birthday']?></span>
								</li>
								<li><span class="labels">手机</span> <span><?php echo $_html['telphone']?></span>
								</li>
								<li><span class="labels">邮箱</span> <span><?php echo $_html['email']?></span>
								</li>
								<li><span class="labels">个性签名</span> <span><?php echo $_html['qianming']?></span>
								</li>
								<li><span class="labels">学校</span> <span><?php echo $_html['school']?></span>
								</li>
								<li><span class="labels">注册时间</span> <span><?php echo $_html['time']?></span>
								</li>
							</ul>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>


	<!-- 底部开始 -->
	<?php
require ROOT_PATH . 'includes/footer.inc.php';
?>
	<!-- 底部结束 -->
</body>
</html>


