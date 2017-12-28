<?php

// 防止恶意调用
if (! defined('IN_TG')) {
    exit("Accsee Defined");
}

if (isset($_COOKIE["username"])) {
    $_rows1 = _fetch_array("SELECT
            js_username,
            js_face,
            js_qianming
            FROM
            js_user
            WHERE
            js_username='{$_COOKIE['username']}'
            ");
    
    if ($_rows1) {
        $_htmltop = array();
        $_htmltop['username'] = $_rows1['js_username'];
        $_htmltop['face'] = $_rows1['js_face'];
        $_htmltop['qianming'] = $_rows1['js_qianming'];
        
        $_htmltop = _html($_htmltop);
    } else {
        _alert_back('此用户不存在');
    }
    
    $_result1 = _query("SELECT js_id FROM js_article WHERE js_username='{$_COOKIE['username']}' ");
    $_article_num = _num_rows($_result1);
    
    $_result2 = _query("SELECT js_id FROM js_friend WHERE js_addername='{$_COOKIE['username']}' ");
    $_guanzhu_num = _num_rows($_result2);
    
    $_result3 = _query("SELECT js_id FROM js_friend WHERE js_friendname='{$_COOKIE['username']}' ");
    $_fans_num = _num_rows($_result3);
} else {
    _alert_back('非法登录');
}

?>
<div id="member_top" class="container">
	<div class="row">
		<p class=" tx">
			<a href="#"><img class="img-respnsive"
				src="images/<?php echo $_htmltop['face']?>" alt=""></a>
		</p>
	</div>
	<div class="row username">
		<h3><?php echo $_COOKIE['username']?></h3>

	</div>
	<div class="row intro">
		<p>
				<?php
    if ($_htmltop['qianming'] == null) {
        $_htmltop['qianming'] = '一句话介绍一下自己吧，让别人更了解你';
        echo $_htmltop['qianming'];
    } else {
        echo $_htmltop['qianming'];
    }
    ?>
			</p>
	</div>
</div>
<div class="container" id="member_header">
	<div class="row">
		<div class="col-xs-8">
			<ul class="nav nav-pills nav-justified">
				<li><a href="member.php">主页</a></li>
				<li><a href="member_myarticle.php">文章</a></li>
				<li><a href="#">动态</a></li>
				<li><a href="member_friend.php">好友</a></li>
			</ul>
		</div>
		<div class="col-xs-4 hidden-xs hidden-sm">
			<ul class="nav nav-pills" role="tablist">
				<li role="presentation"><a href="member_friend.php">粉丝 <span
						class="badge"><?php echo $_fans_num?></span></a></li>
				<li role="presentation"><a href="member_friend.php">关注<span
						class="badge"><?php echo $_guanzhu_num?></span></a></li>
				<li role="presentation"><a href="member_myarticle.php">文章 <span
						class="badge"><?php echo $_article_num;?></span></a></li>
			</ul>
		</div>
	</div>

</div>