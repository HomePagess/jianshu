<?php
session_start();
// 定义一个常量，用来授权调用includes里的文件
define('IN_TG', true);

// 定义一个常量,用来指定本页的内容
define('SCRIPT', 'write');

// 引入公共文件
require dirname(__FILE__) . '/includes/conmon.inc.php';

// 判断是否登录
if (! isset($_COOKIE["username"])) {
    _location('请先登录', 'login.php');
}

// 将文章写入数据库
if ($_GET['action'] == 'write') {
    if (! ! $_rows = _fetch_array("SELECT js_uniqid,js_face FROM js_user WHERE js_username='{$_COOKIE['username']}' LIMIT 1")) {
        // 为了防止cookie伪造，还要比对下唯一标识符uniqid()
        _uniqid($_rows['js_uniqid'], $_COOKIE['uniqid']);
        // 引入验证文件
        include ROOT_PATH . 'includes/check.func.php';
        // 接受帖子内容
        $_clean = array();
        $_clean['username'] = $_COOKIE['username'];
        $_clean['face'] = $_rows['js_face'];
        $_clean['title'] = _check_post_title($_POST['title'], 2, 40);
        $_clean['content'] = _check_post_content($_POST['content'], 10);
        $_clean['pic'] = $_POST['pic'];
        $_clean = _mysql_string($_clean);
        
        // 写入数据库
        _query("INSERT INTO js_article (
                                            js_username,
                                            js_face,
                                            js_title,
                                            js_content,
                                            js_pic,
                                            js_date
                                            )
                                    VALUES (
                                            '{$_clean['username']}',
                                            '{$_clean['face']}',
                                            '{$_clean['title']}',
                                            '{$_clean['content']}',
                                            '{$_clean['pic']}',
                                            NOW()
                        )");
        if (_affected_rows() == 1) {
            // 获取刚刚新增的id
            $_clean['id'] = _insert_id();
            // 关闭数据库
            _close();
            _session_destroy();
            _location('文章发表成功', 'detail.php?id=' . $_clean['id']);
        } else {
            // 关闭数据库
            _close();
            _session_destroy();
            _alert_back('文章发表失败', 'write.php');
        }
    }
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
<script type="text/javascript"
	src="xheditor-1.2.2/jquery/jquery-1.4.4.min.js"></script>
<script type="text/javascript"
	src="xheditor-1.2.2/xheditor-1.2.2.min.js"></script>
<script type="text/javascript"
	src="xheditor-1.2.2/xheditor_lang/zh-tw.js"></script>
<title>简书--写文章</title>
</head>
<body>
	<!-- 导航栏开始 -->
    <?php
    require ROOT_PATH . 'includes/header.inc.php';
    ?>
	<!-- 导航栏结束 -->

	<div id="write" class="container" style="background: #fff;">
		<div class="row">
			<div class="col-xs-12">
				<form method="post" action="?action=write" name='write'>
					<div class="form-group">
						<label for="exampleInputEmail1">标题</label> <input type="text"
							name="title" class="form-control" id="exampleInputEmail1"
							placeholder="请输入标题">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">封面图片</label> <input type="file"
							name="pic" class="form-control" id="exampleInputEmail1">
					</div>
					<div class="form-group">
						<label for="exampleInputEmail1">内容</label>
						<textarea name="content" class="xheditor form-control"></textarea>
					</div>
					<div class="row">
						<div class="col-xs-2 col-xs-offset-10">
							<input type="submit" class="btn btn-danger submit" value="发布文章" />
						</div>
					</div>

				</form>
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




