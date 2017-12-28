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

function _check_uniqid($_first_uniqid, $_end_uniqid)
{
    if ((strlen($_first_uniqid) != 40) || ($_first_uniqid != $_end_uniqid)) {
        _alert_back("唯一标识符异常！");
    }
    return $_first_uniqid;
}

/**
 * _check_username() 表示检测并过滤用户名
 * 
 * @access public
 * @param string $_string
 *            受污染的用户名
 * @param int $_min_num
 *            最小位数
 * @param int $_max_num
 *            最大位数
 * @return string 过滤后的用户名
 */
function _check_username($_string, $_min_num, $_max_num)
{
    // 去掉两边的空格
    $_string = trim($_string);
    // 长度小于2位或大于20位都不行
    if (mb_strlen($_string, 'utf-8') < $_min_num || mb_strlen($_string, 'utf-8') > $_max_num) {
        _alert_back('用户名长度不能小于' . $_min_num . '位或大于' . $_max_num . '位！');
    }
    // 敏感字符限制
    $_char_pattern = "/[<>\'\"\ ]/";
    if (preg_match($_char_pattern, $_string)) {
        _alert_back('用户名不能包含敏感字符！');
    }
    // //限制敏感用户名
    // $_mg[0]="张三";
    // $_mg[1]="李四";
    // $_mg[2]="王五";
    // //告诉用户那些敏感名不能注册
    // foreach ($_mg as $value) {
    // $_mg_string.=$value.'\n';
    // }
    // //这里使用绝对匹配
    // if (in_array($_string, $_mg)) {
    // _alert_back($_mg_string.'以上敏感用户名不能注册！');
    // }
    // 将用户名转义输入
    return _mysql_string($_string);
}

function _check_modify_name($_string, $_min_num)
{
    // 去掉两边的空格
    $_string = trim($_string);
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
function _check_password($_first_psw, $_min_num)
{
    // 判断密码
    if (strlen($_first_psw) < $_min_num) {
        _alert_back('密码不能小于' . $_min_num . '位！');
    }
    
    // 返回经过加密的密码
    return sha1($_first_psw);
}

function _check_modify_psw($_string, $_min_num)
{
    // 判断密码
    if (! empty($_string)) {
        if (strlen($_string) < $_min_num) {
            _alert_back('密码不能小于' . $_min_num . '位！');
        }
    } else {
        return null;
    }
    return sha1($_string);
}

/**
 * _check_question() 返回密码提示
 * 
 * @access public
 * @param string $_string            
 * @param int $_min_num            
 * @param int $_max_num            
 * @return string
 */
function _check_question($_string, $_min_num, $_max_num)
{
    // 长度小于2位或大于20位都不行
    if (mb_strlen($_string, 'utf-8') < $_min_num || mb_strlen($_string, 'utf-8') > $_max_num) {
        _alert_back('密码提示长度不能小于' . $_min_num . '位或大于' . $_max_num . '位！');
    }
    
    return _mysql_string($_string);
}

/**
 * _check_answer() 检测密码回答
 * 
 * @param string $_ques            
 * @param string $_answ            
 * @param int $_min_num            
 * @param int $_max_num            
 * @return string
 */
function _check_answer($_ques, $_answ, $_min_num, $_max_num)
{
    // 去掉两边的空格
    $_answ = trim($_answ);
    // 长度小于2位或大于20位都不行
    if (mb_strlen($_answ, 'utf-8') < $_min_num || mb_strlen($_answ, 'utf-8') > $_max_num) {
        _alert_back('密码提示长度不能小于' . $_min_num . '位或大于' . $_max_num . '位！');
    }
    // 密码提示与回答不能一致
    if ($_ques == $_answ) {
        _alert_back('密码提示与回答不能一致！');
    }
    // 加密转回
    return _mysql_string(sha1($_answ));
}

/**
 * _check_email() 检测邮箱是否合法
 * 
 * @access public
 * @param string $_string            
 * @return string
 */
function _check_email($_string, $_min_num, $_max_num)
{
    if (! preg_match("/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i", $_string)) {
        _alert_back('邮件格式不正确！');
    }
    if (strlen($_string) < $_min_num || strlen($_string) > $_max_num) {
        _alert_back('邮件格式不正确！');
    }
    
    return _mysql_string($_string);
}

/**
 * _check_qq() 检查qq
 * 
 * @access public
 * @param int $_string            
 * @return $_string int
 */
function _check_qq($_string)
{
    if (empty($_string)) {
        return null;
    } else {
        if (! preg_match('/^[1-9]{1}[0-9]{4,9}/', $_string)) {
            _alert_back("QQ号不正确！");
        }
    }
    return _mysql_string($_string);
}

/**
 * _check_url() 检查qq
 * 
 * @access public
 * @param string $_string            
 * @return $_string string
 */
function _check_url($_string, $_max_num)
{
    if (empty($_string) || ($_string == 'http://')) {
        return null;
    } else {
        if (! preg_match("/^https?:\/\/(\w+\.)?[\w\-\.]+(\.\w+)$/", $_string)) {
            _alert_back('网址信息错误');
        }
        if (strlen($_string) > $_max_num) {
            _alert_back('网址太长！');
        }
    }
    return _mysql_string($_string);
}

function _check_post_title($_string, $_min_num, $_max_num)
{
    if (mb_strlen($_string, 'utf-8') < $_min_num || mb_strlen($_string, 'utf-8') > $_max_num) {
        _alert_back('文章标题长度不能小于' . $_min_num . '位或大于' . $_max_num . '位！');
    }
    return $_string;
}

function _check_post_content($_string, $_min_num)
{
    if (mb_strlen($_string, 'utf-8') < $_min_num) {
        _alert_back('文章内容长度不能小于' . $_min_num . '位！');
    }
    return $_string;
}

?>