<?php

// 防止恶意调用
if (! defined('IN_TG')) {
    exit("Accsee Defined");
}

// 数据库连接
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PWD', 'pj19950213qq');
define('DB_NAME', 'jianshu');

function _connect()
{
    // global表示全局
    global $_conn;
    if (! $_conn = mysql_connect(DB_HOST, DB_USER, DB_PWD)) {
        exit('数据库连接失败');
    }
}

function _select_db()
{
    if (! @mysql_select_db(DB_NAME)) {
        exit('找不到指定的数据库');
    }
}

function _set_names()
{
    if (! mysql_query('SET NAMES UTF8')) {
        exit('字符集错误');
    }
}

function _query($_sql)
{
    if (! $_result = mysql_query($_sql)) {
        exit('SQL执行失败！' . mysql_error());
    }
    return $_result;
}

/**
 * _fetch_array($_sql)只能获取一条数组
 * 
 * @param unknown $_sql            
 * @return unknown
 */
function _fetch_array($_sql)
{
    return mysql_fetch_array(_query($_sql), MYSQL_ASSOC);
}

/**
 * _fetch_array_list($_result) 可以返回指定数据集的所有数据
 * 
 * @param unknown $_result            
 * @return unknown
 */
function _fetch_array_list($_result)
{
    return @mysql_fetch_array($_result, MYSQL_ASSOC);
}

function _num_rows($_result)
{
    return mysql_num_rows($_result);
}

/**
 * 销毁结果集
 * 
 * @param unknown $_result            
 */
function _free_result($_result)
{
    mysql_free_result($_result);
}

function _is_repeat($_sql, $_info)
{
    if (_fetch_array($_sql)) {
        _alert_back($_info);
    }
}

/**
 * _affected_rows() 表示影响到的记录数
 * 
 * @return unknown
 */
function _affected_rows()
{
    return mysql_affected_rows();
}

function _close()
{
    if (! mysql_close()) {
        exit('关闭异常');
    }
}

/**
 * 获取新增的id
 * 
 * @return unknown
 */
function _insert_id()
{
    return mysql_insert_id();
}

?>