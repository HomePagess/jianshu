<?php

/**
 * _runtime()是用来获取执行耗时的：获取开始加载的时间-获取加载完成的时间
 * @access public 表示函数对外公开
 * @return float 表示函数返回出来的是一个浮点型数字
 */
function _runtime()
{
    $_mtime = explode(' ', microtime());
    return $_mtime[1] + $_mtime[0];
}

/*
 * _alert() 表示JS弹窗
 * @access public
 * @param $_)info
 * @return void弹窗
 */
function _alert_back($_info)
{
    echo "<script>alert('$_info');history.back();</script>";
    exit();
}

function _location($_info, $_url)
{
    if (! empty($_info)) {
        echo "<script>alert('$_info');location.href='$_url';</script>";
        exit();
    } else {
        header('Location:' . $_url);
    }
}

/**
 * 登录状态的判断
 */
function _login_state()
{
    if (isset($_COOKIE['username'])) {
        _alert_back('登录状态无法进行本操作！');
    }
}

/**
 * 清除session
 */
function _session_destroy()
{
    session_destroy();
}

/**
 * 删除cookies
 */
function _unsetcookies()
{
    setcookie('username', '', time() - 1);
    setcookie('uniqid', '', time() - 1);
    _session_destroy();
    _location(null, 'index.php');
}

function _sha1_uniqid()
{
    return sha1(uniqid(rand(), true));
}

/**
 * _code()是验证码函数
 * 
 * @access public
 * @param int $_width
 *            表示验证码的宽度
 * @param int $_height
 *            表示验证码的高度
 * @param int $_rand_num
 *            表示验证码的位数
 * @param bool $_flag
 *            表示验证码是否边框
 * @return void 这个函数执行后产生一个验证码
 */
function _code($_width = 75, $_height = 25, $_rand_num = 4, $_flag = false)
{
    for ($i = 0; $i < $_rand_num; $i ++) {
        $_nmsg .= dechex(mt_rand(0, 15));
    }
    
    $_SESSION['code'] = $_nmsg;
    
    // 创建一张图像
    $_img = imagecreatetruecolor($_width, $_height);
    // 创建白色
    $_white = imagecolorallocate($_img, 255, 255, 255);
    // 填充
    imagefill($_img, 0, 0, $_white);
    
    // 是否能需要边框
    if ($_flag) {
        // 创建黑色
        $_black = imagecolorallocate($_img, 0, 0, 0);
        // 创建边框
        imagerectangle($_img, 0, 0, $_width - 1, $_height - 1, $_black);
    }
    
    // 随机画出6个线条
    for ($i = 0; $i < 6; $i ++) {
        $_rand_color = imagecolorallocate($_img, mt_rand(0, 255), mt_rand(0, 255), mt_rand(0, 255));
        imageline($_img, mt_rand(0, $_width), mt_rand(0, $_height), mt_rand(0, $_width), mt_rand(0, $_height), $_rand_color);
    }
    
    // 随机雪花
    for ($i = 0; $i < 100; $i ++) {
        $_rand_color = imagecolorallocate($_img, mt_rand(200, 255), mt_rand(200, 255), mt_rand(200, 255));
        imagestring($_img, 1, mt_rand(0, $_width), mt_rand(0, $_height), '*', $_rand_color);
    }
    
    // 输出验证码
    for ($i = 0; $i < strlen($_SESSION['code']); $i ++) {
        $_rand_color = imagecolorallocate($_img, mt_rand(0, 100), mt_rand(0, 150), mt_rand(0, 200));
        imagestring($_img, mt_rand(3, 5), $i * $_width / $_rand_num + mt_rand(0, 10), mt_rand(1, $_height / 2), $_SESSION['code'][$i], $_rand_color);
    }
    
    // 输出图像
    header("Content-Type: image.png");
    imagepng($_img);
    // 销毁
    imagedestroy($_img);
}

function _check_code($_start_code, $_end_code)
{
    if ($_start_code != $_end_code) {
        _alert_back('验证码不正确！');
    }
}

/**
 * 标题截取函数
 * 
 * @param unknown $_string            
 * @return string
 */
function _title($_string, $_num)
{
    if (mb_strlen($_string, 'utf-8') > $_num) {
        $_string = mb_substr($_string, 0, $_num, 'utf-8') . '...';
    }
    return $_string;
}

/**
 * _html() 表示对字符串进行HTML过滤，如果是数组就按数组的方式过滤，如果是单独的字符串就按字符串放手过滤
 * 
 * @param unknown $_string            
 * @return string
 */
function _html($_string)
{
    if (is_array($_string)) {
        foreach ($_string as $_key => $_value) {
            $_string[$_key] = _html($_value); // 这里采用了递归，如果不理解，那么还是用htmlspecialchars（$_value）
        }
    } else {
        $_string = htmlspecialchars($_string);
    }
    return $_string;
}

function _mysql_string($_string)
{
    if (! GPC) {
        if (is_array($_string)) {
            foreach ($_string as $_key => $_value) {
                $_string[$_key] = _mysql_string($_value); // 这里采用了递归，如果不理解，那么还是用htmlspecialchars（$_value）
            }
        } else {
            $_string = mysql_real_escape_string($_string);
        }
    }
    
    return $_string;
}

function _page($_sql, $_size)
{
    // 将所有的变量做成全局变量，外部可以访问
    global $_pagesize, $_pagenum, $_page, $_pageabsolute, $_num;
    if (isset($_GET['page'])) {
        $_page = $_GET['page'];
        if (empty($_page) || $_page <= 0 || ! is_numeric($_page)) {
            $_page = 1;
        } else {
            $_page = intval($_page);
        }
    } else {
        $_page = 1;
    }
    
    $_pagesize = $_size; // 每页多少条
                       // 获得页码首先要得到所有的数据
    $_num = _num_rows(_query($_sql));
    if ($_num == 0) {
        $_pageabsolute = 1;
    } else {
        $_pageabsolute = ceil($_num / $_pagesize);
    }
    if ($_page > $_pageabsolute) {
        
        $_page = $_pageabsolute;
    }
    $_pagenum = ($_page - 1) * $_pagesize;
}

/**
 * _paging()分页函数
 * 
 * @param unknown $_type
 *            return 分页
 */
function _paging($_type)
{
    global $_page, $_pageabsolute, $_num;
    if ($_type == 1) {
        echo '<div id="page_num">';
        echo '<ul class="clear">';
        for ($i = 0; $i < $_pageabsolute; $i ++)
            if ($_page == $i + 1) {
                echo '<li><a class="active" href="blog.php?page=' . ($i + 1) . '">' . ($i + 1) . '</a></li>';
            } else {
                echo '<li><a href="blog.php?page=' . ($i + 1) . '">' . ($i + 1) . '</a></li>';
            }
        echo '</ul>';
        echo '</div>';
    } elseif ($_type == 2) {
        echo '<div id="page_text">';
        echo '<ul>';
        echo '<li>' . $_page . '/' . $_pageabsolute . '页 |</li>';
        echo '<li>共有<strong>' . $_num . '</strong>条数据 |</li>';
        if ($_page == 1) {
            echo '<li>首页 |</li>';
            echo '<li>上一页 |</li>';
        } else {
            echo '<li><a href="' . SCRIPT . '.php">首页</a> |</li>';
            echo '<li><a href="' . SCRIPT . '.php?page=' . ($_page - 1) . '">上一页</a> |</li>';
        }
        if ($_page == $_pageabsolute) {
            echo '<li>下一页 |</li>';
            echo '<li>尾页 </li>';
        } else {
            echo '<li><a href="' . SCRIPT . '.php?page=' . ($_page + 1) . '">下一页</a> |</li>';
            echo '<li><a href="' . SCRIPT . '.php?page=' . $_pageabsolute . '">尾页</a> |</li>';
        }
        echo '</ul>';
        echo '</div>';
    }
}

/**
 * 判断唯一标识符是否异常
 * 
 * @param unknown $_mysql_uniqid            
 * @param unknown $_cookie_uniqid            
 */
function _uniqid($_mysql_uniqid, $_cookie_uniqid)
{
    if ($_mysql_uniqid != $_cookie_uniqid) {
        _alert_back('唯一标识符异常');
    }
}

?>