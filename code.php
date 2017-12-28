<?php
session_start();

// 定义一个常量，用来授权调用includes里的文件
define('IN_TG', true);

// 引入公共文件
require dirname(__FILE__) . '/includes/conmon.inc.php';

// 运行验证码函数
// 默认验证码大小为75*25（第一二个参数是验证码图片的宽高），默认位数是4位验证码（第三个参数）
// 第四个参数是是否需要边框，要的话true,不要的话false,默认是false
_code(80, 30, 4, false);

?>