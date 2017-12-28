<?php

// 防止恶意调用
if (! defined('IN_TG')) {
    exit("Accsee Defined");
}

?>
<nav class="navbar navbar-default navbar-fixed-top" id="nav">
	<div class="container">
		<div class="navbar-header">
			<a href="index.php" class="navbar-brand logo"> <img
				src="images/Logo.png" alt="logo">
			</a>
			<button type="button" class="navbar-toggle left"
				data-toggle="collapse" data-target="#navbar-collapse">
				<span class="sr-only">切换导航</span> <span
					class="iconfont icon-zhedieanniu"></span>
			</button>
		</div>
		<div class="collapse navbar-collapse" id="navbar-collapse">
			<ul class="nav navbar-nav navbar-left">

				<li><a href="index.php" style="color: #ea6f5a;">发现</a></li>
				<li class="download">下载App
					<div class="erweima">
						<img src="./images/erweima.jpg" />
					</div>
				</li>
				<li class="search">
					<form action="#" method="post">
						<input type="text" name="search-ipt" id="search-ipt"
							placeholder="搜索" class="search-input"> <a
							href="javascript:void(null)" class="search-btn"> <span
							class="iconfont icon-sousuo"></span>
						</a>
					</form>
				</li>
			</ul>
			<a href="write.php"
				class="btn btn-default navbar-btn navbar-right write-btn hidden-sm"
				target="_blank"> <span class="iconfont icon-bianji"></span> 写文章
			</a>
			<?php
if (isset($_COOKIE['username'])) {
    echo '<a href="logout.php" class="btn btn-default navbar-btn navbar-right ">退出</a>';
    echo "\n";
    echo '<a href="member.php" class="btn btn-default navbar-btn navbar-right ">' . $_COOKIE['username'] . '</a>';
    echo "\n";
} else {
    echo '<a href="login.php" class="btn btn-default navbar-btn navbar-right ">登录</a>';
    echo "\n";
    echo '<a href="register.php" class="btn btn-default navbar-btn navbar-right ">注册</a>';
    echo "\n";
}
?>
			
		</div>

	</div>
</nav>