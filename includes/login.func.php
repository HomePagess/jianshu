<?php

// 防止恶意调用
if (! defined('IN_TG')) {
    exit("Accsee Defined");
}

// 判断_alert_back()函数如果不存在，则退出程序
if (! function_exists('_alert_back')) {
    exit('alert_back()函数不存在，请检查！');
}

if (! function_exists('_mysql_string')) {
    exit('_mysql_string()函数不存在！');
}

function _setcookies($_username, $_uniqid, $_time)
{
    setcookie('username', $_username);
    setcookie('uniqid', $_uniqid);
    switch ($_time) {
        case 0: // 浏览器进程
            setcookie('username', $_username);
            setcookie('uniqid', $_uniqid);
            break;
        case 1: // 一天
            setcookie('username', $_username, time() + 86400);
            setcookie('uniqid', $_uniqid, time() + 86400);
            break;
        case 2: // 一周
            setcookie('username', $_username, time() + 604800);
            setcookie('uniqid', $_uniqid, time() + 604800);
            break;
        case 3: // 一月
            setcookie('username', $_username, time() + 2592000);
            setcookie('uniqid', $_uniqid, time() + 2592000);
            break;
    }
}

function _check_username($_string, $_min_num, $_max_num)
{
    // 去掉两边的空格
    $_string = trim($_string);
    // 长度小于2位或大于20位都不行
    if (mb_strlen($_string, 'utf-8') < $_min_num || mb_strlen($_string, 'utf-8') > $_max_num) {
        _alert_back('用户名长度不能小于' . $_min_num . '位或大于' . $_max_num . '位！');
    }
    // 敏感字符限制
    $_char_pattern = "/[<>\'\"\ \  ]/";
    if (preg_match($_char_pattern, $_string)) {
        _alert_back('用户名不能包含敏感字符！');
    }
    
    // 将用户名转义输入
    return _mysql_string($_string);
}

/**
 * _check_password() 验证密码
 * 
 * @access public
 * @param string $_first_psw            
 * @param string $_end_psw            
 * @param int $_min_num            
 * @return string $_first_psw 返回的是一个加密密码
 */
function _check_password($_string, $_min_num)
{
    // 判断密码
    if (strlen($_string) < $_min_num) {
        _alert_back('密码不能小于' . $_min_num . '位！');
    }
    
    // 返回经过加密的密码
    return sha1($_string);
}

function _check_time($_string)
{
    return _mysql_string($_string);
}

?>