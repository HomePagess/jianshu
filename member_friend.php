<?php

// 定义一个常量，用来授权调用includes里的文件
define('IN_TG', true);

// 定义一个常量,用来指定本页的内容
define('SCRIPT', 'member_friend');

// 引入公共文件
require dirname(__FILE__) . '/includes/conmon.inc.php';

if (isset($_COOKIE["username"])) {} else {
    _alert_back('非法登录');
}
// 分页模块
global $_pagesize, $_pagenum;
_page("SELECT js_id FROM js_friend WHERE js_friendname='{$_COOKIE['username']}' ", 10);
_page("SELECT js_id FROM js_friend WHERE js_addername='{$_COOKIE['username']}' ", 10);
// 读取好友表
$_result = _query("SELECT js_addername,js_adderface,js_friendname,js_friendface,js_date FROM js_friend WHERE js_friendname='{$_COOKIE['username']}' ORDER BY js_date DESC LIMIT $_pagenum,$_pagesize");
$_result4 = _query("SELECT js_addername,js_adderface,js_friendname,js_friendface,js_date FROM js_friend WHERE js_addername='{$_COOKIE['username']}' ORDER BY js_date DESC LIMIT $_pagenum,$_pagesize");

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
<title>简书--个人中心--好友</title>
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
						<div class="info_show row">
							<div class="col-md-5 col-md-offset-1">
								<h5>我的粉丝</h5>
								
								<?php
        
        $_html = array();
        while (! ! $_rows = _fetch_array_list($_result)) {
            $_html['addername'] = $_rows['js_addername'];
            $_html['adderface'] = $_rows['js_adderface'];
            $_html['friendname'] = $_rows['js_friendname'];
            $_html['friendface'] = $_rows['js_friendface'];
            $_html['date'] = $_rows['js_date'];
            
            ?>
								<div class="fans_list">
									<a href="javascript:;" class="fans"> <img alt=""
										src="images/<?php echo $_html['adderface']?>"> <span><?php echo $_html['addername']?></span>
									</a> <span><?php echo $_html['date']?></span>
								</div>
								<?php
        
}
        _free_result($_result);
        
        ?>
								
								
								
								
							</div>
							<div class="col-md-5 ">
								<h5>我的关注</h5>
								
								<?php
        $_focus = array();
        while (! ! $_rows = _fetch_array_list($_result4)) {
            
            $_focus['addername'] = $_rows['js_addername'];
            $_focus['adderface'] = $_rows['js_adderface'];
            $_focus['friendname'] = $_rows['js_friendname'];
            $_focus['friendface'] = $_rows['js_friendface'];
            $_focus['date'] = $_rows['js_date'];
            
            ?>
								
								<div class="focus_list">
									<a href="javascript:;" class="focus"> <img alt=""
										src="images/<?php echo $_focus['friendface']?>"> <span><?php echo $_focus['friendname']?></span>
									</a> <span><?php echo $_focus['date']?></span>
								</div>
								<?php
        }
        
        _free_result($_result1);
        ?>
							</div>
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


