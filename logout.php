<?php
session_start();
// 定义一个常量，用来授权调用includes里的文件
define('IN_TG', true);

// 引入公共文件
require dirname(__FILE__) . '/includes/conmon.inc.php';

_unsetcookies();

?>