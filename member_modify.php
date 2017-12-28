<?php
session_start();
// 定义一个常量，用来授权调用includes里的文件
define('IN_TG', true);

// 定义一个常量,用来指定本页的内容
define('SCRIPT', 'member_modify');

// 引入公共文件
require dirname(__FILE__) . '/includes/conmon.inc.php';

// 修改资料
if ($_GET['action'] == 'modify') {
    if (! ! $_rows = _fetch_array("SELECT js_uniqid FROM js_user WHERE js_username='{$_COOKIE['username']}' LIMIT 1")) {
        // 为了防止cookie伪造，还要比对下唯一标识符uniqid()
        _uniqid($_rows['js_uniqid'], $_COOKIE['uniqid']);
        // 引入验证文件
        include ROOT_PATH . 'includes/check.func.php';
        // 创建一个数组，用来存放提交过来的合法数据
        $_clean = array();
        $_clean['username'] = _check_username($_POST['username'], 2, 20);
        $_clean['password'] = _check_modify_psw($_POST['password'], 6);
        $_clean['sex'] = $_POST['sex'];
        $_clean['face'] = $_POST['face'];
        $_clean['email'] = _check_email($_POST['email'], 6, 40);
        $_clean['address'] = $_POST['address'];
        $_clean['birthday'] = $_POST['birthday'];
        $_clean['phone'] = $_POST['phone'];
        $_clean['school'] = $_POST['school'];
        $_clean['qianming'] = $_POST['qianming'];
        
        if (empty($_clean['password'])) {
            _query("UPDATE js_user SET
                                            js_username='{$_clean['username']}',
                                            js_sex='{$_clean['sex']}',
                                            js_face='{$_clean['face']}',
                                            js_email='{$_clean['email']}',
                                            js_address='{$_clean['address']}',
                                            js_birthday='{$_clean['birthday']}',
                                            js_telphone='{$_clean['phone']}',
                                            js_school='{$_clean['school']}',
                                            js_qianming='{$_clean['qianming']}'
                                     WHERE
                                            js_username='{$_COOKIE['username']}'
                     ");
        } else {
            _query("UPDATE js_user SET
                                            js_username='{$_clean['username']}',
                                            js_password='{$_clean['password']}',
                                            js_sex='{$_clean['sex']}',
                                            js_face='{$_clean['face']}',
                                            js_email='{$_clean['email']}',
                                            js_address='{$_clean['address']}',
                                            js_birthday='{$_clean['birthday']}',
                                            js_telphone='{$_clean['phone']}',
                                            js_school='{$_clean['school']}',
                                            js_qianming='{$_clean['qianming']}'
                                     WHERE
                                            js_username='{$_COOKIE['username']}'
                                ");
        }
    }
    // 判断是否修改成功
    if (_affected_rows() == 1) {
        // 关闭数据库
        _close();
        _session_destroy();
        _location('恭喜你修改成功', 'member.php');
    } else {
        // 关闭数据库
        _close();
        _session_destroy();
        _location('很遗憾你修改失败', 'member_modify.php');
    }
}

// 是否正常登录
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
                                    js_qianming
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
        $_html['phone'] = $_rows['js_telphone'];
        $_html['school'] = $_rows['js_school'];
        $_html['qianming'] = $_rows['js_qianming'];
        $_html = _html($_html);
        
        // 性别选择
        if ($_html['sex'] == 0) {
            $_html['sex_html'] = '<label>
                                      <input type="radio" name="sex" value="0" checked> 男
                                    </label>
                                    <label>
                                      <input type="radio" name="sex" value="1"> 女
                                    </label>';
        } elseif ($_html['sex'] == 1) {
            $_html['sex_html'] = '<label>
                                      <input type="radio" name="sex" > 男
                                    </label>
                                    <label>
                                      <input type="radio" name="sex" checked> 女
                                    </label>';
        } elseif ($_html['sex'] == null) {
            $_html['sex_html'] = '<label>
                                      <input type="radio" name="sex" > 男
                                    </label>
                                    <label>
                                      <input type="radio" name="sex"> 女
                                    </label>';
        }
        
        // 地址选择
        if ($_html['address'] == null) {
            $_html['address_html'] = '<input type="text" name="address" class="form-control" placeholder="Address">';
        } else {
            $_html['address_html'] = '<input type="text" name="address" value="' . $_html['address'] . '" class="form-control" placeholder="Address">';
        }
        
        // 生日选择
        if ($_html['birthday'] == null) {
            $_html['birthday_html'] = '<input type="text" name="birthday" class="form-control" placeholder="Birthday">';
        } else {
            $_html['birthday_html'] = '<input type="text" name="birthday" value="' . $_html['birthday'] . '" class="form-control" placeholder="Birthday">';
        }
        
        // 手机选择
        if ($_html['phone'] == null) {
            $_html['phone_html'] = '<input type="text" name="phone" class="form-control" placeholder="Telphone">';
        } else {
            $_html['phone_html'] = '<input type="text" name="phone" value="' . $_html['phone'] . '" class="form-control" placeholder="Telphone">';
        }
        
        // 学校选择
        if ($_html['school'] == null) {
            $_html['school_html'] = '<input type="text" name="school" class="form-control" placeholder="School">';
        } else {
            $_html['school_html'] = '<input type="text" name="school" value="' . $_html['school'] . '" class="form-control" placeholder="School">';
        }
        
        // 个性签名
        if ($_html['qianming'] == null) {
            $_html['qianming_html'] = '<input type="text" name="qianming" class="form-control" placeholder="Personalized signature">';
        } else {
            $_html['qianming_html'] = '<input type="text" name="qianming" value="' . $_html['qianming'] . '" class="form-control" placeholder="Personalized signature">';
        }
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
	<link rel="stylesheet" type="text/css" href="css/member.css">
<script type="text/javascript" src="js/jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<title>简书--个人中心--修改信息</title>
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
						<h4>修改信息</h4>
						<form class="form-horizontal" id="modify" method="post"
							action="?action=modify">
							<div class="form-group">
								<label class="col-sm-2 control-label">昵称</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" name="username"
										placeholder="Username"
										value="<?php echo $_COOKIE['username']?>" readonly>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">密码</label>
								<div class="col-sm-8">
									<input type="password" class="form-control" name="password"
										placeholder="Password(留空则不修改)">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">性别</label>
								<div class=" col-sm-8">
									<div class="radio">
                                <?php echo $_html['sex_html']?>
                              </div>
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">头像</label>
								<div class="col-sm-8">
									<input type="file" name="face" class="form-control">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">地址</label>
								<div class="col-sm-8">
                              <?php echo $_html['address_html']?>
                            </div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">邮箱</label>
								<div class="col-sm-8">
									<input type="email" name="email"
										value="<?php echo $_html['email']?>" class="form-control"
										placeholder="Email">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">生日</label>
								<div class="col-sm-8">
                              <?php echo $_html['birthday_html']?>
                            </div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">手机</label>
								<div class="col-sm-8">
                              <?php echo $_html['phone_html']?>
                            </div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">学校</label>
								<div class="col-sm-8">
                              <?php echo $_html['school_html']?>
                            </div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label">个性签名</label>
								<div class="col-sm-8">
                              <?php echo $_html['qianming_html']?>
                            </div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<input type="submit" class="btn btn-default" value="修改" />
								</div>
							</div>

						</form>
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

