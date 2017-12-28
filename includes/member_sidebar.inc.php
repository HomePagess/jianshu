<?php

// 防止恶意调用
if (! defined('IN_TG')) {
    exit("Accsee Defined");
}

?>
<div class="col-xs-2" id="member_sidebar">
	<ul class="nav nav-pills nav-stacked">
		<li role="presentation"><a href="member.php">个人信息</a></li>
		<li role="presentation"><a href="member_modify.php">修改信息</a></li>
		<li role="presentation"><a href="member_myarticle.php">发布的文章</a></li>
		<li role="presentation"><a href="#">评论回复</a></li>
		<li role="presentation"><a href="member_friend.php">我的好友</a></li>
	</ul>

</div>