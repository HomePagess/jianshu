<?php

// 定义一个常量，用来授权调用includes里的文件
define('IN_TG', true);

// 定义一个常量,用来指定本页的内容
define('SCRIPT', 'index');

// 引入公共文件
require dirname(__FILE__) . '/includes/conmon.inc.php';

// 读取帖子列表
// 分页模块
global $_pagesize, $_pagenum;
_page("SELECT js_id FROM js_article", 10);

// 从数据库里提取数据获取结果集
// 我们必须是每次重新读取结果集，而不是重新去执行SQL语句
$_result = _query("SELECT
                            js_id,
                            js_username,
                            js_face,
                            js_title,
                            js_pic,
                            js_readcount,
                            js_commentcount,
                            js_date
                       FROM
                            js_article
                   ORDER BY
                            js_date DESC
                      LIMIT
                            $_pagenum,$_pagesize
                            ");

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
<title>简书--首页</title>
</head>
<body>
	<!-- 导航栏开始 -->
    <?php
    require ROOT_PATH . 'includes/header.inc.php';
    ?>
	<!-- 导航栏结束 -->

	<!-- 轮播开始 -->
	<div class="container">
		<div id="main-carousel" class="carousel slide">
			<ol class="carousel-indicators">
				<li data-target="#main-carousel" data-slide-to="0" class="active"></li>
				<li data-target="#main-carousel" data-slide-to="1"></li>
				<li data-target="#main-carousel" data-slide-to="2"></li>
				<li data-target="#main-carousel" data-slide-to="3"></li>
				<li data-target="#main-carousel" data-slide-to="4"></li>
			</ol>
			<div class="carousel-inner">
				<div class="item active">
					<a href="#"><img src="images/lunbo1.jpg" alt=""></a>
				</div>
				<div class="item">
					<a href="#"><img src="images/lunbo2.jpg" alt=""></a>
				</div>
				<div class="item">
					<a href="#"><img src="images/lunbo3.jpg" alt=""></a>
				</div>
				<div class="item">
					<a href="#"><img src="images/lunbo4.jpg" alt=""></a>
				</div>
				<div class="item">
					<a href="#"><img src="images/lunbo5.jpg" alt=""></a>
				</div>
				<a href="#main-carousel" class="left carousel-control"
					data-slide="prev"> <span class="iconfont icon-lunboanniu-zuo"></span>
				</a> <a href="#main-carousel" class="right carousel-control"
					data-slide="next"> <span class="iconfont icon-lunboanniu-you"></span>
				</a>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$("#main-carousel").carousel({
			interval:3000,
		});
	</script>
	<!-- 轮播结束 -->

	<div class="container" id="article_msg">
		<div class="row">
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
				<div class="media article_index">

					<div class="media-body">
						<h4 class="media-heading">
							<a href="detail.php?id=<?php echo $_html['id']?>"><?php echo $_html['title']?></a>
						</h4>

						<p class="meta">
							<a href="#"><span class="iconfont icon-yuedu"></span><?php echo $_html['readcount']?></a>
							<a href="#"><span class="iconfont icon-pinglun"></span><?php echo $_html['commentcount']?></a>

						</p>
						<div class="article_index_author">
							<a href="#" class="avatar" target="_blank"><img alt=""
								src="images/<?php echo $_html['face']?>"></a> <a href="#"
								class="name" target="_blank"><?php echo $_html['username']?></a>
							<span><?php echo $_html['date']?></span>
						</div>
					</div>
					<div class="media-right article_index_pic">
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

	<!-- 底部开始 -->
	<?php
require ROOT_PATH . 'includes/footer.inc.php';
?>
	<!-- 底部结束 -->
</body>
</html>