<?php

// 定义一个常量，用来授权调用includes里的文件
define('IN_TG', true);

// 定义一个常量,用来指定本页的内容
define('SCRIPT', 'member_myarticle');

// 引入公共文件
require dirname(__FILE__) . '/includes/conmon.inc.php';

// 分页模块
global $_pagesize, $_pagenum;
_page("SELECT js_id FROM js_article WHERE js_username='{$_COOKIE['username']}' ", 10);

// 从数据库里提取数据获取结果集
// 我们必须是每次重新读取结果集，而不是重新去执行SQL语句
$_result = _query("SELECT
                            js_id,
                            js_username,
                            js_face,
                            js_title,
                            js_content,
                            js_pic,
                            js_readcount,
                            js_commentcount,
                            js_date
                       FROM
                            js_article
                      WHERE
                            js_username='{$_COOKIE['username']}'
                   ORDER BY
                            js_date
                       DESC
                       LIMIT
                            $_pagenum,$_pagesize
        ");

global $_article_num;

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
<title>简书--个人中心--文章</title>
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
						<h4>我发布的文章</h4>
						<div class="info_show row">
						<?php
    $_html = array();
    while (! ! $_rows = _fetch_array_list($_result)) {
        $_html['id'] = $_rows['js_id'];
        $_html['username'] = $_rows['js_username'];
        $_html['face'] = $_rows['js_face'];
        $_html['title'] = $_rows['js_title'];
        $_html['pic'] = $_rows['js_pic'];
        $_html['readcount'] = $_rows['js_readcount'];
        $_html['commentcount'] = $_rows['js_commentcount'];
        $_html['date'] = $_rows['js_date'];
        
        ?>
							<div class="col-lg-6 col-md-8 col-md-offset-2 col-lg-offset-0">
								<div class="media myarticle">

									<div class="media-body">
										<h4 class="media-heading">
											<a href="detail.php?id=<?php echo $_html['id']?>"><?php echo $_html['title']?></a>
										</h4>

										<p class="meta">
											<a href="#"><span class="iconfont icon-yuedu"></span><?php echo $_html['readcount']?></a>
											<a href="#"><span class="iconfont icon-pinglun"></span><?php echo $_html['commentcount']?></a>

										</p>
										<div class="author">
											<a href="#" class="avatar" target="_blank"><img alt=""
												src="images/<?php echo $_html['face']?>"></a> <a href="#"
												class="name" target="_blank"><?php echo $_html['username']?></a>
											<span><?php echo $_html['date']?></span>
										</div>
									</div>
									<div class="media-right myarticle_pic">
										<a href="#"> <img class="media-object"
											src="images/<?php echo $_html['pic']?>" alt="...">
										</a>
									</div>
								</div>
							</div>
							
    						<?php
    
}
    _free_result($_result);
    _paging(2);
    ?>
    						
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


