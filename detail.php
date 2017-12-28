<?php
session_start();
// 定义一个常量，用来授权调用includes里的文件
define('IN_TG', true);

// 定义一个常量,用来指定本页的内容
define('SCRIPT', 'detail');

// 引入公共文件
require dirname(__FILE__) . '/includes/conmon.inc.php';

// 读出数据
if (isset($_GET['id'])) {
    $_rows = _fetch_array("SELECT
                                    js_id,
                                    js_username,
                                    js_title,
                                    js_face,
                                    js_content,
                                    js_readcount,
                                    js_commentcount,
                                    js_date
                               FROM
                                    js_article
                               WHERE
                                    js_id='{$_GET['id']}'");
    // 累积阅读量
    _query("UPDATE js_article SET js_readcount=js_readcount+1 WHERE js_id='{$_GET['id']}'");
    
    if ($_rows) {
        $_html = array();
        $_html['id'] = $_rows['js_id'];
        $_html['username'] = $_rows['js_username'];
        $_html['face'] = $_rows['js_face'];
        $_html['title'] = $_rows['js_title'];
        $_html['content'] = $_rows['js_content'];
        $_html['readcount'] = $_rows['js_readcount'];
        $_html['commentcount'] = $_rows['js_commentcount'];
        $_html['date'] = $_rows['js_date'];
        
        // 加好友入数据库
        if ($_GET['action'] == 'addfriend') {
            $_rows8 = _fetch_array("SELECT js_face FROM js_user WHERE js_username='{$_COOKIE['username']}'");
            
            _query("INSERT INTO js_friend (
                                                js_addername,
                                                js_adderface,
                                                js_friendname,
                                                js_friendface,
                                                js_date
                                            ) 
                                        VALUES (
                                                '{$_COOKIE['username']}',
                                                '{$_rows8[js_face]}',
                                                '{$_html['username']}',
                                                '{$_html['face']}',
                                                NOW()
                                            )");
            if (_affected_rows() == 1) {
                // 关闭数据库
                _close();
                _session_destroy();
                _location('恭喜你加好友成功', 'detail.php?id=' . $_html['id']);
            } else {
                // 关闭数据库
                _close();
                _session_destroy();
                _location('很遗憾你加好友失败', 'detail.php?id=' . $_html['id']);
            }
        }
        
        if ($_GET['action'] == 'comment') {
            $_rows3 = _fetch_array("SELECT js_face FROM js_user WHERE js_username='{$_COOKIE['username']}'");
            $_clean = array();
            $_clean['commenter_face'] = $_rows3['js_face'];
            $_clean['commenter'] = $_COOKIE['username'];
            $_clean['content'] = $_POST['content'];
            $_clean['article_id'] = $_html['id'];
            
            // 插入评论表
            _query("INSERT INTO js_comment
                                                (
                                                js_commenter,
                                                js_commenter_face,
                                                js_content,
                                                js_article_id,
                                                js_date
                                                )
                                        VALUES
                                                (
                                                '{$_clean['commenter']}',
                                                '{$_clean['commenter_face']}',
                                                '{$_clean['content']}',
                                                '{$_clean['article_id']}',
                                                NOW()
                                                )
                                        ");
            
            // 累积评论数
            _query("UPDATE js_article SET js_commentcount=js_commentcount+1 WHERE js_id='{$_GET['id']}'");
            if (_affected_rows() == 1) {
                // 关闭数据库
                _close();
                _session_destroy();
                _location('恭喜你评论成功', 'detail.php?id=' . $_html['id']);
            } else {
                // 关闭数据库
                _close();
                _session_destroy();
                _location('很遗憾你评论失败', 'detail.php?id=' . $_html['id']);
            }
        }
        // 读取评论列表
        // 分页模块
        global $_pagesize, $_pagenum;
        _page("SELECT js_id FROM js_comment WHERE js_article_id='{$_html['id']}'", 10);
        
        // 从数据库里提取数据获取结果集
        // 我们必须是每次重新读取结果集，而不是重新去执行SQL语句
        $_result = _query("SELECT
                                    js_id,
                                    js_commenter,
                                    js_commenter_face,
                                    js_content,
                                    js_date
                               FROM
                                    js_comment
                              WHERE
                                    js_article_id='{$_html['id']}'
                           ORDER BY
                                    js_date DESC
                              LIMIT
                                    $_pagenum,$_pagesize
                ");
        $_result1 = _query("SELECT js_id FROM js_comment WHERE js_article_id='{$_html['id']}'");
        $_article_num = _num_rows($_result1);
        
        // 插入回复表
        if ($_GET['action'] == 'reply') {
            $_rows1 = _fetch_array("SELECT js_face FROM js_user WHERE js_username='{$_COOKIE['username']}'");
            $_rows6 = _fetch_array("SELECT js_id FROM js_comment WHERE js_article_id='{$_html['id']}'");
            $_clean = array();
            $_clean['replyer_face'] = $_rows1['js_face'];
            $_clean['replyer'] = $_COOKIE['username'];
            $_clean['content'] = $_POST['re_content'];
            $_clean['reply_obj_id'] = $_POST['comment_id'];
            
            // 插入回复表
            _query("INSERT INTO js_reply
                    (
                    js_reply_obj_id,
                    js_replyer,
                    js_content,
                    js_replyer_face,
                    js_date
                    )
                    VALUES
                    (
                    '{$_clean['reply_obj_id']}',
                    '{$_clean['replyer']}',
                    '{$_clean['content']}',
                    '{$_clean['replyer_face']}',
                    NOW()
                    )
                    ");
            
            if (_affected_rows() == 1) {
                // 关闭数据库
                _close();
                _session_destroy();
                _location('恭喜你回复成功', 'detail.php?id=' . $_html['id']);
            } else {
                // 关闭数据库
                _close();
                _session_destroy();
                _location('很遗憾你回复失败', 'detail.php?id=' . $_html['id']);
            }
        }
    } else {
        _alert_back('不存在这个文章');
    }
} else {
    _alert_back('非法操作');
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
<script type="text/javascript" src="js/detail.js"></script>
<script src="fonts/iconfont.js"></script>
<title>简书--个人中心--文章详情</title>
<style type="text/css">
.icon {
	width: 1em;
	height: 1em;
	fill: currentColor;
	overflow: hidden;
}
</style>
</head>
<body>
	<!-- 导航栏开始 -->
    <?php
    require ROOT_PATH . 'includes/header.inc.php';
    ?>
	
	<div class="container" id="detail">
		<div class="row">
			<h4 class="title"><?php echo $_html['title']?></h4>
			<div class="user row">
				<a href="#" class="col-md-2 name"><img alt=""
					src="images/<?php echo $_html['face']?>">&nbsp;&nbsp;<?php echo $_html['username']?></a>
				<?php
    // 读取好友表
    $_result2 = _query("SELECT js_addername,js_friendname FROM js_friend WHERE js_addername='{$_COOKIE['username']}' AND js_friendname='{$_html['username']}' LIMIT 1");
    
    $_rows5 = _fetch_array_list($_result2);
    
    if ($_rows5) {
        
        ?>
    			
    				        <a href="javascript:;" class="col-md-2 focus"> <svg
						class="icon" aria-hidden="true">
    				                <use xlink:href="#icon-xiangmuyiguanzhu01"></use>
    				            </svg>
				</a>
				            
			            <?php } else{ ?>
				   					<a href="?id=<?php echo $_html['id']?>&action=addfriend"
					class="col-md-2 focus"> <svg class="icon" aria-hidden="true">
            				                <use xlink:href="#icon-guanzhu"></use>
            				            </svg>
				</a>
				   		<?php }?>
    				
    			  
				
				
				
				<span class="col-md-4 meta"> <a href="#"> <svg class="icon"
							aria-hidden="true">
                          <use xlink:href="#icon-yuedu"></use>
                        </svg> <span><?php echo $_html['readcount']?></span>
				</a> <a href="#"> <svg class="icon" aria-hidden="true">
                          <use xlink:href="#icon-pinglun"></use>
                        </svg> <span><?php echo $_html['commentcount']?></span>
				</a>

				</span> <span class="col-md-3 time"><?php echo $_html['date']?></span>
			</div>
			<div class="content"><?php echo $_html['content']?></div>
			
			<?php
if (isset($_COOKIE['username'])) {
    $_rows2 = _fetch_array("SELECT js_face FROM js_user WHERE js_username='{$_COOKIE['username']}'");
    if ($_rows2) {
        $_com = array();
        $_com['face'] = $_rows2['js_face'];
    }
    ?>
			<div class="comment row">
				<div class="col-md-10 col-md-offset-1 col-lg-offset-2 ">
					<form method="post"
						action="?id=<?php echo $_html['id']?>&action=comment" class="row">
						<div class="col-xs-2 col-md-1 ">
							<a href="#" class="name"><img alt=""
								src="images/<?php echo $_com['face']?>"></a>
						</div>
						<div class="col-xs-9">
							<div class="form-group">
								<textarea class="form-control" name="content"></textarea>
							</div>
							<div class="form-group send">
								<input type="submit" class="btn btn-default" value="发表" />
							</div>
						</div>
					</form>
				</div>
			</div>

			<div class="comment_list row">
				<div class="col-md-10 col-md-offset-1 col-lg-offset-2 ">
					<p><?php echo $_article_num?> 条评论</p>
					
					<?php
    $_html = array();
    while (! ! $_rows4 = _fetch_array_list($_result)) {
        $_htmls['comment_id'] = $_rows4['js_id'];
        $_htmls['commenter'] = $_rows4['js_commenter'];
        $_htmls['commenter_face'] = $_rows4['js_commenter_face'];
        $_htmls['content'] = $_rows4['js_content'];
        $_htmls['date'] = $_rows4['js_date'];
        
        ?>
					<div class="comment_wrap">
						<div class="comment_author">
							<a href="#" class="name"><img alt=""
								src="images/<?php echo $_htmls['commenter_face']?>"> <?php echo $_html['commenter']?></a>
							<span><?php echo $_htmls['date']?></span>
						</div>
						<div class="comment_content">
    						<?php echo $_htmls['content']?>
    					</div>

						<div class="reply">
							<a class="reply_btn"> <svg class="icon" aria-hidden="true">
                                  <use xlink:href="#icon-huifu"></use>
                                </svg> <span>回复</span>
							</a>

							<form method="post"
								action="?id=<?php echo $_html['id']?>&action=reply"
								class="row reply_form">
								<input type="hidden" name="comment_id"
									value="<?php echo $_htmls['comment_id']?>" />
								<div class="col-md-10">
									<div class="form-group">
										<textarea class="form-control" name="re_content"></textarea>
									</div>
									<div class="form-group send">
										<input type="submit" class="btn btn-default" value="发表" />
									</div>
								</div>

							</form>
						</div>

						<div class="reply_list row">
    					<?php
        $_reply = array();
        while (! ! $_rows7 = _fetch_array_list($_results)) {
            $_reply['replyer'] = $_rows7['js_replyer'];
            $_reply['reply_obj_id'] = $_rows7['js_reply_obj_id'];
            $_reply['replyer_face'] = $_rows7['js_replyer_face'];
            $_reply['content'] = $_rows7['js_content'];
            $_reply['date'] = $_rows7['js_date'];
            
            if ($_reply['reply_obj_id'] == $_html['com'])
            ?>
    						<div class="col-sm-8 col-sm-offset-1">
								<div class="comment_author">
									<a href="#" class="name"><img alt=""
										src="images/<?php echo $_reply['replyer_face']?>"> <?php echo $_reply['replyer']?></a>
									<span><?php echo $_reply['date']?></span>
								</div>
								<div class="comment_content">
            						<?php echo $_reply['content']?>
            					</div>
							</div>
						<?php }?>
    					</div>
					</div>
					<?php
    
}
    _free_result($_result);
    _paging(2);
    ?>
					
				</div>
			</div>
			
			<?php }else {?>
				<div>
				请先<a href="login.php">登录！！</a>登录后才能评论和查看评论
			</div>
			
			<?php }?>
		</div>
	</div>

	<!-- 底部开始 -->
	<?php
require ROOT_PATH . 'includes/footer.inc.php';
?>
	<!-- 底部结束 -->
</body>
</html>







