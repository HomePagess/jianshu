<?php

// 防止恶意调用
if (! defined('IN_TG')) {
    exit("Accsee Defined");
}

// 转换绝对路径常量
define('ROOT_PATH', substr(dirname(__FILE__), 0, - 8));

// //创建一个自动转义状态的常量
define('GPC', get_magic_quotes_gpc());

// 拒绝PHP低版本
if (PHP_VERSION < '4.1.0') {
    echo 'PHP版本太低！';
}

// //引入核心函数库
require ROOT_PATH . 'includes/global.func.php';
require ROOT_PATH . 'includes/mysql.func.php';

// //执行耗时
// define('START_TIME', _runtime());

// 数据库连接
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PWD', 'pj19950213qq');
define('DB_NAME', 'jianshu');

// 创建数据库连接
_connect();

// 选择一款数据库
_select_db();

// 选择字符集
_set_names();

?>